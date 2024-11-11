<?php
// Include the database connection
include("db_connection.php");
include_once("Class/useradmin.class.php");

session_start();
$useradmin = new Useradmin();

class DeleteUserController {
    private $useradmin;

    public function __construct($useradmin) {
        $this->useradmin = $useradmin;
    }

    public function deleteUser($id) {
        return $this->useradmin->deleteUserById($id);
    }
}

// Check if the user ID is passed via the GET request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new DeleteUserController($useradmin);

    // Call the deleteUser method
    if ($controller->deleteUser($id)) {
        echo "<script>alert('User deleted successfully!'); window.location.href='useradmin.php';</script>";
    } else {
        echo "<script>alert('Error deleting user!'); window.location.href='useradmin.php';</script>";
    }
} else {
    echo "<script>alert('No user ID provided!'); window.location.href='useradmin.php';</script>";
}
?>
