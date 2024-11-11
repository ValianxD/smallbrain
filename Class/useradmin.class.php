<?php
include_once 'user.class.php'; //import /classes/user.class.php
include_once 'db_connection.php';

class Useradmin extends User{
	    //create User Account
    public function createUserAcc($registerfullname, $registeremail, $registerusertype, $registerpassword)
{
    include("db_connection.php");
    $error = array();
    $user_check_query = "SELECT * FROM users WHERE fullname='$registerfullname' OR email='$registeremail' LIMIT 1";
    require 'db_connection.php';
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['fullname'] === $registerfullname) {
            $error[] = "Name already exists";
        }
    
        if ($user['email'] === $registeremail) {
            $error[] = "Email already exists";
        }
    }

    // No errors, proceed with registration
    if (count($error) == 0) {
        $sql = "INSERT INTO users(fullname, email, usertype, password, status) 
                VALUES('$registerfullname', '$registeremail', '$registerusertype', '$registerpassword', 1)";
        
        if (mysqli_query($conn, $sql)) {
            return 'success'; // Registration successful
        } else {
            $error[] = "Registration failed: " . mysqli_error($conn);
        }
    }

    return $error; // Return errors if any, or empty array if no errors
}

    //suspend user func upon posting full name of user account to be suspended
    public function suspendUser()
    {
        if (isset($_POST['fullname'])) {
            $fullname = $_POST['fullname'];
            //echo $fullname;
            $checkuser="SELECT * FROM USERS where fullname= '$fullname'";
            $result=mysqli_query($this->db, $checkuser);
            $row = $result->num_rows;
            if ($row == 1) { //check if user exists in db
                $sql="UPDATE USERS SET status= 0  WHERE fullname= '$fullname'";
                //echo $sql;
                $result=mysqli_query($this->db, $sql);
                if ($result === true) {
                    $message = "User account suspended successfully!";
                    echo "<script type='text/javascript'>alert('$message');</script>"; //do javascript alert upon successful restoration
                    echo "<script>window.open('userAdmin.php', '_self');</script>";    //redirect back to useradmin.php
                } else {
                    echo "Error updating record: " . $this->db->error;
                }
            } else {// if user doesn't exist, echo error msg and redirect back to userAdmin.php
                $message = "Such user account does not exist!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo "<script>window.open('userAdmin.php', '_self');</script>";
            }
        }
    }

    //Restore user func upon posting full name of user account to be restored
    public function restoreUser()
    {
        if (isset($_POST['fullname'])) {
            $fullname = $_POST['fullname'];
            //echo $fullname;
            $checkuser="SELECT * FROM USERS where fullname= '$fullname'";
            $result=mysqli_query($this->db, $checkuser);
            $row = $result->num_rows;
            if ($row == 1) { //check if user exists in db
                $sql="UPDATE USERS SET status= 1  WHERE fullname= '$fullname'";
                //echo $sql;
                $result=mysqli_query($this->db, $sql);
                if ($result === true) {
                    $message = "User account restored successfully!";
                    echo "<script type='text/javascript'>alert('$message');</script>"; //do javascript alert upon successful restoration
                    echo "<script>window.open('userAdmin.php', '_self');</script>";    //redirect back to useradmin.php
                } else {
                    echo "Error updating record: " . $this->db->error;
                }
            } else {// if user doesn't exist, echo error msg and redirect back to userAdmin.php
                $message = "Such user account does not exist!";
                echo "<script type='text/javascript'>alert('$message');</script>";
                echo "<script>window.open('userAdmin.php', '_self');</script>";
            }
        }
    }

    public function fetchAllUsersAcc() {
    include("db_connection.php");
    $sql = "SELECT id, fullname, email, usertype, status FROM users";
    $result = mysqli_query($conn, $sql);
    return $result;
    }

    public function searchUsersAcc($search_fullname, $search_email, $search_usertype, $search_status) {
        include("db_connection.php");

        $sql = "SELECT id, fullname, email, usertype, status FROM users WHERE 1=1";

        if (!empty($search_fullname)) {
            $sql .= " AND fullname LIKE '%" . mysqli_real_escape_string($conn, $search_fullname) . "%'";
        }
        if (!empty($search_email)) {
            $sql .= " AND email LIKE '%" . mysqli_real_escape_string($conn, $search_email) . "%'";
        }
        if (!empty($search_usertype)) {
            $sql .= " AND usertype = '" . mysqli_real_escape_string($conn, $search_usertype) . "'";
        }
        if ($search_status !== '') {
            $sql .= " AND status = '" . mysqli_real_escape_string($conn, $search_status) . "'";
            }
        $result = mysqli_query($conn, $sql);
        return $result;
    }

     // Fetch user details by ID
    public function fetchUserById($id) {
        global $conn;
        $sql = "SELECT * FROM users WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return ($result->num_rows == 1) ? $result->fetch_assoc() : null;
    }


    public function fetchAllUserProfiles() {
        global $conn;
        $sql = "SELECT id, username, gender, phone_number FROM users";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public function searchUserProfiles($search_username, $search_gender, $search_phoneNumber) {
        global $conn;
        $sql = "SELECT id, username, gender, phone_number FROM users WHERE 1=1";

        if (!empty($search_username)) {
            $sql .= " AND username LIKE '%" . mysqli_real_escape_string($conn, $search_username) . "%'";
        }
        if (!empty($search_gender) && $search_gender !== 'NIL') {
            $sql .= " AND gender = '" . mysqli_real_escape_string($conn, $search_gender) . "'";
        }
        if (!empty($search_phoneNumber)) {
            $sql .= " AND phone_number LIKE '%" . mysqli_real_escape_string($conn, $search_phoneNumber) . "%'";
        }

        $result = mysqli_query($conn, $sql);
        return $result;
    }

    public function updateUser($id, $fullname, $email, $usertype) {
    global $conn;

    // Fetch the old fullname before updating
    $query = "SELECT fullname FROM users WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        error_log("Error fetching user: " . mysqli_error($conn));
        return false;
    }

    $user_data = $result->fetch_assoc();
    $old_fullname = $user_data['fullname']; // Store the old fullname

    // Update query to modify the user data
    $update_sql = "UPDATE users SET fullname=?, email=?, usertype=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssi", $fullname, $email, $usertype, $id);

    if ($stmt->execute()) {
        // Update feedback table where agent_name matches the old fullname
        $update_feedback_sql = "UPDATE feedback SET agent_name = ? WHERE agent_name = ?";
        $stmt = $conn->prepare($update_feedback_sql);
        $stmt->bind_param("ss", $fullname, $old_fullname);
        if (!$stmt->execute()) {
            error_log("Error updating feedback: " . mysqli_error($conn));
        }

        // Update car_details table for agent_name if the user is an agent
        if ($usertype === 'agent') {
            $update_car_details_agent_sql = "UPDATE car_details SET agent_name = ? WHERE agent_id = ?";
            $stmt = $conn->prepare($update_car_details_agent_sql);
            $stmt->bind_param("si", $fullname, $id);
            $stmt->execute();
        }

        // Update car_details table for seller_name if the user is a seller
        if ($usertype === 'seller') {
            $update_car_details_seller_sql = "UPDATE car_details SET seller_name = ? WHERE seller_id = ?";
            $stmt = $conn->prepare($update_car_details_seller_sql);
            $stmt->bind_param("si", $fullname, $id);
            $stmt->execute();
        }

        return true; // Success
    } else {
        error_log("Error updating user: " . mysqli_error($conn));
        return false; // Error
    }
}

public function updateUserProfile($id, $updates) {
    global $conn;

    $query = "SELECT username FROM users WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        error_log("Error fetching user: " . mysqli_error($conn));
        return false;
    }

    $user_data = $result->fetch_assoc();
    $old_username = $user_data['username'];

    $setClauses = [];
    $params = [];
    $types = '';

    foreach ($updates as $column => $value) {
        $setClauses[] = "$column = ?";
        $params[] = $value;
        $types .= 's';
    }

    $setClause = implode(", ", $setClauses);
    $params[] = $id; 
    $types .= 'i'; 

    $query = "UPDATE users SET $setClause WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        return true; // Success
    } else {
        error_log("Error updating user profile: " . mysqli_error($conn));
        return false; // Error
    }
}

public function deleteUserById($id) {
    global $conn; // Use the global database connection

    // Prepare the DELETE statement
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        error_log("Error preparing statement: " . $conn->error);
        return false;
    }

    // Bind the ID parameter and execute the query
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        return true; // Successfully deleted the user
    } else {
        error_log("Error executing statement: " . $stmt->error);
        return false; // Failed to delete the user
    }
}



}

?>