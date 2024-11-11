<?php
// Include the database connection and Useradmin class
include("db_connection.php");
include_once("Class/useradmin.class.php");

session_start();

// Controller to handle the logic
class ManageUserProfileController {
    private $useradmin;

    public function __construct() {
        $this->useradmin = new Useradmin();
    }

    // Fetch user by ID
    public function fetchUserById($id) {
        return $this->useradmin->fetchUserById($id);
    }

    // Update user details
    public function updateUser($id, $updates) {
        return $this->useradmin->updateUserProfile($id, $updates);
    }
}

// Boundary to display the form and handle form submission
class ManageUserProfileBoundary {
    private $controller;

    public function __construct($controller) {
        $this->controller = $controller;
    }

    public function displayForm($user) {
        ?>
        <div class="container mt-5">
            <h2 class="mb-4">Manage User Profile</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>">
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" name="gender">
                        <option value="Male" <?php if($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                        <option value="NIL" <?php if($user['gender'] == 'NIL') echo 'selected'; ?>>NIL</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" class="form-control" name="phone_number" value="<?php echo $user['phone_number']; ?>">
                </div>

                <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href='UserProfiles.php';">Back</button>
            </form>
        </div>
        <?php
    }

    public function handleUpdate($id) {
        if (isset($_POST['update'])) {
            // Prepare updates array with only the fields that are filled in
            $updates = [];
            if (!empty($_POST['username'])) {
                $updates['username'] = $_POST['username'];
            }
            if (!empty($_POST['gender'])) {
                $updates['gender'] = $_POST['gender'];
            }
            if (!empty($_POST['phone_number'])) {
                $updates['phone_number'] = $_POST['phone_number'];
            }

            if (!empty($updates)) {
                // Call the controller's update method
                if ($this->controller->updateUser($id, $updates)) {
                    echo "<script>alert('Profile updated successfully!'); window.location.href='UserProfiles.php';</script>";
                } else {
                    echo "<p class='text-danger'>Error updating profile.</p>";
                }
            } else {
                echo "<p class='text-warning'>No changes were made.</p>";
            }
        }
    }
}

// Initialize controller and boundary classes
$controller = new ManageUserProfileController();
$boundary = new ManageUserProfileBoundary($controller);

// Check if the user ID is passed via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = $controller->fetchUserById($id);

    if (!$user) {
        echo "<p class='text-danger'>User not found!</p>";
        exit();
    }

    // Handle the form submission for updating user details
    $boundary->handleUpdate($id);
} else {
    echo "<p class='text-danger'>No user ID provided!</p>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User Profile</title>
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
