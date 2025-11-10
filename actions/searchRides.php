<?php 
    require_once "../common/Rides.php";
    session_start();

    if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }
    
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