<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SchoolyearController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SubjectModalController;



/*|--------------------------------------------------------------------------
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
Route::get('/enrollments/{id}/api-show', [EnrollmentController::class, 'apiShow']);
Route::get('/enrollments/{id}/api-edit', [EnrollmentController::class, 'apiEdit']);


Route::resource('schoolyears', SchoolyearController::class);
Route::get('/schoolyears/{id}/api-show', [SchoolyearController::class, 'apiShow'])->name('schoolyears.api-show');
Route::get('/schoolyears/{id}/api-edit', [SchoolyearController::class, 'apiEdit'])->name('schoolyears.api-edit');

Route::resource('subjects', SubjectController::class);
Route::get('/subjects/{id}/api-edit', [SubjectController::class, 'apiEdit']);
Route::get('/subjects/{id}/api-show', [SubjectController::class, 'apiShow']);
});






Route::resource('/subjectmodals', SubjectModalController::class);

// Invoices
Route::resource('invoices', InvoiceController::class);
Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');

// Payments
Route::resource('payments', PaymentController::class);
Route::get('payments/{payment}/print', [PaymentController::class, 'print'])->name('payments.print');

// Registration
Route::resource('registration', RegistrationController::class);
Route::post('/register-student', [RegistrationController::class, 'store'])->name('register.store');

// Grades
Route::resource('grades', GradeController::class);

    
