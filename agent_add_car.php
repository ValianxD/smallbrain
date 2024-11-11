<?php
include 'db_connection.php';
include_once 'Class/user.class.php'; // Import user class
include_once 'Class/agent.class.php';
include_once 'logoutcontroller.php';
include_once 'agent_addcarcontroller.php';

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

// Instantiate the controller to fetch agent and seller names
$controller = new AddCarController();
$agentNames = $controller->getAgentNames();
$sellerNames = $controller->getSellerNames();

// Initialize a message to display feedback after form submission
$message = "";

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $carData = [
        'car_id' => $_POST['car_id'],
        'make' => $_POST['make'],
        'model' => $_POST['model'],
        'price' => $_POST['price'],
        'mileage' => $_POST['mileage'],
        'manufactured' => $_POST['manufactured'],
        'engine_cap' => $_POST['engine_cap'],
        'transmission' => $_POST['transmission'],
        'coe' => $_POST['coe'],
        'type' => $_POST['type'],
        'agent_name' => $_POST['agent_name'],
        'seller_name' => $_POST['seller_name'],
        'description' => $_POST['description']
    ];

    $images = [
        'img1' => $_FILES['img1'],
        'img2' => $_FILES['img2'],
        'img3' => $_FILES['img3'],
        'img4' => $_FILES['img4'],
        'img5' => $_FILES['img5']
    ];

    $message = $controller->addCar($carData, $images);
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
        .container {
            overflow: auto;
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
            <h2 class="mb-4">Add Used Car Listing</h2>
        </div>
        <!-- Separator -->
        <hr class="separator">

         <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" action="agent_add_car.php" enctype="multipart/form-data">
            <!-- Car ID (unique identifier) -->
            <div class="form-group">
                <label for="car_id">Car ID</label>
                <input type="text" class="form-control" id="car_id" name="car_id" required>
            </div>

            <!-- Basic Car Details -->
            <div class="form-group">
                <label for="make">Make</label>
                <input type="text" class="form-control" id="make" name="make" required>
            </div>
            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>

            <!-- Additional Car Details -->
            <div class="form-group">
                <label for="mileage">Mileage (km)</label>
                <input type="number" class="form-control" id="mileage" name="mileage">
            </div>
            <div class="form-group">
                <label for="manufactured">Manufactured Date</label>
                <input type="date" class="form-control" id="manufactured" name="manufactured">
            </div>
            <div class="form-group">
                <label for="engine_cap">Engine Capacity (cc)</label>
                <input type="number" class="form-control" id="engine_cap" name="engine_cap">
            </div>
            <div class="form-group">
                <label for="transmission">Transmission</label>
                <input type="text" class="form-control" id="transmission" name="transmission">
            </div>
            <div class="form-group">
                <label for="coe">COE</label>
                <input type="number" class="form-control" id="coe" name="coe">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" class="form-control" id="type" name="type">
            </div>

            <!-- Agent and Seller Name Dropdowns -->
            <div class="form-group">
                <label for="agent_name">Agent Name</label>
                <select name="agent_name" class="form-control" required>
                    <?php foreach ($agentNames as $agentName): ?>
                        <option value="<?php echo htmlspecialchars($agentName); ?>"><?php echo htmlspecialchars($agentName); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="seller_name">Seller Name</label>
                <select name="seller_name" class="form-control" required>
                    <?php foreach ($sellerNames as $sellerName): ?>
                        <option value="<?php echo htmlspecialchars($sellerName); ?>"><?php echo htmlspecialchars($sellerName); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <!-- Image Uploads -->
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="form-group">
                    <label for="img<?php echo $i; ?>">Image <?php echo $i; ?> (img<?php echo $i; ?>)</label>
                    <input type="file" class="form-control-file" id="img<?php echo $i; ?>" name="img<?php echo $i; ?>">
                </div>
            <?php endfor; ?>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Car</button>
        </form>

    </div>
</body>

</html>
