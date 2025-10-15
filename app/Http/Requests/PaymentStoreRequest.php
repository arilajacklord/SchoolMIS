<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Allow storing payments
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
            
            'invoice_id'    => ['required', 'exists:invoices,invoice_id'], 
            'date'          => ['required', 'date'],
            'total_amount'  => ['required', 'numeric', 'min:0'],

            // Payment type: you can restrict to certain options (cash, card, gcash, etc.)
            'paymenttype'   => ['required', 'string', 'max:50'],
        ];
    }
}
