<?php
$title = 'Add New User';
@include('../assets/header.php');
?>
<div class="row">
    <div class="col-lg-5 offset-1">
        <h4>Here you can add new users</h4>
        <br>
        <div id="success-alert" class="alert alert-dismissible alert-success d-none">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>User Added Successfully</strong>
        </div>
        <form action="" method="POST" id="add-user">
            <div class="form-group">
                <label for="fName">First Name</label>
                <input type="text" id="fName" name="fName" placeholder="Enter First Name" class="form-control" required />
            </div>
            <div class="form-group mt-3">
                <label for="lName">Last Name</label>
                <input type="text" id="lName" name="lName" placeholder="Enter Last Name" class="form-control" required />
            </div>
            <div class="form-group mt-3">
                <label for="email">Email Address</label>
                <input type="text" id="email" name="email" placeholder="Enter Your Email" class="form-control" required />
            </div>
            <div class="form-group mt-3">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter Your Number" class="form-control" required />
            </div>
            <div class="form-group mt-3">
                <button type="submit" name="insert" id="addUsers" class="btn btn-primary">Add User</button>
            </div>
        </form>
    </div>
</div>


<?php @include('../assets/footer.php') ?>