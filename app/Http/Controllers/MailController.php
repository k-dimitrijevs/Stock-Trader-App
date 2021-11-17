<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function send(Request $request)
    {
        event(new SendMail($request->email));
        return redirect('/dashboard');
    }
}
