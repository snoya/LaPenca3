<?php
include_once '../php/conexion.php';
include_once '../php/funciones.php';

if (HayUsuarioAutenticado() && ($_SESSION['USUARIO']=='admin' || $_SESSION['USUARIO']=='admin2')){
        $usuario =$_POST['nombre'];
        $pass =$_POST['pass'];
        $name =$_POST['name'];
        $last_name=$_POST['last_name'];
        $email=$_POST['email'];
        $murger=$_POST['murger'];
        $rs = mysqli_query($c,'insert into usuario (nombre,name,last_name,email,murger,pass) values ("' . $usuario . '","'.$name.'","'.$last_name.'","'.$email.'","'.$murger.'","' . md5($pass) .'");');
        
        if (!$rs){
            echo mysqli_error($c);
        };
        $to=$email;
        $subject="Bienvenido!! - La Penca de la Murger.";
        $messaje="Nos agrada informarle que ya puede ingresar a: http://www.lapencadelamurger.hol.es ";
        $messaje.="y realizar sus apuestas. \r\n \r\n";
        
        $messaje.= "Su usuario para acceder es: " . $usuario . "\r\n";
        $messaje.= "Su contraseña para acceder es: " . $pass . "\r\n \r\n";
        $messaje.= "En nuestra pagina además de realizar sus apuestas puede ver la tabla de puntuacion \r\n";
        $messaje.= "cambiar su informacion personal desde el perfil, y consultar el reglamento de la penca. \r\n \r\n";
        
        $messaje.= "Mucha suerte!!! \r\n";
        $messaje.= "La Penca de la Murger \r\n";
        $mail = mail($to,$subject,$messaje,'From: LaPencaDeLaMurger');
                     if ($mail){
                        header('Location: usuarios.php');
                     }
}else{
    echo 'Debe de acceder con un usuario administrador';
}

?>