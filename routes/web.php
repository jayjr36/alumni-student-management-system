<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InteractionController;


Route::get('/', function () {
    return view('auth.login');
 })->name('user.login');
 Route::get('/', function () {
    return view('auth.register');
 })->name('user.register');
Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
Route::get('/alumni/create', [AlumniController::class, 'create'])->name('alumni.create');
Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');


Route::get('/add-post', [PostController::class, 'create'])->name('post.create');
Route::post('/add-post', [PostController::class, 'store'])->name('post.store');
Route::get('/all-posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/admin/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/admin/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/admin/posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/admin/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/interaction', [InteractionController::class, 'index'])->name('interaction');
Route::get('/search', [InteractionController::class, 'search'])->name('search');

Route::get('/chat', [ChatController::class, 'index'])->name('chat');

Route::get('/send-message', [ChatController::class, 'sendMessage'])->name('send-message');
Route::get('/receive-message', [ChatController::class, 'receiveMessage'])->name('receive-message');

Route::get('/fetch-messages', [ChatController::class, 'fetchMessages'])->name('fetch-messages');