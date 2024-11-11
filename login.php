<?php
include 'db_connection.php'; // Import db_connection.php
include_once 'Class/user.class.php'; // Import user.class.php
session_start();

// Instantiate the LoginBoundary which handles the login process
$loginBoundary = new LoginBoundary();

class LoginBoundary {
     public $controller;

    public function __construct() {
        $this->controller = new LoginController($this); // Create the controller instance
        $this->handleRequest(); // Handle the request when the boundary is instantiated
    }

     // Handle the incoming request
    private function handleRequest() {
        if (isset($_REQUEST['submit'])) { // Get form values on form submission
            extract($_REQUEST);
            $this->controller->handleLogin($email, $password); // Handle login
        } else {
            $this->displayLoginForm(); // Display the login form if not submitted
        }
    }

    // Display the login form
    public function displayLoginForm() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <link rel="stylesheet" href="./styles.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">  
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                    crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                    crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                    crossorigin="anonymous"></script>
            <title>Log In Page</title>
            <style>
                .brand-logo {
                    font-family: 'Arial', sans-serif;
                    font-size: 36px;
                    font-weight: bold;
                    color: #ff4c4c; /* Red color for branding */
                    text-align: center;
                    text-transform: uppercase;
                    letter-spacing: 2px;
                    margin-bottom: 20px;
                }

                .brand-logo span {
                    color: #777; /* Lighter gray for contrast */
                }
            </style>
        </head>
        <body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler"
                    aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="login.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light" href="login.php">Log In</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="row w-100">
                <div class="col-md-6 col-sm-8 col-10 mx-auto p-4">
                    <div class="brand-logo">
                        <span>Smallbrain</span>
                    </div>
                    <form action="" method="post" name="login" onsubmit="return submitlogin();">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function submitlogin() {
                var form = document.login;
                if (form.email.value == "") {
                    alert("Enter email or username.");
                    return false;
                } else if (form.password.value == "") {
                    alert("Enter password.");
                    return false;
                }
            }
        </script>
        <footer class="fixed-bottom">
            <div class="copyright">
                &copy 2024 -(smallbrain) Developed by: James Tay and Ho Bing Xian
            </div>
        </footer>
        </body>
        </html>
        <?php
    }

    public function displayMessage($message) {
    echo "<script type='text/javascript'>alert('$message'); window.location.href='login.php';</script>";
    exit; // Exit to ensure no further code executes
}
}

class LoginController {
    public $user;
    public $boundary;

    public function __construct($boundary) {
        $this->user = new User(); // Create a User object
        $this->boundary = $boundary; //Store the boundary instance
    }

    public function handleLogin($email, $password) {
        $login = $this->user->validate_login($email, $password); // Validate login

        if ($login) { // If login is valid
            // Login Success
            $id = $_SESSION['id'];
            $usertype = $this->user->get_usertype($id);
            $status = $this->user->get_status($id);
            
            if ($status == 0) { // Check if account is suspended
                $this->boundary->displayMessage("Your account has been suspended, contact your user admin!");
            } else {
                $this->redirectUser($usertype); // Redirect based on user type
            }
        } else {
            $this->boundary->displayMessage("Wrong email or password!"); // Login Failed
        }
    }

    public function redirectUser($usertype) {
        switch ($usertype) {
            case "buyer":
                header("location:buyer.php");
                break;
            case "seller":
                header("location:seller.php");
                break;
            case "admin":
                header("location:useradmin.php");
                break;
            default:
                header("location:agent.php");
                break;
        }
        exit; // Always exit after a header redirect
}
}
?>
