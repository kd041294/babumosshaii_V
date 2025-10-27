<!-- Schedule Visit Modal -->
<div class="modal fade" id="scheduleVisitModal" tabindex="-1" aria-labelledby="scheduleVisitModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="scheduleVisitModalLabel">
                    <i class="bi bi-calendar-event me-2"></i> Schedule Your Visit
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="scheduleVisitForm">
                    <input type="hidden" name="hall_id" value="<?= $hall_id ?>" />
                    <input type="hidden" name="user_id" value="<?= htmlspecialchars($banquet['_user_id']) ?>" />
                    <div class="row g-3">
                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="fullName" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName"
                            placeholder="Enter Full Name" required style="text-transform: capitalize"/>
                        </div>
                        <!-- Contact Number -->
                        <div class="col-md-6">
                            <label for="contactNumber" class="form-label fw-semibold">Contact Number</label>
                            <input type="tel" class="form-control" id="contactNumber" name="contactNumber"
                            maxlength="10" placeholder="Enter Contact Number" pattern="[0-9]{10}" />
                        </div>
                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" />
                        </div>
                        <!-- Visit Date -->
                        <div class="col-md-6">
                            <label for="visitDate" class="form-label fw-semibold">Preferred Visit Date</label>
                            <input type="date" class="form-control" id="visitDate" name="visitDate"
                            min="<?= date('Y-m-d') ?>" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="scheduleVisitForm" class="btn btn-success px-4">
                    <i class="bi bi-check-circle me-1"></i> Confirm Schedule
                </button>
            </div>
        </div>
    </div>
</div>
