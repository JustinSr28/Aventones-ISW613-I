<?php 
    require_once "../common/Rides.php";
    session_start();
    $idUser = $_SESSION['idUser'];
    $role   = $_SESSION['role']; 
   
    $rides = new Rides();

    $origins = $rides->getOrigin();
    $destinations = $rides->getDestination();
    
    $order = 'ASC';
    $orderBy = 'departureTime';

    if (isset($_POST['order'])) {
        $order = $_POST['order'];
    }

    if (isset($_POST['orderBy'])) {
        $orderBy = $_POST['orderBy'];
    }

    if (isset($_POST['change_order'])) {
        $orderBy = $_POST['change_order'];

        if ($order === 'ASC') {
            $order = 'DESC';
        } else {
            $order = 'ASC';
        }
    }

    

    $ridesList = [];
    $days = $_POST['days'] ?? [];

    $originSelected = '';
    $destinationSelected = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $originSelected = $_POST['from'] ?? "";
        $destinationSelected = $_POST['to'] ?? "";
        $ridesList = $rides->filter($originSelected, $destinationSelected, $days, $orderBy, $order);
    }

    function isSelected($value, $selectedValue) {
        if ($value === $selectedValue) {
            return 'selected';
        }
        return '';
    }
    
    function getOrderLabel($orderByCol, $currentOrderBy, $order) {
        $label = 'ASC';
        if ($orderByCol === $currentOrderBy && $order === 'DESC') {
            $label = 'DESC';
        }
        return $label;
    }

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
                            <?php foreach ($origins as $origin) { 
                                $selected = isSelected($origin['origin'], $originSelected);
                            ?>
                            <option value="<?= $origin['origin'] ?>" <?= $selected ?>><?= $origin['origin'] ?></option>
                            <?php } ?>
                    </select>

                    <select class="select-to" id="to-select" name="to">
                        <option value="">-- Select destination --</option>
                        <?php foreach ($destinations as $destination) { 
                            $selected = isSelected($destination['destination'], $destinationSelected);
                        ?>
                        <option value="<?= $destination['destination'] ?>" <?= $selected ?>><?= $destination['destination'] ?></option>
                        <?php } ?>
                    </select>

                    <button type="submit"> Find Rides</button>
                </div>

                <div class="main-days-cont">
                    <label>Days</label>
                    <div class="all-days">
                        <label for="mon"><input id="mon" name="days[]" type="checkbox" value="Mon"  <?php if (in_array('Mon', $days)) { echo 'checked'; } ?>> Mon</label>
                        <label for="tue"><input id="tue" name="days[]" type="checkbox" value="Tue"  <?php if (in_array('Tue', $days)) { echo 'checked'; } ?>> Tue</label>
                        <label for="wed"><input id="wed" name="days[]" type="checkbox" value="Wed"  <?php if (in_array('Wed', $days)) { echo 'checked'; } ?>> Wed</label>
                        <label for="thu"><input id="thu" name="days[]" type="checkbox" value="Thu"  <?php if (in_array('Thu', $days)) { echo 'checked'; } ?>> Thu</label>
                        <label for="fri"><input id="fri" name="days[]" type="checkbox" value="Fri"  <?php if (in_array('Fri', $days)) { echo 'checked'; } ?>> Fri</label>
                        <label for="sat"><input id="sat" name="days[]" type="checkbox" value="Sat"  <?php if (in_array('Sat', $days)) { echo 'checked'; } ?>> Sat</label>
                        <label for="sun"><input id="sun" name="days[]" type="checkbox" value="Sun" 
                         <?php if (in_array('Sun', $days)) { echo 'checked'; } ?>> Sun</label>
                    </div>
                    

                </div>
            </section>
            <section class="section-information">

            <p class="text" id="rides-info-text">Rides found from <strong></strong> to <strong></strong></p>

            <input type="hidden" name="order" value="<?= $order ?>">
            <input type="hidden" name="orderBy" value="<?= $orderBy ?>">
            
            <table>
                <thead>
                    <tr>
                        <th>Driver</th>
                        <th>From
                            <?php $label = getOrderLabel('from', $orderBy, $order); ?>
                            <button type="submit" name="change_order" value="from"><?= $label ?></button>
                        </th>

                        <th>To
                            <?php $label = getOrderLabel('to', $orderBy, $order); ?>
                            <button type="submit" name="change_order" value="to"><?= $label ?></button>
                        </th>
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
                        <td><a href="rideDetails.php?id=<?= $ride['idRide'] ?>"><?= $ride['origin']?></a></td>
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

        </form>


        
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