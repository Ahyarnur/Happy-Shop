<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Produk tidak ditemukan');
        }

        if ($product->quantity < 1) {
            return redirect()->back()->with('error', 'Produk ini sudah habis');
        }

        // $cart = Session::get('cart', []);

        // if (isset($cart[$id])) {
        //     $cart[$id]['quantity']++;
        // } else {
        //     $cart[$id] = [
        //         "name" => $product->nama,
        //         "quantity" => 1,
        //         "price" => $product->harga,
        //         "description" => $product->deskripsi,
        //         "photo" => $product->foto
        //     ];
        // }

        // Kurangi stok produk setelah menambah ke keranjang
        $product->quantity -= 1;
        $product->save();

        // Session::put('cart', $cart);

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => 1
        ]);


        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function cart()
    {
        return view('cart');
    }

    public function removeFromCart($id)
    {
        $cart = Cart::find($id);

        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function updateCart(Request $request)
{
    $cart = Cart::find($request->id);

    if ($request->action == 'increase') {
        $cart->quantity += 1;
    } elseif ($request->action == 'decrease' && $cart->quantity > 1) {
        $cart->quantity -= 1;
    }

    $cart->save();

    return response()->json([
        'quantity' => $cart->quantity,
        'total' => $cart->product->harga * $cart->quantity,
    ]);
}
}
