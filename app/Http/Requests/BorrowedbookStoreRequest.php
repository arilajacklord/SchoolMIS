<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowedbookStoreRequest extends FormRequest
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
            'book_id' => 'required|exists:books,book_id',
            'user_id' => 'required|exists:users,id',
            'borrowed_at' => 'required|date',
            'due_at' => 'required|date|after:borrowed_at',
            'returned_at' => 'nullable|date|after:borrowed_at',
            'status' => 'required|string|in:borrowed,returned,overdue',
        ];
    }
}
