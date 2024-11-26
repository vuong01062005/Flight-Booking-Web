<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/transaction-list', function () {
    return view('transaction_list');
})->name('transaction_list');

Route::get('/my-bookings', function () {
    return view('my_bookings');
})->name('my_bookings');

Route::get('register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('send-verification-code', [RegisterController::class, 'sendVerificationCode'])->name('send.verification.code');
Route::post('verify-code', [RegisterController::class, 'verifyCode'])->name('verify.code');

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/index', [HomeController::class, 'index']);

Route::get('/edit_profile', [HomeController::class, 'edit_profile'])->name('edit_profile');

Route::get('/flight_list', [HomeController::class, 'flight_list'])->name('flight_list');
Route::get('/form_info', [HomeController::class, 'form_info'])->name('form_info');

Route::post('/pay', [HomeController::class, 'pay'])->name('pay');
Route::post('/update-chair', [HomeController::class, 'updateChair'])->name('updateChair');

Route::post('/booking-ticket', [HomeController::class, 'booking_ticket'])->name('booking_ticket');

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::post('/check-flight-code', [AdminController::class, 'checkFlightCode']);
Route::post('/add_flight', [AdminController::class, 'add_flight'])->name('add_flight');
Route::get('/add-flight', function () {
    return view('admin.home');
})->name('add-flight-form');
Route::get('/flight-list', function () {
    return view('admin.flight_list');
})->name('flight-list-form');
Route::get('/admin-customer-contact', function () {
    return view('admin.customer_contact');
})->name('admin-customer-contact');

Route::get('/admin-customer-ticket/{id}', [AdminController::class, 'getCustomerTicketByID'])->name('admin-customer-ticketByID');
Route::get('/admin-customer-contactByID/{id}', [AdminController::class, 'getCustomerContactByID'])->name('admin-customer-contactByID');
Route::get('/admin-customer-ticket', [AdminController::class, 'getCustomerTicket'])->name('admin-customer-ticket');