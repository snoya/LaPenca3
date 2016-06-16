<?php
    session_start();
    if (!(isset($_POST['usuario'])) || !(isset($_POST['password']))){
        HEADER('location: ../index.php?error=2');// "Debe de ingresar un usuario contraseña.";
        
    }elseif($_POST['usuario'] == "" || $_POST['password']==""){
        HEADER('location: ../index.php?error=3');//"El usuario y contraseña no pueden estar vacias";
        
        
    }else {
            /*Hay que validar que la pass sea correcta*/
            include_once 'conexion.php';
            
            $rs = mysqli_query($c,'select * from usuario where nombre="'. $_POST['usuario'] .'";');

                if (!$rs){
                    echo mysqli_error($c);
                }else{
                   
                    if(mysqli_num_rows($rs) != 1){
                        HEADER('location: ../index.php?error=1');// 'El usuario no existe';
                    }else{
                        $row = mysqli_fetch_array($rs);
                        if ( $row['pass']==md5($_POST['password'])){
                            /*Aqui esta todo ok*/
                            
                            $_SESSION['USUARIO'] = $_POST['usuario'];
                            $_SESSION['ID'] = $row['id'];
                            $_SESSION['EMAIL'] = $row['email'];
                            HEADER('location: ../index.php');
                        }else{
                            HEADER('location: ../index.php?error=4');// 'Contraseña incorrecta';
                        }
                        
                    }
                    
                }
            
        }
?>