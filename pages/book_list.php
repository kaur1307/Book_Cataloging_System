<?php
    // pages/book_list.php - Displays a list of books from the database
    // This page fetches book data and presents it in a table format, with search functionality.

    include '../server/db_connect.php';  // Include the database connection
    include '../server/book_actions.php'; // Include file with book-related functions

    session_start(); // Start the session (if you're using sessions for login, etc.)
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    
    $user_id = $_SESSION['user_id'];
    $searchTerm = "";
    $filterGenre = "";
    $filterAuthor = "";
    $books = [];

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchTerm = trim($_GET['search']);
    }
    if (isset($_GET['filter_genre']) && !empty($_GET['filter_genre'])) {
        $filterGenre = trim($_GET['filter_genre']);
    }
    if (isset($_GET['filter_author']) && !empty($_GET['filter_author'])) {
        $filterAuthor = trim($_GET['filter_author']);
    }

    $books = searchAndFilterBooksByUser($conn, $user_id, $searchTerm, $filterGenre, $filterAuthor);

    // Get unique genres and authors for filter dropdowns
    $genres = getUniqueGenres($conn, $user_id);
    $authors = getUniqueAuthors($conn, $user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link rel="stylesheet" href="../css/book_list.css">
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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <!--<div class="search-container">
            <form action="book_list.php" method="get">
                <input type="text" placeholder="Search Books" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                <button type="submit">Search</button>-->

                

            </form>
        </div>
    </header>

    <main class="book-list-container">
        <?php if (isset($_SESSION['user_id'])): ?>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <?php endif; ?>


        <div class="filter-container">  <form action="book_list.php" method="get" class="filter-form">
            <input type="text" placeholder="Search Books" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit">Search</button>

            <label for="filter_genre">Genre:</label>
            <select name="filter_genre" id="filter_genre">
                <option value="">All</option>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?php echo htmlspecialchars($genre); ?>" <?php if ($filterGenre == $genre) echo "selected"; ?>>
                        <?php echo htmlspecialchars($genre); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="filter_author">Author:</label>
            <select name="filter_author" id="filter_author">
                <option value="">All</option>
                <?php foreach ($authors as $author): ?>
                    <option value="<?php echo htmlspecialchars($author); ?>" <?php if ($filterAuthor == $author) echo "selected"; ?>>
                        <?php echo htmlspecialchars($author); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Filter</button>
        </form>
        </div>  <?php if (empty($books)): ?>
            <p>No books found.</p>
        <?php else: ?>
            <ul class="book-list">
                <?php foreach ($books as $book): ?>
                    
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>

        <?php if (empty($books)): ?>
            <p>No books found.</p>
        <?php else: ?>
            <ul class="book-list">
                <?php foreach ($books as $book): ?>
                    <li class="book-item">
                        <div class="book-info">
                            <h3 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p class="book-author">Author: <?php echo htmlspecialchars($book['author']); ?></p>
                            <p class="book-genre">Genre: <?php echo htmlspecialchars($book['genre']); ?></p>
                        </div>
                        <div class="book-actions">
                            <a href="book_details.php?id=<?php echo $book['id']; ?>" class="details-btn">Details</a>
                            <a href="edit_book.php?id=<?php echo $book['id']; ?>" class="edit-btn">Edit</a>
                            <a href="delete_book.php?id=<?php echo $book['id']; ?>" class="delete-btn">Delete</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Readle | Prabhsimran Kaur | Navleen Kaur</p>
    </footer>

</body>
</html>