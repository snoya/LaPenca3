<?php
$servidor='localhost';
$usuario = '';
$contrasenia = '';
$base = '';
$c = mysqli_connect ( $servidor, $usuario, $contrasenia ,$base);
if (!$c) {
    echo "error  " . mysqli_connect_error() . PHP_EOL;
    
}

?>