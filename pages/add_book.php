

<?php
    // pages/add_book.php - Form to add a new book to the catalog
    // Handles form display and processing of new book submissions.

    include '../server/db_connect.php';  // Include the database connection
    include '../server/book_actions.php'; // Include file with book-related functions

    session_start(); // Start the session

       // Check if the user is logged in
       if (!isset($_SESSION['user_id'])) {
           header("Location: login.php"); // Redirect to login if not logged in
           exit();
       }

    $error_message = ""; // Initialize an empty error message

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the form has been submitted
        // Basic validation (more robust validation should be in JavaScript - see validation.js)
        if (empty($_POST['title']) || empty($_POST['author'])) {
            $error_message = "Title and author are required.";
        } else {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $genre = $_POST['genre'];
            $user_id = $_SESSION['user_id'];

            if (addBook($conn, $title, $author, $genre,$user_id)) { // Call the addBook function
                header("Location: book_list.php"); // Redirect to book list after adding
                exit(); // Ensure no further code is executed
            } else {
                $error_message = "Error adding book.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="../css/add_book.css"> </head>
<body>

<header class="main-header">
        <div class="logo-container">
            <img src="../images/logo.jpg" alt="Readle Logo" width="30" height="30">
            <h1 id="logo-name">Readle</h1>
        </div>
        <nav class="main-nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="../index.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="book_list.php" class="nav-link">Book List</a></li>
                <li class="nav-item"><a href="add_book.php" class="nav-link">Add Book</a></li>
                <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
            </ul>
        </nav>
        
    </header>

    <main>
    <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
       
        <div class="add-book-form-container"> 
             
            <form action="add_book.php" method="post" id="addBookForm"> 
                <table>

                    <tr>
                    <div class="loggedin-text">
                        <?php if (isset($_SESSION['username'])): ?>
                        <p>Logged in as <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                        </div>
                    </tr>

                    <tr>
                        <td><label for="title">Title</label></td>
                        <td><input type="text" id="title" name="title" required></td>
                    </tr>
                    <tr>
                        <td><label for="author">Author</label></td>
                        <td><input type="text" id="author" name="author" required></td>
                    </tr>
                    <tr>
                        <td><label for="genre">Genre</label></td>
                        <td><input type="text" id="genre" name="genre"></td>
                    </tr>
                </table>
                <button type="submit">Add Book</button>
            </form>
        </div> 
        <?php else: ?>
            <p>You must be logged in to add books.</p>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </main>
    <script src="../scripts/validation.js"></script>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Readle | Prabhsimran Kaur | Navleen Kaur</p>
    </footer>


</body>
</html>