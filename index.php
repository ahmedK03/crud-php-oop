<?php
$title = 'PHP Crud';
@include('./public/header.php');
?>
<div class="row">
    <div class="col-md-6">
        <h4 class="text-secondary fw-semibold">Users List</h4>
    </div>
    <div class="col-md-6">
        <a href="pages/add-user.php" class="btn btn-primary float-end">Add New User</a>
        <!-- <a href="#" class="btn btn-success float-end me-2">Export To Excel</a> -->
    </div>
</div>
<hr class="mt-3 mb-2">
<div class="row ">
    <div class="col-lg-12">
        <div class="table-responsive" id="showUsersList">
            <table class="table table-sm table-bordered table-sm" id="usersDataTable">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-mail</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- list all the users -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--  Edit Modal -->
<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit User Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-alert">
                <!-- alert goes here -->
            </div>
            <form action="" method="POST" id="edit-user">
                <div class="modal-body">
                    <div class="row justify-content-center g-0">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="e-fName">First Name</label>
                                <input type="text" id="e-fName" name="fName" placeholder="Enter First Name" class="form-control" required />
                            </div>
                            <div class="form-group mt-3">
                                <label for="e-lName">Last Name</label>
                                <input type="text" id="e-lName" name="lName" placeholder="Enter Last Name" class="form-control" required />
                            </div>
                            <div class="form-group mt-3">
                                <input type="hidden" name="id" id="edit-id" />
                                <label for="e-email">Email Address</label>
                                <input type="text" id="e-email" name="email" placeholder="Enter Your Email" class="form-control" required />
                            </div>
                            <div class="form-group mt-3">
                                <label for="e-phone">Phone Number</label>
                                <input type="tel" id="e-phone" name="phone" placeholder="Enter Your Number" class="form-control" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update" id="editUser" class="btn btn-primary me-auto">Edit User</button>
                    <a href="#" type="button" class="btn btn-secondary float-start " data-bs-dismiss="modal">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body py-4">
                <div class="delete-alert text-center" style="min-height: 250px;">
                    <i class="fa-solid fa-circle-exclamation fa-7x text-danger"></i>
                    <h4 class="mt-3 fw-semibold">Are You Sure?</h4>
                    <p class="text-secondary mb-2">You won't be able to revert this!</p>
                    <form action="" id="del-user">
                        <div class="mt-3">
                            <input type="hidden" name="delete" id="delete_id">
                            <button type="submit" name="delete" id="delUser" class="btn btn-outline-danger">Yes, Delete it!</button>
                            <button type="button" class="btn btn-info ms-2" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                <div class="done-alert text-center flex-column justify-content-center" style="min-height: 250px;">
                    <i class="fa-solid fa-circle-check fa-7x text-success"></i>
                    <h4 class="mt-3 fw-semibold">User Deleted Succesfully!</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Details Modal -->
<div class="modal fade" id="viewDetails" tabindex="-1" aria-labelledby="viewDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDetailsLabel">About
                    <span id="userFirstName" class="text-capitalize"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-left mb-3">
                    <i class="fa-solid fa-user fa-6x"></i>
                </div>
                <h2 class="fs-2 fw-light lh-1 user-full-name text-capitalize">

                </h2>
                <p class="mt-3 user-email"></p>
                <p class="user-phone"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-auto" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php @include('./public/footer.php'); ?>