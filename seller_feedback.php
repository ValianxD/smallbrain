<?php
include 'db_connection.php';
include_once 'Class/user.class.php'; // Import user class
include_once 'Class/seller.class.php';
include_once 'logoutcontroller.php';
include_once 'sellerfeedbackcontroller.php';

session_start();
$logoutController = new LogoutController;
$user = new User();
$seller = new Seller();
$id = $_SESSION['id']; // Store session ID into $id

if (!$user->get_session($id)) { // If user is not logged in
    header("location:login.php"); // Redirect to login.php if not logged in
    exit();
}

if ($user->get_usertype($id) !== "seller") {
    header("location:error.php");
    exit();
}

if (isset($_GET['q'])) { // Get 'q' variable to logout
    $logoutController->handleLogout(); // Log user out and destroy session
}

// Fetch the user's full name
$seller_fullname = trim($user->get_fullname($id));

// Initialize controller
$controller = new FeedbackController();

// Fetch user type based on user ID
if (!isset($_SESSION['usertype'])) {
    $_SESSION['usertype'] = $user->get_usertype($id); 
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
    <title>Submit Feedback</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
                    <a class="nav-link" href="seller.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link">Welcome, <?php echo htmlspecialchars($seller_fullname); ?>!</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="seller.php?q=logout">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center">
            <h2 class="mb-4">Submit Feedback</h2>
        </div>
        <?php if (isset($message)) : ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <hr class="separator">
        <form method="POST">
            <div class="form-group">
                <label>User Type:</label>
                <input type="text" name="usertype" value="<?php echo htmlspecialchars($usertype); ?>" class="form-control" readonly>
            </div>

            <div class="form-group">
                <label>Agent Name:</label>
                <select name="agent_name" class="form-control" required>
                    <option value="">Select Agent</option>
                    <?php foreach ($agentNames as $agent): ?>
                        <option value="<?php echo htmlspecialchars($agent['fullname']); ?>"><?php echo htmlspecialchars($agent['fullname']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Rating:</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" required>
            </div>

            <div class="form-group">
                <label>Review:</label>
                <textarea name="review" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Feedback</button>
        </form>
    </div>
</body>
</html>
