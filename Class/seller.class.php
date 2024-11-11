<?php
include_once 'user.class.php'; //import /classes/user.class.php
include_once 'db_connection.php';

class Seller extends User{

    // Fetch all available cars for the seller
    public function getAllAvailableCars($seller_name) {
        $query = "SELECT * FROM car_details WHERE seller_name = ?";
        
        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, 's', $seller_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return $result;
        } else {
            echo "Error preparing SQL statement: " . mysqli_error($this->db);
            return false;
        }
    }

    // Method to search available cars based on filters
    public function searchAvailableCars($seller_name, $make = '', $model = '', $min_price = '', $max_price = '') {
        // Base query to get all cars for this seller
        $query = "SELECT * FROM car_details WHERE seller_name = ?";

        // Add filters based on user input
        if (!empty($make)) {
            $query .= " AND make LIKE ?";
            $make = "%" . $make . "%";
        }
        if (!empty($model)) {
            $query .= " AND model LIKE ?";
            $model = "%" . $model . "%";
        }
        if (!empty($min_price)) {
            $query .= " AND price >= ?";
        }
        if (!empty($max_price)) {
            $query .= " AND price <= ?";
        }

        // Binding the parameters
        if ($stmt = mysqli_prepare($this->db, $query)) {
            // Bind parameters dynamically based on which filters were applied
            $params = [$seller_name];
            if (!empty($make)) {
                $params[] = $make;
            }
            if (!empty($model)) {
                $params[] = $model;
            }
            if (!empty($min_price)) {
                $params[] = $min_price;
            }
            if (!empty($max_price)) {
                $params[] = $max_price;
            }

            // Use ... to expand array into arguments for bind_param
            $param_types = 's' . str_repeat('s', count($params) - 1); // First 's' for seller_name
            mysqli_stmt_bind_param($stmt, $param_types, ...$params);

            // Execute and return results
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            return $result;
        } else {
            echo "Error preparing SQL statement: " . mysqli_error($this->db);
            return false;
        }
    }  
    
    public function getFullname($id) {
        $query = "SELECT fullname FROM users WHERE id = ?";
        if ($stmt = mysqli_prepare($this->db, $query)) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $fullname);
            mysqli_stmt_fetch($stmt);
            return $fullname;
        } else {
            return null;
        }
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
}

?>
