@extends('layouts.app')
@section('titulo')
    Iniciar Sesion &#8226; MokshaBook
@endsection

@section('contenido')
<div class="md:flex justify-center mt-10 md:gap-4 md:items-center ">
       
    <div class="md:w-6/12 p-5">
        <img src="{{ asset('img/login.jpg')}}" alt="Imagen login de usuarios">
    </div>
   
    <div class="md:w-4/12 p-6 ">
        <div class="bg-white p-6 rounded-lg shadow-xl">
            <form action="{{route('login')}}" method="post" novalidate>
                @csrf         
                @if (session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>
                @endif
                <div class="mb-5 block uppercase text-gray-400 font-bold text-center">
                    <p>Inicia sesion en MokshaBook</p>
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Introduce tu email" value="{{old('email')}}" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"/>
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraeña</label>
                    <input type="password" id="password" name="password" placeholder="Introduce tu contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"/>
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="remember" class="mr-1 text-gray-500">Recuerdame</label>
                    <input type="checkbox" name="remember" id="remember">
                </div>
            
                <input type="submit" value="Iniciar Session" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    
        <div class="bg-white p-6 rounded-lg shadow-xl mt-2 text-center">
            <p>¿No tienes cuenta? <a class="text-sky-600 font-semibold hover:text-sky-700" href="{{route('register')}}">Registrate</a></p>
        </div>
    </div>
</div>
@endsection