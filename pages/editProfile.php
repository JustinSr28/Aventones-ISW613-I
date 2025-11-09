<?php
require_once "../common/Users.php";

session_start();

$idUser = $_SESSION['idUser'];

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
                <label for="user-photo">Photo<br></label>
                <input type="file" id="user-photo" name="user-photo" accept="image/*">
                <img src="../<?= $user['picture'] ?>" alt="Vehicle Image" width="100"></td>
                
            </div>

            <div>
                <a href=""> cancel</a>

            </div>

            <div class="contenedor-boton">
                <button type="submit">save</button>
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