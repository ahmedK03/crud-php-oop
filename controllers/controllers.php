<?php
require_once("../modals/operations.php");
$operation = new dbOperations(connection: $connection);


class UserController
{
    public function showAllUsers()
    {
        global $operation;
        $output = '';
        $usersData = $operation->read();
        // check if there are any records at the operation
        if ($operation->totalRowCount() != 0) {
            foreach ($usersData as $tableRows) {
                $output =
                    '<tr class="text-center text-mute">
                    <td>' . $tableRows['id'] . '</td>
                    <td>' . $tableRows['first_name'] . '</td>
                    <td>' . $tableRows['last_name'] . '</td>
                    <td>' . $tableRows['email'] . '</td>
                    <td>' . $tableRows['phone_number'] . '</td>
                    <td>
                        <a href="#" class="text-success me-2 text-decoration-none" title="view details">
                            <i class="fa-solid fa-circle-info"></i>
                        </a>
                        <a href="#" class="text-warning me-2 text-decoration-none btn-edit" data-bs-toggle="modal" data-bs-target="#editModal" title="edit data" data-id="' . $tableRows['id'] . '">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="text-danger text-decoration-none btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" title="delete user"
                        data-id="' . $tableRows['id'] . '">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                    </td>
                </tr>';
                echo $output;
            }
        }
        return true;
    }

    public function addUser($fname, $lname, $email, $phone)
    {
        global $operation;
        $operation->insert($fname, $lname, $email, $phone);
        return true;
    }

    public function singleUserInfo($id)
    {
        global $operation;
        $userDetails = $operation->getUserById($id);
        return json_encode($userDetails);
    }

    public function updateUserInfo($id, $fname, $lname, $email, $phone)
    {
        global $operation;
        $operation->update($id, $fname, $lname, $email, $phone);
        return true;
    }

    public function deleteUser($id)
    {
        global $operation;
        $operation->delete($id);
        return true;
    }
}

$users = new UserController;

// check incoming requests
if (isset($_GET['action'])) {
    $_GET['action'] == 'view' ? $users->showAllUsers() : null;
}
if (isset($_GET['editId'])) {
    $id = $_GET['editId'];
    echo $users->singleUserInfo($id);
}
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'insert') {
        $fname = trim($_POST['fName']);
        $lname = trim($_POST['lName']);
        $email = $_POST['email'];
        $phone = trim($_POST['phone']);
        $users->addUser($fname, $lname, $email, $phone);
    }
    if ($_POST['action'] == 'update') {
        $id = $_POST['id'];
        $fname = trim($_POST['fName']);
        $lname = trim($_POST['lName']);
        $email = $_POST['email'];
        $phone = trim($_POST['phone']);
        $users->updateUserInfo($id, $fname, $lname, $email, $phone);
    }
    if ($_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $users->deleteUser($id);
    }
}


// in case of an error or opening the file
// return 404
