<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ApController;
use App\Http\Controllers\BudgetController;

Route::get('/', [InvoiceController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/ar', [InvoiceController::class, 'index']);
Route::get('/invoices', [InvoiceController::class, 'index']);
Route::post('/payers', [InvoiceController::class, 'storePayer']);
Route::post('/invoices', [InvoiceController::class, 'storeInvoice']);

Route::get('/collections', [CollectionController::class, 'index']);
Route::post('/collections', [CollectionController::class, 'store']);

Route::get('/ap', [ApController::class, 'index']);
Route::get('/ap/entry', [ApController::class, 'entry']);
Route::get('/ap/ledger', [ApController::class, 'ledger']);
Route::post('/ap/suppliers', [ApController::class, 'storeSupplier']);
Route::get('/ap/suppliers/{supplier}/edit', [ApController::class, 'edit']);
Route::put('/ap/suppliers/{supplier}', [ApController::class, 'update']);
Route::delete('/ap/suppliers/{supplier}', [ApController::class, 'destroy']);
Route::post('/ap/invoices', [ApController::class, 'storeInvoice']);
Route::post('/ap/payments', [ApController::class, 'storePayment']);

// Budget Management Routes
Route::get('/budget', [BudgetController::class, 'index']);
Route::post('/budget', [BudgetController::class, 'store']);
Route::delete('/budget/{expense}', [BudgetController::class, 'destroy']);
Route::get('/budget/export', [BudgetController::class, 'exportCsv']);
Route::post('/budget/import', [BudgetController::class, 'importCsv']);

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Placeholder POST route — teams will replace this with their own auth logic
Route::post('/login', function () {
    // TODO: Wire up your team's authentication logic here.
    // Example using Laravel Auth:
    //   $credentials = request()->validate(['email' => 'required|email', 'password' => 'required']);
    //   if (Auth::attempt($credentials, request()->boolean('remember'))) {
    //       return redirect()->intended('/dashboard');
    //   }
    //   return back()->withErrors(['email' => 'Invalid credentials.']);
    return back();
})->name('login.post');

// Dashboard Route — protect with your team's middleware when ready
Route::get('/dashboard', function () {
    // TODO: Add auth middleware once your login system is set up.
    // ->middleware('auth')
    return view('dashboard');
})->name('dashboard');

// Passenger Booking App Simulator (Team 10)
Route::get('/passenger-booking-app', function () {
    return view('passenger-app');
})->name('passenger.booking-app');

// Team 8 Facilities & Admin Sub-Modules and Integration Matrix Overview
Route::get('/facilities-admin', function () {
    return view('facilities.dashboard');
})->name('facilities.dashboard');



// Logout Route — implement when auth is set up
Route::post('/logout', function () {
    // TODO: Auth::logout(); session()->invalidate(); session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');