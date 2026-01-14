<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Pondok Bunga - POS System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F5F7F9] h-screen overflow-hidden font-sans">

    <div class="container mx-auto flex h-full max-w-full">
        <!-- Sidebar Left -->
        <aside class="w-[80px] bg-teal-custom flex flex-col items-center pt-5 shrink-0">
            <div class="text-white text-2xl mb-10"><i class="fa-solid fa-chef-hat"></i></div>
            <nav class="flex flex-col gap-[30px] w-full items-center">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-white text-teal-custom shadow-md' : 'text-teal-light' }} text-[22px] p-2.5 rounded-[10px] transition-all duration-300 hover:bg-white hover:text-teal-custom hover:shadow-md">
                    <i class="fa-solid fa-house"></i>
                </a>
                <a href="{{ route('menus.index') }}" class="{{ request()->routeIs('menus.*') ? 'bg-white text-teal-custom shadow-md' : 'text-teal-light' }} text-[22px] p-2.5 rounded-[10px] transition-all duration-300 hover:bg-white hover:text-teal-custom hover:shadow-md">
                    <i class="fa-solid fa-burger"></i>
                </a>
                 <a href="{{ route('notes.index') }}" class="{{ request()->routeIs('notes.*') ? 'bg-white text-teal-custom shadow-md' : 'text-teal-light' }} text-[22px] p-2.5 rounded-[10px] transition-all duration-300 hover:bg-white hover:text-teal-custom hover:shadow-md">
                    <i class="fa-solid fa-clipboard-list"></i>
                </a>
                <a href="{{ route('stocks.index') }}" class="{{ request()->routeIs('stocks.*') ? 'bg-white text-teal-custom shadow-md' : 'text-teal-light' }} text-[22px] p-2.5 rounded-[10px] transition-all duration-300 hover:bg-white hover:text-teal-custom hover:shadow-md">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </a>
                <a href="{{ route('settings.index') }}" class="{{ request()->routeIs('settings.*') ? 'bg-white text-teal-custom shadow-md' : 'text-teal-light' }} text-[22px] p-2.5 rounded-[10px] transition-all duration-300 hover:bg-white hover:text-teal-custom hover:shadow-md">
                    <i class="fa-solid fa-gear"></i>
                </a>
                 <!-- Auth Link (Login/Logout) -->
                 @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-teal-light text-[22px] p-2.5 rounded-[10px] transition-all duration-300 hover:bg-white hover:text-teal-custom hover:shadow-md">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                 @else
                    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'bg-white text-teal-custom shadow-md' : 'text-teal-light' }} text-[22px] p-2.5 rounded-[10px] transition-all duration-300 hover:bg-white hover:text-teal-custom hover:shadow-md">
                        <i class="fa-solid fa-user"></i>
                    </a>
                 @endauth
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-[20px_30px] overflow-y-auto flex flex-col">
            @if(session('success'))
                <div class="bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                 <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            @yield('content')
        </main>

        <!-- Sidebar Right (Yield or Component) -->
        @yield('sidebar-right')
    </div>
</body>
</html>
