<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class NoteController extends Controller
{
    public function index()
    {
        // Now acting as Sales Report Controller
        $orders = Order::latest()->get();
        
        $totalRevenue = Order::sum('total_price');
        
        // Advanced Stats
        $dailyRevenue = Order::whereDate('created_at', Carbon::today())->sum('total_price');
        $weeklyRevenue = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_price');
        $monthlyRevenue = Order::whereMonth('created_at', Carbon::now()->month)->sum('total_price');
        $yearlyRevenue = Order::whereYear('created_at', Carbon::now()->year)->sum('total_price');

        return view('notes.index', compact('orders', 'totalRevenue', 'dailyRevenue', 'weeklyRevenue', 'monthlyRevenue', 'yearlyRevenue'));
    }

    // Keeping store/destroy if user wants to revert or use for actual notes later, 
    // but based on request, this page is now for Sales Recap.
    // We can remove or keep them unused. check user request "bagian catataan itu adlah hasil recap dari pembelian"
    // So index is the main thing to change.
    
    public function store(Request $request)
    {
       // Unused for now
    }

    public function destroy(string $id)
    {
        // Maybe allow deleting sales history? Let's keep it safe and not implement delete for sales yet unless requested.
    }
}
