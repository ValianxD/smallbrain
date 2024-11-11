<?php
include 'db_connection.php';
include_once 'Class/user.class.php'; // Import user class
include_once 'Class/buyer.class.php';
include_once 'logoutcontroller.php';
include_once 'buyer_feedbackcontroller.php';

session_start();
$logoutController = new LogoutController;
$user = new User();
$buyer = new Buyer();
$id = $_SESSION['id']; // Store session ID into $id

if (!$user->get_session($id)) { // If user is not logged in
    header("location:login.php"); // Redirect to login.php if not logged in
    exit();
}

if ($user->get_usertype($id) !== "buyer") {
    header("location:error.php");
    exit();
}

if (isset($_GET['q'])){ //get q variable to logout
 $logoutController->handleLogout(); //log user out with session destroy
}

// Fetch the user's full name
$buyer_fullname = trim($user->get_fullname($id));

// Initialize controller
$controller = new FeedbackController();

// Fetch user type based on user ID
if (!isset($_SESSION['usertype'])) {
    $_SESSION['usertype'] = $user->get_usertype($id); // Fetch user type based on user ID
}
$usertype = $_SESSION['usertype'];
// Get list of agent names
$agentNames = $controller->getAgentNames();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = intval($_POST['rating']);
    $review = trim($_POST['review']);
    $agent_name = $_POST['agent_name'];

    if ($controller->submitFeedback($usertype, $rating, $review, $agent_name)) {
        $message = "Feedback submitted successfully.";
    } else {
        $message = "Failed to submit feedback.";
    }
}
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
                    <a class="nav-link" href="buyer.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link">Welcome, <?php echo htmlspecialchars($buyer_fullname); ?>!</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="buyer.php?q=logout">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--end of navbar-->

    <!--start of container-->
    <div class="container mt-5">
        <!-- Centralized Available Cars title -->
        <div class="text-center">
            <h2 class="mb-4">Submit Feedback</h2>
        </div>
         <?php if (isset($message)) : ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <!-- Separator -->
        <hr class="separator">

        <form method="POST">
            <!-- User Type (Auto-Detected) -->
            <div class="form-group">
                <label>User Type:</label>
                <input type="text" name="usertype" value="<?php echo htmlspecialchars($usertype); ?>" class="form-control" readonly>
            </div>

            <!-- Agent Name Dropdown -->
            <div class="form-group">
                <label>Agent Name:</label>
                <select name="agent_name" class="form-control" required>
                    <option value="">Select Agent</option>
                    <?php foreach ($agentNames as $agent): ?>
                        <option value="<?php echo htmlspecialchars($agent['fullname']); ?>"><?php echo htmlspecialchars($agent['fullname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Rating -->
            <div class="form-group">
                <label>Rating:</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" required>
            </div>

            <!-- Review -->
            <div class="form-group">
                <label>Review:</label>
                <textarea name="review" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>
  
    </div>

</body>

</html>
