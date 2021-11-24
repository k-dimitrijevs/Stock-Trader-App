<?php

namespace App\Repositories;

use App\Http\Requests\PurchaseStockRequest;
use App\Http\Requests\SearchRequest;

interface StocksRepository
{
    public function getCompanies(SearchRequest $request);
    public function getBySymbol(string $symbol);
    public function getQuote(string $symbol);
    public function getMyStocks();
    public function purchaseStock(PurchaseStockRequest $request, string $symbol);
    public function validatePurchase(string $stockPrice, string $amount, string $balance): bool;
}
