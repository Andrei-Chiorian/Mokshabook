@extends('layouts.app')

@section('titulo')
    {{$user->username}} &#8226; MokshaBook
@endsection

@section('contenido')

    <div class="flex justify-center my-10">
        <div class=" md:w-6/12 lg:w-6/12 flex flex-col item-center md:flex-row">
            <div class=" lg:w-4/12 px-5">
                <img class="rounded-full h-fit" src="{{$user->imagen ? asset('profiles' . '/' . $user->imagen) : asset('img/usuario.svg')}}" alt="Foto de perfil">
            </div>
            <div class=" px-5 flex flex-col pb-10 ">
                
                <div class="flex gap-8">
                    <p class="text-black text-3xl font-semibold">{{$user->username}}</p>
                    @auth
                        @if ($user->username == auth()->user()->username)
                            <a href="{{route('profile.index')}}">
                                <button type="button" class="text-xl font-medium border bg-gray-200 hover:bg-gray-300 shadow py-1 px-3 rounded-lg">Editar perfil</button>
                            </a>    
                        @else
                            @if ($user->siguiendo(auth()->user()))
                                <form action="{{route('users.unfollow', $user)}}" method="POST">
                                @method('DELETE')
                                @csrf                          
                                    <button type="submit" class="group cursor-pointer relative inline-block text-xl font-medium border bg-red-500 hover:bg-red-800 shadow py-1 px-3 rounded-lg">Siguiendo
                                        
                                            <div class="opacity-0 w-28 bg-black text-white text-center text-xs rounded-lg my-1 py-2 absolute z-10 group-hover:opacity-100 bottom-full -left-1/2 ml-14 px-3 pointer-events-none">
                                                Pulsa para dejar de seguir
                                                <svg class="absolute text-black h-2 w-full left-0 top-full" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve"><polygon class="fill-current" points="0,0 127.5,127.5 255,0"/></svg>
                                            </div>                                   
                                        
                                    </button>                                                        
                                </form>
                            @else                
                                <form action="{{route('users.follow', $user)}}" method="POST">
                                @csrf                          
                                    <button type="submit" class="text-xl font-medium border bg-sky-400 hover:bg-sky-800 shadow py-1 px-3 rounded-lg">Seguir</button>                            
                                </form>
                            @endif                       
                        @endif                    
                    @endauth                   
                 </div>

                <div class="flex gap-11 mt-5">
                    <p class="text-gray-800 text-lg mb-3  font-bold">
                        {{$user->followers->count()}}
                        <span class="font-semibold">@choice('Seguidor|Seguidores', $user->followers->count())</span>
                    </p>

                    <p class="text-gray-800 text-lg mb-3 font-bold">
                        {{$user->following()->count()}}
                        <span class="font-semibold"> Siguiendo</span>
                    </p>

                    <p class="text-gray-800 text-lg mb-3 font-bold">
                        {{$user->posts()->count()}}
                        <span class="font-semibold">@choice('Post|Posts', $user->posts()->count())</span>
                    </p>

                </div>

                <div class="text-xl font-semibold">
                    <p>{{$user->name}}</p>
                </div>

                <div class="text-lg">
                    <p>{{$user->presentacion}}</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="border-2">
    <section class="container px-10 mx-auto mt-20">
        
        @if ($posts->count())       

            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 ">
                @foreach ( $posts as $post )
                    <div>
                        <a class="cursor-pointer" href="{{route('posts.show', ['post'=>$post, 'user'=>$user])}}">
                            <img class="hover:shadow-black hover:shadow-lg hover:scale-105 rounded-lg" src="{{asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
                        </a>
                    </div>                    
                @endforeach
            </div>

            <div class="my-10">
                {{$posts->links('pagination::tailwind')}}
            </div>

        @else

            <p class="text-gray-600 uppercase text-sm text-center font-bold">Todavia no hay publicaciones</p>           
           

        @endif
        
    </section>
    
@endsection