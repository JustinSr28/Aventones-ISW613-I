<?php
    require_once "../common/Vehicles.php";
    session_start();

    if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }
    $role   = $_SESSION['role']; 
    $idVehicle = $_GET['id']; 
    $vehicleObj = new Vehicles();
    $vehicle = $vehicleObj->getVehicleById($idVehicle);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Vehicle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/generalStyle.css">
    <link rel="stylesheet" href="../styles/newVehicle.css">

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


    <main class="container">
    <h1>Edit Vehicle</h1>
    <hr>

    <form class="formNewVehicle" method="POST" action="../actions/updateVehicle.php?id=<?= $vehicle['idVehicle'] ?>" enctype="multipart/form-data">

        <label for="plate">Plate<span class="req">*</span></label>
        <input class="input-design" id="plate" type="text" name="plate"
               value="<?= htmlspecialchars($vehicle['plateNumber']) ?>" required>


        <label for="color">Color<span class="req">*</span></label>
        <select id="color" name="color" required>
            <?php
                $colors = ["Red","Blue","Black","White","Grey","Green","Brown","Yellow"]; //Colores predefinidos
                foreach ($colors as $color) {
                    $selected = ($color == $vehicle['color']) ? 'selected' : ''; //Si el color coincide con el color del carro será selected
                    echo "<option value='$color' $selected>$color</option>"; //Crea la linea pero si es el color, le coloca selected para que esté seleccionado por defecto
                }
            ?>
        </select>


        <label for="brand">Brand<span class="req">*</span></label>
        <input id="brand" type="text" name="brand" 
               value="<?= htmlspecialchars($vehicle['brand']) ?>" required>


        <label for="model">Model<span class="req">*</span></label>
        <input id="model" type="text" name="model" 
               value="<?= htmlspecialchars($vehicle['model']) ?>" required>


        <label for="seats">Seats<span class="req">*</span></label>
        <input id="seats" type="number" name="seats" min="1" max="10" step="1"
               value="<?= htmlspecialchars($vehicle['seatCapacity']) ?>" required>

          <label for="year">Year<span class="req">*</span></label>
            <input id="year" type="text" name="year" 
                   value="<?= htmlspecialchars($vehicle['year']) ?>" required>



        <label for="picture">Picture</label>
        <div class="file-field">
            <input type="file" id="picture" name="picture" accept="image/*">
            <img id="preview" src="../<?= htmlspecialchars($vehicle['picture']) ?>" class="preview" style="max-width:120px;">
        </div>


        <div class="form-actions">
            <a class="btn btn-secondary" href="myVehicles.php">Cancel</a>
            <a class="btn btn-danger" href="../actions/desactivateVehicle.php?id=<?= $vehicle['idVehicle'] ?>">Inactivate Vehicle</a>
            <button class="btn btn-primary" type="submit">Save / Activate Vehicle</button>
        </div>
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

    <script src="../JavaScript/newVehicle.js"></script>
</body>

</html>