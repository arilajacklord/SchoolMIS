<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ProspectusController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\SchoolyearController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\SubjectModalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root route: show welcome page to guests, redirect authenticated users to dashboard
Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : view('welcome');
});

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [\Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController::class, 'show'])
        ->name('profile.show');
    Route::put('/user/profile-information', [\Laravel\Fortify\Http\Controllers\ProfileInformationController::class, 'update'])
        ->name('user-profile-information.update');
    Route::put('/user/password', [\Laravel\Fortify\Http\Controllers\PasswordController::class, 'update'])
        ->name('user-password.update');
    Route::delete('/user/other-browser-sessions', [\Laravel\Jetstream\Http\Controllers\OtherBrowserSessionsController::class, 'destroy'])
        ->name('other-browser-sessions.destroy');
    Route::delete('/user', [\Laravel\Jetstream\Http\Controllers\DeleteUserController::class, 'destroy'])
        ->name('user.destroy');

    // Books
    Route::resource('books', BookController::class);

    // Borrowing
    Route::resource('borrows', BorrowController::class);
    Route::put('/borrows/{id}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');
    Route::get('/borrows/returns', [BorrowController::class, 'returnList'])->name('borrows.return_list');

    // Returns
    Route::resource('return', ReturnController::class);

    // History
    Route::resource('history', HistoryController::class);

    // Enrollment & Schoolyears
    Route::resource('enrollments', EnrollmentController::class);
    Route::resource('schoolyears', SchoolyearController::class);

    // Subjects
    Route::resource('subjects', SubjectController::class);
    Route::resource('subjectmodals', SubjectModalController::class);

    // Registration
    Route::resource('registration', RegistrationController::class);
    Route::post('/register-student', [RegistrationController::class, 'store'])->name('register.store');
    Route::get('/studentinfo/{id}', [RegistrationController::class, 'studentinfo_index'])->name('studentinfo.index');

    // Grades
    Route::prefix('grades')->group(function () {
        Route::get('/', [GradeController::class, 'index'])->name('grades.index');
        Route::get('/subject/{schoolyear_id}/{subject_id}', [GradeController::class, 'showSubject'])->name('grades.showSubject');
        Route::post('/store', [GradeController::class, 'store'])->name('grades.store');
        Route::get('/get/{enroll_id}', [GradeController::class, 'get']);
        Route::get('/print/{enroll_id}', [GradeController::class, 'print'])->name('grades.print');
    });

    // Prospectus
    Route::get('prospectus', [ProspectusController::class, 'index'])->name('prospectus.index');
    Route::get('prospectus/print/{schoolyear?}', [ProspectusController::class, 'print'])->name('prospectus.print');

    // Scholarships, Payments, Invoices
    Route::resource('scholarships', ScholarshipController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('payments/{payment}/print', [PaymentController::class, 'print'])->name('payments.print');
    Route::resource('invoices', InvoiceController::class);
    Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');
    Route::post('invoices/{invoice}/send', [InvoiceController::class, 'send'])->name('invoices.send');
});



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



   

    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

Route::resource('borrow', BorrowController::class);
Route::resource('borrows', App\Http\Controllers\BorrowController::class);
Route::get('/borrows', [BorrowController::class, 'index'])->name('borrow.index');
Route::post('/borrows', [BorrowController::class, 'store'])->name('borrow.store');
Route::put('/borrow/{id}', [BorrowController::class, 'update'])->name('borrow.update');
Route::delete('/borrows/{id}', [BorrowController::class, 'destroy'])->name('borrow.destroy');
Route::put('/borrow/{id}/return', [BorrowController::class, 'returnBook'])->name('borrow.return');
// Return book route

Route::put('borrow/{borrow}/return', [BorrowController::class, 'returnBook'])->name('borrow.return');
Route::get('/borrows/{borrow}/edit', [App\Http\Controllers\BorrowController::class, 'edit'])->name('borrow.edit');
Route::get('/returns', [BorrowController::class, 'returnList'])->name('borrow.return_list');
Route::get('return', [ReturnController::class, 'index'])->name('return.index');
Route::get('/return', [BorrowController::class, 'returned'])->name('borrow.return');
Route::get('history', [HistoryController::class, 'index'])->name('history.index');
Route::get('/borrow/history', [BorrowController::class, 'history'])->name('borrow.history');

Route::resource('borrowedbooks', App\Http\Controllers\BorrowedbookController::class);
Route::get('/borrowedbooks', [App\Http\Controllers\BorrowedbookController::class, 'index'])->name('borrowedbook.index');
    

Route::resource('enrollments', EnrollmentController::class);
 Route::resource('schoolyears', SchoolyearController::class);
Route::resource('subjects', SubjectController::class);
 
Route::resource('/subjectmodals', SubjectModalController::class);

// Invoices
Route::resource('invoices', InvoiceController::class);
Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');

Route::resource('scholarships', ScholarshipController::class);
// Payments
Route::resource('payments', PaymentController::class);
// Print Payment
Route::get('payments/{payment}/print', [PaymentController::class, 'print'])
    ->name('payments.print');  

// Borrow Routes

// Return Routes
Route::resource('return', App\Http\Controllers\ReturnController::class);
Route::get('/return', [App\Http\Controllers\ReturnController::class, 'index'])->name('returns.index');
Route::get('/return/create', [App\Http\Controllers\ReturnController::class, 'create'])->name('return.create');
Route::post('/return', [App\Http\Controllers\ReturnController::class, 'store'])->name('return.store');
Route::get('/return/{return}', [App\Http\Controllers\ReturnController::class, 'show'])->name('return.show');
Route::get('/return/{return}/edit', [App\Http\Controllers\ReturnController::class, 'edit'])->name('return.edit');
Route::put('/return/{return}', [App\Http\Controllers\ReturnController::class, 'update'])->name('return.update');
Route::delete('/return/{return}', [App\Http\Controllers\ReturnController::class, 'destroy'])->name('return.destroy');

// History Routes
Route::get('/history', [App\Http\Controllers\BorrowController::class, 'history'])->name('history.index');
// Registration
Route::resource('/registration', RegistrationController::class);
Route::get('studentinfo/{id}', [StudentInfoController::class, 'index'])->name('studentinfo.index');


//Route::post('/register-student', [RegistrationController::class, 'store'])->name('register.store');
Route::get('/studentinfo/{id}', [RegistrationController::class, 'studentinfo_index'])
    ->name('studentinfo.index');


// Grades
// web.php
Route::prefix('grades')->group(function(){
    Route::get('/', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/subject/{schoolyear_id}/{subject_id}', [GradeController::class, 'showSubject'])->name('grades.showSubject');
    Route::post('/store', [GradeController::class, 'store'])->name('grades.store');
    Route::get('/get/{enroll_id}', [GradeController::class, 'get']);
    Route::get('/print/{enroll_id}', [GradeController::class, 'print'])->name('grades.print');
});

Route::get('prospectus', [ProspectusController::class, 'index'])->name('prospectus.index');
Route::get('prospectus/print/{schoolyear?}', [ProspectusController::class, 'print'])->name('prospectus.print');

          
});


Route::get('/', function () {
    return redirect('/login');
});


    
