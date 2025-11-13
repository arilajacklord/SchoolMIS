<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'borrow_id'=> 'required|integer|exists:borrows,borrow_id',
           'user_id'=> 'required|integer|exists:users,id',
           'book_id'=> 'required|integer|exists:books,book_id',
           'date_borrowed'=> 'required|date',
        ];
    }
}
