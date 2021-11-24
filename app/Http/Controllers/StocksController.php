<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseStockRequest;
use App\Http\Requests\SearchRequest;
use App\Models\PurchasedStock;
use App\Repositories\StocksRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StocksController extends Controller
{
    private StocksRepository $stocksRepository;

    public function __construct(StocksRepository $stocksRepository)
    {
        $this->stocksRepository = $stocksRepository;
    }

    public function search(SearchRequest $request)
    {
        $companies = $this->stocksRepository->getCompanies($request);

        return view('companies', ['companies' => $companies]);
    }

    public function viewCompany(string $symbol)
    {
        $company = $this->stocksRepository->getBySymbol($symbol);
        $quote = $this->stocksRepository->getQuote($symbol);

        return view('company', ['company' => $company, 'quote' => $quote]);
    }

    public function purchase(PurchaseStockRequest $request, string $symbol)
    {

        if (!$this->stocksRepository->purchaseStock($request, $symbol))
        {
            return view('invalidPurchase');
        }

        return view( '/dashboard');
    }

    public function viewMyStocks()
    {
        $myStocks = $this->stocksRepository->getMyStocks();
        $userIncome = Auth::user()->total_income;

        return view('myStocks', ['myStocks' => $myStocks, 'income' => $userIncome]);
    }

    public function sellStock(Request $request, PurchasedStock $myStock)
    {
        $this->stocksRepository->sellStock($request, $myStock);

        return view('/dashboard');
    }
}
