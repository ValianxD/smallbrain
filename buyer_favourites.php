<?php
include 'db_connection.php';
include_once 'Class/user.class.php'; // Import user class
include_once 'Class/buyer.class.php';
include_once 'logoutcontroller.php';
include_once 'buyer_favouritescontroller.php';

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

if (isset($_GET['q'])) { // Get q variable to logout
    $logoutController->handleLogout(); // Log user out with session destroy
}

// Fetch the user's full name
$buyer_fullname = trim($user->get_fullname($id));

// Initialize controller for favourites
$controller = new FavouritesController();

// Initialize search parameters
$make = '';
$model = '';
$minPrice = '';
$maxPrice = '';
$favourites = [];

// Fetch all favourites if no search has been made
$favourites = $controller->getUserFavourites($id);

// Handle search submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $make = isset($_POST['make']) ? $_POST['make'] : '';
    $model = isset($_POST['model']) ? $_POST['model'] : '';
    $minPrice = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $maxPrice = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 0;

    // Search for user's favourites based on criteria
    $favourites = $controller->searchFavourites($id, $make, $model, $minPrice, $maxPrice);
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Link to styles.css -->
    <link rel="stylesheet" href="./styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Your Favourites</title>
    <style>
        .separator {
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 2px solid #ddd;
        }

        .favourite-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .favourite-card img {
            width: 100px;
            height: 75px;
            border-radius: 5px;
            margin-right: 15px;
            object-fit: cover;
        }

        .favourite-details {
            flex: 1;
        }

        .favourite-details h4 {
            margin: 0;
            font-size: 1.2em;
        }

        .favourite-details p {
            margin: 5px 0;
            color: #555;
        }
    </style>
</head>

<body>
    <!-- Start of navbar -->
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
    <!-- End of navbar -->

    <!-- Start of container -->
    <div class="container mt-5">
        <!-- Centralized Favourites title -->
        <div class="text-center">
            <h2 class="mb-4">Your Favourites</h2>
        </div>
        <!-- Separator -->
        <hr class="separator">

        <!-- Search Form -->
        <form method="POST" action="buyer_favourites.php">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="make">Make</label>
                    <input type="text" class="form-control" id="make" name="make" value="<?php echo htmlspecialchars($make); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="<?php echo htmlspecialchars($model); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="min_price">Min Price (£)</label>
                    <input type="number" class="form-control" id="min_price" name="min_price" value="<?php echo htmlspecialchars($minPrice); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="max_price">Max Price (£)</label>
                    <input type="number" class="form-control" id="max_price" name="max_price" value="<?php echo htmlspecialchars($maxPrice); ?>">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="button" class="btn btn-secondary" onclick="resetFavourites()">Reset</button>
            </div>
        </form>

        <hr>

        <!-- Favourites container -->
        <div class="row">
            <?php if (!empty($favourites)): ?>
                <?php foreach ($favourites as $favourite): ?>
                    <div class="col-md-4">
                        <div class="favourite-card">
                            <img src="<?php echo htmlspecialchars($favourite['car_image']); ?>" alt="Car Image">
                            <div class="favourite-details">
                                <h4><?php echo htmlspecialchars($favourite['make']); ?> - <?php echo htmlspecialchars($favourite['model']); ?></h4>
                                <p>Price: £<?php echo htmlspecialchars(number_format($favourite['price'], 2)); ?></p>
                                <a href="buyer_car_details.php?id=<?php echo urlencode($favourite['car_id']); ?>" class="btn btn-primary btn-sm mt-2">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No favourites found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
    function resetFavourites() {
        // Redirect to the same page to show all favourites
        window.location.href = 'buyer_favourites.php';
    }
    </script>
</body>

</html>
