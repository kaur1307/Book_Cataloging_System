<?php
    // server/db_connect.php - Database connection script
    // This file establishes a connection to the MySQL database.
    // It's included in other PHP files that need to interact with the database.

    $servername = "localhost"; // Change if your MySQL server is on a different host
    $username = "root"; // Change to your actual database username
    $password = ""; // Change to your actual database password
    $dbname = "book_catalog"; // Change to your actual database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error); // Terminate script on connection error
    }
?>