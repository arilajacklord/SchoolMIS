<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use Illuminate\Http\RedirectResponse;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource along with enrollments for the create modal.
     */
    public function index()
    {
        // Eager load enrollment + user + payments for efficiency
        $invoices = Invoice::with(['enrollment.user', 'payments'])->latest()->get();

        // Ensure balance is current for all invoices
        foreach ($invoices as $invoice) {
            $invoice->updateBalance();
        }

        // Get enrollments for Create Invoice modal dropdown
        $enrollments = Enrollment::with('user')->get();

        // Pass both invoices and enrollments to the view
        return view('invoices.index', compact('invoices', 'enrollments'));
    }

    /**
     * Show the form for creating a new resource (optional if using modal on index).
     */
    public function create()
    {
        $enrollments = Enrollment::with('user')->get();
        return view('invoices.create', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceStoreRequest $request)
    {
        $validated = $request->validated();

        // Create invoice
        $invoice = Invoice::create($validated);

        // Update balance dynamically
        $invoice->updateBalance();

        return redirect()->route('invoices.index')
                         ->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('enrollment.user', 'payments');

        // Update balance in case any payments changed
        $invoice->updateBalance();

        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $enrollments = Enrollment::with('user')->get();
        return view('invoices.edit', compact('invoice', 'enrollments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice): RedirectResponse
    {
        $validated = $request->validated();

        // Update invoice fields
        $invoice->update($validated);

        // Recalculate balance based on all payments
        $invoice->updateBalance();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    /**
     * Print invoice
     */
    public function print(Invoice $invoice)
    {
        $invoice->load('enrollment.user', 'payments');

        // Ensure balance is current
        $invoice->updateBalance();

        return view('invoices.print', compact('invoice'));
    }
}
