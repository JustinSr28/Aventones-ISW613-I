
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link rel="stylesheet" href="../styles/generalStyle.css">
    <link rel="stylesheet" href="../styles/activateAccount.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <img src="../images/logo.png" class="design-logo" alt="Aventones Logo">
    </header>

    <main>
        <h1>Activate Account</h1>

       
        <?php
            require_once "../common/Users.php";
            require_once "../common/conectionBD.php";
            $db = new ConnectionBD();
            $conn = $db->getConnection();
            $user = new Users();
            $token = $_GET['token'];
            $user -> activateUser($token);
           
        ?>
        <p class="message">¡Tu cuenta ha sido activada exitosamente!</p>
        <a href="login.php" class="btn">Ir al login</a>
       
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