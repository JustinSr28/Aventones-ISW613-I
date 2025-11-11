<?php 
    require_once "../common/Users.php";

    
    session_start();
    if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }

    $idUser = $_SESSION['idUser'];
    $role   = $_SESSION['role']; 

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
                    <?php 
                        if ($role === "Driver") {
                            echo '<li id="rides-navegation"><a href="myVehicles.php">Vehicles</a></li>';
                            echo '<li id="rides-navegation"><a href="myRides.php">Rides</a></li>';
                            echo '<li><a href="bookings.php">Bookings</a></li>';
                        }
                        else if ($role === "Client"){
                            echo '<li><a href="searchRides.php">Home</a></li>';
                            echo '<li><a href="bookings.php">Bookings</a></li>';
                        }
                        else {
                            echo '<li><a href="allUsers.php" class="activo">Users</a></li>';
                        }
                    ?>
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
        <h1>Configuration</h1>
        <form action="../actions/saveConfiguration.php" method="POST" id="configuration_form">
            <label for="public-name">Public Name</label>
            <input type="text" id="public-name" name="public-name" value="<?php echo $publicName ?>">

            <label for="public-bio">Public Bio</label>
            <textarea id="public-bio" name="public-bio"> <?php echo $publicBio ?> </textarea>

            <div class="buttons">
                <?php 
                    if ($role === "Driver") {
                        echo '<a id="a-form" href="myRides.php">Cancel</a>';
                    }
                    else if ($role === "Client"){
                        echo '<a id="a-form" href="searchRides.php">Cancel</a>';
                    }
                    else {
                        echo '<a id="a-form" href="allUsers.php">Cancel</a>';
                    }
                    ?>
                <button type="submit">Save</button>
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