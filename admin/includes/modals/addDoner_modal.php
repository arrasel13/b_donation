<!-- Add Blood Group Modal -->
<div class="modal fade" id="newDonerAdd" tabindex="-1" aria-labelledby="newDonerAddLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newDonerAddLabel">Add New Donner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

                <div class="modal-body">
                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="row g-3" enctype="multipart/form-data">
                        <div class="col-md-6">
                             <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control fname" id="fname" name="fname" placeholder="First Name" autofocus required>
                        </div>
                        <div class="col-md-6">
                             <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control lname" id="lname" name="lname" placeholder="Last Name" required>
                        </div>

                        <div class="col-md-6">
                             <label for="display_name" class="form-label">Display Name</label>
                            <input type="text" class="form-control display_name" id="display_name" name="display_name" placeholder="Display Name" required>
                        </div>
                        <div class="col-md-6">
                             <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control email" id="email" name="email" placeholder="Email ID" required>
                        </div>

                        <div class="col-md-6">
                             <label for="contact_no" class="form-label">Mobile No</label>
                            <input type="text" class="form-control contact_no" id="contact_no" name="contact_no" placeholder="Mobile Number" required>
                        </div>
                        <div class="col-md-6">
                             <label for="doner_image" class="form-label">Your Image</label>
                            <input type="file" class="form-control doner_image" id="doner_image" name="doner_image" required>
                        </div>

                        <div class="col-md-3">
                             <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control dob" id="dob" name="dob" placeholder="dob" required>
                        </div>
                        <div class="col-md-3">
                             <label for="age" class="form-label">Age</label>
                            <input type="text" class="form-control age" id="age" name="age" placeholder="Age" required>
                        </div>
                        <div class="col-md-3">
                             <label for="gender" class="form-label">Gender</label>
                            <select id="gender" class="form-select gender" name="gender" required>
                                <option selected>Gender...</option>
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                             <label for="blood_group" class="form-label">Blood Group</label>
                            <select id="blood_group" class="form-select blood_group" name="blood_group" required>
                                <option selected>Blood Group...</option>
                                <?php if ($b_group_query->num_rows > 0): ?>
                                    <?php while($b_group_name = $b_group_query->fetch_assoc()): ?>
                                        <option value="<?= $b_group_name['id']; ?>"><?= $b_group_name['b_group_name']; ?></option>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <option>No Blood Group Recorded</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-12">
                             <label for="contact_address" class="form-label">Your Address</label>
                            <textarea class="form-control contact_address" id="contact_address" name="contact_address" rows="3" placeholder="Your Address" required></textarea>
                        </div>
                        <div class="col-12">
                             <label for="additional_info" class="form-label">Additional Information</label>
                            <textarea class="form-control additional_info" id="additional_info" name="additional_info" rows="5" placeholder="Additional Information (optional)"></textarea>
                        </div>

                        <div class="col-md-3">
                             <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control password" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="col-md-3">
                             <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control confirm_password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                        </div>
                        <div class="col-md-3">
                             <label for="doner_status" class="form-label">Status</label>
                            <select id="doner_status" class="form-select doner_status" name="doner_status">
                                <option selected>Choose Status...</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="doner_role" class="form-label">Role</label>
                            <select id="doner_role" class="form-select doner_role" name="doner_role" required>
                                <option selected>Choose Role...</option>
                                <option value="1">Admin</option>
                                <option value="2">General</option>
                            </select>
                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="saveDoner_btn" class="btn btn-primary">Save Doner Info</button>
                </div>
            </form>
        </div>
    </div>
</div>