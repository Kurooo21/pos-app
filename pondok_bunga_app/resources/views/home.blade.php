@extends('layouts.app')

@section('content')
    <header class="grid grid-cols-3 items-center mb-5 gap-x-20">
        <div class="leading-tight justify-self-start">
             <img src="{{ asset('images/logo_v2.png') }}" alt="Warung Pondok Bunga" class="h-32 w-auto object-contain">
        </div>
        
        <div class="search-bar relative justify-self-center">
            <style>
                @keyframes breathe {
                    0%, 100% { box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-color: transparent; }
                    50% { box-shadow: 0 0 15px rgba(20, 184, 166, 0.3); border-color: rgba(20, 184, 166, 0.5); }
                }
                .animate-breathe {
                    animation: breathe 3s infinite ease-in-out;
                }
                .search-bar:focus-within .animate-breathe {
                    animation: none; /* Stop animation when typing */
                }
            </style>
            <form action="{{ route('home') }}" method="GET">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu disini..." class="w-[400px] py-3 px-5 rounded-[50px] border border-transparent bg-white shadow-[0_2px_10px_rgba(0,0,0,0.05)] outline-none focus:ring-2 focus:ring-teal-custom transition-all animate-breathe">
            </form>
        </div>

        <div></div>
    </header>

    <div class="mb-6">
        <h3 class="text-base font-normal mb-2.5 capitalize">navbar</h3>
        <div class="flex gap-[15px]">
            <a href="{{ route('home') }}" class="py-2 px-6 rounded-[5px] font-semibold cursor-pointer text-sm {{ !request('category') ? 'bg-teal-dark text-white' : 'bg-teal-custom text-white hover:bg-teal-dark' }}">All</a>
            <a href="{{ route('home', ['category' => 'food']) }}" class="py-2 px-6 rounded-[5px] font-semibold cursor-pointer text-sm {{ request('category') == 'food' ? 'bg-teal-dark text-white' : 'bg-teal-custom text-white hover:bg-teal-dark' }}">Food</a>
            <a href="{{ route('home', ['category' => 'drink']) }}" class="py-2 px-6 rounded-[5px] font-semibold cursor-pointer text-sm {{ request('category') == 'drink' ? 'bg-teal-dark text-white' : 'bg-teal-custom text-white hover:bg-teal-dark' }}">Drink</a>
            <a href="{{ route('home', ['category' => 'desert']) }}" class="py-2 px-6 rounded-[5px] font-semibold cursor-pointer text-sm {{ request('category') == 'desert' ? 'bg-teal-dark text-white' : 'bg-teal-custom text-white hover:bg-teal-dark' }}">Desert</a>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-5">
        @forelse($menus as $menu)
        <div class="bg-white rounded-[15px] p-3 shadow-[0_4px_15px_rgba(0,0,0,0.05)] flex flex-col h-[260px] group transition-all hover:scale-[1.02] hover:shadow-lg border border-transparent hover:border-teal-50">
            <div class="w-full h-[140px] bg-gray-200 bg-cover bg-center rounded-[12px] mb-3" style="background-image: url('{{ $menu->image }}');"></div>
            
            <div class="flex flex-col flex-grow">
                <h4 class="text-sm font-bold text-gray-800 line-clamp-2 mb-1">{{ $menu->name }}</h4>
                
                <div class="mt-auto flex justify-between items-end">
                    <span class="font-extrabold text-lg text-teal-custom">Rp {{ number_format($menu->price/1000, 0) }}k</span>
                    
                    <form action="{{ route('cart.add', $menu->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-8 h-8 bg-teal-custom rounded-full text-white hover:bg-teal-dark transition-all flex items-center justify-center shadow-md transform active:scale-95">
                            <i class="fa-solid fa-plus text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-4 flex flex-col items-center justify-center py-20 text-gray-400">
            <i class="fa-solid fa-cookie-bite text-6xl mb-4 opacity-50"></i>
            <p class="text-xl font-bold text-gray-500">Pencarian anda tidak ada</p>
            <p class="text-sm">Coba cari dengan kata kunci lain.</p>
        </div>
        @endforelse
    </div>
