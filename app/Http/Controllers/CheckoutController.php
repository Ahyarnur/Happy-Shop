<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Monitor;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $cartItems = Cart::where('user_id', auth()->id())->where('is_checkout', false)->get();
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

        
        foreach (Cart::where('user_id', auth()->id())->where('is_checkout', false)->get() as $item) {
            // $order->items()->create([
            //     'product_id' => $item->product_id,
            //     'quantity' => $item->quantity,
            //     'price' => $item->product->harga,
            // ]);
            
            $item->is_checkout = true;
            $item->save();
            Monitor::create([
                'cart_id' => $item->id,
                'is_done' => false
            ]);
        }
        

        if(User::find(Auth::id())->usertype === "user") {
            return redirect()->route('dashboarduser')->with('success','Order berhasil diproses! Silahkan hubungi nomer di samping untuk info lebih lanjut')->with('link','http://wa.me/6281390796503');    
        }
        return redirect()->route('dashboard')->with('success','Order berhasil diproses! Silahkan hubungi nomer di samping untuk info lebih lanjut')->with('link','http://wa.me/6281390796503');
    }

    public function removeFromMonitor($id)
    {
        $cart = Monitor::find($id);

        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    
}
