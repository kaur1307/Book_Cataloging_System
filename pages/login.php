<?php
    // pages/login.php - User login form
    // Handles the display of the login form and the authentication of users.

    include '../server/db_connect.php';  // Include the database connection
    include '../server/user_actions.php'; // Include file with user-related functions

    $error_message = ""; // Initialize an empty error message

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the form has been submitted
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error_message = "Username and password are required.";
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = loginUser($conn, $username, $password); // Get the user data

            if ($user) {
                // Successful login - start a session and redirect
                session_start();
                $_SESSION['user_id'] = $user['id']; // Store user ID in session
                $_SESSION['username'] = $user['username']; // Store username
                $_SESSION['email'] = $user['email']; // Store email (optional)
                header("Location: book_list.php"); // Redirect to book list
                exit();
            } else {
                $error_message = "Invalid username or password.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="../css/login.css"> </head>
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
        <?php if ($error_message): ?>  <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <div class="login-form-container">        
            <form action="login.php" method="post" id="loginForm"> 
                <table>
                    <tr>
                        <td>
                            <label for="username">Username</label>
                        </td>
                        <td>
                            <input type="text" id="username" name="username" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="password">Password</label>
                        </td> 
                        <td>
                            <input type="password" id="password" name="password" required>
                        </td>                    
                    </tr>
                </table>
                <button type="submit">Login</button>
            </form>
        </div>
    </main>
    <script src="../scripts/validation.js"></script>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Readle | Prabhsimran Kaur | Navleen Kaur</p>
    </footer>

</body>
</html>