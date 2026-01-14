@extends('layouts.app')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-teal-custom">Logistik / Stok Bahan</h2>
        <p class="text-gray-500 text-lg mt-2">Kelola stok bahan baku restoran.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Add Stock Form -->
        <div class="bg-white p-8 rounded-[20px] shadow-lg border border-gray-100 lg:col-span-1">
            <h3 class="font-bold text-xl mb-6 text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-plus-circle text-teal-custom"></i> Tambah Stok
            </h3>
            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Bahan</label>
                    <input type="text" name="name" class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50 font-semibold" placeholder="Contoh: Beras" required>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Jumlah</label>
                        <input type="number" name="quantity" class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50 font-semibold" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Satuan</label>
                        <select name="unit" class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50 font-semibold">
                            <option value="kg">Kg</option>
                            <option value="gram">Gram</option>
                            <option value="liter">Liter</option>
                            <option value="pcs">Pcs</option>
                            <option value="ikat">Ikat</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="w-full bg-teal-custom text-white py-3 px-6 rounded-xl hover:bg-teal-dark font-bold shadow-md transition-all">
                    Simpan Stok
                </button>
            </form>
        </div>

        <!-- Stock List -->
        <div class="bg-white rounded-[20px] shadow-lg overflow-hidden border border-gray-100 lg:col-span-2">
            <div class="p-6 border-b border-gray-100 bg-gray-50">
                <h3 class="font-bold text-xl text-gray-800">Daftar Stok Bahan</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white text-gray-600 border-b">
                            <th class="p-5 font-bold">Nama Bahan</th>
                            <th class="p-5 font-bold">Jumlah</th>
                            <th class="p-5 font-bold">Satuan</th>
                            <th class="p-5 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stocks as $stock)
                        <tr class="hover:bg-teal-50 transition-colors border-b border-gray-100 last:border-none">
                            <td class="p-5 font-bold text-gray-800">{{ $stock->name }}</td>
                            <td class="p-5 font-bold text-teal-custom text-lg">{{ $stock->quantity }}</td>
                            <td class="p-5 text-gray-600 font-medium capitalize">{{ $stock->unit }}</td>
                            <td class="p-5 flex justify-center gap-3">
                                <!-- Delete Action -->
                                <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" onsubmit="return confirm('Hapus stok ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-red-100 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                 <!-- Simple Edit (Update Quantity) could be added here, but for now simple delete/re-add or we can add a modal later if needed. Keeping it simple first. -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400">
                                <i class="fa-solid fa-box-open text-4xl mb-3"></i>
                                <p>Belum ada data stok.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
