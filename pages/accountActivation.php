
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
        <h1>Activate Account</h1>
        <?php
            require_once "../common/Users.php";
            require_once "../common/conectionBD.php";
            $db = new ConnectionBD();
            $conn = $db->getConnection();
            $user = new Users();
            $token = $_GET['token'];
            $user -> activateUser($token);
            header('Location: ../index.html');
        ?>
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