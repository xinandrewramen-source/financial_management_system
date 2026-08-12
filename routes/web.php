<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ApController;
use App\Http\Controllers\BudgetController;

Route::get('/', [InvoiceController::class, 'index']);
Route::get('/ar', [InvoiceController::class, 'index']);
Route::get('/invoices', [InvoiceController::class, 'index']);
Route::post('/payers', [InvoiceController::class, 'storePayer']);
Route::post('/invoices', [InvoiceController::class, 'storeInvoice']);

Route::get('/collections', [CollectionController::class, 'index']);
Route::post('/collections', [CollectionController::class, 'store']);

Route::get('/ap', [ApController::class, 'index']);
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