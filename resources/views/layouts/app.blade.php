<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="utf-8">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.1/dist/flowbite.min.css" />
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <script src="resources/js/app.js" type="text/javascript"></script>  
    @stack('jquery')
    @stack('styles')      
    <title>@yield('titulo')</title>    
</head>
<body class="bg-gray-100">    
    @if ($_SERVER["REQUEST_URI"] != '/login' && $_SERVER["REQUEST_URI"] != '/register')
        <header class="p-5 border-b bg-white shadow ">
            <div class="container mx-auto px-10 flex justify-between items-center">
            <h1 class="text-3xl font-black fa-solid fa-flip" style="--fa-animation-duration: 3s; --fa-animation-iteration-count: 1;"><a href="{{route('home')}}">MokshaBook</a></h1>
                @auth
                <nav class="flex gap-2 items-center">
                    
                    <a class="flex items-center gap-2 px-2 py-1 rounded-lg text-sm text-white font-semibold uppercase cursor-pointer shadow hover:text-white hover:bg-sky-800 bg-sky-500 hover:bg-opacity-100 mr-5" href="{{route('posts.create')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                    </svg>
                    Crear
                    </a>                   

                    <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="font-medium hover:text-gray-600 text-lg text-center inline-flex items-center " type="button">{{auth()->user()->username}}</button>

                    <!-- Dropdown menu -->
                    <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div>{{auth()->user()->name}}</div>
                            <div class="font-medium truncate">{{auth()->user()->email}}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                            <li>
                                <a href="{{route('posts.index', auth()->user()->username)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mi perfil</a>
                            </li>
                            <li>
                                <a href="{{route('profile.index', auth()->user()->username)}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editar perfil</a>
                            </li>                        
                        </ul>
                        <div class="py-2">
                            <form action="{{route('logout')}}" method="POST" class="block hover:bg-gray-100  dark:hover:bg-gray-600">
                                @csrf
                                <button type="submite" class="px-4 py-2 text-red-500  dark:hover:text-white " href="{{ route('logout') }}">Cerrar Sesion</button>
                            </form>
                        </div>
                    </div>
                                                                
                </nav> 
                @endauth
                
                @guest
                <nav class="flex gap-2 items-center">            
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                    <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>                
                </nav>
                @endguest
                        
            </div>        
        </header>    
    @endif
    

    <main class="container mx-auto mt-10">        
        @yield('contenido')
    </main>

    <footer class="text-center  p-5 text-gray-500 font-bold uppercase mt-10">
        MokshaBook - Todos los derechos reservados {{now()->year}} <br>        
        Proyecto desarrollado por <br>
        <a href="" class="text-neutral-800 italic hover:text-blue-600 ">Andrei Chiorian</a> 
    </footer>
    
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
</html>