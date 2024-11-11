<?php
include 'db_connection.php';
include_once 'Class/user.class.php'; // Import user class
include_once 'Class/buyer.class.php';
include_once 'logoutcontroller.php';
include_once 'buyer_viewcarcontroller.php';
include_once 'buyer_carsearchcontroller.php';

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
$controller = new ViewCarController();
$cars = $controller->getCars();

// Instantiate the controller
$controller = new SearchCarController();

// Initialize search parameters
$make = '';
$model = '';
$minPrice = '';
$maxPrice = '';
$cars = [];

// Handle search submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $make = isset($_POST['make']) ? $_POST['make'] : '';
    $model = isset($_POST['model']) ? $_POST['model'] : '';
    $minPrice = isset($_POST['min_price']) ? floatval($_POST['min_price']) : 0;
    $maxPrice = isset($_POST['max_price']) ? floatval($_POST['max_price']) : 0;

   // Search for cars based on criteria
    $cars = $controller->searchCars($make, $model, $minPrice, $maxPrice);
    } else {
        // Fetch all cars if no search has been made
        $cars = $controller->searchCars('', '', 0, 0);
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
        .car-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
	    }

	    .car-image {
	        width: 100%;
	        height: auto;
	        border-radius: 5px;
	        object-fit: cover;
	    }

	    .car-details h2 {
	        font-size: 1.25em;
	        margin: 10px 0;
	    }

	    .car-details p {
	        font-size: 1em;
	        color: #333;
	        margin-bottom: 15px;
	    }

	    .button-container .btn {
	        width: 100%;
	        font-size: 14px;
	    }

	    .button-container .btn:not(:last-child) {
	        margin-bottom: 10px;
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
            <h2 class="mb-4">Available cars</h2>
        </div>

        <form method="POST" action="buyer_car.php">
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
                    <label for="min_price">Min Price</label>
                    <input type="number" class="form-control" id="min_price" name="min_price" value="<?php echo htmlspecialchars($minPrice); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="max_price">Max Price</label>
                    <input type="number" class="form-control" id="max_price" name="max_price" value="<?php echo htmlspecialchars($maxPrice); ?>">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="button" class="btn btn-secondary" onclick="resetSearch()">Reset</button>
            </div>
        <script>
        function resetSearch() {
            // Redirect to the same page to show all cars
            window.location.href = 'buyer_car.php';
        }
        </script>


        <!-- Separator -->
        <hr class="separator">

        <!-- Car container -->
        <div class="row">
            <?php if (!empty($cars)): ?>
                <?php foreach ($cars as $car): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card d-flex flex-column">
                            <!-- Car Image -->
                            <img src="<?php echo htmlspecialchars($car['image']); ?>" alt="Car Image" class="card-img-top car-image">

                            <!-- Car Details -->
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($car['make']); ?> - <?php echo htmlspecialchars($car['model']); ?></h5>
                                <p class="card-text">Price: £<?php echo htmlspecialchars(number_format($car['price'], 2)); ?></p>
                            </div>

                            <!-- Buttons at the bottom -->
                            <div class="button-container d-flex flex-column mb-3">
                                <a href="buyer_car_details.php?id=<?php echo urlencode($car['id']); ?>" class="btn btn-primary mb-2">View Details</a>
                                <a href="buyer_add_to_favourites.php?car_id=<?php echo urlencode($car['id']); ?>&model=<?php echo urlencode($car['model']); ?>&make=<?php echo urlencode($car['make']); ?>&price=<?php echo urlencode($car['price']); ?>&car_image=<?php echo urlencode($car['image']); ?>" 
                                   class="btn btn-secondary mb-2">
                                   Add to Favourites
                                </a>
                                <a href="buyer_loan_calc.php?price=<?php echo urlencode($car['price']); ?>" class="btn btn-info">Calculate Loan</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">No cars available matching your search criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    </div>

</body>

</html>
