<!DOCTYPE html>
<?php include_once 'php/funciones.php';
if (HayUsuarioAutenticado()){
    HEADER('location: penca-form.php');
}else{

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Penca de La Murger King - by German Ríos" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>Login</title>
</head>

<body>
    <?php include_once "menu.php";?>
    <div id='form_login'>
        
        
        
        <form id="contact_form" action="php/login.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div for="usuario" class='label'>Usuario:</div>
            <input id="usuario" class="input" name="usuario" type="text" size="30" /><br />
        </div>
        <div class="row">
            <div for="pass" class='label'>Contraseña:</div>
            <input id="pass" class="input" name="password" type="password" value="" size="30" /><br />
        </div>
        
        <input id="submit_button" class='btn' type="submit" value="Ingresar" />
        </form>
        <div class="row"> <a href="OlvidoPass.php">Olvido Su contraseña</a></div>
    </div>

</div>
<?php if (isset($_GET['error'])){
    switch ($_GET['error']){
                   case 1:   $error = "El usuario no existe.";
                    break;
                   case 2:   $error = "Debe de ingresar un usuario contraseña.";
                    break;
                   case 3:   $error = "El usuario y contraseña no pueden estar vacias";
                    break;
                   case 4:   $error = "Contraseña incorrecta";
                    break;
                case 5:   $error = "Consulte su correo electronico.";
                    break;
                 case 6:   $error = "Error [mail] - Consultas admin@lapencadelamurger.com.";
                    break;
                case 7:   $error = "El email ingresado no existe.";
                    break;
               } ;  
  echo "<div class=error>" . $error . "</div>";
}?>
</body>
</html>

<?php } ?>