<?php
include 'db_connection.php';
include_once 'Class/user.class.php'; // Import user class
include_once 'Class/agent.class.php';
include_once 'logoutcontroller.php';
session_start();
$logoutController = new LogoutController;
$user = new User();
$agent = new Agent();
$id = $_SESSION['id']; // Store session ID into $id

if (!$user->get_session($id)) { // If user is not logged in
    header("location:login.php"); // Redirect to login.php if not logged in
    exit();
}

if ($user->get_usertype($id) !== "agent") {
    header("location:error.php");
    exit();
}

if (isset($_GET['q'])){ //get q variable to logout
 $logoutController->handleLogout(); //log user out with session destroy
}

// Fetch the user's full name
$agent_fullname = trim($user->get_fullname($id));
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
    <style>
        .separator {
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 2px solid #ddd;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
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
                    <a class="nav-link" href="agent.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link">Welcome, <?php echo htmlspecialchars($agent_fullname); ?>!</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="agent.php?q=logout">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--end of navbar-->

    <!--start of container-->
    <div class="container mt-5">
        <!-- Centralized Available Cars title -->
        <div class="text-center">
            <h2 class="mb-4">What would you like to do today?</h2>
        </div>
        <!-- Separator -->
        <hr class="separator">

        <!-- Button Container -->
        <div class="button-container">
            <button onclick="addCars()">Add Used Cars</button>
            <button onclick="editCars()">Edit Used Cars</button>
            <button onclick="removeCars()">Remove Used Cars</button>
            <button onclick="ViewSearchCars()">View and Search Used Cars</button>
            <button onclick="viewFeedback()">View Feedback</button>
        </div>

        <!-- Move JavaScript functions outside of button elements -->
        <script>
        function addCars() {
            window.location.href = 'agent_add_car.php';
        }

        function editCars() {
            window.location.href = 'agent_edit_car.php';
        }

        function removeCars() {
            window.location.href = 'agent_remove_car.php';
        }

        function ViewSearchCars() {
            window.location.href = 'agent_view_car.php';
        }

        function viewFeedback() {
            window.location.href = 'agent_feedback.php';
        }
        </script>
  

</body>

</html>