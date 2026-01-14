@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-teal-custom">Input Menu</h2>
    </div>

    <div class="bg-white p-8 rounded-[15px] shadow-md max-w-2xl">
        {{-- Display Global Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong class="font-bold">Ada kesalahan!</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Menu</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50 @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Harga</label>
                    <input type="number" name="price" value="{{ old('price') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50 @error('price') border-red-500 @enderror" required>
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                    <select name="category" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50 @error('category') border-red-500 @enderror">
                        <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Food</option>
                        <option value="drink" {{ old('category') == 'drink' ? 'selected' : '' }}>Drink</option>
                        <option value="desert" {{ old('category') == 'desert' ? 'selected' : '' }}>Desert</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Gambar</label>
                <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom bg-gray-50 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-400 mt-1">Format: JKPG, PNG. Max: 2MB.</p>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('menus.index') }}" class="bg-gray-500 text-white py-2 px-6 rounded-lg hover:bg-gray-600 font-bold">Cancel</a>
                <button type="submit" class="bg-teal-custom text-white py-2 px-6 rounded-lg hover:bg-teal-dark font-bold shadow-md">Simpan</button>
            </div>
        </form>
    </div>
@endsection
