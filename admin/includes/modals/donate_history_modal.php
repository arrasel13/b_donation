<!-- Add Blood Group Modal -->
<div class="modal fade" id="donationDateAdd" tabindex="-1" aria-labelledby="donationDateAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="donationDateAddLabel">Add Donation Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="donate_history_process.php" method="post" class="row g-3">
                    <div class="col-md-12">
                        <label for="display_name" class="form-label">Display Name</label>
                        <input type="hidden" class="form-control uid" id="uid" name="uid" value="<?= $userid; ?>" required>
                        <input type="text" class="form-control display_name" id="display_name" name="display_name" value="<?= $username; ?>" placeholder="Display Name" readonly required>
                    </div>

                    <div class="col-md-12">
                        <label for="donate_date" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control donate_date" id="donate_date" name="donate_date" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="saveRecord_btn" class="btn btn-primary">Save Record</button>
            </div>
                </form>
        </div>
    </div>
</div>


