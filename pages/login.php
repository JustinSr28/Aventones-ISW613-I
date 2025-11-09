<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="/styles/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>

    <main>
        <header>
            <img src="../images/logo.png" class="imageLogo" alt="Aventones Logo" />
        </header>

        <section class="contLogin">


            <form action="../actions/login.php" method="POST">
                <div class="inputClass">
                    <label for="username">Username <br></label>
                    <input type="text" id="username" name="username">
                </div>

                <br>
                <div class="inputClass">
                    <label for="password">Password <br></label>
                    <input type="password" id="password" name="password">
                </div>

                <p id="loginError">
                    <?php
                    if (isset($_GET['error'])) {
                    switch($_GET['error']) {
                    case "password": echo "Incorrect password"; break;
                    case "inactive": echo "Your account is inactive"; break;
                    case "pending": echo "Account pending approval"; break;
                    case "notfound": echo "User not found"; break;
                    }
                    }
                    ?>
                </p>


                <p>Not a user? <a href="pages/userRegistration.html">Register Now</a></p>

                <div class="contButton">
                    <button type="submit" class="button">Login</button>
                </div>

            </form>

        </section>
    </main>

    <footer>
        <hr>
        <nav aria-label="Footer navigation">
            <a href="" class="foot">Home</a> |
            <a href="" class="foot">Rides</a> |
            <a href="" class="foot">Bookings</a> |
            <a href="" class="foot">Settings</a> |
            <a href="" class="foot">Login</a> |
            <a href="" class="foot">Register</a>
        </nav>
        <p>&copy; 2025 Aventones.com</p>

    </footer>
</body>

</html>