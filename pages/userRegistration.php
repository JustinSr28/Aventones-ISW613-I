<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="../styles/register.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <img src="../images/logo.png" class="image" alt="Aventones Logo" />
    </header>

    <main>
        <h1>User Registration</h1>
        <?php if (isset($_GET['error'])): ?>
            <div class="error-box">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="../actions/insertClient.php" method="POST" class="formRider" enctype="multipart/form-data">
            <div>
                <label for="first-name">First Name <br></label>
                <input type="text" id="first-name" name="first-name" required>
            </div>

            <div>
                <label for="last-name">Last Name<br></label>
                <input type="text" id="last-name" name="last-name" required>
            </div>

            <div>
                <label for="id-card">ID<br></label>
                <input type="text" id="id-card" name="id-card" required>
            </div>

            <div>
                <label for="birth-date">Birth Date<br></label>
                <input type="date" id="birth-date" name="birth-date" required>
            </div>

            <div class="bigElement">
                <label for="gmail">Email<br></label>
                <input type="email" id="gmail" name="gmail" required>
            </div>

            <div>
                <label for="password">Password<br></label>
                <input type="password" id="password" name="password" required>
            </div>

            <div>
                <label for="repeat-password">Repeat Password<br></label>
                <input type="password" id="repeat-password" name="repeat-password" required>
            </div>

            <div class="bigElement">
                <label for="address">Address<br></label>
                <input type="text" id="address" name="address" required>
            </div>

            <div>
                <label for="phone-number">Phone Number<br></label>
                <input type="tel" id="phone-number" name="phone-number" required>
            </div>
            <div>
                <label for="user-photo">Photo<br></label>
                <input type="file" id="user-photo" name="user-photo" accept="image/*">
            </div>
            <input type="hidden" name="role" value="user">

            <p class="left">Already a user? <a href="login.php">Login here</a></p>
            <p class="right">Register as driver? <a href="riderRegistration.php">Click here</a></p>
            <div class="bigElement" id="buttonId">
                <button type="submit" class="buttonClass">Sign up</button>
            </div>
        </form>

    </main>
    
    <footer>
        <hr>
        <nav aria-label="Footer navigation">
            <a href="editProfile.php" class="foot">Profile</a> |
            <a href="configuration.php" class="foot">Settings</a>
        </nav>
        <p>&copy; 2025 Aventones.com</p>

    </footer>
</body>

</html>