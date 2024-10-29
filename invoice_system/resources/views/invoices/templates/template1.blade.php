<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {  
            font-size: 1.2em; /* Adjusted size for headers */
           
        }
        h3 {
            font-size: 1em; /* Increase the size of h3 elements */
             /* Set the color to green */
        }
        p {
            font-size: 0.9em; /* Smaller font size for paragraphs */
        }
        .invoice-header {
            text-align: center;
        }
        .company-details, .client-details, .items-table {
            width: 100%;
            margin-top: 20px;
        }
        .items-table {
            border-collapse: collapse; /* Ensure borders don't overlap */
        }
        .items-table th, .items-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .items-table th {
            background-color: #f4f4f4;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    
<div style="margin-top: 20px; padding: 0 20px;">
    <!-- Invoice Header -->
    <div style="margin-top: 20px;">
        <div style="width: 50%; float: left;">
            <h2 style="margin-bottom: 5px;">{{ $company->name }}</h2>
            <p style="max-width: 170px; word-wrap: break-word; word-break: break-all; white-space: normal;">
    {{ $company->address }}<br>
</p>
        
        </div>
        <div style="width: 20%; float: right;">
            <h2 style="margin-bottom: 5px;">{{ $invoice->invoice_type }}</h2>
            <img src="{{ $company->company_logo }}" style="max-height: 100px;">
        </div>
        <div style="clear: both;"></div>
    </div>
</div>
    
    <!-- Bill To and Ship To Details -->
    <div style="margin-top: 20px;">
        <div style="width: 50%; float: left;">
            <h3 style="margin-bottom: 5px;">Bill To</h3>
            <p>{{ $invoice->bill_to }}</p>
        </div>
        <div style="width: 60%; float: right;">
            <h3 style="margin-bottom: 5px;">Ship To</h3>
            <p style="max-width: 100px; word-wrap: break-word; word-break: break-all;">
                {{ $invoice->ship_to }}
            </p>
        </div>
        <div style="width: 30%; float: right;">
            <h3 style="margin-bottom: 5px;">Date <p>{{ $invoice->date }}</p></h3>
            <p>Due Date: {{ $invoice->due_date }}  </p>
            <p>Invoice Number: {{ $invoice->invoice_number }}</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <!-- Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th>Qty</th>
                <th>Description</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $invoice->qty }}</td>
                <td>{{ $invoice->description }}</td>
                <td>R {{ number_format($invoice->unit_price, 2) }}</td>
                <td>R {{ number_format($invoice->amount, 2) }}</td>
            </tr>
            <!-- You can add more rows here as needed -->
        </tbody>
    </table>

    <div class="total">
        <p>Subtotal: R {{ number_format($invoice->subtotal, 2) }}</p>
        <p>VAT: R {{ number_format($invoice->tax_total, 2) }}</p>
        <p>Total: R {{ number_format($invoice->total_amount, 2) }}</p>
    </div>

    <div class="signature">
        <p>Signature: __ <span>{{ $invoice->signature }}</span> _____</p>
    </div>

    <div class="banking-details">
        <h3>Banking Details:</h3>
        <p>Bank Name: [Your Bank Name]</p>
        <p>Account Number: [Your Account Number]</p>
        <p>IBAN: [Your IBAN]</p>
    </div>

    <div class="terms-and-conditions">
        <h3>Terms & Conditions:</h3>
        <p>{{ $invoice->terms_and_conditions }}</p>
    </div>

</div>
</body>
</html>
