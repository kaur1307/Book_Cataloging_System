<?php
    // pages/register.php - User registration form
    // Handles the display of the registration form and the processing of new user registrations.

    include '../server/db_connect.php';  // Include the database connection
    include '../server/user_actions.php'; // Include file with user-related functions

    $error_message = ""; // Initialize an empty error message
    $username = $email = ""; // Initialize variables to avoid notices

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize inputs to prevent potential security issues
        $username = htmlspecialchars(trim($_POST['username']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = $_POST['password'];

        // Basic validation
        if (empty($username) || empty($password) || empty($email)) {
            $error_message = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid email format.";
        } else {
            // Hash the password before storing it
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Attempt to register the user
            $registration_result = registerUser($conn, $username, $hashed_password, $email);

            if ($registration_result === true) {
                header("Location: login.php"); // Redirect on success
                exit();
            } elseif ($registration_result === "username_exists") {
                $error_message = "Username already exists.";
            } elseif ($registration_result === "email_exists") {
                 $error_message = "Email address already exists.";
            } else {
                $error_message = "Error registering user. Please try again."; // Generic error
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="../css/register.css">
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
        
    </header>

    <div>
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <div class="register-form-container">
            <form action="register.php" method="post" id="registrationForm">
                <table>
                    <tr>
                        <td>
                            <label for="username">Username</label>
                        </td>
                        <td>
                            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>                        
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
                    <tr>
                        <td>
                            <label for="email">Email</label> 
                        </td>
                        <td>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required> 
                        </td>
                    </tr>
                </table>
                <button type="submit">Register</button>
            </form>
        </div>
    </main>
    <script src="../scripts/validation.js"></script>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Readle | Prabhsimran Kaur | Navleen Kaur</p>
    </footer>

</body>
</html>