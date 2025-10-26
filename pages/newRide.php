<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Ride</title>
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
        <h1>New Ride</h1>
        <form class="formm" id="new_ride_form">
             <div class="input-design-right">
                <label for="departure-from">Departure from <br></label>
                <input type="text" id="departure-from" name="departure-from" class="input-desing" >
            </div>

            <div class="input-design-left">
                <label for="arrive-to">Arrive To <br></label>
                <input type="text" id="arrive-to" name="arrive-to" class="input-desing" >
            </div>

            <h2>Days</h2>

            <fieldset class="rows">
                <label for="mon"><input id="mon" name="days[]" type="checkbox" value="Mon" checked> Mon</label>
                <label for="tue"><input id="tue" name="days[]" type="checkbox" value="Tue" checked> Tue</label>
                <label for="wed"><input id="wed" name="days[]" type="checkbox" value="Wed" checked> Wed</label>
                <label for="thu"><input id="thu" name="days[]" type="checkbox" value="Thu" checked> Thu</label>
                <label for="fri"><input id="fri" name="days[]" type="checkbox" value="Fri" checked> Fri</label>
                <label for="sat"><input id="sat" name="days[]" type="checkbox" value="Sat" checked> Sat</label>
                <label for="sun"><input id="sun" name="days[]" type="checkbox" value="Sun" checked> Sun</label>
            </fieldset>

            <fieldset class="details-rows">

                <div>
                    <label for="time">Time <br></label>
                    <select id="time" name="time">
                        <option value="10:00">10:00 am</option>
                        <option value="11:00">11:00 am</option>
                    </select>
                </div>

                <div>
                    <label for="seats">Seats <br></label>
                    <input type="number" min="1" max="100" step="1" value="1" id="seats" name="seats">
                </div>

                <div>
                    <label for="fee">Fee <br></label>
                    <input type="number" min="1" max="100" step="1" value="1" id="fee" name="fee">
                </div>

            </fieldset>

            <h2>My Vehicles</h2>
            <?php
            require_once "../common/Vehicles.php";
            session_start();
            $idUser = $_SESSION['idUser']; // Obtener el idUser de la sesión
            $vehicleObj = new Vehicles();
            $vehicles = $vehicleObj->loadVehicles($idUser);
            ?>
           <?php foreach ($vehicles as $vehicle): ?>

                <div class="vehicle-details">
                    <div>
                        <label for="plate">Plate <br></label>
                        <select id="plate" name="plate">
                        <option value="<?= htmlspecialchars($vehicle['plateNumber']) ?>"><?= htmlspecialchars($vehicle['plateNumber']) . ' ' . htmlspecialchars($vehicle['brand'])?></option>

                        </select>
                    </div>  
                </div>
           <?php endforeach; ?>

            <div class="button-rows">
                <a href="">cancel</a>
                <button type="submit">Create</button>
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