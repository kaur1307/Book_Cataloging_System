<?php
    // pages/edit_book.php - Form to edit an existing book's information
    // Fetches book data for editing and handles form submissions to update the data.

    include '../server/db_connect.php';
    include '../server/book_actions.php';

    $error_message = "";

    // Get the book ID from the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
        $book = getBookDetails($conn, $id); // Fetch book details using the ID

        if (!$book) {
            // Book not found, redirect to book list
            header("Location: book_list.php");
            exit();
        }
    } else {
        // Invalid ID, redirect to book list
        header("Location: book_list.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validation
        if (empty($_POST['title']) || empty($_POST['author'])) {
            $error_message = "Title and author are required.";
        } else {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $genre = $_POST['genre'];

            if (updateBook($conn, $id, $title, $author, $genre)) { // Update the book in the database
                header("Location: book_list.php");
                exit();
            } else {
                $error_message = "Error updating book.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="../css/edit.css">
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
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <div class="edit-form-container">
            
                <form action="edit_book.php?id=<?php echo $id; ?>" method="post">
                    <table>
                        <tr>
                            <td> <label for="title">Title</label></td>
                            <td><input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="author">Author</label></td>
                            <td><input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="genre">Genre</label></td>
                            <td><input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>"></td>
                        </tr>
                        </table>
                    <button type="submit">Update Book</button>
                </form>
                
            
        </div>    
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Readle | Prabhsimran Kaur | Navleen Kaur</p>
    </footer>

</body>
</html>