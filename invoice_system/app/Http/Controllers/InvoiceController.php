<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Company;
use App\Models\Client; // Assuming you have a Client model
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;


class InvoiceController extends Controller
{

    public function index()
    {
        // Fetch invoices with company and client relations, limited to the latest 6
        $invoices = Invoice::with('company', 'client')->latest()->take(6)->get();
    
        // Assuming you fetch all clients
        $clients = Client::all(); 
    
        // Fetch the company associated with the first invoice, or set it to null if no invoices exist
        $company = $invoices->first()->company ?? null; 
    
        // Return the dashboard view, passing invoices, company, and clients
        return view('dashboard', compact('invoices', 'company', 'clients'));
    }
    
    public function create()
    {
        $clients = Client::all(); // Fetch clients for the dropdown
        return view('invoices.create', compact('clients'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'client_id' => 'required|exists:clients,id',
            'invoice_type' => 'required|string',
            'invoice_number' => 'required|integer|unique:invoices,invoice_number',
            'bill_to' => 'required|string',
            'ship_to' => 'required|string',
            'date' => 'required|date',
            'due_date' => 'required|date',
            'qty' => 'required|integer',
            'description' => 'nullable|string', // Changed to a single string
            'qty' => 'required|integer', // Changed to a single integer
            'unit_price' => 'nullable|numeric', // Changed to a single numeric value
            'amount' => 'nullable|numeric', // Changed to a single numeric value
            'total_amount' => 'required|numeric',
            'signature' => 'nullable|string|max:5000', // Validate signature field
            'terms_and_conditions' => 'nullable|string|max:5000', // Validate terms_and_conditions field
        ]);


        $invoice = Invoice::create($request->all());

        // Redirect to the chooseTemplate method with the invoice ID
        return redirect()->route('invoices.chooseTemplate', ['invoiceId' => $invoice->id])
            ->with('success', 'Invoice created successfully!');
    }   

    public function show(Invoice $invoice)
    {
        // Get the total number of invoices
        $totalInvoices = Invoice::count();
    
        // Get the number of paid invoices
        $paidInvoices = Invoice::where('status', 'paid')->count();
    
        // Get the number of unpaid invoices (assuming 'unpaid' means 'pending')
        $unpaidInvoices = Invoice::where('status', 'pending')->count();
    
        // Fetch all invoices
        $invoices = Invoice::with('company', 'client')->get(); 
        
        // Pass the data to the view
        return view('invoices', compact('invoice', 'invoices', 'totalInvoices', 'paidInvoices', 'unpaidInvoices'));
    }
    


    public function edit(Invoice $invoice)
    {
        $clients = Client::all();
        return view('invoices.edit', compact('invoice', 'clients'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:paid,pending,overdue',
            // Add other fields as necessary for updating
        ]);

        $invoice->update($validatedData);
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully.');
    }

    public function share($invoiceId)
{
    // Logic to share the invoice
    // For example, sending it via email or generating a shareable link
}

public function download($invoiceId)
{
    // Logic to generate and return the invoice PDF for download
    $invoice = Invoice::findOrFail($invoiceId);
    $pdf = PDF::loadView('invoices.templates.default', compact('invoice')); // Adjust template as needed
    return $pdf->download("invoice_$invoiceId.pdf");
}

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully.');
    }

    // Method for choosing a template for the invoice
    public function chooseTemplate($invoiceId)
    {
        // Find the invoice by its ID
        $invoice = Invoice::findOrFail($invoiceId);

        // Return a view to select a template for the invoice
        return view('invoices.choose_template', compact('invoice'));
    }


    public function generatePdf(Request $request, $invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $company = Company::find($invoice->company_id); // Assuming you have a Company model
    
        $template = $request->input('template');
    
        // Load the selected template view and pass the company details
        $pdf = PDF::loadView("invoices.templates.$template", compact('invoice', 'company'));
    
        // Generate PDF and return download response
        return $pdf->download("invoice_$invoiceId.pdf");
    }

    // Method to update the invoice status
    public function updateStatus(Request $request, $id)
{
    $invoice = Invoice::findOrFail($id);

    // Check if the request is to mark as paid
    if ($request->input('status') === 'paid') {
        $invoice->status = 'paid';
    }

    // Check if the invoice is overdue only if it's not marked as paid
    if ($invoice->due_date < now() && $invoice->status !== 'paid') {
        $invoice->status = 'overdue';
    }

    $invoice->save();

    return redirect()->back()->with('success', 'Invoice status updated successfully.');
}
}
