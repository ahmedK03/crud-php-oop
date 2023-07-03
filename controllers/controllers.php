<?php
require_once("../modals/operations.php");
require_once("utils.php");
$utils = new Utils;

/**
 * configure actions on ajax requests
 */
class UserController extends DatabaseOperations
{
    public function showAllUsers()
    {
        $output = '';
        $usersData = DatabaseOperations::read();
        // check if there are any records at the operation
        if (DatabaseOperations::totalRowCount() > 0) {
            foreach ($usersData as $tableRows) {
                $output =
                    '<tr class="text-center text-mute">
                    <td>' . $tableRows['id'] . '</td>
                    <td>' . $tableRows['first_name'] . '</td>
                    <td>' . $tableRows['last_name'] . '</td>
                    <td>' . $tableRows['email'] . '</td>
                    <td>' . $tableRows['phone_number'] . '</td>
                    <td>
                        <a href="#" class="text-success me-2 text-decoration-none btn-details"
                        data-bs-toggle="modal" data-bs-target="#viewDetails"
                        data-id="' . $tableRows['id'] . '" title="view details">
                            <i class="fa-solid fa-circle-plus"></i>
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
        DatabaseOperations::insert($fname, $lname, $email, $phone);
        return true;
    }

    public function singleUserInfo($id)
    {
        $userDetails = DatabaseOperations::getUserById($id);
        return json_encode($userDetails);
    }

    public function updateUserInfo($id, $fname, $lname, $email, $phone)
    {
        DatabaseOperations::update($id, $fname, $lname, $email, $phone);
        return true;
    }

    public function deleteUser($id)
    {
        DatabaseOperations::delete($id);
        return true;
    }

    public function exportToExcel()
    {
        // define header properties
        header("Content-Disposition: attachment; filename:users.xls");
        header("Content-Type: application/vnd.ms-excel;  name='excel'");
        header("Pargma: no-cache");
        header("Expires: 0");

        $dataRows = DatabaseOperations::read();
?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
            </tr>
            <?php
            foreach ($dataRows as $row) {
            ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['first_name'] ?></td>
                    <td><?php echo $row['last_name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['phone_number'] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
<?php
        return true;
    }
}

$users = new UserController;

// check incoming requests
if (isset($_GET['action'])) {
    $_GET['action'] == 'view' ? $users->showAllUsers() : null;
}
if (isset($_GET['user_id'])) {
    $id = $_GET['user_id'];
    echo $users->singleUserInfo($id);
}
// export to excel & not working
if (isset($_GET['export']) && $_GET['export'] == 'excel') {
    $users->exportToExcel();
}

if (isset($_POST['action'])) {
    $id = $_POST['id'];
    $fname = $utils->sanitizeInputs($_POST['fName']);
    $lname = $utils->sanitizeInputs($_POST['lName']);
    $email = $utils->sanitizeInputs($_POST['email']);
    $phone = $utils->sanitizeInputs($_POST['phone']);
    // to add new user
    if ($_POST['action'] == 'insert') {
        $users->addUser($fname, $lname, $email, $phone);
    }
    // to update user
    if ($_POST['action'] == 'update') {
        $users->updateUserInfo($id, $fname, $lname, $email, $phone);
    }
    // to delete user
    if ($_POST['action'] == 'delete') {
        $users->deleteUser($id);
    }
}

// in case of an error or opening the file
// return 404