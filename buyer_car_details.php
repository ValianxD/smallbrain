<?php
include 'db_connection.php';
include_once 'Class/user.class.php'; // Import user class
include_once 'Class/buyer.class.php';
include_once 'logoutcontroller.php';
include_once 'buyer_cardetailscontroller.php';

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

if (isset($_GET['id'])) {
    
    $carId = intval($_GET['id']); // Convert to integer for security
    
    // Create an instance of the Buyer class
    $buyer = new Buyer();

    // Call the method to increment the car views
    $buyer->incrementCarViews($carId);

    // Optionally, fetch the car details after incrementing the views
    // Add your code to fetch car details here...
    
} else {
    echo "No car ID provided.";
    exit();
}

// Fetch the user's full name
$buyer_fullname = trim($user->get_fullname($id));

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$controller = new CarDetailsController();
$car = $controller->getCarDetails($id);

// Redirect or show an error message if car details are not found
if (!$car) {
    echo "<p>Car details not found.</p>";
    exit;
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
        .details-container {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .main-image {
            width: 100%;
            max-width: 500px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .thumbnail-container {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .thumbnail {
            width: 80px;
            height: 60px;
            cursor: pointer;
            border-radius: 5px;
            object-fit: cover;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .car-info {
            flex: 1;
        }

        .car-info h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .car-info p {
            font-size: 1em;
            color: #555;
        }

        .car-info .label {
            font-weight: bold;
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

    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1><?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?> Details</h1>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="details-container">
                    <!-- Car Images Section -->
                    <div>
                        <!-- Main Image -->
                        <img src="<?php echo htmlspecialchars($car['img1']); ?>" alt="Main Car Image" class="main-image" id="mainImage">
                        
                        <!-- Thumbnails -->
                        <div class="thumbnail-container">
                            <?php foreach (['img1', 'img2', 'img3', 'img4', 'img5'] as $imgKey): ?>
                                <?php if (!empty($car[$imgKey])): ?>
                                    <img src="<?php echo htmlspecialchars($car[$imgKey]); ?>" alt="Thumbnail" class="thumbnail" onclick="changeMainImage(this)">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Car Details Section -->
                    <div class="car-info">
                        <h2><?php echo htmlspecialchars($car['make']); ?> - <?php echo htmlspecialchars($car['model']); ?></h2>
                        <p><span class="label">Price:</span> £<?php echo htmlspecialchars(number_format($car['price'], 2)); ?></p>
                        <p><span class="label">Mileage:</span> <?php echo htmlspecialchars(number_format($car['mileage'])); ?> km</p>
                        <p><span class="label">Manufactured:</span> <?php echo htmlspecialchars($car['manufactured']); ?></p>
                        <p><span class="label">Engine Capacity:</span> <?php echo htmlspecialchars($car['engine_cap']); ?> cc</p>
                        <p><span class="label">Transmission:</span> <?php echo htmlspecialchars($car['transmission']); ?></p>
                        <p><span class="label">COE:</span> <?php echo htmlspecialchars($car['coe']); ?></p>
                        <p><span class="label">Type:</span> <?php echo htmlspecialchars($car['type']); ?></p>
                        <p><span class="label">Agent Name:</span> <?php echo htmlspecialchars($car['agent_name']); ?></p>
                        <p><span class="label">Seller Name:</span> <?php echo htmlspecialchars($car['seller_name']); ?></p>
                        <p><span class="label">Description:</span> <?php echo htmlspecialchars($car['description']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to change the main image when a thumbnail is clicked
        function changeMainImage(thumbnail) {
            document.getElementById('mainImage').src = thumbnail.src;
        }
    </script>
</body>

</html>
