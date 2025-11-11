<?php 
    session_start();
   if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
    echo "DEBUG: No hay sesión activa. Redirigiendo...";
    header("Location: ../pages/login.php");
    exit();
}
    
    $role   = $_SESSION['role']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Administrator</title>
    <link rel="stylesheet" href="../styles/generalStyle.css">
    <link rel="stylesheet" href="../styles/editProfile.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <img src="../images/logo.png" class="design-logo" alt="Aventones Logo">

        <div class="menu-cont">
            <nav class="Head" aria-label="Main menu">
                <ul>
                    <li><a href="allUsers.php" class="activo">Users</a></li>
                </ul>
            </nav>

            <div class="navigation-cont">
                <div class="user-menu">
                    <img src="../images/user.png" class="navigation-image" alt="User icon">
                    <nav class="menu-hover">
                        <ul>
                            <li><a href="../actions/logout.php">Logout</a></li>
                            <li><a href="editProfile.php">Profile</a></li>
                            <li><a href="configuration.php">Configuration</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main>
        <h1>New Administrator</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-box">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="../actions/insertAdmin.php" method="post" class="formRider">
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
                <label for="email">Email<br></label>
                <input type="text" id="email" name="email" required>
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

            <div>
                <a href="allUsers.php"> cancel</a>

            </div>

            <div class="contenedor-boton">
                <button type="submit">save</button>
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