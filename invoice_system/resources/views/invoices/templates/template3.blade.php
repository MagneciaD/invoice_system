<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: green; /* Background color for header */
            padding: 10px;
            color: white;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0; /* Removes any margin */
        }
        h2 {  
            font-size: 1.2em; /* Adjusted size for headers */
           
        }
        .invoice-title {
            font-size: 24px;
            text-align: right;
            margin: 0; /* Removes any margin */
        }
        .company-info p {
            margin: 5px 0;
        }
        .details, .bill-to, .ship-to, .due-date {
            margin-bottom: 20px;
        }
        .bill-to, .ship-to, .due-date{
            display: inline-block;
            width: 30%;
            vertical-align: top;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .total {
            font-weight: bold;
        }
        .terms {
            margin-top: 30px;
        }
        .signature {
            text-align: right;
            margin-top: 20px;
        }
        .info-container {
            background-color: #89C703; /* Background color for the info container */
            padding: 10px; /* Padding inside the container */
            margin-top: 20px; /* Adds margin above the container */
        }
        .info-container h2 {
            margin: 0; /* Removes margin to maintain layout */
            color: white; /* Text color for visibility */
        }
        .logo-address-container {
            display: flex; /* Use flexbox for layout */
            justify-content: space-between; /* Space between logo and address */
            align-items: center; /* Center items vertically */
            margin-top: 10px; /* Adds space above the logo and address */
        }
        .logo-container {
            text-align: right; /* Aligns logo to the right */
            margin-left: auto; /* Pushes logo to the right */
        }
        .address {
            text-align: left; /* Align address to the left */
            margin: 0; /* Remove margin */
        }
    </style>
</head>
<body>

<div class="info-container">
        <div style="width: 50%; float: left;">
            <h2>{{ $company->name }}</h2>          
        </div>
        <div style="width: 20%; float: right;">
            <h2>{{ $invoice->invoice_type }}</h2>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div style="width: 50%; float: left;">
    <p style="max-width: 190px; word-wrap: break-word; word-break: break-all; white-space: normal;">
    {{ $company->address }}<br> 
        </div>
        <div style="width: 20%; float: right;">
        <img src="{{ $company->company_logo }}" style="max-height: 100px;"> <!-- Logo aligned to the right -->
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="bill-to">
        <p><strong>Bill To:</strong></p>
        <p>{{ $invoice->bill_to }}</p>
    </div>

    <div class="ship-to">
        <p><strong>Ship To:</strong></p>
        <p style="max-width: 120px; word-wrap: break-word; word-break: break-all;">
                {{ $invoice->ship_to }}
            </p>
    </div>
    <div class="due-date">
    <p><strong>Due Date:</strong></p>
     <p>{{ $invoice->due_date }} </p>
     <p>Invoice #: </strong> {{ $invoice->invoice_number }}</p>
     <p>Invoice Date: </strong> {{ $invoice->date }}</p>
      <p>P.O.#: </strong> 1834/2019</p>
    </div>


    <table>
        <thead>
            <tr>
                <th>QTY</th>
                <th>DESCRIPTION</th>
                <th>UNIT PRICE</th>
                <th>AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>{{ $invoice->qty }}</td>
            <td>{{ $invoice->description }}</td>
            <td>R {{ number_format($invoice->unit_price, 2) }}</td>
            <td>R {{ number_format($invoice->amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p>_________________________</p>
        <p>Authorized Signature</p>
    </div>

    <div class="terms">
        <p><strong>Terms & Conditions</strong></p>
        <p>Payment is due within 15 days</p>
        <p>Capitec Bank<br>Sort Code: 33-45-46<br>Account Number: 123456789</p>
    </div>
</div>
</body>
</html>
