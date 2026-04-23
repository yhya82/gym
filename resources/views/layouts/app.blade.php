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
            
                <aside id="sidebar" class="overflow-y-scroll h-screen p-4 lg:p-8 fixed lg:relative z-30 inset-y-0 left-0 w-80 -translate-x-full lg:translate-x-0 transition duration-300 bg-blue-900">
                    <div class="mt-16">
                      <p class="text-3xl lg:text-5xl text-white font-serif">Gym Mangement System</p>
                    </div>
                    <ul class="flex flex-col space-y-4 lg:space-y-7 mt-10 lg:mt-32 text-white">
                         @if(auth()->user()->role =='owner')
                        <div class="flex space-x-2">
                            <i class="fa-regular fa-house text-2xl lg:text-4xl text-gray-200"></i>
                            <a href="{{route('dashboard')}}" class="text-2xl lg:text-4xl hover:text-gray-400" >Dashboard</a>
                        </div>
                        @endif
                        <div class="flex space-x-2">
                            <i class="fa-solid fa-users text-2xl lg:text-4xl text-gray-200"></i>
                            <a href="{{route('members.web.index')}}" class="text-2xl lg:text-4xl hover:text-gray-400" >Members</a>
                        </div>
                        @if(auth()->user()->role =='owner')
                         <div class="flex space-x-2">
                            <i class="fa-solid fa-globe text-2xl lg:text-4xl text-gray-200"></i>
                            <a href="{{route('plans.index')}}" class="text-2xl lg:text-4xl hover:text-gray-400" >Plans</a>
                        </div>
                        
                        <div class="flex space-x-2">
                            <i class="fa-solid fa-circle-user text-2xl lg:text-4xl text-gray-200"></i>
                            <a href="{{route('users.index')}}" class="text-2xl lg:text-4xl hover:text-gray-400" >Users</a>
                        </div>
                        
                         <div class="flex space-x-2">
                            <i class="fa-solid fa-gear text-2xl lg:text-4xl text-gray-200"></i>
                            <a href="{{route('audit')}}" class="text-2xl lg:text-4xl hover:text-gray-400" >Audit Logs</a>
                        </div>
                        @endif
                    </ul>
                    <div class="fixed bottom-8 bg-red-700 hover:bg-red-400 p-2 lg:p-6 text-center rounded-xl">
                        <form action="{{route('logout')}}" Method="POST">
                            @csrf
                            <button type="submit" class="text-white text-3xl lg:text-4xl "> Logout</button>
                        </form>
                    </div>
                </aside>
            
                <button id="btn" class="lg:hidden  absolute top-2 left-2 z-40"><i class="fa-solid fa-bars text-3xl"></i></button>
                
            
            <!--main content -->
            <main class="flex-1 overflow-y-scroll px-4 lg:px-16 ">
                @yield('content')

                @yield('scripts')
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
