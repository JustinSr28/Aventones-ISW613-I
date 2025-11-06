<?php 
    require_once "../common/Users.php";

    session_start();
    $idUser = $_SESSION['idUser'];

    $user = new Users();
    $result = $user -> getConfigurationData($idUser);

    $publicName = "";
    $publicBio = "";

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $publicName = $row['publicname'];
        $publicBio = $row['publicbio'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Edit Ride</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/generalStyle.css">
    <link rel="stylesheet" href="../styles/configuration.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <img src="../images/logo.png" class="design-logo" alt="Aventones Logo">

        <div class="menu-cont">
            <nav class="Head" aria-label="Main menu">
                <ul>
                    <li><a href="">Home</a></li>
                    <li id="rides-navegation"><a href="" class="activo">Rides</a></li>
                    <li><a href="">Bookings</a></li>
                </ul>
            </nav>

            <div class="navigation-cont">
                <div class="user-menu">
                    <img src="../images/user.png" class="navigation-image" alt="User icon">
                    <nav class="menu-hover">
                        <ul>
                            <li><a href="" id="logout-link">Logout</a></li>
                            <li><a href="">Profile</a></li>
                            <li><a href="" class="activo">Configuration</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <main>
        <h1>Configuration</h1>
        <form action="../actions/saveConfiguration.php" method="POST" id="configuration_form">
            <label for="public-name">Public Name</label>
            <input type="text" id="public-name" name="public-name" value="<?php echo $publicName ?>">

            <label for="public-bio">Public Bio</label>
            <textarea id="public-bio" name="public-bio"> <?php echo $publicBio ?> </textarea>

            <div class="buttons">
                <a id="a-form" href="myRides.html">Cancel</a>
                <button type="submit">Save</button>
            </div>
        </form>
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