<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SchoolyearController;


use App\Http\Controllers\EnrollmentController;

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\BookController;

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



Route::get('/', function () {
    return view('welcome');
});
Route::get('/books', [App\Http\Controllers\BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [App\Http\Controllers\BookController::class, 'create'])->name('books.create');
Route::post('/books', [App\Http\Controllers\BookController::class, 'store'])->name('books.store');
Route::get('/books/{book}', [App\Http\Controllers\BookController::class, 'show'])->name('books.show');
Route::get('/books/{book}/edit', [App\Http\Controllers\BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{book}', [App\Http\Controllers\BookController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [App\Http\Controllers\BookController::class, 'destroy'])->name('books.destroy');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    
Route::resource('enrollments', EnrollmentController::class);
Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
Route::resource('schoolyear', SchoolyearController::class);
Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
Route::resource('subjects', SubjectController::class);
Route::get('/schoolyears', [SchoolYearController::class, 'index'])->name('schoolyears.index');

});


Route::resource('registration', RegistrationController::class);