@endsection

@section('sidebar-right')
<aside class="w-[320px] bg-white p-[25px] flex flex-col shadow-[-2px_0_10px_rgba(0,0,0,0.05)] shrink-0 h-full">
    <div class="flex items-center gap-2.5 mb-5">
        @if(auth()->user()->avatar)
            <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-[45px] h-[45px] rounded-full object-cover shadow-sm bg-white">
        @else
            <div class="w-[45px] h-[45px] bg-gray-300 rounded-full flex items-center justify-center text-gray-500">
                <i class="fa-solid fa-user"></i>
            </div>
        @endif
        <div class="leading-tight">
            <h4 class="text-sm font-bold">{{ auth()->user()->name ?? 'Guest Defaults' }}</h4>
            <span class="text-xs text-gray-500">{{ auth()->user()->email ?? 'guest' }}</span>
        </div>
        <div class="ml-auto flex gap-[5px]">
             <div class="w-[30px] h-[30px] bg-[#E0E0E0] rounded-full"></div>
             <div class="w-[30px] h-[30px] bg-[#E0E0E0] rounded-full"></div>
        </div>
    </div>

    <hr class="border-0 border-t-2 border-[#f0f0f0] mb-5">
    
    <div class="flex-grow flex flex-col overflow-hidden">
        <h3 class="text-base mb-5 font-bold">Order Details</h3>
        
        <div class="overflow-y-auto flex-grow pr-2">
            @php
                $displayItems = session('cart') ?? session('last_order_details');
                $isReadOnly = !session('cart') && session('last_order_details');
            @endphp

            @if($displayItems)
                @foreach($displayItems as $id => $details)
                <div class="flex items-center mb-5 bg-gray-50 p-2 rounded-lg {{ $isReadOnly ? 'opacity-80' : '' }}">
                    <div class="w-12 h-12 bg-gray-300 rounded-md mr-2.5 shrink-0" style="background-image: url('{{ $details['image'] }}'); background-size: cover;"></div>
                    <div class="flex-grow">
                        <h4 class="text-sm font-bold">{{ $details['name'] }}</h4>
                        <span class="block text-xs font-bold text-[#333]">{{ number_format($details['price'], 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if(!$isReadOnly)
                        <!-- Decrease -->
                        <form action="{{ route('cart.decrease', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-6 h-6 bg-red-100 text-red-500 rounded flex items-center justify-center hover:bg-red-200">
                                <i class="fa-solid fa-minus text-xs"></i>
                            </button>
                        </form>
                        @endif

                        <span class="text-sm font-bold">{{ $details['quantity'] }}</span>

                        @if(!$isReadOnly)
                        <!-- Increase -->
                        <form action="{{ route('cart.add', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-6 h-6 bg-teal-100 text-teal-custom rounded flex items-center justify-center hover:bg-teal-200">
                                <i class="fa-solid fa-plus text-xs"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <div class="flex flex-col items-center justify-center h-40 text-gray-400">
                    <i class="fa-solid fa-cart-shopping text-3xl mb-2"></i>
                    <p class="text-sm">Cart is empty</p>
                </div>
            @endif
        </div>
    </div>

    <form action="{{ route('orders.store') }}" method="POST" class="mt-auto pt-4">
        @csrf
        
        <!-- Recipient / Table Name Input -->
        <div class="mb-[15px]">
            <label class="block font-bold mb-[5px] text-sm">Table / Recipient</label>
            <input type="text" name="customer_name" placeholder="Enter name / Table No." required class="bg-[#eee] border-none py-2 px-[15px] rounded-[20px] w-full text-sm focus:ring-2 focus:ring-teal-custom outline-none">
        </div>

        <div class="flex justify-between font-bold text-sm mb-4">
            <span>Customer ID</span>
            <span class="font-extrabold">#{{ str_pad(session('print_order_id') ?? $nextOrderId, 4, '0', STR_PAD_LEFT) }}</span>
        </div>

        @php 
            $total = 0; 
            if($displayItems) {
                foreach($displayItems as $details) {
                    $total += $details['price'] * $details['quantity'];
                }
            }
        @endphp

        <div class="flex justify-between items-center mb-4 border-t pt-4">
            <span class="font-bold text-lg">Total</span>
            <span class="font-bold text-xl text-teal-custom">Rp <span id="total-text">{{ number_format($total, 0, ',', '.') }}</span></span>
            <input type="hidden" id="raw-total" value="{{ $total }}">
        </div>

        <div class="mb-4">
            <div class="flex justify-between items-center mb-2">
                 <label class="font-bold text-sm">Bayar (Rp)</label>
                 <input type="number" id="paid-input" name="paid_amount" placeholder="0" class="bg-gray-100 border-none rounded-lg px-3 py-1 text-right font-bold text-gray-800 w-32 focus:ring-2 focus:ring-teal-custom outline-none" required min="0">
            </div>
            <div class="flex justify-between items-center text-gray-500">
                 <span class="font-bold text-sm">Kembali</span>
                 <span class="font-bold text-lg" id="change-text">Rp 0</span>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const total = parseInt(document.getElementById('raw-total').value);
                const paidInput = document.getElementById('paid-input');
                const changeText = document.getElementById('change-text');

                paidInput.addEventListener('input', function() {
                    const paid = parseInt(this.value) || 0;
                    const change = paid - total;
                    changeText.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(change);
                    
                    if(change < 0) {
                        changeText.classList.add('text-red-500');
                        changeText.classList.remove('text-teal-custom');
                    } else {
                        changeText.classList.remove('text-red-500');
                        changeText.classList.add('text-teal-custom');
                    }
                });
            });
        </script>

        <div class="flex gap-3 mt-4">
            @if(session('print_order_id'))
                {{-- Mode Setelah Bayar: Tombol Cetak & Transaksi Baru --}}
                 <a href="{{ route('orders.print', session('print_order_id')) }}" 
                   target="_blank" 
                   class="flex-1 bg-yellow-500 text-white py-3 rounded-[15px] font-bold text-base hover:bg-yellow-600 transition-colors shadow-md flex items-center justify-center gap-2">
                    <i class="fa-solid fa-print"></i> Cetak
                </a>

                {{-- FORM KHUSUS UNTUK TOMBOL TRANSAKSI BARU (CLEAR) --}}
                {{-- Kita gunakan formaction atau form terpisah. Karena ini dalam form order, kita sebaiknya buat tombol ini submit ke route clear, tapi karena form induk ke orders.store, kita butuh cara lain. --}}
                {{-- Solusi: Gunakan tag <a> atau button type="button" dengan form terpisah via JS, ATAU button form attribute (HTML5) --}}
                <button type="submit" form="clear-session-form" class="flex-1 bg-teal-custom text-white py-3 rounded-[15px] font-bold text-base hover:bg-teal-dark transition-colors shadow-md">
                    Selesai
                </button>
            @else
                {{-- Mode Sebelum Bayar: Tombol Cetak (Disabled) & Bayar --}}
                <a href="#" 
                   class="flex-1 py-3 rounded-[15px] font-bold text-base transition-colors shadow-md flex items-center justify-center gap-2 bg-gray-300 text-gray-500 cursor-not-allowed pointer-events-none">
                    <i class="fa-solid fa-print"></i> Cetak
                </a>
                
                <button type="submit" class="flex-1 bg-teal-custom text-white py-3 rounded-[15px] font-bold text-base hover:bg-teal-dark transition-colors shadow-md">
                    Bayar
                </button>
            @endif
        </div>
    </form>
    
    {{-- Hidden Form untuk Clear Session --}}
    <form id="clear-session-form" action="{{ route('orders.clear') }}" method="POST" class="hidden">
        @csrf
    </form>
</aside>
@endsection
