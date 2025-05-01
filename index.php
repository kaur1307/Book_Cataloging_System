<?php
    // index.php - Main page of the Book Cataloging System
    // This file provides a basic overview and navigation to other parts of the application.

    // You might include session start here if you are using sessions for user login
    // session_start();  // Enable sessions if you need user authentication
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Readle</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/homepage.css">  </head>
<body>
    <header class="main-header">
        <div class="logo-container">
            <img src="./images/logo.jpg" alt="Readle Logo" width="30" height="30">
            <h1 id="logo-name">Readle</h1>
        </div>
        <nav class="main-nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="pages/book_list.php" class="nav-link">Book List</a></li>
                <li class="nav-item"><a href="pages/add_book.php" class="nav-link">Add Book</a></li>
                <li class="nav-item"><a href="pages/login.php" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="pages/register.php" class="nav-link">Register</a></li>
            </ul>
        </nav>
        
    </header>

    <main class="homepage-main">
        <div class="main-content">
            <h1>Readle: The Book Cataloging System</h1>
            <h2>Organize Your Booklist, According To You</h2>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Readle | Prabhsimran Kaur | Navleen Kaur</p>
    </footer>

</body>
</html>