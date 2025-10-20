<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Enrollment;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use Illuminate\Http\RedirectResponse;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // eager load enrollment + user for efficiency
        $invoices = Invoice::with(['enrollment.user'])->latest()->get();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enrollments = Enrollment::with('user')->get();
        return view('invoices.create', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceStoreRequest $request): RedirectResponse
    {
        Invoice::create($request->validated());

        return redirect()
            ->route('invoices.index')
            ->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $invoice->load('enrollment.user');
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
        $invoice->update($request->validated());

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
        $invoice->load('enrollment.user');
        return view('invoices.print', compact('invoice'));
    }
}
