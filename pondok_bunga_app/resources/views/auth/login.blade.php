<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Warung Pondok Bunga</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen relative font-sans">

    {{-- Wave Background & Header Section --}}
    <div class="absolute top-0 left-0 w-full h-[280px] md:h-[320px] bg-gradient-to-br from-teal-custom to-teal-dark rounded-b-[40px] md:rounded-b-[60px] z-0 overflow-hidden shadow-lg">
        {{-- Decorative Circles for "Wave" effect detail --}}
        <div class="absolute top-[-50px] left-[-50px] w-32 h-32 md:w-48 md:h-48 bg-white opacity-10 rounded-full"></div>
        <div class="absolute bottom-[-20px] right-[-20px] w-40 h-40 md:w-60 md:h-60 bg-white opacity-10 rounded-full"></div>
        
        {{-- Header Text (Centering it within the colored background) --}}
        <div class="w-full h-full flex flex-col items-center justify-start pt-12 md:pt-16">
            <h1 class="text-3xl md:text-3xl font-bold text-white mb-2 drop-shadow-md text-center px-4">Welcome Back!</h1>
            <p class="text-teal-50 text-opacity-90 font-light text-sm md:text-base text-center">Login to your dashboard</p>
        </div>
    </div>

    {{-- Main Content Container --}}
    <div class="relative z-10 w-full min-h-screen flex flex-col justify-start items-center pt-[180px] md:pt-[200px] px-4 pb-10">
        
        {{-- Login Card --}}
        <div class="bg-white rounded-[30px] shadow-2xl p-8 w-full max-w-[400px] relative">
            {{-- Icon --}}
            <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
                 <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-full p-2 shadow-lg flex items-center justify-center border-[6px] border-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 md:h-12 md:w-12 text-teal-custom" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <div class="mt-8 md:mt-10">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Login</h2>

                <form action="{{ route('authenticate') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="group">
                        <label class="block text-gray-600 text-sm font-medium mb-2 ml-3 group-focus-within:text-teal-custom transition-colors">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" 
                            class="w-full px-6 py-3.5 rounded-full bg-gray-50 border border-gray-200 focus:bg-white focus:border-teal-custom focus:ring-4 focus:ring-teal-light/20 transition-all outline-none text-gray-700 placeholder-gray-400"
                            placeholder="name@example.com" required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-2 ml-3 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="group">
                        <label class="block text-gray-600 text-sm font-medium mb-2 ml-3 group-focus-within:text-teal-custom transition-colors">Password</label>
                        <input type="password" name="password" 
                            class="w-full px-6 py-3.5 rounded-full bg-gray-50 border border-gray-200 focus:bg-white focus:border-teal-custom focus:ring-4 focus:ring-teal-light/20 transition-all outline-none text-gray-700 placeholder-gray-400"
                            placeholder="••••••••" required>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-teal-custom to-teal-dark text-white font-bold py-4 rounded-full shadow-lg hover:shadow-teal-custom/40 hover:-translate-y-1 active:scale-[0.98] transition-all duration-300">
                            LOGIN
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Footer --}}
        <div class="mt-8 text-gray-400 text-xs text-center">
            &copy; {{ date('Y') }} Warung Pondok Bunga. All rights reserved.
        </div>
    </div>

</body>
</html>