<?php
include_once 'Class/buyer.class.php';

class CarDetailsController {
    private $buyer;

    public function __construct() {
        $this->buyer = new Buyer();
    }

    public function getCarDetails($id) {
        return $this->buyer->getCarDetails($id);
    }
}
?>