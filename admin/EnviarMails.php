<!DOCTYPE html>
<?php include_once '../php/funciones.php';
if (HayUsuarioAutenticado() && $_SESSION["USUARIO"]=="admin"){
   

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Penca de La Murger King - by German Ríos" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <title>Envio Email</title>
</head>

<body>
    <?php include_once "../menu.php";?>
    <div id='form_login'>
        
        
        
        <form id="contact_form" action="Send.php" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div for="usuario" class='label'>Subject:</div>
            <input id="usuario" class="input" name="subject" type="text" size="30" /><br />
        </div>
        <div class="row">
            <div for="message" class='label'>Message:</div>
            <textarea rows="10" id="texto" class="input" name="message" type="text" value="" ></textarea><br />
        </div>
        
        <input id="submit_button" class='btn' type="submit" value="Enviar Mails" />
        </form>
        
    </div>

</div>
</body>
</html>

<?php } ?>