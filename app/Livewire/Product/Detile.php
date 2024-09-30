<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use Livewire\Attributes\Validate;
use App\Models\Transaction_detile;
use Illuminate\Support\Facades\Auth;


class Detile extends Component
{
    public $product;

    #[Validate(['required', 'numeric'])]
    public $total = 1;

    public function mount($id){
            $productDetile = Product::find($id);
            
            if($productDetile){
                $this->product = $productDetile;
            }
        }

    public function addToCart(){
        $this->validate();

        // check auth
        if(!Auth::user()){
            return $this->redirectRoute('login');
        }

        // count price
        $priceTotal = $this->product->price * $this->total;

        // check user has transaction pending
        $transactions = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
        // create transaction
        if(empty($transactions)){
            Transaction::create([
                'user_id' => Auth::user()->id,
                'status' => 0,
                'price_total' => $priceTotal,
            ]);
            
            $transactions = Transaction::where('user_id', Auth::user()->id)->where('status', 0)->first();
            $transactions->transaction_code = 'INV-' . $transactions->id.'-'.rand(100, 999);
            $transactions->update();

        }else{
            $transactions->price_total = $transactions->price_total + $priceTotal;
            $transactions->update();
        }

        // create transaction detail
        $transactionsDetile = Transaction_detile::where('transaction_id', $transactions->id)->where('product_id', $this->product->id)->first();
        if(!empty($transactionsDetile)){
            $transactionsDetile->transaction_total = $transactionsDetile->transaction_total + $this->total;
            $transactionsDetile->price_total = $transactionsDetile->price_total + $priceTotal;
            $transactionsDetile->update();
        }else{
            Transaction_detile::create([
                'transaction_id' => $transactions->id,
                'product_id' => $this->product->id,
                'transaction_total' => $this->total,
                'price_total' => $priceTotal,
            ]);
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $transactions->transaction_code,
                'gross_amount' => $transactions->price_total,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transactions->snaps_token = $snapToken;
        $transactions->update();

        session()->flash('successAddToCart', 'product added to cart');

        $this->dispatch('cartUpdated');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.product.detile');
    }
}
