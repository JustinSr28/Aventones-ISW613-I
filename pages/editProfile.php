<?php
require_once "../common/Users.php";


session_start();
    if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }

$idUser = $_SESSION['idUser'];
$role   = $_SESSION['role']; 
$userData = new Users();
$userResult = $userData -> loadUserData($idUser);

$user= mysqli_fetch_assoc($userResult);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
        <h1>Edit Profile</h1>
        <form action="../actions/updateUser.php" method="post" class="formRider" enctype="multipart/form-data">
            <div>
                <label for="first-name">First Name <br></label>
                <input type="text" id="first-name" name="first-name" value = "<?= $user['name'] ?>">
            </div>

            <div>
                <label for="last-name">Last Name<br></label>
                <input type="text" id="last-name" name="last-name" value = "<?= $user['lastName']?>">
            </div>

            <div>
                <label for="id-card">ID<br></label>
                <input type="text" id="id-card" name="id-card" value = "<?= $user['ID']?>">
            </div>

             <div>
                <label for="birth-date">Birth Date<br></label>
                <input type="date" id="birth-date" name="birth-date" value = "<?= $user['birthDate']?>" required >
            </div>

            <div class="bigElement">
                <label for="email">Email<br></label>
                <input type="text" id="email" name="email" value = "<?= $user['gmail']?>">
            </div>

            <div>
                <label for="password">Password<br></label>
                <input type="password" id="password" name="password" >
            </div>

            <div>
                <label for="repeat-password">Repeat Password<br></label>
                <input type="password" id="repeat-password" name="repeat-password" >
            </div>

            <div class="bigElement">
                <label for="address">Address<br></label>
                <input type="text" id="address" name="address" value = "<?= $user['address']?>">
            </div>

            <div>
                <label for="phone-number">Phone Number<br></label>
                <input type="tel" id="phone-number" name="phone-number" value = "<?= $user['phoneNumber']?>">
            </div>

            <div>
                <label for="picture">Photo<br></label>
                <input type="file" id="picture" name="picture" accept="image/*">
                <img src="../<?= $user['picture'] ?>" alt="Image" width="100"></td>
            </div>

            <div>
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
            <a href="configuration.php" class="foot">Settings</a> |
            <a href="login.php" class="foot">Login</a> |
            <a href="userRegistration.html" class="foot">Register</a>
        </nav>
        <p>&copy; 2025 Aventones.com</p>

    </footer>

</body>

</html>