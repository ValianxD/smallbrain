<?php
include_once 'Class/buyer.class.php';

class SearchCarController {
    private $buyer;

    public function __construct() {
        $this->buyer = new Buyer();
    }

    // Method to search for cars
    public function searchCars($make, $model, $minPrice, $maxPrice) {
        return $this->buyer->searchCars($make, $model, $minPrice, $maxPrice);
    }
}
?>