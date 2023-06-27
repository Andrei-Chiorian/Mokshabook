@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@extends('layouts.app')

@section('titulo')
Crear nueva publicacion &#8226; MokshaBook 
@endsection

@section('contenido')
    <div class="md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf
            </form>
        </div>
        <div class="md:w-1/2 px-10 bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf
                
                {{-- Entrada para el titulo
                <div class="mb-5 ">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Titulo</label>
                    <input type="text" id="titulo" name="titulo" placeholder="Introduce un nombre" value="{{old('titulo')}}" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"/>
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div> --}}

                {{-- Entrada para la descripcion --}}
                <div class="mb-5 ">
                    <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">Descripcion de la publicacion</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Describe tu publicacion" class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror">{{old('descripcion')}}</textarea>                    
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>               

                {{-- Entrada para la imagen --}}
                <div class="mb-5 ">
                    <input type="hidden" name="imagen" value="{{old('imagen')}}">
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Publicar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>    
        </div>
    </div>
@endsection