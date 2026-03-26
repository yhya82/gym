<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-200">
        <div class=" flex ">
            
                <aside id="sidebar" class="h-screen p-4 lg:p-8 fixed lg:relative z-30 inset-y-0 left-0 w-80 -translate-x-full lg:translate-x-0 transition duration-300 bg-blue-900">
                    <div class="mt-6 lg:mt-8">
                      <p class="text-3xl lg:text-5xl text-white">Gym Mangement System</p>
                    </div>
                    <ul class="flex flex-col space-y-4 lg:space-y-7 mt-10 lg:mt-32 text-white">

                        <div class="flex space-x-2">
                            <i class="fa-regular fa-house text-2xl lg:text-4xl text-gray-200"></i>
                            <a href="{{route('dashboard')}}" class="text-2xl lg:text-4xl hover:text-gray-400" >Dashboard</a>
                        </div>
                        <div class="flex space-x-2">
                            <i class="fa-solid fa-users text-2xl lg:text-4xl text-gray-200"></i>
                            <a href="" class="text-2xl lg:text-4xl hover:text-gray-400" >Members</a>
                        </div>
                        <div class="flex space-x-2">
                            <i class="fa-solid fa-globe text-2xl lg:text-4xl text-gray-200"></i>
                            <a href="{{route('plans.index')}}" class="text-2xl lg:text-4xl hover:text-gray-400" >Plans</a>
                        </div>
                        <div class="flex space-x-2">
                            <i class="fa-solid fa-circle-user text-2xl lg:text-4xl text-gray-200"></i>
                            <a href="{{route('users.index')}}" class="text-2xl lg:text-4xl hover:text-gray-400" >Users</a>
                        </div>
                    
                   
                    </ul>
                    <div class="mt-80 bg-red-700 p-2 lg:p-4 text-center">
                        <a href="" class="text-2xl lg:text-4xl text-white">Logout</a>
                    </div>
                </aside>
            
                <button id="btn" class="md:hidden  absolute top-2 left-2 z-40"><i class="fa-solid fa-bars text-3xl"></i></button>
                
            
            <!--main content -->
            <main class="flex-1 overflow-y-auto ml-0 lg:ml-80 ">
                @yield('content')

            </main>
            
        </div>
        
        <script>
            const btn = document.getElementById('btn');
            const sidebar = document.getElementById('sidebar');

            btn.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
            
        </script>

    </body>
</html>
