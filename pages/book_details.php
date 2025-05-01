<?php
    // pages/book_details.php - Displays detailed information for a single book
    // Fetches book data based on the ID passed in the URL.

    include '../server/db_connect.php';
    include '../server/book_actions.php';

    // Get the book ID from the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $book = getBookDetails($conn, $id); // Fetch book details

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
    <link rel="stylesheet" href="../css/details.css">
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

    <main class="details-main">
        <div class="book-details-container">
            <table class="book-details-table">
                <tr>
                    <td colspan="3"><h1 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h1></td>
                </tr>
                <tr>
                    <td> <p class="book-author"><strong>Author: </strong> <?php echo htmlspecialchars($book['author']); ?></p></td>
                    <td></td>
                    <td><p class="book-genre"><strong>Genre: </strong> <?php echo htmlspecialchars($book['genre']); ?></p></td>
                </tr>
            </table>
            <div class="back-button-container">
                <button class="back-to-list-button"><a href="book_list.php">Back to Book List</a></button>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Readle | Prabhsimran Kaur | Navleen Kaur</p>
    </footer>

</body>
</html>