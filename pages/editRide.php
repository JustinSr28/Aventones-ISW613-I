<?php
        require_once "../common/Rides.php";
        require_once "../common/Vehicles.php";

       session_start();
        if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
            header("Location: login.php");
            exit();
        }
        $role   = $_SESSION['role'];  
        $idRide = $_GET['id'];
        $rideObj = new Rides();
        $vehicleObj = new Vehicles();

        $ride = $rideObj->getRideById($idRide);
        $vehicles = $vehicleObj->loadVehicles($_SESSION['idUser']);

        $selectedDays = explode(",", $ride['rideDate']);
        $days = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> Edit Ride</title>
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
                    <li id="rides-navegation"><a href="myVehicles.php">Vehicles</a></li>
                    <li id="rides-navegation"><a href="myRides.php" class="activo">Rides</a></li>
                    <li><a href="bookings.php">Bookings</a></li>
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
    <h1>Edit Ride</h1>


    <form class="formm" id="edit_ride_form" action="../actions/updateRide.php?id=<?= $idRide?>" method="POST">
        
        <input type="hidden" name="idRide" value="<?= $idRide ?>">

        <div class="input-design-right">
            <label for="departure-from">Departure from <br></label>
            <input type="text" id="departure-from" name="departure-from"
                   value="<?= htmlspecialchars($ride['origin']) ?>">
        </div>

        <div class="input-design-left">
            <label for="arrive-to">Arrive To <br></label>
            <input type="text" id="arrive-to" name="arrive-to"
                   value="<?= htmlspecialchars($ride['destination']) ?>">
        </div>

        <h2>Days</h2>

        <fieldset class="rows">
            <?php foreach ($days as $d): ?>
                <label>
                    <input type="checkbox" name="days[]" value="<?= $d ?>"
                        <?= in_array($d, $selectedDays) ? "checked" : "" ?>>
                    <?= $d ?>
                </label>
            <?php endforeach; ?>
        </fieldset>

        <fieldset class="details-rows">
            <div>
                <label for="time">Time <br></label>
                <input type="time" id="time" name="time"
                       value="<?= htmlspecialchars($ride['departureTime']) ?>">
            </div>

            <div>
                <label for="seats">Seats <br></label>
                <input type="number" id="seats" name="seats"
                       value="<?= htmlspecialchars($ride['availableSeats']) ?>">
            </div>

            <div>
                <label for="fee">Fee <br></label>
                <input type="number" id="fee" name="fee"
                       value="<?= htmlspecialchars($ride['costPerSeat']) ?>">
            </div>
        </fieldset>

        <h2>Vehicle Details</h2>

        <div class="vehicle-details">
            <label for="plate">Plate & Brand <br></label>
            <select id="plate" name="plate">
                <?php foreach ($vehicles as $v): ?>
                    <option 
                        value="<?= $v['plateNumber'] ?>"
                        <?= $v['plateNumber'] === $ride['plateNumber'] ? "selected" : "" ?>
                    >
                        <?= $v['plateNumber'] . " - " . $v['brand'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="button-rows">
            <a id="a-form" href="myRides.php">Cancel</a>
            <a href="../actions/desactivateRide.php?id=<?= $ride['idRide'] ?>">Inactivate Ride</a>
            <button type="submit">Save/activate</button>
            
        </div>

    </form>
</main>


    <footer>
        <hr>
        <nav aria-label="Footer navigation">
            <a href="editProfile.php" class="foot">Profile</a> |
            <a href="configuration.php" class="foot">Settings</a> |
        </nav>
        <p>&copy; 2025 Aventones.com</p>

    </footer>

</body>

</html>