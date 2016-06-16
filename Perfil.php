<!DOCTYPE html>
<?php
include_once 'php/conexion.php';
include_once 'php/funciones.php';

if (HayUsuarioAutenticado()){?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html charset=utf-8" />
    <meta name="author" content="Penca de La Murger King - by German Ríos" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>La Penca de la Murger</title>
</head>

<body>

<?php
include 'menu.php';

$rs = mysqli_query($c,'select * from usuario a where a.id="'.$_SESSION["ID"].'"');
$row = mysqli_fetch_array($rs);
$usuario = $row['nombre'];
$email = $row['email'];
?>
	    <div id='form_login'>
                
                <form id="contact_form" action="php/Actualizar.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class='label' for="usuario">Usuario:</div>
                    <input id="usuario" class="input" name="usuario" type="text" size="30" <?php if(isset($usuario)){ echo "value='".$usuario."'";}; ?> /><br />
                </div>
                <div class="row">
                    <div class='label' for="usuario">Email:</div>
                    <input id="usuario" class="input" name="email" type="text" size="30" <?php if(isset($email)){ echo "value='".$email."'";}; ?> /><br />
                </div>
                <div class="row">
                    <div class='label' for="pass">Nueva Contraseña:</div>
                    <input id="pass" class="input" name="new_pass" type="password" value="" size="30" /><br />
                </div>
                <div class="row">
                    <div class='label' for="pass">Repita Contraseña:</div>
                    <input id="pass" class="input" name="rep_new_pass" type="password" value="" size="30" />
                </div>
                
                <input id="submit_button" class='btn' type="submit" value="Actualizar" />
                </form>	
            </div>
            
            <?php if (isset($_GET['error'])){
                switch ($_GET['error']){
                               case 1:   $error = "El usuario que selecciono ya existe.";
                                break;
                               case 2:   $error = "El email que introdujo no es correcto.";
                                break;
                               case 3:   $error = "La contraseña no puede ser vacia.";
                                break;
                               case 4:   $error = "Las contraseñas no coinciden.";
                                break;
                               case 5:   $error = "El registro se actualizo correctamente.";
                                break;
                           } ;  
              echo "<div class=error>" . $error . "</div>";
            }?>

</body>
</html>
<?php } ?>