<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SubjectController,
    ProspectusController,
    ScholarshipController,
    SchoolyearController,
    EnrollmentController,
    RegistrationController,
    GradeController,
    InvoiceController,
    PaymentController,
    BookController,
    BorrowController,
    ReturnController,
    HistoryController,
    SubjectModalController,
    StudentInfoController
};

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
Route::resource('/registration', RegistrationController::class);
Route::get('/studentinfo/{id}', [RegistrationController::class, 'studentinfo_index'])->name('studentinfo.index');
//Route::get('studentinfo/{id}', [StudentInfoController::class, 'index'])->name('studentinfo.index');
 //Route::post('/register-student', [RegistrationController::class, 'store'])->name('register.store');

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
