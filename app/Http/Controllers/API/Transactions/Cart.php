<?php

namespace App\Http\Controllers\API\Transactions;

use Midtrans\Snap;
use App\Models\Transaction;
use App\Models\Transaction_detile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class Cart extends Controller
{

     public function __construct()
    {
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    public function index()
    {
        $cart = Transaction::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $cart_detile = Transaction_detile::with('product')->where('transaction_id', $cart->id)->get();
        if ($cart) {
            return response()->json([
                'success' => true,
                'data' => [
                    'transaction' => $cart, 
                    'detile' => $cart_detile
                    ]
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'data' => []
            ], 404);
        }
    }

    public function payment(){
        $cart = Transaction::where('user_id', auth()->user()->id)->where('status', 0)->first();

        return response()->json([
            'success' => true,
            'data' => ['snap_token' => $cart->snaps_token],
        ], 200);
    }

    public function paymentSuccess(){
        $cart = Transaction::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $cart->status = 1;
        $cart->update();
        return response()->json([
            'success' => true,
            'message' => 'Payment Success',
            'data' => [],
        ], 200);
    }
}
