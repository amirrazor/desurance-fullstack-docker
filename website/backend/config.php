<?php 

$servertype = "mysql";
$servername = "localhost";
$serverport = 3307;
$username = "root";
$password = "";
$dbname = "desurance";
$tablename = "users";
$claim_table = "claims";


try {
        if ($servertype == "mysql") {
                $dsn = "mysql:host=$servername;port=$serverport;dbname=$dbname;";
        } else {
                die ('DB config error');
        }
        $conn = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $e) {
        die($e->getMessage());
}