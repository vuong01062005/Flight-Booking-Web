<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('send-verification-code', [RegisterController::class, 'sendVerificationCode'])->name('send.verification.code');
Route::post('verify-code', [RegisterController::class, 'verifyCode'])->name('verify.code');

Route::post('login', [LoginController::class, 'login'])->name('login');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/index', [HomeController::class, 'index']);

Route::get('/wallet/{id}', [HomeController::class, 'wallet'])->name('wallet');
Route::get('/edit_profile/{id}', [HomeController::class, 'edit_profile'])->name('edit_profile');
Route::get('/my_bookings/{id}', [HomeController::class, 'my_bookings'])->name('my_bookings');
Route::get('/transaction-list/{id}', [HomeController::class, 'transactionList'])->name('transaction_list');

Route::get('/flight_list', [HomeController::class, 'flight_list'])->name('flight_list');
Route::get('/form_info', [HomeController::class, 'form_info'])->name('form_info');
Route::post('/pay', [HomeController::class, 'pay'])->name('pay');
Route::post('/update-chair', [HomeController::class, 'updateChair'])->name('updateChair');
Route::post('/booking-ticket', [HomeController::class, 'booking_ticket'])->name('booking_ticket');
Route::post('/filter-transactions/{user_id}', [HomeController::class, 'filterTransactions'])->name('filter.transactions');

Route::post('/updateInfo/{id}', [HomeController::class, 'updateInfo'])->name('updateInfo');
Route::post('/updateAvatar/{id}', [HomeController::class, 'updateAvatar'])->name('updateAvatar');
Route::post('/updatePass/{id}', [HomeController::class, 'updatePass'])->name('updatePass');
Route::get('/change-ticket/{id}/{date}', [HomeController::class, 'changeTicket'])->name('changeTicket');
Route::post('/filter-flight', [HomeController::class, 'filterFlight'])->name('filter-flight');
Route::get('/change-ticket-info/{customer_id}/{flight_id}', [HomeController::class, 'changeTicketInfo'])->name('changeTicketInfo');
Route::post('/add-payment', [HomeController::class, 'addPayment'])->name('add-payment');
Route::post('/confirm-change', [HomeController::class, 'confirmChange'])->name('confirm-change');
Route::post('/cancel-ticket/{id}', [HomeController::class, 'cancelTicket'])->name('cancelTicket');

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
Route::get('/introduce', function () {
    return view('introduce');
})->name('introduce');
Route::get('/contact', function () {
    return view('Contact');
})->name('contact');

Route::get('/admin-customer-ticket/{id}', [AdminController::class, 'getCustomerTicketByID'])->name('admin-customer-ticketByID');
Route::get('/admin-customer-contactByID/{id}', [AdminController::class, 'getCustomerContactByID'])->name('admin-customer-contactByID');
Route::get('/admin-customer-ticket', [AdminController::class, 'getCustomerTicket'])->name('admin-customer-ticket');
Route::get('/admin-customer-account', [AdminController::class, 'getCustomerAccount'])->name('admin-customer-account');

Route::get('/update-flight/{id}', [AdminController::class, 'updateFlight'])->name('update-flight');
Route::post('/update_flightInfo', [AdminController::class, 'updateFlightInfo'])->name('update_flightInfo');
Route::post('/delete-flight/{id}', [AdminController::class, 'deleteFlight'])->name('delete-flight');
Route::get('/revenue', [AdminController::class, 'revenue'])->name('revenue');