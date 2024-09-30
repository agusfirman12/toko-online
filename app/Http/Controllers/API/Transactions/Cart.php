<?php

namespace App\Http\Controllers\API\Transactions;

use Midtrans\Snap;
use App\Models\Transaction;
use App\Models\Transaction_detile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class Cart extends Controller
{
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
