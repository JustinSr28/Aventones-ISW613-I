<?php 
    require_once "../common/Rides.php"; 

    session_start();
    if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
            header("Location: login.php");
            exit();
    }
        
    $role = $_SESSION['role'];

    $ridesObj = new Rides();

    $idRide = $_GET['id'];

    $ridesResult = $ridesObj->loadRideDetails($idRide);

    $ride = mysqli_fetch_assoc($ridesResult);
    $rideDays = explode(',', $ride['rideDate']); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ride Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/generalStyle.css">
    <link rel="stylesheet" href="../styles/rides.css">
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
                            echo '<li id="rides-navegation"><a href="myRides.php" class="activo">Rides</a></li>';
                            echo '<li><a href="bookings.php">Bookings</a></li>';
                        }
                        else if ($role === "Client"){
                            echo '<li><a href="searchRides.php" class="activo">Home</a></li>';
                            echo '<li><a href="bookings.php">Bookings</a></li>';
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
        <h1>Ride Details</h1>

        <figure class="driver-photo">
            <img src="../<?= $ride['picture'] ?>" alt="Driver photo" class="profile-picture" ></td>
            <figcaption id="rider-name" class="driver-name" ><?= $ride['name']?></figcaption>
        </figure>

        <form class="formm" id="ride_details_form" action= "../actions/insertBooking.php" method="POST">
            
            <input type="hidden" name="idRide" value="<?= $ride['idRide']?>">

            <div class="input-design-right">
                <label for="departure-from">Departure from <br></label>
                <input type="text" id="departure-from" name="departure-from" class="input-desing"  disabled value="<?= $ride['origin'] ?>">
            </div>

            <div class="input-design-left">
                <label for="arrive-to">Arrive To <br></label>
                <input type="text" id="arrive-to" name="arrive-to" class="input-desing" disabled value="<?= $ride['destination'] ?>" >
            </div>

            <h2>Days</h2>

           
            <fieldset class="rows">
                <label for="mon"><input id="mon" name="days[]" type="checkbox" disabled value="Mon" <?php if(in_array('Mon', $rideDays)) echo 'checked'; ?>> Mon</label>
                <label for="tue"><input id="tue" name="days[]" type="checkbox" disabled value="Tue" <?php if(in_array('Tue', $rideDays)) echo 'checked'; ?>> Tue</label>
                <label for="wed"><input id="wed" name="days[]" type="checkbox" disabled value="Wed" <?php if(in_array('Wed', $rideDays)) echo 'checked'; ?>> Wed</label>
                <label for="thu"><input id="thu" name="days[]" type="checkbox" disabled value="Thu" <?php if(in_array('Thu', $rideDays)) echo 'checked'; ?>> Thu</label>
                <label for="fri"><input id="fri" name="days[]" type="checkbox" disabled value="Fri" <?php if(in_array('Fri', $rideDays)) echo 'checked'; ?>> Fri</label>
                <label for="sat"><input id="sat" name="days[]" type="checkbox" disabled value="Sat" <?php if(in_array('Sat', $rideDays)) echo 'checked'; ?>> Sat</label>
                <label for="sun"><input id="sun" name="days[]" type="checkbox" disabled value="Sun" <?php if(in_array('Sun', $rideDays)) echo 'checked'; ?>> Sun</label>
            </fieldset>

            <fieldset class="details-rows">

               
                <div>
                    <label for="time">Time <br></label>
                    <input type="time" id="time" name="time" value="<?= $ride['departureTime'] ?>" disabled>
                </div>

                <div>
                    <label for="seats">Seats <br></label>
                    <input type="number" min="1" max="100" step="1"  id="seats" name="seats"  disabled value="<?= $ride['availableSeats'] ?>">
                </div>

                <div>
                    <label for="fee">Fee <br></label>
                    <input type="number" min="1" max="100" step="1"  id="fee" name="fee" disabled value="<?= $ride['costPerSeat'] ?>">
                </div>

            </fieldset>

            <h2>Vehicle Details</h2>

            <div class="vehicle-details">
                    <div>
                        <label for="plate">Plate & Brand<br></label>
                        <input type="text" id="plate-brand" name="plate-brand"  disabled value="<?= $ride['plateNumber'] . " - " . $ride['brand'] ?>">
                    </div>  
                </div>

           
            <?php 
                if ($role == "Driver") {
                echo '
                    <div class="button-rows">
                        <a href="myRides.php" id="cancel">cancel</a>
                        <button type="submit" disabled>Request</button>
                    </div>';
                }
                else {
                    echo '
                    <div class="button-rows">
                        <a href="searchRides.php" id="cancel">cancel</a>
                        <button type="submit" >Request</button>
                    </div>';
                }
                
            ?>

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