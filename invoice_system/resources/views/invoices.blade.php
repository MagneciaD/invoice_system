<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="container-fluid" style="padding: 40px; margin-top: 0;">
        <div class="row">
            <!-- Main Content -->
            <div class="d-flex justify-content-center align-items-center mb-4">
                <div class="d-flex align-items-center" style="position: relative; width: 300px;">
                    <!-- Search Icon -->
                    <i class="fas fa-search"
                        style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); 
                  color: #888;"></i>
                    <!-- Search Bar -->
                    <input type="text" class="form-control me-3" placeholder="Search"
                        style="border-radius: 25px; padding: 10px 20px 10px 40px; width: 100%; 
                      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border: 1px solid #ccc; 
                      transition: box-shadow 0.3s ease; outline: none;"
                        onfocus="this.style.boxShadow='0 4px 12px rgba(0, 123, 255, 0.4)';"
                        onblur="this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)';">
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-3">Eleanor Pena</span>
                    <img src="profile.jpg" alt="Profile" class="rounded-circle" width="40">
                </div>
            </div>
            <!-- Overview Cards and Invoice Status Chart -->
            <div class="row">
                <!-- Cards -->
                <div class="col-md-8">
                    <div class="row justify-content-start"> <!-- Total Invoices Card -->
                        <div class="col-md-5 mb-4 offset-md-1">
                            <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec); min-height: 150px;"> <!-- Increased padding and added min-height -->
                                <h5 style="font-family: Arial, sans-serif; color: #333;">Total</h5>
                                <p style="font-size: 18px; font-weight: bold; color: #007bff;">{{ $totalInvoices }} Invoices</p>
                            </div>
                        </div>
                        <!-- Paid Invoices Card -->
                        <div class="col-md-5 mb-4 ">
                            <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec); min-height: 150px;"> <!-- Increased padding and added min-height -->
                                <h5 style="font-family: Arial, sans-serif; color: #333;">Paid</h5>
                                <p style="font-size: 18px; font-weight: bold; color: #28a745;">{{ $paidInvoices }} Invoices</p>
                            </div>
                        </div>
                        <!-- Unpaid Invoices Card -->
                        <div class="col-md-5 mb-4 offset-md-1">
                            <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec); min-height: 150px;"> <!-- Increased padding and added min-height -->
                                <h5 style="font-family: Arial, sans-serif; color: #333;">Unpaid</h5>
                                <p style="font-size: 18px; font-weight: bold; color: #dc3545;">{{ $unpaidInvoices }} Invoices</p>
                            </div>
                        </div>

                        <!-- Unpaid Invoices Card -->
                        <div class="col-md-5 mb-4 ">
                            <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec); min-height: 150px;"> <!-- Increased padding and added min-height -->
                                <h5 style="font-family: Arial, sans-serif; color: #333;">Overdue</h5>
                                <p style="font-size: 18px; font-weight: bold; color: #dc3545;">{{ $unpaidInvoices }} Invoices</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-md-4">
                    <div class="card p-4" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #f0f4f8, #dfe8ec);">
                        <h5 style="font-family: Arial, sans-serif; color: #333;">Invoice Status</h5>
                        <div class="chart-container">
                            <canvas id="invoiceChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Toggle Buttons for Filtering Invoices -->
