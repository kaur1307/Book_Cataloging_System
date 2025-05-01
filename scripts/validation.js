// scripts/validation.js - Client-side form validation using JavaScript
// This file contains JavaScript functions to validate form inputs before submission.
// It uses DOM manipulation to check input values and display error messages.

document.addEventListener('DOMContentLoaded', function() { // Run code after the DOM is fully loaded

    // --- Registration Form Validation ---
    const registrationForm = document.getElementById('registrationForm');
    if (registrationForm) { // Check if the registration form exists on the page
        registrationForm.addEventListener('submit', function(event) { // Add submit event listener
            let isValid = true; // Assume the form is valid initially
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const email = document.getElementById('email').value;

            if (username.trim() === '') { // Check if username is empty
                alert('Username is required');
                isValid = false;
            }

            if (password.length < 6) { // Check if password is too short
                alert('Password must be at least 6 characters');
                isValid = false;
            }

             if (!email.includes('@')) { // Check if email is valid (basic check)
                alert('Invalid email format');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }

    // --- Add Book Form Validation ---
    const addBookForm = document.getElementById('addBookForm');
    if (addBookForm) { // Check if the add book form exists
        addBookForm.addEventListener('submit', function(event) {
            let isValid = true;
            const title = document.getElementById('title').value;
            const author = document.getElementById('author').value;

            if (title.trim() === '') { // Check if title is empty
                alert('Title is required');
                isValid = false;
            }

            if (author.trim() === '') { // Check if author is empty
                alert('Author is required');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }

     // --- Login Form Validation ---
    const loginForm = document.getElementById('loginForm');
    if (loginForm) { // Check if the login form exists
        loginForm.addEventListener('submit', function(event) {
            let isValid = true;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (username.trim() === '') { // Check if username is empty
                alert('Username is required');
                isValid = false;
            }

            if (password.trim() === '') { // Check if password is empty
                alert('Password is required');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }
});