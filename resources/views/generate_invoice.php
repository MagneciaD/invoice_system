<!-- resources/views/partials/modals/create_invoice_modal.blade.php -->
<div class="modal fade" id="createInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="createInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createInvoiceModalLabel">Create Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createInvoiceForm" method="POST" action="{{ route('invoices.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="company_id">Company</label>
                        <select name="company_id" class="form-control" required>
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="invoice_type">Invoice Type</label>
                        <input type="text" name="invoice_type" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="invoice_number">Invoice Number</label>
                        <input type="number" name="invoice_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="bill_to">Bill To</label>
                        <input type="text" name="bill_to" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ship_to">Ship To</label>
                        <input type="text" name="ship_to" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" name="qty" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="pending">Pending</option>
                            <option value="paid">Paid</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Invoice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
