<?php
include_once 'Class/buyer.class.php';

class ViewCarController {
    private $buyer;

    public function __construct() {
        $this->buyer = new Buyer();
    }

    public function getCars() {
        return $this->buyer->getAllCars();
    }
}
?>
