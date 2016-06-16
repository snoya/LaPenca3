<?php
include_once 'funciones.php';
include_once 'conexion.php';

 $nombre = $_POST['usuario'];
 $email= $_POST['email'];
 $new_pass= $_POST['new_pass'];
 $rep_new_pass= $_POST['rep_new_pass'];
 
 $valida = 'select * from usuario where nombre="'.$nombre.'";';
 $val = mysqli_query($c,$valida);
 if (mysqli_num_rows($val)>0 and $_SESSION["USUARIO"]<>$nombre){
    HEADER('location: ../Perfil.php?error=1');// "El usuario que selecciono ya existe.";
 }else{
    if(comprobar_email($email)==0){
        HEADER('location: ../index.php?error=2');// "El email que introdujo no es correcto.";
    }else{
        if((empty($new_pass))|| (empty($rep_new_pass))){
            HEADER('location: ../Perfil.php?error=3');// "La contraseña no puede ser vacia.";
        }else{
            if($new_pass<>$rep_new_pass){
                HEADER('location: ../Perfil.php?error=4');// "Las contraseñas no coinciden.";
            }else{
                /*debo de actualizar el registro*/
                $update = 'update usuario set nombre="'.$nombre.'" , email="'.$email.'" , pass="'.md5($new_pass).'" where id="'.$_SESSION["ID"].'"';
                $up = mysqli_query($c,$update);
                if ($up){
                    HEADER('location: ../Perfil.php?error=5');// "El registro se actualizo correctamente.";
                }
            }
        }
    }
 }
 
?>