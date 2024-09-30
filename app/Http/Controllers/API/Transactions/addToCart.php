<?php

namespace App\Http\Controllers\API\Transactions;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Transaction_detile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class addToCart extends Controller
{
    public function store(Request $request, String $id)
    {
        $products = Product::find($id);

        if (empty($products)) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Product not found',
            ], 404);
        }else{
            $validate = $request->validate([
                'quantity' => ['required', 'numeric']
            ]);

             // count price
            $priceTotal = $products->price * $validate['quantity'];

            // check user has transaction pending
            $transactions = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();

            // check if already has transactions pending
            if (empty($transactions)) {
                // create transaction
                Transaction::create([
                    'user_id' => Auth::user()->id,
                    'status' => 0,
                    'price_total' => $priceTotal,
                    // 'transaction_code' => 'INV-'. rand(100, 999),
                ]);

                // update to assign transaction code
                $transactions = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
                $transactions->transaction_code = 'INV-' . $transactions->id.'-'.rand(100, 999);
                $transactions->update();
            }else{
                // update price total of already created transaction
                $transactions->price_total = $transactions->price_total + $priceTotal;
                $transactions->update();
            }

            // create transaction detail
            $transactionsDetile = Transaction_detile::where('transaction_id', $transactions->id)->where('product_id', $products->id)->first();
            if (empty($transactionsDetile)) {
                Transaction_detile::create([
                    'transaction_id' => $transactions->id,
                    'product_id' => $products->id,
                    'transaction_total' => $validate['quantity'],
                    'price_total' => $priceTotal,
                ]);
            }else{
                $transactionsDetile->transaction_total = $transactionsDetile->transaction_total + $validate['quantity'];
                $transactionsDetile->price_total = $transactionsDetile->price_total + $priceTotal;
                $transactionsDetile->update();
            }

            // assign snaps token for midtrans
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            if (empty($transactions->transaction_code)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Transaction code is missing',
                ], 500);
            }

            $params = array(
                'transaction_details' => array(
                    'order_id' => $transactions->transaction_code,
                    'gross_amount' => $transactions->price_total,
                )
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $transactions->snaps_token = $snapToken;
            $transactions->update();

            return response()->json([
                'success' => true,
                'data' => $transactions
            ], 200);
        }
    }
}
