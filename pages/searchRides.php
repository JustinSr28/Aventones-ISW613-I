<?php 
    require_once "../common/Rides.php";
    session_start();
    $idUser = $_SESSION['idUser'];
    $role   = $_SESSION['role']; 

    $rides = new Rides();

    $origins = $rides->getOrigin();
    $destinations = $rides->getDestination();

    $ridesList = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $origin = $_POST['from'] ?? "";
        $destination = $_POST['to'] ?? "";
        $days = $_POST['days'] ?? [];
        $ridesList = $rides->filter($origin, $destination, $days);}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Rides</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/generalStyle.css">
    <link rel="stylesheet" href="../styles/searchRides.css">
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
        <h1>Search Rides</h1>
        <form id="search-form" method="POST" >
            <section class="section-search">
                <div class="places">
                    <label>From</label>
                    <select class="select-from" id="from-select" name="from">

                        <option value="">-- Select origin --</option>

                        <?php foreach ($origins as $origin) { ?>
                            <option value="<?= $origin['origin'] ?>">  
                                <?= $origin['origin']?> 
                            </option>
                        <?php } ?>  

                    </select>

                    <label>To</label>
                    <select class="select-to" id="to-select" name="to">

                        <option value="">-- Select destination --</option>

                        <?php foreach ($destinations as $destination) { ?>
                            <option value="<?= $destination['destination'] ?>" > 
                                <?= $destination['destination']?>
                            </option>
                        <?php } ?>
                    
                    </select>

                    <button type="submit"> Find Rides</button>
                </div>

                <div class="main-days-cont">
                    <label>Days</label>
                    <div class="all-days">
                        <label for="mon"><input id="mon" name="days[]" type="checkbox" value="Mon" checked> Mon</label>
                        <label for="tue"><input id="tue" name="days[]" type="checkbox" value="Tue" checked> Tue</label>
                        <label for="wed"><input id="wed" name="days[]" type="checkbox" value="Wed" checked> Wed</label>
                        <label for="thu"><input id="thu" name="days[]" type="checkbox" value="Thu" checked> Thu</label>
                        <label for="fri"><input id="fri" name="days[]" type="checkbox" value="Fri" checked> Fri</label>
                        <label for="sat"><input id="sat" name="days[]" type="checkbox" value="Sat" checked> Sat</label>
                        <label for="sun"><input id="sun" name="days[]" type="checkbox" value="Sun" checked> Sun</label>
                    </div>

                </div>
            </section>
        </form>


        <section class="section-information">
            <p class="text" id="rides-info-text">Rides found from <strong></strong> to <strong></strong></p>
            <table>
                <thead>
                    <tr>
                        <th>Driver</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Seats</th>
                        <th>Car</th>
                        <th>Fee</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody id="search_list">
                    <?php foreach ($ridesList as $ride) { ?>
                    <tr>
                        <td> <?= $ride['name'] . " " . $ride['lastName'] ?> </td>
                        <td> <?= $ride['origin'] ?></td>
                        <td> <?= $ride['destination'] ?></td>
                        <td> <?= $ride['availableSeats'] ?></td>
                        <td> <?= $ride['brand'] . " - " . $ride['model'] ?> </td>
                        <td> <?= $ride['costPerSeat'] ?></td>

                        <td> <a href="../actions/insertBooking.php?idRide=<?= $ride['idRide'] ?>">Request</a> </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </section>

        <section>
            <iframe class="map-image"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.1184828238515!2d-84.4230223!3d10.3142701!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa065e88d7467c3%3A0x4601c6c51fd48543!2sBarrio%20Gamonales%2C%20Cd%20Quesada!5e0!3m2!1ses!2scr!4v1724025000000!5m2!1ses!2scrs"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </section>

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