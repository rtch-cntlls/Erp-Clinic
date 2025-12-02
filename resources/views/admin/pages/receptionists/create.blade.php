<div class="modal fade" id="createReceptionistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-sm border-0">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="bi bi-person-plus me-2"></i> Add Receptionist
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <form action="{{ route('admin.receptionists.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6 form-floating">
                            <input type="text" name="name" class="form-control rounded-3" placeholder="Full Name" required>
                            <label class="small" for="name">Full Name</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="email" name="email" class="form-control rounded-3" placeholder="Email" required>
                            <label class="small" for="email">Email</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="text" name="phone" class="form-control rounded-3" placeholder="Phone" required>
                            <label class="small" for="phone">Phone</label>
                        </div>
                        <div class="col-md-6 form-floating">
                            <input type="password" name="password" class="form-control rounded-3" placeholder="Password" required>
                            <label class="small" for="password">Password</label>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-success rounded-pill px-4">
                            <i class="bi bi-check-circle me-1"></i> Save Receptionist
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