<div class="row mt-4">
    <div class="col-md-12 d-flex justify-content-between align-items-center">
        <div>
            <button
                class="btn"
                id="allInvoicesBtn"
                style="background-color: transparent; border: none; color: #007bff; padding: 10px 50px;">
                All Invoices()
            </button>
            <button
                class="btn"
                id="paidInvoicesBtn"
                style="background-color: transparent; border: none; color: #28a745; padding: 5px 20px;">
                Paid()
            </button>
            <button
                class="btn"
                id="unpaidInvoicesBtn"
                style="background-color: transparent; border: none; color: #dc3545; padding: 10px 20px;">
                Unpaid()
            </button>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createInvoiceModal" style="margin-left: auto;">
            Create Invoice
        </button>
        @include('partials.modals.create_invoice') <!-- Include the invoice modal -->
    </div>

    <div class="row mt-4" style="padding-top: 15px;">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="invoiceTable" style=" width: 92%; border-collapse: collapse; font-family: Arial, sans-serif; background-color: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); margin: auto;">
                    <thead style="background: #43BA7F; color: #fff;">
                        <tr>
                            <th style="padding: 8px; border: none; text-align: left; font-size: 14px;">Client Name</th>
                            <th style="padding: 8px; border: none; text-align: left; font-size: 14px;">Product</th>
                            <th style="padding: 8px; border: none; text-align: left; font-size: 14px;">Due Date</th>
                            <th style="padding: 8px; border: none; text-align: left; font-size: 14px;">Status</th>
                            <th style="padding: 8px; border: none; text-align: left; font-size: 14px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr class="invoice-row" data-status="{{ $invoice->status }}" style="background-color: #f8f9fa; transition: background-color 0.3s; cursor: pointer;">
                            <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $invoice->client->name }}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ $invoice->description }}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-size: 14px;">{{ \Carbon\Carbon::parse($invoice->due_date)->format('d M, Y') }}</td>
                            <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-size: 14px;">
                                <span class="badge" style="background-color: {{ $invoice->status == 'paid' ? '#28a745' : ($invoice->status == 'overdue' ? '#ffc107' : '#dc3545') }}; color: white; padding: 5px 10px; border-radius: 20px; font-size: 12px;">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td style="padding: 8px; border-bottom: 1px solid #dee2e6; font-size: 14px;">
                                <a href="#" title="Share" class="me-2" style="color: #007bff; text-decoration: none; transition: color 0.3s;">
                                    <i class="fas fa-share-alt" style="font-size: 16px;"></i>
                                </a>
                                <a href="#" title="Download" class="me-2" style="color: #007bff; text-decoration: none; transition: color 0.3s;">
                                    <i class="fas fa-download" style="font-size: 16px;"></i>
                                </a>
                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0" title="Delete" onclick="return confirm('Are you sure you want to delete this invoice?');" style="color: #dc3545; padding: 0; border: none; background: none;">
                                        <i class="fas fa-trash-alt" style="font-size: 16px;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        /* CSS for the active button underline */
        .active {
            text-decoration: underline;
            font-weight: bold; /* Optional: Make it bold */
        }

        #invoiceTable tbody tr:hover {
            background-color: #e2e6ea; /* Light gray on hover */
        }
    </style>

    <!-- JavaScript for Filtering Invoices -->
    <script>
        // Function to handle button clicks
        function setActiveButton(buttonId) {
            const buttons = ['allInvoicesBtn', 'paidInvoicesBtn', 'unpaidInvoicesBtn'];
            buttons.forEach(id => {
                const button = document.getElementById(id);
                if (id === buttonId) {
                    button.classList.add('active'); // Add active class to the clicked button
                } else {
                    button.classList.remove('active'); // Remove active class from other buttons
                }
            });
        }

        document.getElementById('allInvoicesBtn').addEventListener('click', function() {
            setActiveButton('allInvoicesBtn'); // Set the clicked button as active
            filterInvoices('all');
        });

        document.getElementById('paidInvoicesBtn').addEventListener('click', function() {
            setActiveButton('paidInvoicesBtn'); // Set the clicked button as active
            filterInvoices('paid');
        });

        document.getElementById('unpaidInvoicesBtn').addEventListener('click', function() {
            setActiveButton('unpaidInvoicesBtn'); // Set the clicked button as active
            filterInvoices('unpaid');
        });

        function filterInvoices(status) {
            let rows = document.querySelectorAll('.invoice-row');

            rows.forEach(function(row) {
                if (status === 'all') {
                    row.style.display = '';
                } else if (row.getAttribute('data-status') === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>

    <script>
        var ctx = document.getElementById('invoiceChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Paid', 'Pending', 'Draft', 'OverDue'],
                datasets: [{
                    data: [42, 32, 13, 10],
                    backgroundColor: ['#4CAF50', '#FFC107', '#FF9800', '#F44336']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script>
</div>
</x-app-layout>


