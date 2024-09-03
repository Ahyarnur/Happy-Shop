<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // public function index()
    // {
    //     $products = Product::paginate(12);

    //     return view('products.index', compact('products'));
    // }
    public function dashboard()
    {
        $products = Product::latest()->paginate(6);

        return view('dashboard', compact('products'));
    }

    public function create(){
        return view('create');
    }
    public function createpost(Request $request){
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'quantity' => 'required|numeric|min:0',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg'
        ]);


        $foto = $request->file('foto');
        $foto->storeAs('public', $foto->hashName());

        Product::create([
            'nama' => $request->nama,
            'harga' => str_replace(".", "", $request->harga),
            'quantity' => $request->quantity,
            'deskripsi' => $request->deskripsi,
            'foto' => $foto->hashName()
            
        ]);
        
        return redirect()->route('dashboard')->with('success', 'Produk berhasil ditambahkan'); 
       
    }

    public function keranjang(){
        return view('keranjang');
    }
    public function edit($id){
        $edit = Product::find($id);
        return view('edit',compact('edit'));
    }
    public function update(Request $request, $id){
        $product = Product::find($id);
        $product->nama = $request->nama;
        $product->harga = str_replace(".", "", $request->harga);
        $product->quantity = $request->quantity;
        $product->deskripsi = $request->deskripsi;

        if ($request->file('foto')) {

            Storage::disk('local')->delete('public/'.$product->foto);
            $foto = $request->file('foto');
            $foto->storeAs('public', $foto->hashName());
            $product->foto = $foto->hashName();
        }
        

        $product->save();
        return redirect()->route('dashboard')->with('success', 'Update Product Berhasil');

    }

}
