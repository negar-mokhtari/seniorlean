<?php

namespace App\Http\Controllers\User\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function payment()
    {
        $token = "70e913014ab0f3c01e59d75860569dffcdeec80dca8a9950fd10f1df3236aab6";
        $res_number = Str::random();
        $args = [
            "amount" => 1000,
            "payerName" => auth()->user()->first_name,
            "returnUrl" => route('user.payment.callback'),
            "clientRefId" => $res_number
        ];

        $payment = new \PayPing\Payment($token);

        try {
            $payment->pay($args);
        } catch (Exception $e) {
            throw $e;
        }
        //echo $payment->getPayUrl();

        return redirect($payment->getPayUrl());
    }
    public function callback()
    {

    }

}
