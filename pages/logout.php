<?php
       // pages/logout.php - Handles user logout

       session_start();
       session_unset(); // Unset all session variables
       session_destroy(); // Destroy the session
       header("Location: login.php"); // Redirect to the login page
       exit();
   ?>
