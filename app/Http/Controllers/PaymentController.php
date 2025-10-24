<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display payments for a specific invoice.
     */
    public function index(Request $request)
    {
        $invoice_id = $request->query('invoice_id');
        $invoice = Invoice::with('enrollment.user', 'payments')->find($invoice_id);

        if (!$invoice) {
            return redirect()->route('invoices.index')
                             ->with('error', 'Invoice not found');
        }

        return view('payments.index', compact('invoice'));
    }

    /**
     * Show the form for creating a new payment.
     */
    public function create()
    {
        $invoices = Invoice::all(); // For dropdown
        return view('payments.create', compact('invoices'));
    }

    /**
     * Store a newly created payment.
     */
    public function store(Request $request)
    {
        $request->validate([
            'invoice_id'   => 'nullable|exists:invoices,invoice_id', // optional
            'total_amount' => 'required|numeric|min:0.01',
            'paymenttype'  => 'required|string|in:cash,card,online',
            'date'         => 'nullable|date', // optional; auto-set if missing
        ]);

        $payment = Payment::create([
            'invoice_id'   => $request->invoice_id ?? null,
            'total_amount' => $request->total_amount,
            'paymenttype'  => $request->paymenttype,
            'date'         => $request->date ?? now()->format('Y-m-d'),
        ]);

        if ($payment->invoice_id) {
            $this->updateInvoiceBalance($payment->invoice_id);
        }

        return redirect()->route('payments.index', ['invoice_id' => $payment->invoice_id])
                         ->with('success', 'Payment recorded successfully and invoice balance updated');
    }

    /**
     * Show the form for editing a payment.
     */
    public function edit(Payment $payment)
    {
        $invoices = Invoice::all(); // optional dropdown if user wants to change invoice
        return view('payments.edit', compact('payment', 'invoices'));
    }

    /**
     * Update a payment.
     */
    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $request->validate([
            'invoice_id'   => 'nullable|exists:invoices,id', // optional
            'total_amount' => 'required|numeric|min:0.01',
            'paymenttype'  => 'required|string|in:cash,card,online',
            'date'         => 'nullable|date', // optional; auto-set if missing
        ]);

        $payment->update([
            'invoice_id'   => $request->invoice_id ?? $payment->invoice_id,
            'total_amount' => $request->total_amount,
            'paymenttype'  => $request->paymenttype,
            'date'         => $request->date ?? now()->format('Y-m-d'),
        ]);

        if ($payment->invoice_id) {
            $this->updateInvoiceBalance($payment->invoice_id);
        }

        return redirect()->route('payments.index', ['invoice_id' => $payment->invoice_id])
                         ->with('success', 'Payment updated successfully and invoice balance updated.');
    }

    /**
     * Delete a payment.
     */
    public function destroy(Payment $payment): RedirectResponse
    {
        $invoice_id = $payment->invoice_id;
        $payment->delete();

        if ($invoice_id) {
            $this->updateInvoiceBalance($invoice_id);
        }

        return redirect()->route('payments.index', ['invoice_id' => $invoice_id])
                         ->with('success', 'Payment deleted successfully and invoice balance updated.');
    }

    /**
     * Print a payment.
     */
    public function print(Payment $payment)
    {
        return view('payments.print', compact('payment'));
    }

    /**
     * Helper function to recalculate invoice balance.
     */
    private function updateInvoiceBalance($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        if ($invoice) {
            $invoice->balance = max(
                $invoice->total_amount - $invoice->payments()->sum('total_amount'),
                0
            );
            $invoice->save();
        }
    }
    
}
