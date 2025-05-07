# 📚 Readle – Book Cataloging System

**Readle** is a user-friendly book cataloging system designed to help users organize their personal library. It allows users to register, log in, add books, and manage their collection with features like editing, deleting, and filtering.

## 🚀 Features

### ✅ User Authentication
- Secure registration and login pages (`register.php`, `login.php`)
- Only logged-in users can access and manage their book list

### 📖 Add Books
- Logged-in users can add new books using `add_books.php`
- Required fields: Title, Author, Genre
- After submission, the book appears in the user's personalized library

### 📚 Book List Management
- View all added books in `book_list.php`
- Features include:
  - View book details
  - Edit or delete existing books
  - Search and filter books by keywords

## 🗃️ Database Structure

### 🔐 Users Table
| Field       | Description                         |
|-------------|-------------------------------------|
| `id`        | Auto-incremented user ID            |
| `username`  | Unique username (required)          |
| `password`  | Hashed password (required)          |
| `email`     | Unique email address (required)     |
| `created_at`| Timestamp of account creation       |

### 📘 Books Table
| Field       | Description                                          |
|-------------|------------------------------------------------------|
| `id`        | Auto-incremented book ID                             |
| `user_id`   | ID of the user who added the book                    |
| `title`     | Title of the book (required)                         |
| `author`    | Author name (required)                               |
| `genre`     | Genre of the book (required)                         |
| `added_at`  | Timestamp of when the book was added                 |


