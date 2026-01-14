@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-teal-custom">Laporan Penjualan</h2>
        <p class="text-gray-500 text-lg mt-2">Rekapitulasi riwayat pesanan dan penghasilan.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Daily -->
        <div class="bg-white p-6 rounded-[20px] shadow-md border-l-4 border-teal-custom flex flex-col justify-between h-32">
            <h4 class="font-bold text-gray-500 text-sm uppercase">Pendapatan Hari Ini</h4>
            <p class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($dailyRevenue, 0, ',', '.') }}</p>
            <span class="text-xs text-green-500 font-bold flex items-center gap-1"><i class="fa-solid fa-calendar-day"></i> {{ date('d M Y') }}</span>
        </div>

        <!-- Weekly -->
        <div class="bg-white p-6 rounded-[20px] shadow-md border-l-4 border-blue-500 flex flex-col justify-between h-32">
             <h4 class="font-bold text-gray-500 text-sm uppercase">Minggu Ini</h4>
             <p class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($weeklyRevenue, 0, ',', '.') }}</p>
             <span class="text-xs text-blue-500 font-bold flex items-center gap-1"><i class="fa-solid fa-calendar-week"></i> Minggu ke-{{ date('W') }}</span>
        </div>

        <!-- Monthly -->
         <div class="bg-white p-6 rounded-[20px] shadow-md border-l-4 border-purple-500 flex flex-col justify-between h-32">
             <h4 class="font-bold text-gray-500 text-sm uppercase">Bulan Ini</h4>
             <p class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
             <span class="text-xs text-purple-500 font-bold flex items-center gap-1"><i class="fa-solid fa-calendar"></i> {{ date('F Y') }}</span>
        </div>

        <!-- Yearly -->
         <div class="bg-white p-6 rounded-[20px] shadow-md border-l-4 border-orange-500 flex flex-col justify-between h-32">
             <h4 class="font-bold text-gray-500 text-sm uppercase">Tahun Ini</h4>
             <p class="text-2xl font-extrabold text-gray-800">Rp {{ number_format($yearlyRevenue, 0, ',', '.') }}</p>
             <span class="text-xs text-orange-500 font-bold flex items-center gap-1"><i class="fa-solid fa-flag"></i> Tahun {{ date('Y') }}</span>
        </div>
    </div>

    <!-- Total All Time (Optional Context) -->
    <div class="mb-6 flex items-center gap-3 bg-teal-50 p-4 rounded-lg text-teal-800 font-bold border border-teal-200">
        <i class="fa-solid fa-sack-dollar text-xl"></i> Total Transaksi Seumur Hidup: Rp {{ number_format($totalRevenue, 0, ',', '.') }} ({{ $orders->count() }} Pesanan)
    </div>

    <div class="bg-white rounded-[20px] shadow-lg overflow-hidden border border-gray-100 flex flex-col">
        <div class="p-6 border-b border-gray-100 flex-shrink-0">
            <h3 class="font-bold text-xl text-gray-800">Riwayat Pesanan</h3>
        </div>
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600">
                        <th class="p-4 border-b font-bold">ID Pesanan</th>
                        <th class="p-4 border-b font-bold">Tanggal</th>
                        <th class="p-4 border-b font-bold">Pelanggan / Meja</th>
                        <th class="p-4 border-b font-bold">Total</th>
                        <th class="p-4 border-b font-bold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-none cursor-pointer group" onclick="window.open('{{ route('orders.print', $order->id) }}', '_blank')" title="Klik untuk melihat nota">
                        <td class="p-4 font-mono text-sm text-gray-500">#{{ $order->id }}</td>
                        <td class="p-4 text-gray-700">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="p-4 font-bold text-gray-800">{{ $order->customer_name }}</td>
                        <td class="p-4 font-bold text-teal-custom">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase">{{ $order->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-400">
                            Belum ada data penjualan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
