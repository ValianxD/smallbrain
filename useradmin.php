<?php
session_start();
include 'db_connection.php';
include_once 'Class/user.class.php';
include_once 'Class/useradmin.class.php';
include_once 'logoutcontroller.php';

$logoutController = new LogoutController;
$user = new User(); 
$useradmin = new useradmin();
$id = $_SESSION['id']; //store session id into $id

if (!$user->get_session($id)){ //if user is not logged in
 header("location:login.php"); //redirect to login.php *this also disables access to index.php from browser url*
 exit();
}

if ($user->get_usertype($id) !== "admin") {
    header("location:error.php");
    exit();
    }

if (isset($_GET['q'])){ //get q variable to logout
 $logoutController->handleLogout(); //log user out with session destroy
 }

$admin_fullname = trim($user->get_fullname($id));

// Display message if it's set in the session
if (isset($_SESSION['message'])) {
    echo "<script type='text/javascript'>
        window.onload = function() {
            displayMessage('" . addslashes(htmlspecialchars($_SESSION['message'])) . "');
        };
    </script>";
    unset($_SESSION['message']); // Clear the message after displaying it
}
// Define CreateUserController class
class CreateUserAccController {// Display message if it's set in the session
    public $useradmin;


    public function __construct($useradmin) {
        $this->useradmin = $useradmin;
    }

   
    public function handleRegistration() {
        if (isset($_POST['registerbtn'])) {
            // Retrieve input values directly, as prepared statements will handle escaping
            $registerfullname = $_POST['registerfullname'];
            $registeremail = $_POST['registeremail'];
            $registerpassword = $_POST['registerpassword'];
            $registerusertype = $_POST['registerusertype'];

            // Call function in createUserController
            $created = $this->useradmin->createUserAcc($registerfullname, $registeremail, $registerusertype, $registerpassword);
            
            if ($created === 'success') {
                $_SESSION['message'] = "Registration successful! Redirecting...";
                header("Location: useradmin.php");
                exit();
            } else {
                $_SESSION['message'] = implode(', ', $created); // Concatenate any error messages
                header("Location: useradmin.php");
                exit();
}

        }
    }   
}

// Instantiate classes
$userAdmin = new Useradmin();
$createUserAccController = new CreateUserAccController($useradmin);
$createUserAccController->handleRegistration();
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--link to styles.css-->
    <link rel="stylesheet" href="./styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <title>Home</title>
</head>

