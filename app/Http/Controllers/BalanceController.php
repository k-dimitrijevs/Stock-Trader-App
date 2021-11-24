<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function viewBalance()
    {
        return view('addBalance');
    }

    public function addBalance(Request $request)
    {
        $balance = $request->get('addBalance');

        Auth::user()->update(['balance' => Auth::user()->balance += $balance]);

        return redirect()->back();
    }
}
