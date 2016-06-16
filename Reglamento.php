<!DOCTYPE html>
<?php include_once 'php/funciones.php';
if (HayUsuarioAutenticado()){
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Penca de La Murger King - by German Ríos" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>Reglamento</title>
</head>

<body>
    <?php include_once "menu.php";?>
    <div id='reglamento'>
        <h1>Reglamento:</h1>

        <h2>Puntajes:</h2>

        <p>Por cada ronda se asigna un puntaje al resultado; los mismos son:</p>
        <ul>
            <li>4 pts en primera ronda.</li>
            <li>6 pts en segunda ronda.</li>
            <li>8 pts en semi-final y final..</li>
        </ul>

        <p>En caso de acertar los goles exactos que hizo un cuadro, se suma la mitad del puntaje dado para esa ronda.</p>
        <ul>
            <li>2 pts en primera ronda</li>
            <li>3 pts en segunda ronda</li>
            <li>4 pts en semi-final y final.</li>
        </ul>

        <h3>Ejemplo:</h3>
        <p>Supongamos que en el partido Uruguay - Jamaica (primera ronda), se apuesta a favor de uruguay [2]-[1].</p>
        <ul>
            <li>En caso de que uruguay gane [2]-[1] se suma:</li>
            <ul>
                <li>4 pts por resultado.</li>
                <li>2 pts por adivinar los goles que hizo Uruguay.</li>
                <li>2 pts por adivinar los goles que hizo Jamaica.</li>
                <li>Un total de 8pts.</li>
            </ul>
        </ul>

  
        <ul>
            <li>En caso de que gane Jamaica [1]-[0] se suma:</li>
            <ul>
                <li>0 pts por resultado.</li>
                <li>0 pts por adivinar los goles que hizo Uruguay.</li>
                <li>2 pts por adivinar los goles que hizo Jamaica.</li>
                <li>Un total de 2pts.</li>
            </ul>
        </ul>
        

        <ul>
            <li>En caso de que gane Uruguay [1]-[0] se suma:</li>
            <ul>
                <li>4 pts por resultado.</li>
                <li>0 pts por adivinar los goles que hizo Uruguay.</li>
                <li>0 pts por adivinar los goles que hizo Jamaica.</li>
                <li>Un total de 4pts.</li>
            </ul>
        </ul>

        <br><h2>Apuestas:</h2>
        <p>Las apuestas se pueden modificar hasta las 00:00 hs del dia del partido.</p>
        <p>La apuesta por defecto en el caso de no modificar nada es de [0]-[0]</p>
        <p>Para estar participando necesariamente debe de darle al botón “Guardar” en la pagina “Mi Penca”</p>
        <p>El marcador se puede escoger del [0] al [10] (Dificilmente alguien pierda por más goles que Brasil - Alemania).</p>
        <p>Cualquier duda puede enviar un mail a: murger_king@hotmail.com</p>

        <h2>Cómo participar:</h2>


        <p>Se ingresa a la penca con la suma de $100, instancia en la que se le solicita una dirección de correo electrónico personal.</p>
        <p>Con dicho correo se le crea y envía a la misma dirección el usuario y la contraseña para ingresar a la penca.</p>
        <p>Con este usuario ya puede realizar su apuesta.</p>
        <p>Desde “Perfil” se puede cambiar el nombre de usuario, la contraseña, y el correo si es que desea.</p>

        <h2>Premiación:</h2>

        
        <p>1° Premio: $4000.</p>
        <p>2° Premio: $2000.</p>

    </div>
</body>
</html>

<?php } ?>