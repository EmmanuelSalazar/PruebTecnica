<?php 

$mysqli = new mysqli("localhost", "root", "", "prueba_tecnica");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>