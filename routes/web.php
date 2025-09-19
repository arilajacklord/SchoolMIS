<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SchoolyearController;
use App\Http\Controllers\EnrollmentController;

use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('subjects', SubjectController::class);
Route::resource('schoolyears', SchoolyearController::class);
Route::resource('enrollments', EnrollmentController::class);



Route::get('/', function () {
    return view('welcome');
});
Route::resource('books', App\Http\Controllers\bookController::class);
Route::resource('book', bookController::class);
Route::get('/book', [bookController::class, 'index'])->name('book.index');
Route::get('/book/create', [bookController::class, 'create'])->name('book.create');
Route::post('/book', [bookController::class, 'store'])->name('book.store');
Route::get('/book/{book}', [bookController::class, 'show'])->name('book.show');
Route::get('/book/{book}/edit', [bookController::class, 'edit'])->name('book.edit');
Route::put('/book/{book}', [bookController::class, 'update'])->name('book.update');
Route::delete('/book/{book}', [bookController::class, 'destroy'])->name('book.destroy');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::resource('registration', RegistrationController::class);



