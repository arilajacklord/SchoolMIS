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
use App\Http\Controllers\BorrowController;




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

Route::resource('borrows', App\Http\Controllers\BorrowController::class);
Route::get('/borrows', [BorrowController::class, 'index'])->name('borrow.index');
Route::post('/borrows', [BorrowController::class, 'store'])->name('borrow.store');
Route::put('/borrows/{id}', [BorrowController::class, 'update'])->name('borrow.update');
Route::delete('/borrows/{id}', [BorrowController::class, 'destroy'])->name('borrow.destroy');
Route::put('/borrow/{id}/return', [BorrowController::class, 'returnBook'])->name('borrow.return');
Route::get('/borrows/{borrow}/edit', [App\Http\Controllers\BorrowController::class, 'edit'])->name('borrow.edit');
Route::get('/returns', [BorrowController::class, 'returnList'])->name('borrow.return_list');
Route::get('return', [ReturnController::class, 'index'])->name('return.index');
Route::get('/return', [BorrowController::class, 'returned'])->name('borrow.return');
Route::get('history', [HistoryController::class, 'index'])->name('history.index');


    

Route::resource('enrollments', EnrollmentController::class);
 Route::resource('schoolyears', SchoolyearController::class);
Route::resource('subjects', SubjectController::class);
 





Route::resource('/subjectmodals', SubjectModalController::class);

// Invoices
Route::resource('invoices', InvoiceController::class);
Route::get('invoices/{invoice}/print', [InvoiceController::class, 'print'])->name('invoices.print');

// Payments
Route::resource('payments', PaymentController::class);
// Print Payment
Route::get('payments/{payment}/print', [PaymentController::class, 'print'])
    ->name('payments.print');  

// Borrow Routes

// Return Routes
Route::resource('return', App\Http\Controllers\ReturnController::class);
Route::get('/return', [App\Http\Controllers\ReturnController::class, 'index'])->name('return.index');
Route::get('/return/create', [App\Http\Controllers\ReturnController::class, 'create'])->name('return.create');
Route::post('/return', [App\Http\Controllers\ReturnController::class, 'store'])->name('return.store');
Route::get('/return/{return}', [App\Http\Controllers\ReturnController::class, 'show'])->name('return.show');
Route::get('/return/{return}/edit', [App\Http\Controllers\ReturnController::class, 'edit'])->name('return.edit');
Route::put('/return/{return}', [App\Http\Controllers\ReturnController::class, 'update'])->name('return.update');
Route::delete('/return/{return}', [App\Http\Controllers\ReturnController::class, 'destroy'])->name('return.destroy');

// History Routes
Route::resource('history', App\Http\Controllers\HistoryController::class);Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history.index');         
// Registration
Route::resource('/registration', RegistrationController::class);
Route::post('/register-student', [RegistrationController::class, 'store'])->name('register.store');

// Grades
Route::resource('grades', GradeController::class);
   

});
  


    
