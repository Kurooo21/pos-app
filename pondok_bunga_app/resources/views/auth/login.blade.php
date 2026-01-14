<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warung Pondok Bunga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-teal-custom flex items-center justify-center h-screen font-sans">

    <div class="bg-white p-10 rounded-[20px] shadow-lg w-[400px]">
        <h2 class="text-2xl font-bold text-center mb-6 text-teal-custom">Login Admin</h2>
        
        <form action="{{ route('authenticate') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-custom" required>
            </div>

            <button type="submit" class="w-full bg-teal-custom text-white font-bold py-2 px-4 rounded-lg hover:bg-teal-dark transition duration-300">
                Login
            </button>
        </form>
    </div>

</body>
</html>
