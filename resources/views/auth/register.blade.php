@extends('layouts.app')

@section('titulo')
Iniciar Sesion &#8226; MokshaBook
@endsection

@section('contenido')
    <div class="md:flex justify-center mt-10 md:gap-4 md:items-center ">
       
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/register.jpg')}}" alt="Imagen registro de usuarios">
        </div>
        <div class="md:w-4/12">
            <div class=" bg-white p-6 rounded-lg shadow-xl">
                <form action="{{ route('register') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-5 block uppercase text-gray-400 font-bold text-center">
                        <p>Crea una cuenta</p>
                    </div>
                    <div class="mb-5">
                        <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                        <input type="text" id="name" name="name" placeholder="Introduce tu nombre" value="{{old('name')}}" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"/>
                        @error('name')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="mb-5">
                        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Nombre de Usuario</label>
                        <input type="text" id="username" name="username" placeholder="Introduce tu nombre de usuario" value="{{old('username')}}" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"/>
                        @error('username')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-5 ">
                        <label for="presentacion" class="mb-2 block uppercase text-gray-500 font-bold">Presentacion</label>
                        <textarea id="presentacion" name="presentacion" placeholder="Añade una presentacion para que los usuarios sepan mas acerca de ti" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">{{old('presentacion')}}</textarea>                    
                        @error('presentacion')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
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
                        <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repite tu Contraeña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Vuelve a introducir tu contraseña" class="border p-3 w-full rounded-lg @error('password_confimation') border-red-500 @enderror"/>
                        @error('password_confirmation')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                </form>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-xl mt-2 text-center">
                <p>Si ya tienes una cuenta <a class="text-sky-600 font-semibold hover:text-sky-700" href="{{route('login')}}">Inicia Sesion</a></p>
            </div>
        </div>
    </div>

@endsection