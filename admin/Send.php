<?php
include_once '../php/funciones.php';
if (HayUsuarioAutenticado() && $_SESSION["USUARIO"]=="admin"){
    include_once '../php/conexion.php';
    $subject = $_POST["subject"];
    $messaje = $_POST["message"];
    $qy = 'select email from usuario where email<>""';
    $rs = mysqli_query($c,$qy);
    
    while ($row = mysqli_fetch_array($rs)) {
       /*Recorro todos los mails de usuarios*/
       $to = $row['email'];
              
       $bool = mail($to,$subject,$messaje,'From: LaPencaDeLaMurger');
       
    }
    
    
}
?>