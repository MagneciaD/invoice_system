<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-container {
            width: 650px;
            /* Reduced width for smaller content */
            margin-left: 0;
            /* Align container to the far left */
            padding: 20px;
            border: 1px solid #ddd;
            font-size: 14px;
            /* Reduced font size for smaller content */
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid green;
            padding-bottom: 10px;
        }

        .invoice-header h1 {
            color: green;
            margin: 0;
            font-size: 30px;
        }

        h3 {
            font-size: 1.0em;
        }

        p {
            font-size: 0.9em;
        }

        .invoice-header .logo {
            width: 80px;
            height: 80px;
            background-color: #ddd;
            border-radius: 50%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .invoice-details div {
            width: 45%;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .invoice-table th {
            background-color: green;
            color: white;
            font-size: 14px;
            /* Reduced table font size */
        }

        .totals {
            text-align: right;
            margin-top: 20px;
            font-size: 14px;
            /* Reduced totals font size */
        }

        .totals div {
            margin-bottom: 10px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
            font-size: 18px;
            /* Reduced signature font size */
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .footer .terms {
            width: 60%;
            font-size: 13px;
            /* Reduced terms font size */
        }

        .footer .thank-you {
            width: 35%;
            text-align: right;
            font-size: 20px;
            /* Reduced thank-you font size */
            color: green;
        }
    </style>
</head>

<body>

    <div class="invoice-header">
        <div style="margin-top: 20px; padding: 0 20px;">
            <div style="margin-top: 20px;">
                <div style="width: 50%; float: left;">
                    <h1 style="margin-bottom: 3px;  color: green;">{{ $invoice->invoice_type }}</h1>
                    <p><strong>{{ $company->name }}</strong><br></p>
                    <p> {{ $company->address }} <br></p>
                    <p> <strong>Invoice #:</strong> {{ $invoice->invoice_number }}<br></p>
                    <p> <strong>Invoice Date:</strong> {{ $invoice->date }}<br></p>
                    <p> <strong>PO #:</strong> 1830/2019<br></p>
                    <p><strong>Due Date:</strong> {{ $invoice->due_date }} </p>
                </div>
                <div style="width: 30%; float: right;">
                    <img src="{{ $company->company_logo }}" style="max-height: 200px;">
                </div>
                <div style="clear: both;"></div>
            </div>
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
            <h3 style="margin-bottom: 5px;">Date: </h3>
            <p> Date: {{ $invoice->date }}</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <table class="invoice-table">
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

    <div class="totals">
        <div><strong>Subtotal:</strong> 1,995.00</div>
        <div><strong>VAT 15.0%:</strong> 299.25</div>
        <div><strong>TOTAL:</strong> R {{ number_format($invoice->total_amount, 2) }}</div>
    </div>

    <div class="signature">
        signature___________
    </div>

    <div class="footer">
        <div class="terms">
            <strong>Terms & Conditions</strong><br>
            Payment is due within 15 days
            Capitec Bank<br>
            Sort Code: 12-34-56<br>
            Account Number: 12345678
        </div>
        <br>
        <br>
        <div class="thank-you">
            Thank you
        </div>
    </div>
    </div>

</body>

</html>