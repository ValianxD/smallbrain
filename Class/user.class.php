<?php

class User
{   
    public $conn;

    public function __construct() // constructor runs when object is created
    {   
        global $conn; // Get the global $conn variable from db_connection.php
        $this->conn = $conn; // Assign the connection to the class property
        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if (mysqli_connect_errno()) { //if fail to connect to database echo error
            echo "Error: Could not connect to database.";
            exit;
        }
    }

    /* for login process */
    public function validate_login($email, $password) //get email & password input from login.php form
    {
        $sql="SELECT id from users WHERE email='$email' and password='$password'"; //sql statement which retrieves id from users table where email and password match   

        //checking if the id is available in the table
        $result = mysqli_query($this->db, $sql); //query out user table id from db and store in $result
        $user_data = mysqli_fetch_array($result); //fetches a result row as an associative array in $user_data
        $count_row = $result->num_rows;

        if ($count_row == 1) { //if array is present with one row
            // creates and stores a session
            $_SESSION['login'] = true; //session login is true
            $_SESSION['id'] = $user_data['id']; //stores user id into a session variable 'id'
            return true;
        } else {
            return false;
        }
    }
    /*get user account status */
    public function get_status($id)
    {
        $sql="SELECT status FROM users WHERE id = $id";
        $result = mysqli_query($this->db, $sql);
        $user_data = mysqli_fetch_array($result);
        //echo $user_data['status'];
        return $user_data['status'];
    }

    /*get user fullname*/
   public function get_fullname($id)
{
    // Ensure $id is properly escaped to prevent SQL injection
    $id = mysqli_real_escape_string($this->db, $id);
    
    // Correct SQL query with proper connection handling
    $sql = "SELECT fullname FROM users WHERE id = '$id'";
    $result = mysqli_query($this->db, $sql);
    
    // Fetch and return the fullname
    if ($user_data = mysqli_fetch_array($result)) {
        return $user_data['fullname']; // Return fullname instead of echoing it
    }
    
    return ''; // Return an empty string if no fullname is found
}


    /*get user email*/
    public function get_email($id)
    {
        $sql="SELECT email FROM users WHERE id = $id";
        $result = mysqli_query($this->db, $sql);
        $user_data = mysqli_fetch_array($result);
        echo $user_data['email'];
    }

    /*get user role */
    public function get_usertype($id)
    {
        $sql="SELECT usertype FROM users WHERE id = $id";
       
        $result = mysqli_query($this->db, $sql);
        
        $user_data = mysqli_fetch_array($result);
        // echo $user_data['usertype'];
        return $user_data['usertype'];
        }

    /*** starting the session ***/
    public function get_session($id)
    {
        return $_SESSION['login'];
    }
    
    /*logging user out and destroying the session */
    public function user_logout()
    {
        $_SESSION['login'] = false;
        session_destroy();
    }
}
