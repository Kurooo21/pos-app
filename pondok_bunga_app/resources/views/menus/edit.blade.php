@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-teal-custom">Edit Menu</h2>
    </div>

    <div class="bg-white p-8 rounded-[15px] shadow-md max-w-2xl">
        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="name" value="{{ $menu->name }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50" required>
            </div>

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Harga</label>
                    <input type="number" name="price" value="{{ $menu->price }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                    <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50">
                        <option value="food" {{ $menu->category == 'food' ? 'selected' : '' }}>Food</option>
                        <option value="drink" {{ $menu->category == 'drink' ? 'selected' : '' }}>Drink</option>
                        <option value="desert" {{ $menu->category == 'desert' ? 'selected' : '' }}>Desert</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Gambar</label>
                <div class="mb-2">
                    <img src="{{ $menu->image }}" alt="Current Image" class="w-32 h-24 object-cover rounded-md">
                </div>
                <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50">
                <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('menus.index') }}" class="bg-gray-500 text-white py-2 px-6 rounded-lg hover:bg-gray-600 font-bold">Cancel</a>
                <button type="submit" class="bg-teal-custom text-white py-2 px-6 rounded-lg hover:bg-teal-dark font-bold shadow-md">Update</button>
            </div>
        </form>
    </div>
@endsection