<body>
    <!--start of navbar-->
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="useradmin.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link">Welcome, <?php echo htmlspecialchars($admin_fullname); ?>!</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-custom-log" href="UserProfiles.php">View User Profiles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-custom-log" href="userAdmin.php?q=logout">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--end of navbar-->
    <!--start of container-->
    <div class="container">
        <div class="row">
            <div class="col">
                <!--start of nav tablist-->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-manage-tab" data-toggle="tab" href="#nav-manage"
                            role="tab" aria-controls="nav-manage" aria-selected="true">View User Accounts</a>
                        <a class="nav-item nav-link" id="nav-create-tab" data-toggle="tab" href="#nav-create" role="tab"
                            aria-controls="nav-create" aria-selected="false">Create Users</a>
                        <a class="nav-item nav-link" id="nav-suspend-tab" data-toggle="tab" href="#nav-suspend"
                            role="tab" aria-controls="nav-suspend" aria-selected="false">Suspend/Restore Users</a>
                    </div>
                </nav>
                <!--start of tab div contents-->
                <div class="tab-content" id="nav-tabContent">
                    <!--start of users manage tab-->
                    <div class="tab-pane fade show active" id="nav-manage" role="tabpanel" aria-labelledby="nav-manage-tab">
                    <?php         
                        // FetchUsersAccController
                        class FetchUsersAccController {
                            public $useradmin;

                            public function __construct($useradmin) {
                                $this->useradmin = $useradmin;
                            }

                            public function fetchAllUsersAcc() {
                                return $this->useradmin->fetchAllUsersAcc();
                            }
                        }
                        // FetchUsersBoundary
                        class FetchAllUsersAccBoundary {
                            public $fetchUserController;

                            public function __construct($fetchUserController) {
                                $this->fetchUserController = $fetchUserController;
                            }
                            public function displayUsers() {
                                $result = $this->fetchUserController->fetchAllUsersAcc();

                                if ($result && $result->num_rows > 0) {
                                    echo "<table class='table table-striped'>";
                                    echo "<tr><th>ID</th><th>Fullname</th><th>Email</th><th>Usertype</th><th>Status</th><th>Action</th><th>Manage</th></tr>";
                                    
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['fullname'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['usertype'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td><a href='deleteUserController.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Delete</button></a></td>";
                                        echo "<td><a href='manageUserAcc.php?id=" . $row['id'] . "'><button class='btn btn-secondary'>Manage</button></a></td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "<p>No users found.</p>";
                                }
                            }
                        }

                        // SearchUsersAccController
                        class SearchUsersAccController {
                            private $useradmin;

                            public function __construct($useradmin) {
                                $this->useradmin = $useradmin;
                            }

                            public function searchUsersAcc($fullname, $email, $usertype, $status) {
                                return $this->useradmin->searchUsersAcc($fullname, $email, $usertype, $status);
                            }
                        }

                        // SearchUsersAccBoundary
                        class SearchUsersAccBoundary {
                            private $searchUsersAccController;

                            public function __construct($searchUsersAccController) {
                                $this->searchUsersAccController = $searchUsersAccController;
                            }

                            public function displaySearchResults($fullname, $email, $usertype, $status) {
                                $result = $this->searchUsersAccController->searchUsersAcc($fullname, $email, $usertype, $status);

                                if ($result && $result->num_rows > 0) {
                                    echo "<table class='table table-striped'>";
                                    echo "<tr><th>ID</th><th>Fullname</th><th>Email</th><th>Usertype</th><th>Status</th><th>Action</th><th>Manage</th></tr>";
                                    
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['fullname'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['usertype'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td><a href='deleteUserController.php?id=" . $row['id'] . "'><button class='btn btn-danger'>Delete</button></a></td>";
                                        echo "<td><a href='manageUserAcc.php?id=" . $row['id'] . "'><button class='btn btn-secondary'>Manage</button></a></td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    echo "<p>No users found matching the search criteria.</p>";
                                }
                            }

                            public function displaySearchForm() {
                                $fullname = isset($_GET['fullname']) ? htmlspecialchars($_GET['fullname']) : '';
                                $email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
                                $usertype = isset($_GET['usertype']) ? htmlspecialchars($_GET['usertype']) : '';
                                $status = isset($_GET['status']) ? htmlspecialchars($_GET['status']) : '';

                                $form = "
                                    <form method='GET' action='useradmin.php' class='mb-4'>
                                        <div class='row'>
                                            <div class='col-md-3'>
                                                <input type='text' name='fullname' class='form-control' placeholder='Fullname' value='$fullname'>
                                            </div>
                                            <div class='col-md-3'>
                                                <input type='text' name='email' class='form-control' placeholder='Email' value='$email'>
                                            </div>
                                            <div class='col-md-2'>
                                                <select name='usertype' class='form-control'>
                                                    <option value=''>Select Usertype</option>
                                                    <option value='buyer' " . ($usertype === 'buyer' ? 'selected' : '') . ">Buyer</option>
                                                    <option value='seller' " . ($usertype === 'seller' ? 'selected' : '') . ">Seller</option>
                                                    <option value='agent' " . ($usertype === 'agent' ? 'selected' : '') . ">Used Car Agent</option>
                                                    <option value='admin' " . ($usertype === 'admin' ? 'selected' : '') . ">User Administrator</option>
                                                </select>
                                            </div>
                                            <div class='col-md-2'>
                                                <select name='status' class='form-control'>
                                                    <option value=''>Select Status</option>
                                                    <option value='1' " . ($status === '1' ? 'selected' : '') . ">Active</option>
                                                    <option value='0' " . ($status === '0' ? 'selected' : '') . ">Suspended</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='col-md-12 d-flex justify-content-center mt-3'>
                                            <button type='submit' class='btn btn-primary btn-spacing'>Search</button>
                                            <a href='useradmin.php' class='btn btn-secondary'>Reset</a>
                                        </div>
                                    </form>
                                ";

                                return $form;
                            }
              }              
                            // Instantiate the necessary classes
                            $useradmin = new useradmin();

                            $fetchUsersAccController = new FetchUsersAccController($useradmin);
                            $fetchAllUsersAccBoundary = new FetchAllUsersAccBoundary($fetchUsersAccController);
                            $searchUsersAccController = new SearchUsersAccController($useradmin);
                            $searchUsersAccBoundary = new SearchUsersAccBoundary($searchUsersAccController);

                            // Display the search form
                            echo $searchUsersAccBoundary->displaySearchForm();  // Displays the search form       
                
                            // Check if search criteria are submitted
                            if (isset($_GET['fullname']) || isset($_GET['email']) || isset($_GET['usertype']) || isset($_GET['status'])) {
                                $fullname = $_GET['fullname'] ?? '';
                                $email = $_GET['email'] ?? '';
                                $usertype = $_GET['usertype'] ?? '';
                                $status = $_GET['status'] ?? '';

                                // Display search results
                                $searchUsersAccBoundary->displaySearchResults($fullname, $email, $usertype, $status);
                            } else {
                                // Display all users by default
                                $fetchAllUsersAccBoundary->displayUsers();
                            }
                        ?>
                        
                    </div>

                    <!-- Start of create user tab -->
                    <div class="tab-pane fade" id="nav-create" role="tabpanel" aria-labelledby="nav-create-tab">
                        <form id="registerUser" method="post">
                            <div class="form-group">
                                <label>Full name</label>
                                <input type="text" class="form-control" name="registerfullname" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="registeremail" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="registerpassword" required>
                            </div>
                            <div class="form-group">
                                <label>User Type</label>
                                <select class="form-control" name="registerusertype" required>
                                    <option value="buyer">Buyer</option>
                                    <option value="seller">Seller</option>
                                    <option value="agent">Used Car Agent</option>
                                    <option value="admin">User Administrator</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary" name="registerbtn" id="registerbtn">Create User</button>
                        </form>
                    </div>
                    <!--start of suspend/restore user account tab form-->
                    <div class="tab-pane fade" id="nav-suspend" role="tabpanel" aria-labelledby="nav-suspend-tab">
                        <form action="suspendUserController.php" method="post">
                            <legend>
                                Suspend User Account
                            </legend>
                            <div class="form group">
                                <label for="fullname">Enter full name of user account to suspend</label>
                                <input type="text" name="fullname" class="form-control" id="fullname">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-danger">Suspend User Account</button>
                        </form>

                        <form action="restoreUserController.php" method="post">
                            <legend>
                                Restore User Account
                            </legend>
                            <div class="form group">
                                <label for="fullname">Enter full name of user account to restore</label>
                                <input type="text" name="fullname" class="form-control" id="fullname">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-success">Restore User Account</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end of container-->

      <!-- Display alert function -->
    <script type="text/javascript">
        function displayMessage(message) {
            alert(message); // Display alert with message
        }
    </script>
    
    <script>

    document.getElementById("registerUser").onsubmit = function() {
    document.getElementById("registerbtn").disabled = true;

    // Javascript to enable link to tab
var url = document.location.toString();
if (url.match('#')) {
    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
} 

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
})
    </script>
</body>

</html>