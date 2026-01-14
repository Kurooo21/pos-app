<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;


class OrderController extends Controller
{
    public function addToCart($id)
    {
        $menu = \App\Models\Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $menu->name,
                "quantity" => 1,
                "price" => $menu->price,
                "image" => $menu->image
            ];
        }

        session()->put('cart', $cart);
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function decreaseCart($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                session()->put('cart', $cart);
            } else {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        return redirect()->back();
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart');

        if(!$cart || count($cart) == 0) {
            return redirect()->back()->with('error', 'Cart is empty!');
        }

        $request->validate([
            'customer_name' => 'required|string',
            'paid_amount' => 'required|numeric|min:0',
        ]);

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Check if paid amount is sufficient
        if ($request->paid_amount < $total) {
             return redirect()->back()->with('error', 'Uang pembayaran kurang!');
        }

        $change = $request->paid_amount - $total;

        $order = \App\Models\Order::create([
            'customer_name' => $request->customer_name,
            'table_name' => $request->customer_name, 
            'total_price' => $total,
            'paid_amount' => $request->paid_amount,
            'change_amount' => $change,
            'status' => 'paid', 
            'payment_method' => 'cash',
        ]);

        foreach($cart as $id => $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        session(['print_order_id' => $order->id, 'last_order_details' => $cart]);
        
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Transaksi Berhasil!');
    }

    public function print($id)
    {
        $order = \App\Models\Order::with('items.menu')->findOrFail($id);
        return view('orders.print', compact('order'));
    }

    public function printCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('orders.print_cart', compact('cart', 'total'));
    }
    public function clearSession()
    {
        session()->forget(['print_order_id', 'last_order_details']);
        return redirect()->route('home');
    }
}
