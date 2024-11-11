<?php
include 'db_connection.php';
include_once 'Class/user.class.php';
include_once 'Class/seller.class.php';
include_once 'logoutcontroller.php';

session_start();
$logoutController = new LogoutController;
$user = new User();
$seller = new Seller();
$id = $_SESSION['id']; // store session id into $id

if (!$user->get_session($id)) { // if user is not logged in
    header("location:login.php"); // redirect to login.php *this also disables access to index.php from browser url*
}

if ($user->get_usertype($id) !== "seller") {
    header("location:error.php");
}

// Get seller's full name
$seller_name = $seller->getFullname($id);

// Logout handling
if (isset($_GET['q'])) { 
    $logoutController->handleLogout(); 
}

// FetchCarController class
class FetchCarController {
    public $seller;

    public function __construct($seller) {
        $this->seller = $seller;
    }

    public function fetchAvailableCars($seller_name) {
        return $this->seller->getAllAvailableCars($seller_name);
    }
}

// SearchCarController class
class SearchCarController {
    public $seller;

    public function __construct($seller) {
        $this->seller = $seller;
    }

    public function searchAvailableCars($seller_name, $make, $model, $min_price, $max_price) {
        return $this->seller->searchAvailableCars($seller_name, $make, $model, $min_price, $max_price);
    }
}

class FetchCarBoundary {
    public $fetchCarController;

    public function __construct($fetchCarController) {
        $this->fetchCarController = $fetchCarController;
    }

    public function displayCars($seller_name) {
        $cars = $this->fetchCarController->fetchAvailableCars($seller_name);

        $output = "<div class='row'>";
        if ($cars && mysqli_num_rows($cars) > 0) {
            while ($row = mysqli_fetch_assoc($cars)) {
                $make = htmlspecialchars($row['make']);
                $model = htmlspecialchars($row['model']);
                $price = number_format($row['price'], 2);
                $image = htmlspecialchars($row['img1']);
                $views = $row['views'];
                $favourites = $row['favourites_count'];
                
                $output .= "
                    <div class='col-md-4'>
                        <div class='card mb-4'>
                            <img src='$image' class='card-img-top' alt='$make $model'>
                            <div class='card-body'>
                                <h5 class='card-title'>$make $model</h5>
                                <p class='card-text'>Price: $$price</p>
                                <p class='card-text'>Views: $views</p>
                                <p class='card-text'>Favourites: $favourites</p>
                            </div>
                        </div>
                    </div>
                ";
            }
        } else {
            $output .= "<p class='text-center'>No cars found matching your criteria.</p>";
        }
        $output .= "</div>";
        return $output;
    }
}


class SearchCarBoundary {
    public $searchCarController;

    public function __construct($searchCarController) {
        $this->searchCarController = $searchCarController;
    }

     // Display the search form with current values in inputs
    public function displaySearchForm() {
        $search_make = isset($_GET['make']) ? htmlspecialchars($_GET['make']) : '';
        $search_model = isset($_GET['model']) ? htmlspecialchars($_GET['model']) : '';
        $min_price = isset($_GET['min_price']) ? htmlspecialchars($_GET['min_price']) : '';
        $max_price = isset($_GET['max_price']) ? htmlspecialchars($_GET['max_price']) : '';

        $form = "
            <form method='GET' action='seller.php' class='mb-4'>
                <div class='form-row'>
                    <div class='form-group col-md-3'>
                        <label for='make'>Make</label>
                        <input type='text' class='form-control' name='make' id='make' value='$search_make'>
                    </div>
                    <div class='form-group col-md-3'>
                        <label for='model'>Model</label>
                        <input type='text' class='form-control' name='model' id='model' value='$search_model'>
                    </div>
                    <div class='form-group col-md-3'>
                        <label for='min_price'>Min Price</label>
                        <input type='number' class='form-control' name='min_price' id='min_price' value='$min_price' step='0.01'>
                    </div>
                    <div class='form-group col-md-3'>
                        <label for='max_price'>Max Price</label>
                        <input type='number' class='form-control' name='max_price' id='max_price' value='$max_price' step='0.01'>
                    </div>
                </div>
                <button type='submit' class='btn btn-primary'>Search</button>
                <button type='button' class='btn btn-secondary' onclick='window.location.href=\"seller.php\"'>Reset</button>
            </form>
        ";

        return $form;
    }


    public function displayCars($seller_name) {
        // Get search filters
        $search_make = isset($_GET['make']) ? $_GET['make'] : '';
        $search_model = isset($_GET['model']) ? $_GET['model'] : '';
        $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
        $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';

        $cars = $this->searchCarController->searchAvailableCars($seller_name, $search_make, $search_model, $min_price, $max_price);

        $output = "<div class='row'>";
        if ($cars && mysqli_num_rows($cars) > 0) {
            while ($row = mysqli_fetch_assoc($cars)) {
                $make = htmlspecialchars($row['make']);
                $model = htmlspecialchars($row['model']);
                $price = number_format($row['price'], 2);
                $image = htmlspecialchars($row['img1']);
                $views = $row['views'];
                $favourites = $row['favourites_count'];
                
                $output .= "
                    <div class='col-md-4'>
                        <div class='card mb-4'>
                            <img src='$image' class='card-img-top' alt='$make $model'>
                            <div class='card-body'>
                                <h5 class='card-title'>$make $model</h5>
                                <p class='card-text'>Price: $$price</p>
                                <p class='card-text'>Views: $views</p>
                                <p class='card-text'>Favourites: $favourites</p>
                            </div>
                        </div>
                    </div>
                ";
            }
        } else {
            $output .= "<p class='text-center'>No cars found matching your criteria.</p>";
        }
        $output .= "</div>";
        return $output;
    }
}

// Instantiate classes
$fetchCarController = new FetchCarController($seller);
$searchCarController = new SearchCarController($seller);
$fetchCarBoundary = new FetchCarBoundary($fetchCarController);
$searchCarBoundary = new SearchCarBoundary($searchCarController); 


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6Hty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Seller Dashboard</title>
    <style>
        .separator {
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 2px solid #ddd;
        }
        .card-body {
            position: relative;
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
                    <a class="nav-link" href="seller.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link">Welcome, <?php echo $seller_name; ?>!</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="seller_feedback.php">Agent Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-light" href="seller.php?q=logout">Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="text-center">
            <h2 class="mb-4">Your Available Cars</h2>
        </div>
        <hr class="separator">
        <?php
            // Call displaySearchForm to render the search form
            echo $searchCarBoundary->displaySearchForm();
          
            // Display cars based on search criteria else show all cars
            if (isset($_GET['make']) || isset($_GET['model']) || isset($_GET['min_price']) || isset($_GET['max_price'])) {
                echo $searchCarBoundary->displayCars($seller_name);
            } else {
                echo $fetchCarBoundary->displayCars($seller_name);
            }
            ?>
    </div>
</body>
</html>
