<!-- payment_modal.blade.php -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Make a Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('payfast.payment') }}" method="POST" id="payfastForm">
                    @csrf
                    <!-- PayFast Fields -->
                    <input type="hidden" name="merchant_id" value="your_merchant_id">
                    <input type="hidden" name="merchant_key" value="your_merchant_key">
                        <input type="hidden" name="return_url" value="{{ route('payment.success') }}">
                    <input type="hidden" name="cancel_url" value="{{ route('payment.cancel') }}">
                    <input type="hidden" name="notify_url" value="{{ route('payment.notify') }}">
                    <input type="hidden" name="amount" value="100.00"> <!-- Change as needed -->
                    <input type="hidden" name="item_name" value="Payment for Services"> <!-- Change as needed -->
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
