<?php
    // server/user_actions.php - PHP functions for user operations
    // This file contains functions to handle user registration and login.

    // Function to register a new user
    function registerUser($conn, $username, $password, $email) {
        // Check if username or email already exists
        if (usernameExists($conn, $username)) {
            return "username_exists";
        }
        if (emailExists($conn, $email)) {
            return "email_exists";
        }

        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $password, $email);
        if ($stmt->execute()) {
            return true; // Registration successful
        } else {
            return false; // Registration failed
        }
    }

    // Function to check if a username already exists
    function usernameExists($conn, $username) {
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result(); // Store the result to get num_rows
        return $stmt->num_rows > 0;
    }

    // Function to check if an email already exists
     function emailExists($conn, $email) {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }


    // Function to get user details by username
    function getUserDetailsByUsername($conn, $username) {
        $sql = "SELECT id, username, email FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    // Function to authenticate a user during login
    function loginUser($conn, $username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Verify the provided password against the hashed password in the database
            if (password_verify($password, $user['password'])) {
                return $user; // Return the entire user array
            }
        }
        return false;
    }
?>