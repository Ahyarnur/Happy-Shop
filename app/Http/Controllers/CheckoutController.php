<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });

        return view('checkout', compact('cartItems', 'total'));
    }

    public function processCheckout(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        
        $order = new Order();
        $order->user_id = auth()->id();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->total = $request->total;
        $order->payment_method = $request->payment_method;
        $order->save();

        
        foreach (Cart::where('user_id', auth()->id())->get() as $item) {
            // $order->items()->create([
            //     'product_id' => $item->product_id,
            //     'quantity' => $item->quantity,
            //     'price' => $item->product->harga,
            // ]);
            
            $item->delete();
        }

        return redirect()->route('dashboard')->with('success','Order berhasil diproses! Silahkan hubungi nomer di samping')->with('link','http://wa.me/6281390796503');
    }


    
}
