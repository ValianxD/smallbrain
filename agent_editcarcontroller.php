<?php
include_once 'Class/agent.class.php';

class EditCarController {
    private $agent;

    public function __construct() {
        $this->agent = new Agent();
    }

    // Fetch all cars associated with this agent
    public function getAgentCars($agentName) {
        return $this->agent->getAgentCars($agentName);
    }

    // Fetch details of the selected car
    public function getCarDetails($carId) {
        return $this->agent->getCarDetails($carId);
    }

    // Update car details
    public function updateCarDetails($carData, $images) {
        // Process image uploads and map them into `images` array
        $uploadedImages = [];
        foreach ($images as $key => $imageFile) {
            if (!empty($imageFile['tmp_name'])) {
                $filename = "uploads/" . $carData['car_id'] . "_" . basename($imageFile['name']);
                move_uploaded_file($imageFile['tmp_name'], $filename);
                $uploadedImages[$key] = $filename;
            } else {
                $uploadedImages[$key] = null;
            }
        }
        return $this->agent->updateCarListing($carData, $uploadedImages);
    }
}
?>
