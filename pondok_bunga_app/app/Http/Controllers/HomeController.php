<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Menu::query();

        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $menus = $query->get();

        // Calculate Next Order ID
        $lastOrder = \App\Models\Order::latest('id')->first();
        $nextOrderId = $lastOrder ? $lastOrder->id + 1 : 1;

        return view('home', compact('menus', 'nextOrderId'));
    }
}
