<?php
require_once("../modals/operations.php");
$newDataBase = new dbOperations($connection);


function displayUsers()
{
    global $newDataBase;
    $output = '';
    // grap the request sent by ajax
    if (isset($_POST['action']) && $_POST['action'] == 'view') {
        $usersData = $newDataBase->read();
        // check if there are any records at the database
        if ($newDataBase->totalRowCount() != 0) {
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
                        <a href="#" class="text-warning me-2 text-decoration-none" title="edit data">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>
                        <a href="#" class="text-danger text-decoration-none" title="delete user">
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

// in case of an error or opening the file
// return 404
