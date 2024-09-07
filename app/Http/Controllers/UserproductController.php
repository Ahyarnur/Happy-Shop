<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserproductController extends Controller
{
    public function dashboarduser(){
        if(User::find(Auth::id())->usertype === 'admin') return redirect('/dashboard');
        $products = Product::latest()->paginate(20);

        return view('user.dashboarduser', compact('products'));
    }
}
