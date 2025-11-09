<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Rides</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/generalStyle.css">
    <link rel="stylesheet" href="../styles/myRides.css">
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
        <h1>My rides</h1>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-box">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>


        <div class="button-cont">
            <a id="newRideBtn" class="button" href="newRide.php">New Ride</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>Seats</th>
                    <th>Time</th>
                    <th>Days</th>
                    
                    <th id="feeTable">Fee</th>
                    <th>Status</th>
                    <th id="actionTable">Actions</th>

                </tr>
            </thead>
            <tbody id="ride_list">
            <?php
            require_once "../common/Rides.php";
            session_start();
            $idUser = $_SESSION['idUser'];
            $objRides = new Rides();
            $rides = $objRides->loadRides($idUser);

            ?>

            <?php foreach ($rides as $ride): ?>

            <tr>
                        
                        <td><a href="rideDetails.php?id=<?= $ride['idRide'] ?>"><?= $ride['origin']?></a></td>
                        <td><?= htmlspecialchars($ride['destination']) ?></td>
                        <td><?= htmlspecialchars($ride['availableSeats']) ?></td>
                        <td><?= htmlspecialchars($ride['departureTime']) ?></td>
                        <td><?= htmlspecialchars($ride['rideDate']) ?></td>
                        <td><?= htmlspecialchars($ride['costPerSeat']) ?></td>       
                        <td><?= htmlspecialchars($ride['status']) ?></td>   
                        <td>
                            <a href="editRide.php?id=<?= $ride['idRide'] ?>">Edit</a>
                        </td>
            </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
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