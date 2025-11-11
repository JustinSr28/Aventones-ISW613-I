<?php
$currentDir = dirname(__FILE__);
$parentDir = dirname($currentDir);

include($parentDir . '/common/conectionBD.php');
include($parentDir . '/actions/email.php');



if ($argc < 2) {  // argc porque hay 2 cosas: "script.php" y "30", Cantidad de argumentos que yo pso este incluye el nombre del archivo 
    echo "Uso: php script.php <minutos>\n";
    exit(1);
}

$minutos = intval($argv[1]);   //array con los valores de esos argumentos

$dataBase = new ConnectionBD();
$conn = $dataBase->getConnection();

$email = new Email();


$query = "SELECT uD.name AS driver_name, uD.lastName AS driver_lastName, uD.gmail AS driver_email,
    r.origin, r.destination, r.rideDate, r.departureTime,
    b.dateTime AS booking_time,
    uC.name AS client_name, uC.lastName AS client_lastName
FROM rides r
JOIN bookings b ON r.idRide = b.idRide
JOIN users uD ON r.idUser = uD.idUser
JOIN users uC ON b.idUser = uC.idUser
WHERE b.status = 'pending' AND TIMESTAMPDIFF(MINUTE, b.dateTime, NOW()) > $minutos;";


$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error al consultar usuarios: " . mysqli_error($conn) . "\n";
    exit(1);
}

$drivers = [];

while ($row = mysqli_fetch_assoc($result)) {
    $driverEmail = $row['driver_email'];
    $driverName  = $row['driver_name'] . ' ' . $row['driver_lastName'];

    $found = false;

    for ($i = 0; $i < count($drivers); $i++) {
        if ($drivers[$i]['gmail'] === $driverEmail) {
            $drivers[$i]['bookings'][] = $row; 
            $found = true;
            break;
        }
    }

    if (!$found) {
        $drivers[] = [
            "name" => $driverName,
            "gmail" => $driverEmail,
            "bookings" => [$row] 
        ];
    }
}


if (count($drivers) > 0) {
    foreach ($drivers as $driver) {
        $driverName  = $driver['name'];
        $driverEmail = $driver['gmail'];
        $bookings    = $driver['bookings'];

        $subject = "Pending reservations.";
        $body  = "Hello,$driverName,you have pending reservations.";
        
        foreach ($bookings as $b) {
            $clientName = $b['client_name'] . ' ' . $b['client_lastName'];
            $body .= "<div style='border:1px solid #ccc; border-radius:8px; padding:10px; margin-bottom:10px;'>
                        <p><strong>Client:</strong> " . $clientName . "</p>
                        <p><strong>Origin:</strong> " . $b['origin'] . "</p>
                        <p><strong>Destination:</strong> " . $b['destination'] . "</p>
                        <p><strong>Date:</strong> " . $b['rideDate'] . "</p>
                        <p><strong>Hour:</strong> " . $b['departureTime'] . "</p>
                        <p><strong>Booking hour:</strong> " . $b['booking_time'] . "</p>
                      </div>";
        }

        $email->send($driverEmail,$driverName, $subject, $body);
    }

    echo "Email sended.\n";
} else {
    echo "No hay reservas.\n";
}

$dataBase->closeConnection();
?>
