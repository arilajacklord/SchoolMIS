<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Enrollment;
use App\Models\Scholarship;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use Illuminate\Http\RedirectResponse;

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices with related data (enrollment, user, payments, scholarship)
     */
  public function index()
{
    // Load invoices with relationships and paginate (5 per page)
    $invoices = Invoice::with(['enrollment.user', 'payments', 'scholar'])
        ->latest()
        ->paginate(5)
        ->withQueryString(); // keeps search/filter parameters

    // Update balance for each invoice dynamically
    foreach ($invoices as $invoice) {
        $invoice->updateBalance();
    }

    $enrollments = Enrollment::with('user')->get();
    $scholarships = Scholarship::orderBy('name')->get();

    return view('invoices.index', compact('invoices', 'enrollments', 'scholarships'));
}

    /**
     * Show the form for creating a new invoice.
     */
    public function create()
    {
        $enrollments = Enrollment::with('user')->get();
        $scholarships = Scholarship::orderBy('name')->get();

        return view('invoices.create', compact('enrollments', 'scholarships'));
    }

    /**
     * Store a newly created invoice in storage.
     */
    public function store(InvoiceStoreRequest $request)
    {
        $validated = $request->validated();

        // Create the invoice
        $invoice = Invoice::create($validated);

        // Update balance after creation
        $invoice->updateBalance();

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    /**
     * Display a specific invoice.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('enrollment.user', 'payments', 'scholar');
        $invoice->updateBalance();

        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing an existing invoice.
     */
    public function edit(Invoice $invoice)
    {
        $enrollments = Enrollment::with('user')->get();
        $scholarships = Scholarship::orderBy('name')->get();

        return view('invoices.edit', compact('invoice', 'enrollments', 'scholarships'));
    }

    /**
     * Update the specified invoice in storage.
     */
    public function update(InvoiceUpdateRequest $request, Invoice $invoice): RedirectResponse
    {
        $validated = $request->validated();

        $invoice->update($validated);
        $invoice->updateBalance();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    /**
     * Remove the specified invoice from storage.
     */
    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->delete();

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

    /**
     * Print a specific invoice.
     */
    public function print(Invoice $invoice)
    {
        $invoice->load('enrollment.user', 'payments', 'scholar');
        $invoice->updateBalance();

        return view('invoices.print', compact('invoice'));
    }
}
