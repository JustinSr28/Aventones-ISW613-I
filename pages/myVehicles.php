<?php 
    require_once "../common/Vehicles.php";
    session_start();
    if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }
    
    $role   = $_SESSION['role']; 
    $idUser = $_SESSION['idUser'];
    $vehicleObj = new Vehicles();
    $vehicles = $vehicleObj->loadVehicles($idUser);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Vehicles</title>
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
                    <li id="rides-navegation"><a href="myVehicles.php" class="activo">Vehicles</a></li>
                    <li id="rides-navegation"><a href="myRides.php">Rides</a></li>
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
        <h1>My Vehicles</h1>
        <?php if (isset($_GET['error'])): ?>
            <div class="error-box">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <div class="button-cont">
            <a id="newVehicleBtn" class="button" href="newVehicle.php">Add New Vehicle</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Plate</th>
                    <th>Color</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Seats</th>
                    <th>Status</th>
                    <th id="picture"></th>
                    <th id="actionTable">Actions</th>

                </tr>
            </thead>
            <tbody id="vehicle_list">
                

                <?php foreach ($vehicles as $vehicle): ?>
                    <tr>
                        <td><?= htmlspecialchars($vehicle['plateNumber']) ?></td>
                        <td><?= htmlspecialchars($vehicle['color']) ?></td>
                        <td><?= htmlspecialchars($vehicle['brand']) ?></td>
                        <td><?= htmlspecialchars($vehicle['model']) ?></td>
                        <td><?= htmlspecialchars($vehicle['year']) ?></td>
                        <td><?= htmlspecialchars($vehicle['seatCapacity']) ?></td>
                        <td><?= htmlspecialchars($vehicle['status']) ?></td>
                        <td><img src="../<?= htmlspecialchars($vehicle['picture']) ?>" alt="Vehicle Image" width="100"></td>
                        <td>
                            <a href="editMyVehicles.php?id=<?= $vehicle['idVehicle'] ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
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