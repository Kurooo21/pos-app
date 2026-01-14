@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-extrabold text-teal-custom">Manajemen Menu</h2>
        <a href="{{ route('menus.create') }}" class="bg-teal-custom text-white py-4 px-8 rounded-xl hover:bg-teal-dark font-extrabold shadow-lg hover:scale-105 transition-all text-xl">
            <i class="fa-solid fa-plus mr-3"></i> Tambah Menu
        </a>
    </div>

    <div class="bg-white rounded-[20px] shadow-lg overflow-hidden border border-gray-100 flex flex-col">
        <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-teal-custom text-white">
                    <th class="p-6 border-b text-xl font-bold">Gambar</th>
                    <th class="p-6 border-b text-xl font-bold">Nama Menu</th>
                    <th class="p-6 border-b text-xl font-bold">Kategori</th>
                    <th class="p-6 border-b text-xl font-bold">Harga</th>
                    <th class="p-6 border-b text-xl font-bold w-[180px]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr class="hover:bg-teal-50 transition-colors border-b border-gray-100 last:border-none">
                    <td class="p-6">
                        <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="w-24 h-20 object-cover rounded-xl shadow-sm">
                    </td>
                    <td class="p-6 font-bold text-gray-800 text-xl">{{ $menu->name }}</td>
                    <td class="p-6 capitalize text-lg text-gray-600 font-medium">
                         <span class="px-4 py-2 bg-gray-100 rounded-full">{{ $menu->category }}</span>
                    </td>
                    <td class="p-6 text-xl font-bold text-teal-custom">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td class="p-6">
                        <div class="flex gap-4">
                            <a href="{{ route('menus.edit', $menu->id) }}" class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all text-xl shadow-sm border border-blue-100" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-12 h-12 flex items-center justify-center bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all text-xl shadow-sm border border-red-100" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
