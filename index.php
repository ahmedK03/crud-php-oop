<?php
$title = 'PHP Crud';
@include('./public/header.php');
?>
<div class="row">
    <div class="col-md-6">
        <h4 class="text-secondary fw-semibold">Users List</h4>
    </div>
    <div class="col-md-6">
        <button class="btn btn-primary float-end">Add New User</button>
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
                <tbody>
                    <?php for ($i = 1; $i <= 100; $i++) : ?>
                        <tr class="text-center text-mute">
                            <td><?php echo (110 + $i) ?></td>
                            <td><?php echo 'User' . $i ?></td>
                            <td><?php echo 'lName' . $i ?></td>
                            <td>user.<?php echo (10 + $i) ?>@aol.net</td>
                            <td>012<?php echo rand(1, 9); ?>97<?php echo random_int(1, 9); ?>5694</td>
                            <td>
                                <a href="#" class="text-success me-2 text-decoration-none" title="view details">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                                <a href="#" class="text-warning me-2 text-decoration-none" title="edit data">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="text-danger text-decoration-none" title="delete user">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php @include('./public/footer.php'); ?>