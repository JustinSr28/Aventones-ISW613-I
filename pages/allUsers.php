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
        <h1>All Users</h1>

        <div class="button-cont">
            <a id="newRideBtn" class="button" href="newRide.html">New User</a>
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
                $users = $usuario->loadUsers();
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
            <a href="" class="foot">Home</a> |
            <a href="" class="foot">Rides</a> |
            <a href="" class="foot">Bookings</a> |
            <a href="" class="foot">Settings</a> |
            <a href="" class="foot">Login</a> |
            <a href="" class="foot">Register</a>
        </nav>
        <p>&copy; 2025 Aventones.com</p>

    </footer>
    <script src="../JavaScript/updateStatusCheckBox.js"></script>
</body>
</html>