<?php
require_once("../modals/operations.php");

// grap the request sent by ajax
if (isset($_POST['action']) && $_POST['action'] == 'view') {
    echo 'done from controllerss';
} else {
    echo 'fail';
}
