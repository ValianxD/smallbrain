<?php
session_start();
include_once 'buyer_favouritescontroller.php';

// Assume the user is logged in and their user ID is stored in the session
$user_id = isset($_SESSION['id']) ? intval($_SESSION['id']) : 0;
$car_id = isset($_GET['car_id']) ? intval($_GET['car_id']) : 0;

// Ensure user is logged in and car_id is provided
if ($user_id && $car_id) {
    $controller = new FavouritesController();

    // Check if the car is already favourited
    if ($controller->isCarFavourited($user_id, $car_id)) {
        echo "This car is already in your favourites.";
    } else {
        // Fetch car details (replace this with the correct details as needed)
        $model = $_GET['model'] ?? '';
        $make = $_GET['make'] ?? '';
        $price = $_GET['price'] ?? 0;
        $car_image = $_GET['car_image'] ?? '';

        // Add to favourites if it's not already favourited
        if ($controller->addToFavourites($user_id, $car_id, $model, $make, $price, $car_image)) {
            echo "Car added to favourites successfully.";
        } else {
            echo "Failed to add car to favourites.";
        }
    }
} else {
    echo "User not logged in or car ID not provided.";
}
?>

<a href='buyer_car.php'>Go Back</a>
