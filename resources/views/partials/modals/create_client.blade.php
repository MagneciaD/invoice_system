<!-- resources/views/partials/modals/create_client.blade.php -->
<div class="modal fade" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('clients.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientModalLabel">Add New Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="client_details" class="form-label">Client Details</label>
                        <textarea class="form-control" id="client_details" name="client_details" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email (optional)</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone (optional)</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                    <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Client</button>
                </div>
            </div>
        </form>
    </div>
</div>
