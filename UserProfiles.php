<?php
session_start();
include 'db_connection.php';
include_once 'Class/useradmin.class.php';
include_once 'logoutcontroller.php';
include_once 'Class/user.class.php';

$user = new User();
$logoutController = new LogoutController;
// Initialize user admin instance
$useradmin = new useradmin();
$id = $_SESSION['id']; //store session id into $id

if ($user->get_usertype($id) !== "admin") {
    header("location:error.php");
    exit();
    }

if (isset($_GET['q'])){ //get q variable to logout
 $logoutController->handleLogout(); //log user out with session destroy
 }
 $admin_fullname = trim($user->get_fullname($id));

// FetchUserProfileController class
class FetchUserProfileController {
    public $useradmin;

    public function __construct($useradmin) {
        $this->useradmin = $useradmin;
    }

    public function fetchAllUserProfiles() {
        return $this->useradmin->fetchAllUserProfiles();
    }
}

// SearchUserProfileController class
class SearchUserProfileController {
    public $useradmin;

    public function __construct($useradmin) {
        $this->useradmin = $useradmin;
    }

    public function searchUserProfiles($username, $gender, $phoneNumber) {
        return $this->useradmin->searchUserProfiles($username, $gender, $phoneNumber);
    }
}

// FetchUserProfileBoundary class
class FetchUserProfileBoundary {
    public $fetchController;

    public function __construct($fetchController) {
        $this->fetchController = $fetchController;
    }

    public function displayUserProfiles() {
        $result = $this->fetchController->fetchAllUserProfiles();
        if ($result && $result->num_rows > 0) {
            echo "<table class='table table-striped'>";
            echo "<thead class='thead-light'><tr><th>ID</th><th>Username</th><th>Gender</th><th>Phone Number</th><th>Manage</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                echo "<td>
                    <a href='manageUserProf.php?id=" . $row['id'] . "' class='btn btn-secondary'>Manage</a>
                </td>";
            echo "</tr>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No user profiles found.</p>";
        }
    }
}

// SearchUserProfileBoundary class
class SearchUserProfileBoundary {
    public $searchController;

    public function __construct($searchController) {
        $this->searchController = $searchController;
    }

    public function displaySearchResults($username, $gender, $phoneNumber) {
        $result = $this->searchController->searchUserProfiles($username, $gender, $phoneNumber);
        if ($result && $result->num_rows > 0) {
            echo "<table class='table table-striped'>";
            echo "<thead class='thead-light'><tr><th>ID</th><th>Username</th><th>Gender</th><th>Phone Number</th><th>Manage</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
                echo "<td>" . htmlspecialchars($row['phone_number']) . "</td>";
                echo "<td>
                    <a href='manageUserProf.php?id=" . $row['id'] . "' class='btn btn-secondary'>Manage</a>
                </td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No results found based on your search criteria.</p>";
        }
    }

    public function displaySearchForm() {
        $username = isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '';
        $gender = isset($_GET['gender']) ? htmlspecialchars($_GET['gender']) : '';
        $phoneNumber = isset($_GET['phone_number']) ? htmlspecialchars($_GET['phone_number']) : '';

        echo "
        <form method='GET' action='UserProfiles.php' class='mb-4'>
            <div class='row'>
                <div class='col-md-4'>
                    <input type='text' name='username' class='form-control' placeholder='Username' value='$username'>
                </div>
                <div class='col-md-3'>
                    <select name='gender' class='form-control'>
                        <option value=''>Select Gender</option>
                        <option value='Male' " . ($gender === 'Male' ? 'selected' : '') . ">Male</option>
                        <option value='Female' " . ($gender === 'Female' ? 'selected' : '') . ">Female</option>
                        <option value='NIL' " . ($gender === 'NIL' ? 'selected' : '') . ">NIL</option>
                    </select>
                </div>
                <div class='col-md-3'>
                    <input type='text' name='phone_number' class='form-control' placeholder='Phone Number' value='$phoneNumber'>
                </div>
                <div class='col-md-2'>
                    <button type='submit' class='btn btn-primary'>Search</button>
                    <a href='UserProfiles.php' class='btn btn-secondary'>Reset</a>
                </div>
            </div>
        </form>";
    }
}

// Instantiate controllers and boundaries
$fetchController = new FetchUserProfileController($useradmin);
$searchController = new SearchUserProfileController($useradmin);

$fetchBoundary = new FetchUserProfileBoundary($fetchController);
$searchBoundary = new SearchUserProfileBoundary($searchController);

?>
<!DOCTYPE html>
<html>
<head>
    <title>View User Profiles</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="useradmin.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link">Welcome, <?php echo htmlspecialchars($admin_fullname); ?>!</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm btn-outline-primary" href="UserProfiles.php?q=logout">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container mt-4">
        <h1>View User Profiles</h1>
        <?php
        // Display search form
        $searchBoundary->displaySearchForm();

        // Display results
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && (isset($_GET['username']) || isset($_GET['gender']) || isset($_GET['phone_number']))) {
            $username = $_GET['username'] ?? '';
            $gender = $_GET['gender'] ?? '';
            $phoneNumber = $_GET['phone_number'] ?? '';
            $searchBoundary->displaySearchResults($username, $gender, $phoneNumber);
        } else {
            $fetchBoundary->displayUserProfiles();
        }
        ?>
    </div>
</body>
</html>
