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
use App\Http\Controllers\ScholarshipController;



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

Route::resource('grades', GradeController::class);
Route::get('/grades/{subject_id}/getStudent', [GradeController::class,'getStudent']);
    
Route::resource('enrollments', EnrollmentController::class);
Route::resource('schoolyears', SchoolyearController::class);
Route::resource('subjects', SubjectController::class);


// Registration Routes
Route::resource('registration', RegistrationController::class);
Route::get('/registrations/studentinfo/{id?}', [RegistrationController::class, 'studentinfo_index'])
    ->name('registrations.studentinfo_index');
Route::post('/register-student', [RegistrationController::class, 'store'])->name('register.store');

// Invoice and Payment Routes
Route::resource('invoices', InvoiceController::class);
Route::resource('payments', PaymentController::class);

// Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
// Print Invoice
Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])
        ->name('invoices.print');
// Print Payment
Route::get('payments/{payment}/print', [PaymentController::class, 'print'])
    ->name('payments.print');    


// SCHOLARSHIP ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/scholarships', [ScholarshipController::class, 'index'])->name('scholarships.index');
    Route::post('/scholarships', [ScholarshipController::class, 'store'])->name('scholarships.store');
    Route::put('/scholarships/{scholar_id}', [ScholarshipController::class, 'update'])->name('scholarships.update');
    Route::delete('/scholarships/{scholar_id}', [ScholarshipController::class, 'destroy'])->name('scholarships.destroy');
});

// SUBJECT MODAL ROUTE
Route::resource('/subjectmodals', SubjectModalController::class);
});