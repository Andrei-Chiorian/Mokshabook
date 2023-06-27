<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ComentarioController;

Route::get('/',HomeController::class)->name('home');

Route::get('/Login',[LoginController::class, 'index']);

Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/follow', [FollowerController::class, 'destroy'])->name('users.unfollow');

Route::get('/editar-perfil',[ProfileController::class, 'index'])->name('profile.index');
Route::post('/editar-perfil',[ProfileController::class, 'store'])->name('profile.store');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'store']);

Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

Route::get('/{user:username}',[PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');
Route::post('/posts',[PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/post/{post}',[PostController::class, 'show'])->name('posts.show');
Route::delete('/post/{post}',[PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/imagenes',[ImageController::class, 'store'])->name('imagenes.store');

Route::post('/{user:username}/post/{post}',[ComentarioController::class, 'store'])->name('comentarios.store');
Route::delete('/post/{post}/comentario',[ComentarioController::class, 'destroy'])->name('comentarios.destroy');

Route::post('/post/{post}/likes',[LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/post/{post}/likes',[LikeController::class, 'destroy'])->name('posts.likes.destroy');

