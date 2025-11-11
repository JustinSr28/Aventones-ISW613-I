<?php 
    require_once "../common/Rides.php";
    session_start();


    /*Se verifica que el usuario tenga una session activa por medio de las variables temporales */
    if (!isset($_SESSION['idUser']) || !isset($_SESSION['role'])) {
        header("Location: login.php");
        exit();
    }
    
    $idUser = $_SESSION['idUser'];
    $role   = $_SESSION['role']; 
   
    $rides = new Rides();


    /*Se oobtienen los origenes y destinos para cargarlos en los selects */
    $origins = $rides->getOrigin();
    $destinations = $rides->getDestination();
    

    /*Variables por defecto, debido a que cuando se filtra debe ordenarse de forma ascendente por la hora */
    $order = 'ASC';
    $orderBy = 'departureTime';

    /*Se comprueba si el formulario envió las variables de order,order by,change_order, si existen se guardan sus varores*/

    if (isset($_POST['order'])) {
        $order = $_POST['order'];
    }

    if (isset($_POST['orderBy'])) {
        $orderBy = $_POST['orderBy'];
    }

    /*Cuando se de click en alguno de los botones asc/desc se detecta por esta variable
     cual fue la columna afectada, se obtienen la variable de order y se le hace el cambio de acuerdo a su valor */
    if (isset($_POST['change_order'])) {
        $orderBy = $_POST['change_order'];

        if ($order === 'ASC') {
            $order = 'DESC';
        } else {
            $order = 'ASC';
        }
    }
    /*------------------------------ */
    

    $ridesList = [];
    $days = $_POST['days'] ?? [];

    $originSelected = '';
    $destinationSelected = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $originSelected = $_POST['from'] ?? "";
        $destinationSelected = $_POST['to'] ?? "";
        $ridesList = $rides->filter($originSelected, $destinationSelected, $days, $orderBy, $order);
    }

    /*Determina si una opción de destino y origen debe ser seleccionada, debido a que cuando se envía el formulario, se pierde visualmente la opción seleccionada */
    function isSelected($value, $selectedValue) {
        if ($value === $selectedValue) {
            return 'selected';
        }
        return '';
    }
    
    /*Define que debe mostrar el botón de asc/desc */
    function getOrderLabel($orderByCol, $currentOrderBy, $order) {
        $label = 'ASC';
        if ($orderByCol === $currentOrderBy && $order === 'DESC') {
            $label = 'DESC';
        }
        return $label;
    }

?>