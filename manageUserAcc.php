<?php
// Include the database connection and Useradmin class
include("db_connection.php");
include_once("Class/useradmin.class.php");

session_start();

// Controller to handle the logic
class ManageUserController {
    private $useradmin;

    public function __construct() {
        $this->useradmin = new Useradmin();
    }

    // Fetch user by ID
    public function fetchUserById($id) {
        return $this->useradmin->fetchUserById($id);
    }

    // Update user details
    public function updateUser($id, $fullname, $email, $usertype) {
        return $this->useradmin->updateUser($id, $fullname, $email, $usertype);
    }
    // Reset user password
    public function resetPassword($id, $newPassword) {
        return $this->useradmin->resetPassword($id, $newPassword);
    }
}

// Boundary to display the form and handle form submission
class ManageUserBoundary {
    private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function displayForm($user) {
        ?>
        <div class="container mt-5">
            <h2 class="mb-4">Manage User Account</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" class="form-control" name="fullname" value="<?php echo $user['fullname']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="usertype">User Type:</label>
                    <select class="form-control" name="usertype">
                        <option value="buyer" <?php if($user['usertype'] == 'buyer') echo 'selected'; ?>>Buyer</option>
                        <option value="seller" <?php if($user['usertype'] == 'seller') echo 'selected'; ?>>Seller</option>
                        <option value="admin" <?php if($user['usertype'] == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="agent" <?php if($user['usertype'] == 'agent') echo 'selected'; ?>>Agent</option>
                    </select>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update User</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='useradmin.php';">Back</button>
            </form>
            <!-- Password reset form -->
            <h4 class="mt-4">Reset Password</h4>
            <form method="post" action="">
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" class="form-control" name="new_password" required>
                </div>
                <button type="submit" name="reset_password" class="btn btn-warning">Reset Password</button>
            </form>
        </div>
        <?php
    }

    public function handleUpdate($id) {
        if (isset($_POST['update'])) {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $usertype = $_POST['usertype'];

            // Call the controller's update method
            if ($this->controller->updateUser($id, $fullname, $email, $usertype)) {
                echo "<script>alert('User updated successfully!'); window.location.href='useradmin.php';</script>";
            } else {
                echo "Error updating record.";
            }
        }
        // Handle password reset
        if (isset($_POST['reset_password'])) {
            $newPassword = $_POST['new_password'];

            // Call the controller's resetPassword method
            if ($this->controller->resetPassword($id, $newPassword)) {
                echo "<script>alert('Password reset successfully!'); window.location.href='useradmin.php';</script>";
            } else {
                echo "Error resetting password.";
            }
        }
    }

}

// Initialize controller and boundary classes
$controller = new ManageUserController();
$boundary = new ManageUserBoundary($controller);

// Check if the user ID is passed via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $controller->fetchUserById($id); //Store entire record of the user based on id

    if (!$user) {
        echo "User not found!";
        exit();
    }

    // Handle the form submission for updating user details
    $boundary->handleUpdate($id);
} else {
    echo "No user ID provided!";
    exit();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    // Display the form with user data
    $boundary->displayForm($user);
    ?>
    <!-- Optional Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
