<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tcgstore";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    echo "db rusak";
    die("error! ");
}

echo "we bisa cok";

?>
