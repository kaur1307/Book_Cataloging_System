<?php
    // pages/delete_book.php -  Confirms and processes the deletion of a book
    //  Asks for confirmation before deleting and then performs the deletion.

    include '../server/db_connect.php';
    include '../server/book_actions.php';

    // Get the book ID from the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $book = getBookDetails($conn, $id); // Fetch book details for display


        if (!$book) {
            // Book not found, redirect
            header("Location: book_list.php");
            exit();
        }
    } else {
        // Invalid ID, redirect
        header("Location: book_list.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['confirm_delete']) && $_POST['confirm_delete'] == 'yes') {
            if (deleteBook($conn, $id)) {  // Delete the book
                header("Location: book_list.php"); // Redirect after deletion
                exit();
            } else {
                $error_message = "Error deleting book.";
            }
        } else {
            // User cancelled, redirect
            header("Location: book_list.php");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
    <link rel="stylesheet" href="../css/delete_book.css">
</head>
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
        <div class="search-container">
            <input type="text" placeholder="Search Books ">
            <button type="submit">Search</button>
        </div>
    </header>

    <main>
        <div class="delete-form-container">
            <h2>Confirm Delete</h2>
            <p>Are you sure you want to delete the following book?</p>
            <p><strong>Title: </strong> <?php echo htmlspecialchars($book['title']); ?></p>
            <p><strong>Author: </strong> <?php echo htmlspecialchars($book['author']); ?></p>

            <form action="delete_book.php?id=<?php echo $id; ?>" method="post">
                <input type="hidden" name="confirm_delete" value="yes">
                <button type="submit">Yes, Delete</button>
                <button> <a href="book_list.php">No, Cancel</a></button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Readle | Prabhsimran Kaur | Navleen Kaur</p>
    </footer>

</body>
</html>