<?php 
    session_start();
    
    if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }

    $role   = $_SESSION['role']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users</title>
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
                    <li><a href="allUsers.php" class="activo">Users</a></li>
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
        <h1>All Users</h1>

        <div class="button-cont">
            <a id="newRideBtn" class="button" href="newAdmin.php">New User</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th class="hidden">id</th>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="ride_list">
                <?php
                require_once "../common/Users.php";
                $usuario = new Users();
                $users = $usuario->loadUsers(); //Funcion que carga todos los usuarios de la BD
                ?>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td class="hidden"><?= htmlspecialchars($user['idUser']) ?></td> 
                    <td><?= htmlspecialchars($user['ID']) ?></td>
                    <td><?= htmlspecialchars($user['name'] . ' ' . $user['lastName']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <input 
                            type="checkbox"
                            class="status-toggle"
                            data-id="<?= htmlspecialchars($user['idUser']) ?>"
                            <?= $user['status'] === 'active' ? 'checked' : '' ?>>
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
    <script src="../JavaScript/updateStatusCheckBox.js"></script>
</body>
</html>