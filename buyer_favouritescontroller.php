<?php
include_once 'Class/buyer.class.php';

class FavouritesController {
    private $buyer;

    public function __construct() {
        $this->buyer = new Buyer();
    }

    public function addToFavourites($user_id, $car_id, $model, $make, $price, $car_image) {
        return $this->buyer->addToFavourites($user_id, $car_id, $model, $make, $price, $car_image);
    }

    public function isCarFavourited($user_id, $car_id) {
    return $this->buyer->isCarFavourited($user_id, $car_id);
	}

	public function getUserFavourites($user_id) {
    return $this->buyer->getUserFavourites($user_id);
	}

    // Method to get all favourites
    public function getAllFavourites($userId) {
    return $this->buyer->getAllFavourites($userId);
    }

    // Method to search favourites
    public function searchFavourites($userId, $make, $model, $minPrice, $maxPrice) {
    return $this->buyer->searchFavourites($userId, $make, $model, $minPrice, $maxPrice);
    }
}
?>
