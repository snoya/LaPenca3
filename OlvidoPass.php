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
    <!--<div id='form_login'>
        
        
        
        <form id="contact_form" action="php/ActPass.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div for="email" class='label'>Correo:</div>
            <input id="usuario" class="input" name="email" type="text" size="30" /><br />
        </div>
                
        <input id="submit_button" class='btn' type="submit" value="Restablecer" />
        </form>
        
    </div>-->
    <div class=error>Por problema de contraseña dirigirse a : lapencadelamurger2016@gmail.com <br><br> <a href="index.php" >volver</a></div>
</div>
</body>
</html>

<?php } ?>