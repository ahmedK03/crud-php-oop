<?php
$title = 'PHP Crud';
@include('./public/header.php');
?>
<div class="row">
    <div class="col-md-6">
        <h4 class="text-secondary fw-semibold">Users List</h4>
    </div>
    <div class="col-md-6">
        <a href="views/adduser.php" class="btn btn-primary float-end">Add New User</a>
        <a href="#" class="btn btn-success float-end me-2">Export To Excel</a>
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

                </tbody>
            </table>
        </div>
    </div>
</div>
<?php @include('./public/footer.php'); ?>