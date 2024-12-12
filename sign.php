<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup-container">
        <h2>Create Account</h2>
        <p>Sign up for an account</p>
        <form onsubmit="showSnackbar(event)">
            <input type="text" placeholder="Name" required>
            <input type="email" placeholder="Email" required>
            <input type="password" placeholder="Password" required>
            <button type="submit">SIGN UP</button>
        </form>
    </div>

    <!-- Snackbar container -->
    <div id="snackbar">Account created successfully!</div>

    <script>
        function showSnackbar(event) {
            event.preventDefault(); // Prevent form submission

            // Show snackbar
            var snackbar = document.getElementById("snackbar");
            snackbar.className = "show";

            // Hide snackbar after 3 seconds
            setTimeout(function() {
                snackbar.className = snackbar.className.replace("show", "");
            }, 3000);
        }
    </script>

<script>
        // Function to set a cookie
        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        // Function to get a cookie by name
        function getCookie(name) {
            const nameEQ = name + "=";
            const cookiesArray = document.cookie.split(';');
            for (let i = 0; i < cookiesArray.length; i++) {
                let cookie = cookiesArray[i];
                while (cookie.charAt(0) == ' ') cookie = cookie.substring(1, cookie.length);
                if (cookie.indexOf(nameEQ) === 0) return cookie.substring(nameEQ.length, cookie.length);
            }
            return null;
        }

        // Function to check login state
        function checkLoginStatus() {
            const user = getCookie("user");
            if (user) {
                alert("Welcome back, " + user);
                // Redirect or handle logged-in state as needed
            }
        }

        // Function to handle login form submission
        document.getElementById("login-form").addEventListener("submit", function(event) {
            event.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            // Simulate authentication check
            if (email === "user@example.com" && password === "password123") {
                setCookie("user", email, 1); // Set a 1-day session cookie
                alert("Login successful!");
                // Redirect to a new page or handle logged-in state here
            } else {
                alert("Invalid email or password");
            }
        });

        // Check login status on page load
        window.onload = function() {
            checkLoginStatus();
        };
    </script>
</body>
</html>
