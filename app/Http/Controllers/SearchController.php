<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
   public function index(Request $request)
{
    $query = trim($request->search);

    if ($query === '') {
        return redirect()->back();
    }

    // Products
    $products = Product::where('name', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->get();

    // Cart items (logged-in user)
    $carts = Cart::where('user_id', Auth::id())
        ->whereHas('product', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })
        ->get();

    // Orders (search by USER NAME)
    $orders = Order::whereHas('user', function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })
        ->with('user') // eager load user
        ->get();

    return view('search.results', compact(
        'query',
        'products',
        'carts',
        'orders'
    ));
}
}
