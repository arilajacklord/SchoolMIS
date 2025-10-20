<?php  

namespace App\Http\Requests;  

use Illuminate\Foundation\Http\FormRequest;  

class InvoiceStoreRequest extends FormRequest  
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
            // Primary key - usually auto increment, but validating just in case  
            'invoice_id' => ['nullable', 'integer'],  

            // Foreign key validation  
            'enroll_id' => ['required', 'exists:enrollments,enroll_id'],  

            // Required fields  
            'amount' => ['required', 'numeric', 'min:0'],  
            'status' => ['nullable', 'in:paid,unpaid,overdue'],  
             

            // Optional extra charges  
            'insurance' => ['nullable', 'numeric', 'min:0'],  
            'sanitation' => ['nullable', 'numeric', 'min:0'], 
            'scholarship' => ['nullable', 'numeric', 'min:0'], 

            // Computed / remaining balance  
            'balance' => ['nullable', 'numeric', 'min:0'],  
        ];  
    }  
}
