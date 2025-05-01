<?php
    // server/book_actions.php - PHP functions for book operations
    // This file contains functions to perform CRUD (Create, Read, Update, Delete) operations
    // on the 'books' table in the database.

    // Function to fetch all books from the database
    function getAllBooks($conn) {
        $sql = "SELECT * FROM books"; // SQL query to select all books
        $result = $conn->query($sql); // Execute the query
        $books = []; // Initialize an empty array to store books
        if ($result->num_rows > 0) { // Check if there are any results
            while($row = $result->fetch_assoc()) { // Loop through each row
                $books[] = $row; // Add each book to the $books array
            }
        }
        return $books; // Return the array of books
    }

    // Function to add a new book to the database
    function addBook($conn, $title, $author, $genre, $user_id) { // Added user_id parameter
        $sql = "INSERT INTO books (title, author, genre, user_id) VALUES (?, ?, ?, ?)"; // Included user_id in the INSERT
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $author, $genre, $user_id); // Bound the user_id
        return $stmt->execute();
    }

    // Function to get details of a single book by ID
    function getBookDetails($conn, $id) {
        $sql = "SELECT * FROM books WHERE id = ?"; // SQL query to select a book by its ID
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id); // Bind the ID parameter (i = integer)
        $stmt->execute();
        $result = $stmt->get_result(); // Get the result set

        if ($result->num_rows == 1) { // Check if exactly one row is returned
            return $result->fetch_assoc(); // Fetch and return the book details as an associative array
        } else {
            return false; // Return false if no book is found with the given ID
        }
    }

    // Function to update an existing book's information
    function updateBook($conn, $id, $title, $author, $genre) {
        $sql = "UPDATE books SET title = ?, author = ?, genre = ? WHERE id = ?"; // SQL query to update a book
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $author, $genre, $id); // Bind parameters (s = string, i = integer)
        return $stmt->execute(); // Execute the update query
    }

    // Function to delete a book from the database
    function deleteBook($conn, $id) {
        $sql = "DELETE FROM books WHERE id = ?"; // SQL query to delete a book
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id); // Bind the ID parameter
        return $stmt->execute(); // Execute the delete query
    }
    // Function to search for books by title, author, or genre
    function searchBooks($conn, $searchTerm) {
        $searchTerm = "%" . $searchTerm . "%"; // Add wildcards for "contains" search
        $sql = "SELECT * FROM books WHERE title LIKE ? OR author LIKE ? OR genre LIKE ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $books = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }

    function getBooksByUser($conn, $user_id) {
        $sql = "SELECT * FROM books WHERE user_id = ?"; //  Added WHERE clause
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $books = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }
    function searchAndFilterBooksByUser(
        $conn,
        $user_id,
        $searchTerm = "",
        $filterGenre = "",
        $filterAuthor = ""
    ) {
        $sql = "SELECT * FROM books WHERE user_id = ?";
        $params = [$user_id];
        $types = "i";
    
        if (!empty($searchTerm)) {
            $sql .= " AND (title LIKE ? OR author LIKE ? OR genre LIKE ?)";
            $searchTerm = "%" . $searchTerm . "%";
            array_push($params, $searchTerm, $searchTerm, $searchTerm);
            $types .= "sss";
        }
    
        if (!empty($filterGenre)) {
            $sql .= " AND genre = ?";
            array_push($params, $filterGenre);
            $types .= "s";
        }
    
        if (!empty($filterAuthor)) {
            $sql .= " AND author = ?";
            array_push($params, $filterAuthor);
            $types .= "s";
        }
    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $books = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }

    function getUniqueGenres($conn, $user_id) {
        $sql = "SELECT DISTINCT genre FROM books WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $genres = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $genres[] = $row['genre'];
            }
        }
        return $genres;
    }
    
    function getUniqueAuthors($conn, $user_id) {
        $sql = "SELECT DISTINCT author FROM books WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $authors = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $authors[] = $row['author'];
            }
        }
        return $authors;
    }
?>