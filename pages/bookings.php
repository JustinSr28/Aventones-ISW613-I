<?php 
    require_once "../common/Bookings.php";
       
    session_start();
    if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }
    $idUser = $_SESSION['idUser'];
    $role   = $_SESSION['role']; 
    $bookingsObj = new Bookings();
    $bookings = $bookingsObj->loadBookings($idUser);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/generalStyle.css">
    <link rel="stylesheet" href="../styles/booking.css">
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
                            echo '<li><a href="bookings.php" class="activo">Bookings</a></li>';
                        }
                        else if ($role === "Client"){
                            echo '<li><a href="searchRides.php">Home</a></li>';
                            echo '<li><a href="bookings.php" class="activo">Bookings</a></li>';
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
        <h1>Bookings</h1>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Ride</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="bookings_list">
                <?php foreach ($bookings as $booking) { ?>
                    <tr>
                        <td> <?= $booking['name'] . " " . $booking['lastName'] ?> </td>
                        <td> <?= $booking['origin'] . " - " . $booking['destination'] ?> </td>
                        <td> <?= $booking['status'] ?></td>
                        <td> 
                            <?php
                            if ($role === 'Driver') {
                
                                if ($booking['status'] === 'pending') {
                                    echo '<a href="../actions/updateStatusBooking.php?action=accept&id=' . $booking['idBooking'] . '">Accept</a> | ';
                                    echo '<a href="../actions/updateStatusBooking.php?action=reject&id=' . $booking['idBooking'] . '" onclick="return confirm(\'Are you sure?\')">Reject</a>';
                                } else {
                                    echo '<span style="color: gray;">—</span>';
                                }
                            
                            } elseif ($role === 'Client') {
                                if ($booking['status'] === 'accepted' || $booking['status'] === 'pending') {
                                    echo '<a href="../actions/updateStatusBooking.php?action=reject&id=' . $booking['idBooking'] . '" onclick="return confirm(\'Are you sure you want to cancel this booking?\')">Cancel</a>';
                                } else {
                                    echo '<span style="color: gray;">—</span>';
                                }
                            }
                ?>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>

        </table>
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