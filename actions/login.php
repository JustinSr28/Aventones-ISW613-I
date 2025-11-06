<?php
include_once('../common/Users.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $users = new Users();
    $result = $users -> getLoginData($username);

   
    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){
            if ($user['status'] == 'active'){
                
                session_start();
                
                $_SESSION['username'] = $user['gmail'];
                $_SESSION['idUser'] = $user['idUser'];
                $_SESSION['role'] = $user['role'];

                redirectByRole($user['role']);

            } else {
                header("Location: ../index.html");
                exit();
            }
        }
    }
    else {
        header("Location: ../index.html");
        exit();
    }

} else {
    header("Location: ../index.html");
    exit();
}


function redirectByRole($role){

    if($role == 'Client'){
        header("Location: /pages/bookings.php");
        exit();
    }
    else if($role == 'Driver'){
        header("Location: /pages/myRides.html");
        exit();
    }
    else if($role == 'Admin'){
        header("Location: /pages/allUsers.php");
        exit();
    }
}


?>