<?php
include_once 'funciones.php';
include_once 'conexion.php';
 //require_once "Mail.php";
include ('../mailer/class.phpmailer.php');
include ('../mailer/class.smtp.php');
define("EMAIL_USE_SMTP", true);
define("EMAIL_SMTP_HOST", "ssl://smtp.gmail.com");
define("EMAIL_SMTP_AUTH", true);
define("EMAIL_SMTP_USERNAME", "micuenta@gmail.com");
define("EMAIL_SMTP_PASSWORD", "mipass");
define("EMAIL_SMTP_PORT", 25);
define("EMAIL_SMTP_ENCRYPTION", "ssl");
//require ('../mailer/PHPMailerAutoload.php');

 $email= $_POST['email'];
 $new_pass= substr( md5(microtime()), 1, 8);
 
 $valida ='SELECT `id`, `nombre`, `email`, `pass`, `name`, `last_name`, `murger` FROM `usuario` WHERE email="'.$email.'"';
 $val = mysqli_query($c,$valida);
 if (!($val)){
    echo mysqli_error($val);
 }
 if (mysqli_num_rows($val)>0){
	
    $row = mysqli_fetch_array($val);
    $up = 'UPDATE `usuario` SET `pass`="'.md5($new_pass).'" WHERE id="'.$row["id"].'";';
    $update = mysqli_query($c,$up);
    $usuario = $row["nombre"];
    
        $to=$email;
        $subject="Cambio de contraseña - La Penca de la Murger.";
        $messaje="Su contraseña se cambio correctamente. Ya puede ingresar a: http://www.lapencadelamurger.hol.es ";
        $messaje.="y realizar sus apuestas. \r\n \r\n";
        
        $messaje.= "Su usuario para acceder es: " . $usuario . "\r\n";
        $messaje.= "Su nueva contraseña para acceder es: " . $new_pass . "\r\n \r\n";
        $messaje.= "En nuestra pagina además de realizar sus apuestas puede ver la tabla de puntuacion \r\n";
        $messaje.= "cambiar su informacion personal desde el perfil, y consultar el reglamento de la penca. \r\n \r\n";
        
        $messaje.= "Mucha suerte!!! \r\n";
        $messaje.= "La Penca de la Murger \r\n";
	 
	 
	 $mail = new PHPMailer();
	 $mail->IsSendmail();
	 $mail->Mailer = "smtp";
	 $mail->IsSMTP(); 
	 $mail->SMTPAuth = true; 
	 $mail->Host = "mx1.hostinger.es"; 
	 $mail->Port = 110; 
	 $mail->Username = "info@lapencadelamurger.hol.es"; 
	 $mail->Password = "murg4c0m1d4";
	 $mail->SMTPSecure = '';
	 
	 $mail->From = "lepencadelamurger2016@gmail.com"; 
	 $mail->FromName = "LaPencaDeLaMurger"; 
	 $mail->Subject = $subject; 
	 $mail->AltBody = $messaje; 
	 $mail->MsgHTML("<b>Este es un mensaje de prueba</b>."); 
	 //$mail->AddAttachment("files/files.zip"; 
	 //$mail->AddAttachment("files/img03.jpg"; 
	 $mail->AddAddress($email, "Prueba"); 
	 $mail->IsHTML(true); 
	 
	 
		if(!$mail->Send()) {
		//HEADER('location: ../index.php?error=6');// "Error [mail] - Consultas lapencadelamurger2016@gmail.com";
                      echo $mail->ErrorInfo;
		} else {
		 HEADER('location: ../index.php?error=5');// "Consulte su correo electronico!.";
		}			 
 }else{
    HEADER('location: ../index.php?error=7');
 }
 
?>		