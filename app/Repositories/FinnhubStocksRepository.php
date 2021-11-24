<?php

namespace App\Repositories;

use App\Http\Requests\PurchaseStockRequest;
use App\Http\Requests\SearchRequest;
use App\Models\PurchasedStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FinnhubStocksRepository implements StocksRepository
{
    private string $token;
    private const API_URL = 'https://finnhub.io/api/v1/';

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getCompanies(SearchRequest $request)
    {
        $companyName = strtolower($request->get('company'));
        $cacheKey = 'companies.' . Str::snake($companyName);

        if (Cache::has($cacheKey))
        {
            return Cache::get($cacheKey);
        }

        $companies = Http::get(self::API_URL .'search?q='. $companyName .'&token=' . $this->token);

        Cache::put($cacheKey, $companies->json('result'), now()->addMinutes(10));

        return $companies->json('result');
    }

    public function getBySymbol(string $symbol)
    {
        $symbol = strtoupper($symbol);
        $cacheKey = 'companies.view' . $symbol;

        if (Cache::has($cacheKey))
        {
            return Cache::get($cacheKey);
        }

        $company = Http::get(self::API_URL . 'stock/profile2?symbol='. $symbol .'&token=' . $this->token);

        Cache::put($cacheKey, $company->json(), now()->addMinutes(10));

        return $company->json();
    }

    public function getQuote(string $symbol)
    {
        $quote = Http::get( self::API_URL .'quote?symbol=' . $symbol . '&token=' . $this->token);
        return $quote->json();
    }

    public function purchaseStock(PurchaseStockRequest $request, string $symbol)
    {
        $companyName = $this->getBySymbol($symbol);
        $currentPrice = $this->getQuote($symbol)['c'];
        $amount = $request->get('stockAmount');
        $total = $currentPrice * $amount;
        $userBalance = Auth::user()->balance;
        $newBalance = $userBalance - $total;


        if (!$this->validatePurchase($currentPrice, $amount, $userBalance))
        {
            return false;
        } else {
            Auth::user()->update(['balance' => $newBalance]);
            Auth::user()->update(['total_income' => Auth::user()->total_income -= $total]);

            $purchasedStock = new PurchasedStock([
                'stock_name' => $companyName['name'],
                'stock_symbol' => $symbol,
                'stock_amount' => $amount,
                'price' => $currentPrice,
                'total' => $total,
            ]);
            $purchasedStock->user()->associate(auth()->user());
            $purchasedStock->save();

            return true;
        }
    }

    public function getMyStocks()
    {
        $purchasedStocks = PurchasedStock::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return $purchasedStocks;
    }

    public function validatePurchase(string $stockPrice, string $amount, string $balance): bool
    {
        if (($stockPrice * $amount) > $balance)
        {
            return false;
        }
        return true;
    }

    public function sellStock(Request $request, PurchasedStock $myStock)
    {
        $userBalance = Auth::user()->balance;
        $currentPrice = $this->getQuote($myStock['stock_symbol'])['c'];
        $total = $currentPrice * $request->get('amount');
        $newAmount = $myStock['stock_amount'] - $request->get('amount');

        $myStock['stock_amount'] -= $request->get('amount');
        Auth::user()->update(['balance' => $userBalance += $total]);
        Auth::user()->update(['total_income' => Auth::user()->total_income += $total]);

        $myStock->update([
            'stock_amount' => $newAmount,
        ]);

        if ($myStock['stock_amount'] == 0)
        {
            $myStock->delete();
        }
    }
}
