<?php
include_once 'user.class.php'; //import /classes/user.class.php
include_once 'db_connection.php';

class Buyer extends User{

// Gets all the car for view_car.php
public function getAllCars() {
    $sql = "SELECT id, make, model, price, image FROM cars";
    $result = $this->db->query($sql); 
    
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Gets car details
public function getCarDetails($id) {
    $sql = "SELECT make, model, price, mileage, manufactured, engine_cap, transmission, coe, type, 
                   agent_name, seller_name, description, img1, img2, img3, img4, img5 
            FROM car_details
            WHERE car_id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

    public function addToFavourites($user_id, $car_id, $model, $make, $price, $car_image) {
    // Start a transaction
    $this->db->begin_transaction();

    try {
        // Insert the favourite car for the user
        $sqlInsert = "INSERT INTO favourites (user_id, car_id, model, make, price, car_image) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsert = $this->db->prepare($sqlInsert);
        $stmtInsert->bind_param("iissss", $user_id, $car_id, $model, $make, $price, $car_image);
        
        // Execute the insert statement
        $stmtInsert->execute();

        // Check if the insert was successful by checking the affected rows
        if ($stmtInsert->affected_rows > 0) {
            // If the insert was successful, increment the favourites_count for the car
            $sqlUpdate = "UPDATE car_details SET favourites_count = favourites_count + 1 WHERE car_id = ?";
            $stmtUpdate = $this->db->prepare($sqlUpdate);
            $stmtUpdate->bind_param("i", $car_id);

            if (!$stmtUpdate->execute()) {
                throw new Exception("Error updating favourites count: " . $stmtUpdate->error);
            }
        } else {
            throw new Exception("Car already exists in favourites or error adding to favourites.");
        }

        // Commit the transaction
        $this->db->commit();
        return true;

    } catch (Exception $e) {
        // Rollback on error
        $this->db->rollback();
        echo "Exception: " . $e->getMessage();
        return false;
    }
}




// Check if car is already favourite
public function isCarFavourited($user_id, $car_id) {
    $sql = "SELECT 1 FROM favourites WHERE user_id = ? AND car_id = ?";
    $stmt = $this->db->prepare($sql); 
    $stmt->bind_param("ii", $user_id, $car_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Return true if a record is found, false otherwise
    return $result->num_rows > 0;
}

// Get user's favourites
public function getUserFavourites($user_id) {
    $sql = "SELECT car_id, model, make, price, car_image FROM favourites WHERE user_id = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Get all agent names
public function getAllAgentNames() {
    $sql = "SELECT DISTINCT fullname FROM users WHERE usertype = 'agent'";
    $result = $this->db->query($sql); 

    return $result->fetch_all(MYSQLI_ASSOC);
}

// Save feedback
public function saveFeedback($usertype, $rating, $review, $agent_name) {
    // Start transaction
    $this->db->begin_transaction();

    try {
        // Retrieve agent_id based on agent_name
        $sqlAgent = "SELECT id FROM users WHERE fullname = ?";
        $stmtAgent = $this->db->prepare($sqlAgent);
        $stmtAgent->bind_param("s", $agent_name);
        $stmtAgent->execute();
        $resultAgent = $stmtAgent->get_result();
        
        if ($resultAgent->num_rows > 0) {
            $agent_id = $resultAgent->fetch_assoc()['id'];
        } else {
            throw new Exception("Agent not found");
        }
        
        // Insert feedback
        $sql = "INSERT INTO feedback (usertype, rating, review, agent_name, agent_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sissi", $usertype, $rating, $review, $agent_name, $agent_id);
        
        if (!$stmt->execute()) {
            throw new Exception("Error in feedback insertion: " . $stmt->error);
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


// Determine interest rate based on loan term
    public function getInterestRate($loanTermYears) {
        if ($loanTermYears >= 1 && $loanTermYears <= 4) {
            return 2.48;
        } elseif ($loanTermYears >= 5 && $loanTermYears <= 7) {
            return 3.18;
        } else {
            return 0;
        }
    }

    // Calculate monthly payment based on loan amount, term, and interest rate
    public function calculateMonthlyPayment($loanAmount, $loanTermYears, $interestRate) {
        $loanTermMonths = $loanTermYears * 12;
        $monthlyInterestRate = ($interestRate / 100) / 12;

        // Calculate the monthly payment
        $monthlyPayment = $loanAmount * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $loanTermMonths) /
                          (pow(1 + $monthlyInterestRate, $loanTermMonths) - 1);

        return $monthlyPayment;
    }

    // Search for car
    public function searchCars($make, $model, $minPrice, $maxPrice) {
    $sql = "SELECT * FROM cars WHERE 1=1"; // Start with a base query
    $params = [];
    $types = '';

    if ($make) {
        $sql .= " AND make LIKE ?";
        $params[] = "%$make%";
        $types .= 's'; // String type
    }

    if ($model) {
        $sql .= " AND model LIKE ?";
        $params[] = "%$model%";
        $types .= 's'; // String type
    }

    if ($minPrice) {
        $sql .= " AND price >= ?";
        $params[] = $minPrice;
        $types .= 'd'; // Double type for price
    }

    if ($maxPrice) {
        $sql .= " AND price <= ?";
        $params[] = $maxPrice;
        $types .= 'd'; // Double type for price
    }

    $stmt = $this->db->prepare($sql);

    // Only bind parameters if there are any
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params); // Bind the parameters
    }

    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Method to get all favourites
    public function getAllFavourites($userId) {
        $sql = "SELECT * FROM favourites WHERE user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Method to search favourites
    public function searchFavourites($userId, $make, $model, $minPrice, $maxPrice) {
        $sql = "SELECT * FROM favourites WHERE user_id = ? AND 1=1";
        $params = [$userId];
        $types = 'i';

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
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

public function incrementCarViews($car_id) {
    global $conn;
    $sql = "UPDATE car_details SET views = views + 1 WHERE car_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $car_id);
        
        if ($stmt->execute()) {
        } else {
            echo "Error updating views: " . $stmt->error; // Display any error from execution
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error; // Display error if statement fails to prepare
    }
}

public function incrementFav($car_id) {
    global $conn;
    $sql = "UPDATE car_details SET favourites_count = favourites_count + 1 WHERE car_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $car_id);
        
        if ($stmt->execute()) {
        } else {
            echo "Error updating Favourites: " . $stmt->error; // Display any error from execution
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error; // Display error if statement fails to prepare
    }
}

 
}
?>
