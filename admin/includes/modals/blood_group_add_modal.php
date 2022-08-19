<!-- Add Blood Group Modal -->
<div class="modal fade" id="bloodGroupAdd" tabindex="-1" aria-labelledby="bloodGroupAddLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bloodGroupAddLabel">Add Blood Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" class="row g-3">
                <div class="modal-body">
                    <div class="col-md-12">
                        <label for="blood_group" class="form-label">Blood Group</label>
                        <input type="text" class="form-control blood_group" id="blood_group" name="blood_group">
                    </div>
                    <div class="col-md-12">
                        <label for="activeStatus" class="form-label">Status</label>
                        <select id="activeStatus" class="form-select bg_status" name="bg_status">
                            <option selected>Choose Status...</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="blood_group_btn" class="btn btn-primary">Save Blood Group</button>
                </div>
            </form>
        </div>
    </div>
</div>
