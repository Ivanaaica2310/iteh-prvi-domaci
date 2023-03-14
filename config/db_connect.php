<!-- Konkecija sa bazom koju unosimo u svaki fajl u aplikaciji -->
<?php

$host = 'localhost';
$user = 'admin';
$password = 'admin';
$database = 'comicshop';
$conn = mysqli_connect($host, $user, $password, $database);
// $conn = konekcija sa bazom

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
    // u slučaju greške pri povezivanju ispisuje se greška 
    // (npr nije uključen MySQL)
}
