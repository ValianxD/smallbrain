<?php
include_once 'user.class.php'; // Import user base class
include_once 'db_connection.php';

class Agent extends User {

public function addCarListing($carData, $images) {
    // Start transaction
    $this->db->begin_transaction();

    try {
        // Retrieve seller_id from users table
        $sqlSeller = "SELECT id FROM users WHERE fullname = ?";
        $stmtSeller = $this->db->prepare($sqlSeller);
        $stmtSeller->bind_param("s", $carData['seller_name']);
        $stmtSeller->execute();
        $stmtSeller->bind_result($seller_id);
        $stmtSeller->fetch();
        $stmtSeller->close();

        if (!$seller_id) {
            throw new Exception("Seller not found: " . $carData['seller_name']);
        }

        // Retrieve agent_id from users table
        $sqlAgent = "SELECT id FROM users WHERE fullname = ?";
        $stmtAgent = $this->db->prepare($sqlAgent);
        $stmtAgent->bind_param("s", $carData['agent_name']);
        $stmtAgent->execute();
        $stmtAgent->bind_result($agent_id);
        $stmtAgent->fetch();
        $stmtAgent->close();

        if (!$agent_id) {
            throw new Exception("Agent not found: " . $carData['agent_name']);
        }

        // Insert into car_details with agent_name, seller_name, agent_id, and seller_id
        $sqlDetails = "INSERT INTO car_details (car_id, make, model, price, mileage, manufactured, engine_cap, transmission, coe, type, agent_id, agent_name, seller_id, seller_name, description, img1, img2, img3, img4, img5) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtDetails = $this->db->prepare($sqlDetails);
        $stmtDetails->bind_param(
            "issdissssissssssssss",
            $carData['car_id'],
            $carData['make'],
            $carData['model'],
            $carData['price'],
            $carData['mileage'],
            $carData['manufactured'],
            $carData['engine_cap'],
            $carData['transmission'],
            $carData['coe'],
            $carData['type'],
            $agent_id,
            $carData['agent_name'],
            $seller_id,
            $carData['seller_name'],
            $carData['description'],
            $images['img1'],
            $images['img2'],
            $images['img3'],
            $images['img4'],
            $images['img5']
        );

        if (!$stmtDetails->execute()) {
            throw new Exception("Error in car_details insertion: " . $stmtDetails->error);
        }

        // Insert into cars database
        $sqlCars = "INSERT INTO cars (id, make, model, price, image) VALUES (?, ?, ?, ?, ?)";
        $stmtCars = $this->db->prepare($sqlCars);
        $stmtCars->bind_param(
            "issds",
            $carData['car_id'],
            $carData['make'],
            $carData['model'],
            $carData['price'],
            $images['img1']
        );

        if (!$stmtCars->execute()) {
            throw new Exception("Error in cars insertion: " . $stmtCars->error);
        }

        // Commit transaction
        $this->db->commit();
        return true;

    } catch (Exception $e) {
        // Rollback on error
        $this->db->rollback();
        echo $e->getMessage(); // Check error message if any
        return false;
    }
}




