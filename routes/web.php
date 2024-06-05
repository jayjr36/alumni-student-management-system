<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\MentorshipOfferController;
use App\Http\Controllers\MentorshipRequestController;


Route::get('/', function () {
    return view('auth.login');
 })->name('user.login');
 Route::get('/', function () {
    return view('auth.register');
 })->name('user.register');
Route::get('/admin', function () {
    return view('admin.dashboard');
});
Route::get('/landingpage', function () {
    return view('landingpage');
})->name('landingpage');

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
Route::get('/recent-contacts', [ChatController::class, 'recentContacts'])->name('recent.contacts');
Route::get('/fetch-messages', [ChatController::class, 'fetchMessages'])->name('fetch-messages');

Route::get('/mentorship-offers', [MentorshipOfferController::class, 'index'])->name('mentorship_offers.index');
Route::get('/mentorship-offers/create', [MentorshipOfferController::class, 'create'])->name('mentorship_offers.create');
Route::post('/mentorship-offers', [MentorshipOfferController::class, 'store'])->name('mentorship_offers.store');
Route::get('/mentorship-offers/{mentorshipOffer}/edit', [MentorshipOfferController::class, 'edit'])->name('mentorship_offers.edit');
Route::put('/mentorship-offers/{mentorshipOffer}', [MentorshipOfferController::class, 'update'])->name('mentorship_offers.update');
Route::delete('/mentorship-offers/{mentorshipOffer}', [MentorshipOfferController::class, 'destroy'])->name('mentorship_offers.destroy');
Route::get('/mentorship', function () {
    return view('mentorship');
})->name('mentorship');
Route::post('/mentorship-requests', [MentorshipRequestController::class, 'store'])->name('mentorship_requests.store');
Route::get('/new/mentorship-requests', [MentorshipRequestController::class, 'index'])->name('mentorship_requests.new');
Route::post('/mentorship-requests/{mentorshipRequest}/accept', [MentorshipRequestController::class, 'accept'])->name('mentorship_requests.accept');
Route::post('/mentorship-requests/{mentorshipRequest}/reject', [MentorshipRequestController::class, 'reject'])->name('mentorship_requests.reject');
