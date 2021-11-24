<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedStock extends Model
{
    use HasFactory;

    protected $table = 'users_stocks';

    protected $fillable = [
        'stock_name',
        'stock_symbol',
        'stock_amount',
        'price',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
