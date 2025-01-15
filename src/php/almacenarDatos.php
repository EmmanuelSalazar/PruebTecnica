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
                            $respuesta = array('mensaje' => 'Venta realizada con exito', 'alerta' => 'alert alert-success');
                            header('Content-Type: application/json'); 
                            echo json_encode($respuesta, true);
                        } else {
                            $respuesta = array('mensaje' => 'Error al realizar la venta', 'alerta' => 'alert alert-danger');
                            header('Content-Type: application/json'); 
                            echo json_encode($respuesta, true);                        }
                    } else {
                        $respuesta = array('mensaje' => 'El monto entregado no es suficiente', 'alerta' => 'alert alert-warning');
                        header('Content-Type: application/json'); 
                        echo json_encode($respuesta, true);                    }
                } else {
                    $respuesta = array('mensaje' => 'La cantidad debe ser un numero entero', 'alerta' => 'alert alert-warning');
                    header('Content-Type: application/json'); 
                    echo json_encode($respuesta, true);                
                }
            } else{
                $respuesta = array('mensaje' => 'El precio o monto no pueden ser negativos', 'alerta' => 'alert alert-warning');
                header('Content-Type: application/json'); 
                echo json_encode($respuesta, true);
            }
        } else {
            $respuesta = array('mensaje' => 'El nombre no puede estar vacio', 'alerta' => 'alert alert-warning');
            header('Content-Type: application/json'); 
            echo json_encode($respuesta, true);
        }
}
?>