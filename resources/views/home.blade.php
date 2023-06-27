@push('jquery')
<script src="https://code.jquery.com/jquery-3.2.1.js" type="text/javascript"></script>
@endpush

@extends('layouts.app')
@section('titulo')
    MokshaBook
@endsection
@section('contenido')
@auth
    <div class="flex">        

        <div class="w-1/4" id="relaciones">

            <div class="flex justify-center gap-5">
                <button class="text-lg font-semibold text-black visited:text-gray-400" type="button" id="boton1">
                    Seguidos
                </button>
                <button class="text-lg font-semibold text-gray-400 visited:text-gray-400" type="button" id="boton2">
                    Siguidores
                </button>                           
            </div>

            <hr class="mt-5 border-1 border-gray-800 mx-7">            

            <div class="grid justify-center mt-2" id="seguidos">
                @if (auth()->user()->following()->count())           
                    @foreach ($following as $follow )                        
                        <div class="mt-3">
                            <div class="flex gap-3 items-center">
                                <div>                                    
                                    <img class="h-10 rounded-full" src="{{$follow->imagen ? asset('profiles'.'/' . $follow->imagen) : asset('img/usuario.svg')}}" alt="Imagen de perfil">                                    
                                </div>                                
                                <a class="font-medium hover:text-gray-500" href="{{route('posts.index', $follow->username)}}">{{$follow->username}}</a>
                                                            
                            </div>                                           
                        </div>                        
                    @endforeach
                @else
                    <div class="mx-auto mt-7">
                        <p>No sigues a nadie</p>
                    </div>
                @endif
            </div>

            <div class=" justify-center mt-2 hidden" id="seguidores">
                @if (auth()->user()->followers->count())           
                    @foreach (auth()->user()->followers as $follow )                        
                        <div class="mt-3">
                            <div class="flex gap-3 items-center">
                                <div>                                    
                                    <img class="h-10 rounded-full" src="{{$follow->imagen ? asset('profiles'.'/' . $follow->imagen) : asset('img/usuario.svg')}}" alt="Imagen de perfil">                                    
                                </div>                                
                                <a class="font-medium hover:text-gray-500" href="{{route('posts.index', $follow->username)}}">{{$follow->username}}</a>
                                                            
                            </div>                                           
                        </div>                        
                    @endforeach
                @else
                    <div class="mx-auto mt-7">
                        <p>Aun no te sigue nadie</p>
                    </div>
                @endif
            </div>  

        </div>

        <div class="w-2/4 text-center grid overflow-y-scroll scrollbar-hide max-h-screen">           
            @if ($posts->count())           
                @foreach ($posts as $post )
                    <div class="mx-auto mb-7">
                        <div class="flex gap-3 items-center">
                            <div>
                                <img class="h-10 rounded-full" src="{{$post->user->imagen ? asset('profiles'.'/' . $post->user->imagen) : asset('img/usuario.svg')}}" alt="Imagen de perfil">
                            </div>
                            <a class="font-medium hover:text-gray-500" href="{{route('posts.index', $post->user)}}">{{$post->user->username}}</a>
                            &#8226;
                            <p class=" font-light">{{$post->created_at->diffForHumans()}}</p>
                        </div>
                        
                        <div class="mt-5">
                            <div class="">
                                <a href="{{route('posts.show', ['post'=>$post, 'user'=>$post->user->username])}}">                                
                                    <img class="h-96 rounded-md" src="{{asset('uploads' . '/' . $post->imagen)}}" alt="Foto del post">
                                </a>
                            </div> 
                        </div>                   
                    </div>
                @endforeach
            @else
                <div class="mx-auto mt-7">
                    <p>No hay posts que mostrar sigue a otro usuario para ver sus posts</p>
                </div>
            @endif            
        </div>
        
        <div class="w-1/4 mx-auto text-center text-lg font-medium text-gray-600">
            Sugerencias
            <hr class="mt-5 border-1 border-gray-800 mx-7"> 
        </div>
    </div>
@endauth    
@endsection

