<?php
include_once 'Class/user.class.php'; // Include the LogoutEntity

class LogoutController {
    public $user;

    public function __construct() {
        $this->user = new User(); // Instantiate the entity
    }

    public function handleLogout() {
        $this->user->user_logout(); // Log out the user
        header("Location: login.php"); // Redirect to login page
        exit(); // Ensure the script stops after redirection
    }
}
?>