    // Gets all cars listed by this agent
    public function getAgentCars($agent_name) {
        $sql = "SELECT car_id, make, model, price, img1 AS image FROM car_details WHERE agent_name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $agent_name);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Get all seller names for dropdown
    public function getAllSellerNames() {
        $sql = "SELECT fullname FROM users WHERE usertype = 'seller'";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get all agent names for dropdown
    public function getAllAgentNames() {
        $sql = "SELECT fullname FROM users WHERE usertype = 'agent'";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to check if car_id is unique
    public function isCarIdUnique($car_id) {
        $sql = "SELECT 1 FROM car_details WHERE car_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $car_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows === 0;
    }
    
    // Method to handle image upload
    public function handleImageUpload($imageFile, $filename) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($filename);
        
        // Check if file upload is valid
        if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
            return $targetFile;
        } else {
            return null;
        }
    }

    // Method to get agent's car for editing
	public function getEditAgentCars($agentName) {
        $sql = "SELECT car_id, make, model FROM car_details WHERE agent_name = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $agentName);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Method to get car's details for editing
    public function getCarDetails($carId) {
        $sql = "SELECT * FROM car_details WHERE car_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $carId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Update the car listing in both `car_details` and `cars` tables
    public function updateCarListing($carData, $images) {
        // Start a transaction
        $this->db->begin_transaction();
        try {
            // Prepare to update `car_details` table
            $sqlDetails = "UPDATE car_details SET make=?, model=?, price=?, mileage=?, manufactured=?, engine_cap=?, transmission=?, coe=?, type=?, description=?, img1=?, img2=?, img3=?, img4=?, img5=? WHERE car_id = ?";
            $stmtDetails = $this->db->prepare($sqlDetails);
            $stmtDetails->bind_param(
                "ssdisisssssssssi",
                $carData['make'],
                $carData['model'],
                $carData['price'],
                $carData['mileage'],
                $carData['manufactured'],
                $carData['engine_cap'],
                $carData['transmission'],
                $carData['coe'],
                $carData['type'],
                $carData['description'],
                $images['img1'],
                $images['img2'],
                $images['img3'],
                $images['img4'],
                $images['img5'],
                $carData['car_id']
            );
            $stmtDetails->execute();

            // Update `cars` table
            $sqlCars = "UPDATE cars SET make=?, model=?, price=?, image=? WHERE id=?";
            $stmtCars = $this->db->prepare($sqlCars);
            $stmtCars->bind_param("ssdsi", $carData['make'], $carData['model'], $carData['price'], $images['img1'], $carData['car_id']);
            $stmtCars->execute();

            $this->db->commit(); // Commit transaction
            return true;
        } catch (Exception $e) {
            $this->db->rollback(); // Rollback transaction on error
            return false;
        }
    }

    // Method to get car for deletion
    public function getDeleteAgentCars($agent_name) {
    $sql = "SELECT car_id, make, model FROM car_details WHERE agent_name = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("s", $agent_name);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	}

	// Delete car listing
	public function deleteCarListing($carId) {
	    $this->db->begin_transaction();
	    
	    try {
	        // Delete from car_details
	        $sqlDetails = "DELETE FROM car_details WHERE car_id = ?";
	        $stmtDetails = $this->db->prepare($sqlDetails);
	        $stmtDetails->bind_param("i", $carId);
	        if (!$stmtDetails->execute()) {
	            throw new Exception("Failed to delete from car_details: " . $stmtDetails->error);
	        }

	        // Delete from cars
	        $sqlCars = "DELETE FROM cars WHERE id = ?";
	        $stmtCars = $this->db->prepare($sqlCars);
	        $stmtCars->bind_param("i", $carId);
	        if (!$stmtCars->execute()) {
	            throw new Exception("Failed to delete from cars: " . $stmtCars->error);
	        }

	        $this->db->commit();
	        return true;
	        
	    } catch (Exception $e) {
	        $this->db->rollback();
	        error_log($e->getMessage()); // Log the error message for debugging
	        return false;
	    }
	}

	// Get feedback by agent name
	public function getFeedbackByAgentName($agent_name) {
    $sql = "SELECT usertype, rating, review FROM feedback WHERE agent_name = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("s", $agent_name);
    $stmt->execute();
	    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	}
	
	// Method to get cars by agent name
	public function getCarsByAgentName($agent_name) {
    $sql = "SELECT car_id, make, model, price, img1 AS image FROM car_details WHERE agent_name = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("s", $agent_name);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	}

	// Nethod to search for agent cars
	public function searchAgentCars($agent_name, $make, $model, $minPrice, $maxPrice) {
    $sql = "SELECT car_id, make, model, price, img1 AS image FROM car_details WHERE agent_name = ?";
    $params = [$agent_name];
    $types = 's';

    if ($make) {
        $sql .= " AND make LIKE ?";
        $params[] = "%$make%";
        $types .= 's';
    }

    if ($model) {
        $sql .= " AND model LIKE ?";
        $params[] = "%$model%";
        $types .= 's';
    }

    if ($minPrice) {
        $sql .= " AND price >= ?";
        $params[] = $minPrice;
        $types .= 'd';
    }

    if ($maxPrice) {
        $sql .= " AND price <= ?";
        $params[] = $maxPrice;
        $types .= 'd';
    }

    $stmt = $this->db->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	}



}
?>