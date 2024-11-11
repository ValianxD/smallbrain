<?php
include_once 'Class/agent.class.php';

class AddCarController {
    private $agent;

    public function __construct() {
        $this->agent = new Agent();
    }

    // Method to add a new car listing
    public function addCar($carData, $images) {
        // Check if car_id is unique
        if (!$this->agent->isCarIdUnique($carData['car_id'])) {
            return "Error: Car ID already exists. Please use a unique Car ID.";
        }

        // Process image uploads
        $uploadedImages = [];
        for ($i = 1; $i <= 5; $i++) {
            $imageKey = 'img' . $i;
            if (isset($images[$imageKey]) && $images[$imageKey]['tmp_name']) {
                $filename = $carData['car_id'] . "_img" . $i . "_" . basename($images[$imageKey]['name']);
                $uploadedImages[$imageKey] = $this->agent->handleImageUpload($images[$imageKey], $filename);
                
                if (!$uploadedImages[$imageKey]) {
                    return "Error: Failed to upload image {$i}. Please try again.";
                }
            } else {
                $uploadedImages[$imageKey] = null; // Store null if the image is not provided
            }
        }

        // Add car listing to database
        $carData = array_merge($carData, $uploadedImages); // Merge images into car data
        if ($this->agent->addCarListing($carData, $uploadedImages)) {
            return "Car listing successfully added.";
        } else {
            return "Error: Failed to add car listing.";
        }
    }

    // Method to get agent names for dropdown
    public function getAgentNames() {
        return array_column($this->agent->getAllAgentNames(), 'fullname');
    }

    // Method to get seller names for dropdown
    public function getSellerNames() {
        return array_column($this->agent->getAllSellerNames(), 'fullname');
    }
}
