@push('jquery')
<script src="https://code.jquery.com/jquery-3.2.1.js" type="text/javascript"></script>
@endpush
@extends('layouts.app')

@section('titulo')
{{$post->user->name}} ({{$post->user->username}}) &#8226; MokshaBook 
@endsection

@section('contenido')

    <div class="container mx-auto md:px-10 md:flex mt-20">

        <div class="md:w-1/2">
            <img class="shadow-2xl rounded-md border-black" src="{{asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
        </div>

        <div class="md:w-1/2 ">

            <div class="md:h-fit ml-8 shadow bg-gray-50 rounded-t-lg p-2">
                <div class="flex flex-row items-center ">
                    <div class="flex items-center">                        
                        <img class="h-14 rounded-full" src="{{asset('profiles') . '/' . $post->user->imagen}}" alt="Imagen de perfil">
                    </div>
                    <a class="ml-4 flex flex-col items-center
                     md:items-start md:justify-center text-2xl font-bold hover:text-gray-500" href="{{route('posts.index', $post->user)}}">
                        {{$post->user->username}}                        
                    </a>
                    @auth                  
                        @if ($post->user_id != auth()->user()->id)                                                                             
                            @foreach (auth()->user()->following as $ids)
                            
                                @if ($ids->id == $post->user->id)
                                   @php
                                      $count ++
                                   @endphp                                   
                                @endif                                
                            @endforeach 
                            @if ($count == 0 )
                                <div class="mx-6 flex flex-col items-center
                                md:items-start md:justify-center text-2xl font-bold">
                                    &#8226; 
                                </div>
                                <div class=" flex flex-col items-center md:items-start md:justify-center text-lg font-bold">
                                    <form action="{{route('users.follow', $user)}}" method="POST">
                                    @csrf
                                        <button type="submit" class=" text-sky-400 hover:text-sky-800">Seguir</button>                                           
                                    </form>
                                </div>
                            @endif                             
                        @endif  
                    @endauth
                </div>                
            </div>

            

            <div class="md:h-3/6 mt-2 ml-8 max-h-96 overflow-y-scroll scrollbar-hide bg-gray-50 p-5 shadow rounded-t-lg  text-lg font-normal flex flex-col gap-5">
                    
                @if ($post->descripcion)                
                    <div>
                        <div class="flex gap-3 ">
                            <div>
                                <img class="h-10 rounded-full" src="{{asset('profiles' . '/' . $post->user->imagen)}}" alt="Imagen de perfil">
                            </div>
                            <a class="font-medium hover:text-gray-500" href="{{route('posts.index', $post->user)}}">{{$post->user->username}}</a>
                            <p>{{$post->descripcion}}</p>
                        </div>
                        
                    </div>
                @endif    
                @foreach ($comen as $comentario )
                    <div>
                        <div class="flex gap-3">
                            <div class="flex gap-3">
                                <div>
                                    <img class="h-10 rounded-full" src="{{$comentario->user->imagen ? asset('profiles'.'/' . $comentario->user->imagen) : asset('img/usuario.svg')}}" alt="Imagen de perfil">
                                </div>
                                <div class="flex">                                
                                    <a class="font-medium hover:text-gray-500" href="{{route('posts.index', $comentario->user)}}">{{$comentario->user->username}}</a>
                                </div>
                            </div>
                            <div class="">
                                <p class="">{{$comentario->comentario}}</p>
                            </div>                            
                        </div>
                        <p class="mt-1 font-light">{{$comentario->created_at->diffForHumans()}}</p>
                    </div>
                @endforeach
               
                
            </div>

            <section class="md:h-2/6 mt-2 ml-8 mb-1 flex-col">
                <div class="inline-flex gap-3 w-full bg-gray-50 shadow text-xl font-semibold p-2 rounded-t-lg">
                    
                    <div class="inline-flex gap-2 w-1/3 items-center">
                        
                        @if ($post->likes->count())
                            <div class="items-center">
                                <button id="dropdownUsersButton" data-dropdown-toggle="dropdownUsers" data-dropdown-placement="top" class="font-medium hover:text-gray-600 text-lg text-center inline-flex items-center" type="button">{{$post->likes->count()}} @choice('Like|Likes', $post->likes->count())</button>
                                <!-- Dropdown menu -->
                                <div id="dropdownUsers" class="z-10 hidden rounded-lg shadow w-60 bg-gray-100">
                                    <ul class="h-48 py-2 overflow-y-auto text-gray-700" aria-labelledby="dropdownUsersButton">                                        
                                        @foreach ($post->likes as $like )                        
                                                    <li class="px-2 mb-2">
                                                        <div class="flex gap-3 items-center">
                                                            <div>                                    
                                                                <img class="h-8 rounded-full" src="{{$like->user->imagen ? asset('profiles'.'/' . $like->user->imagen) : asset('img/usuario.svg')}}" alt="Imagen de perfil">                                    
                                                            </div>                                
                                                            <a class="font-medium text-sm hover:text-gray-500" href="{{route('posts.index', $like->user->username)}}">#{{$like->user->username}}</a>
                                                                                        
                                                        </div>                                           
                                                    </li>                        
                                        @endforeach
                                    </ul>        
                                </div>                                
                            </div>  
                        @endif

        

                        @auth                          
                            @if ($post->checkLike(auth()->user()))
                            
                                <form action="{{route('posts.likes.destroy', $post)}}" method="post" class="flex items-center">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 fill-red-600 stroke-red-600 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{route('posts.likes.store', $post)}}" method="post" class="flex items-center">
                                    @csrf
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:fill-red-600 hover:stroke-red-600 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                            <a href="#comentario" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:stroke-sky-600 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                </svg>                              
                            </a>

                            @if ($post->user_id == auth()->user()->id)
                                <form action="{{route('posts.destroy', $post)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:stroke-red-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        @endauth
                        

                    </div>
                    <div class="flex w-2/4 justify-end font-normal">{{$post->created_at->diffForHumans()}}</div>
                </div>

                @auth                       

                <div class=" mt-2 bg-gray-50 shadow text-xl font-normal rounded-lg">
                    <form action="{{route('comentarios.store',['post'=>$post ,'user'=>$user])}}" method="post" class="flex flex-col"> 
                        @csrf                  
                        <textarea id="comentario" name="comentario" rows="1" placeholder="Añade un comentario..." class="p-3  rounded-md bg-gray-50  @error('comentario') border-red-500 @enderror"></textarea>
                       
                        @if (session('mensaje'))
                            <p id="mensaje" class="bg-green-600 text-white my-2 rounded-lg text-sm p-2 text-center">{{session('mensaje')}}</p>                           
                                                        
                        @endif
                       
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                        
                        <input type="submit" value="Enviar comentario" class="bg-sky-500 hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold flex-col items-center
                        justify-center p-3 text-white rounded-lg ">
                    </form> 
                </div>

                @endauth
               
            </section>            

        </div>

    </div>

@endsection