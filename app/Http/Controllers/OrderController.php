<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\RecentOrders;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth::id())->with('product')->get();
        return view('orders.index', compact('orders'));
    }

     public function store()
    {
        $cartItems = Cart::where('user_id', auth::id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty.');
        }

        $totalPrice = $cartItems->sum(function($item){
            return $item->product->price * $item->quantity;
        });

        // Create order with all cart items combined
        $order = Order::create([
            'user_id' => auth::id(),
            'product_id' => $cartItems->first()->product->id,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        // Create recent orders entries for tracking
        foreach ($cartItems as $item) {
            RecentOrders::create([
                'user_id' => auth::id(),
                'order_id' => $order->id,
                'product_id' => $item->product->id,
                'quantity' => $item->quantity,
                'total_price' => $item->product->price * $item->quantity,
                'status' => 'pending'
            ]);
        }

        // Clear the cart
        Cart::where('user_id', auth::id())->delete();

        return redirect('/orders')->with('success', 'Order placed successfully!');
    }
    
}
