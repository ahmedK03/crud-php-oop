<?php
require_once("../modals/operations.php");
$operation = new dbOperations(connection: $connection);

function displayUsers()
{
    global $operation;
    $output = '';
    // grap the request sent by ajax
    if (isset($_GET['action']) && $_GET['action'] == 'view') {
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
        } else {
            echo '<tr><h3 class="text-center">No Records Found</h3></tr>';
        }
    }
    return true;
}
// any echo command is simply the responce that the ajax is receiving
displayUsers();


// add records to the operation
function addUsers()
{
    global $operation;
    if (isset($_POST['action']) && $_POST['action'] == 'insert') {
        $fname = trim($_POST['fName']);
        $lname = trim($_POST['lName']);
        $email = $_POST['email'];
        $phone = trim($_POST['phone']);
        $operation->insert($fname, $lname, $email, $phone);
        // print_r([$fname, $lname, $email, $phone]);
    };
    return true;
}
addUsers();


function updateUser()
{
    global $operation;
    // get solo user info
    if (isset($_GET['editId'])) {
        $id = $_GET['editId'];
        $userDetails = $operation->getUserById($id);
        echo json_encode($userDetails);
    }
    // update user info
    if (isset($_POST['action']) && $_POST['action'] == 'update') {
        $id = $_POST['id'];
        $fname = trim($_POST['fName']);
        $lname = trim($_POST['lName']);
        $email = $_POST['email'];
        $phone = trim($_POST['phone']);
        $operation->update($id, $fname, $lname, $email, $phone);
    }
    return true;
}
updateUser();

function deleteUser()
{
    global $operation;
    if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $id = $_POST['id'];
        $operation->delete($id);
    }
}
deleteUser();
// in case of an error or opening the file
// return 404
