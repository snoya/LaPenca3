<?php
include_once 'funciones.php';
//$_SESSION['USUARIO'] = "";
$res = session_destroy();
if ($res) {
    echo 'Sesion Terminada';
    
};
HEADER('location: ../index.php');
?>