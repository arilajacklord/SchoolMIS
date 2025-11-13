<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow authorized users to update invoices
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
            // Usually invoice_id comes from the route (so we don't validate it here)
            'enroll_id'   => ['nullable', 'exists:enrollments,enroll_id'],
            'scholar_id'  => ['nullable', 'exists:scholarships,scholar_id'],
            'amount'      => ['required', 'numeric', 'min:0'],
            'status'      => ['nullable', 'in:paid,unpaid,overdue'],
           

            // Optional additional fields
            'insurance'   => ['nullable', 'numeric', 'min:0'],
            'sanitation'  => ['nullable', 'numeric', 'min:0'],
            'balance'     => ['nullable', 'numeric', 'min:0'],
        ];
    }
}

