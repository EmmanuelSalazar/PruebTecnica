<?php 

require 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = mysqli_real_escape_string($mysqli, $_POST['nombre']);
    $precio = mysqli_real_escape_string($mysqli, $_POST['precio']);
    $cantidad = (int)mysqli_real_escape_string($mysqli, $_POST['cantidad']);
    $montoEntregado = mysqli_real_escape_string($mysqli, $_POST['monto']);
    $precioFinal = $precio * $cantidad;
        if (!empty($nombre)) {
            if($precio >= 0 && $cantidad >= 0 && $montoEntregado >= 0) {
                if (is_int($cantidad)) {
                    if ($montoEntregado >= $precioFinal) {
                        $sql = "INSERT INTO productos (nombre, precio, cantidad, montoRecibido) VALUES ('$nombre', '$precio', '$cantidad', '$montoEntregado')";
                        if ($mysqli->query($sql) === TRUE) {
                            echo json_encode('Venta realizada con exito', true);
                        } else {
                            echo json_encode('Error al realizar la venta', true);
                        }
                    } else {
                        echo json_encode('El monto entregado no es suficiente', true);
                    }
                } else {
                    echo json_encode('La cantidad debe ser un numero entero', true);
                }
            } else{
                echo json_encode('El precio o monto no pueden ser negativos', true);
            }
        } else {
            echo json_encode('El nombre no puede estar vacio', true);
        }
}
?>