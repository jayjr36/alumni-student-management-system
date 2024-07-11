<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\MentorshipOfferController;
use App\Http\Controllers\MentorshipRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

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

Route::get('/adminhome', function () {
    return view('admin.adminhome');
})->name('adminhome');

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

// routes/web.php
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::post('/forum', [ForumController::class, 'store'])->name('forum.store');
Route::put('/forum/{post}', [ForumController::class, 'update'])->name('forum.update');
Route::delete('/forum/{post}', [ForumController::class, 'destroy'])->name('forum.destroy');

Route::get('/forum/fetch-messages', [ForumController::class, 'fetchMessages'])->name('forum.fetch-messages');

Route::get('/alumni/{id}', [ProfileController::class, 'showAlumni'])->name('alumni_profile');
Route::get('/student/{id}', [ProfileController::class, 'showStudent'])->name('student_profile');


// New routes for mentor requests and mentorship management
Route::post('/alumni/{id}/request-mentor', [ProfileController::class, 'requestMentor'])->name('request.mentor');
Route::post('/admin/mentor-requests/{id}/approve', [ProfileController::class, 'approveMentorRequest'])->name('approve.mentor.request');
Route::post('/admin/mentor-requests/{id}/reject', [ProfileController::class, 'rejectMentorRequest'])->name('reject.mentor.request');
Route::post('/mentorship/{mentor_id}/{student_id}/request', [ProfileController::class, 'requestMentorship'])->name('request.mentorship');
Route::post('/mentorship/{mentor_id}/{student_id}/respond/{response}', [ProfileController::class, 'respondMentorshipRequest'])->name('respond.mentorship');

Route::get('/all/admin/mentor-requests', [AdminController::class, 'mentorRequests'])->name('admin.mentor.requests');
Route::post('/admin/mentor-requests/{id}/approve', [AdminController::class, 'approveMentorRequest'])->name('approve.mentor.request');
Route::post('/admin/mentor-requests/{id}/reject', [AdminController::class, 'rejectMentorRequest'])->name('reject.mentor.request');


Route::get('/alumni/profile', [AlumniController::class, 'showProfile'])->name('alumni.profile');
Route::get('/alumni/profile/edit', [AlumniController::class, 'editProfileForm'])->name('alumni.profile.edit');
Route::put('/alumni/profile/update', [AlumniController::class, 'updateProfile'])->name('alumni.profile.update');


Route::get('/student/profile', [StudentController::class, 'showProfile'])->name('student.profile');
Route::get('/student/profile/edit', [StudentController::class, 'editProfileForm'])->name('student.profile.edit');
Route::put('/student/profile/update', [StudentController::class, 'updateProfile'])->name('student.profile.update');

Route::get('/student/mentorship/{id}', [ProfileController::class, 'studentMentors'])->name('student.mentorship');
Route::get('/alumni/mentors/{id}', [ProfileController::class, 'alumniMentors'])->name('alumni.mentorship');


Route::get('/alumni/{id}', [AlumniController::class, 'show'])->name('alumni.show');
Route::delete('/alumni/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');
// Route to delete a student
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

// Route to view student profile (modal popup)
Route::get('/students/{id}/profile', [StudentController::class, 'profile'])->name('students.profile');