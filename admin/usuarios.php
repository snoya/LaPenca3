<!DOCTYPE html>
<?php
include_once '../php/conexion.php';
include_once '../php/funciones.php';
echo $_SESSION['USUARIO'];
if (HayUsuarioAutenticado() && ($_SESSION['USUARIO']=='admin' || $_SESSION['USUARIO']=='admin2')){?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html charset=utf-8" />
    <meta name="author" content="Penca de La Murger King - by German Ríos" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <title>Alta de usuarios</title>
</head>

<body>
<?php
	include '../menu.php'
	;?>

<form id="contact_form" action="registro.php" method="POST" enctype="multipart/form-data">
	<div class="row">
		<div class='label' for="name">Nombre:</div>
		<input id="name" class="input" name="name" type="text" value="" size="30" />
	</div>
	<div class="row">
		<div class='label' for="last_name">Apellido:</div>
		<input id="name" class="input" name="last_name" type="text" value="" size="30" />
	</div>
	<div class="row">
		<div class='label' for="nombre">Usuario:</div>
		<input id="name" class="input" name="nombre" type="text" value="" size="30" />
	</div>
	<div class="row">
		<div class='label' for="email">Email:</div>
		<input id="name" class="input" name="email" type="text" value="" size="30" />
	</div>
	<div class="row">
		<div class='label' for="murger">Murger:</div>
		<input id="name" class="input" name="murger" type="text" value="" size="30" />
	</div>
	<div class="row">
		<div class='label' for="pass">Contraseña:</div>
		<input id="pass" class="input" name="pass" type="password" value="" size="30" />
	</div>
	
	<input id="submit_button" class='btn' type="submit" value="Alta Usuario" />
</form>	
<br><br>
<div class='datagrid'>
	<table>
		<tr>
				<th>id</th>
				<th>Nombre</th>
				<th>Apellido</th>
				<th>usuario</th>
				<th>email</th>
				<th>pass</th>
			</tr>
<?php

$rs = mysqli_query($c,'SELECT id,name, last_name, nombre, email, murger FROM usuario');
while ($row = mysqli_fetch_array($rs)) {
			
		?>
			<tr>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['last_name']; ?></td>
				<td><?php echo $row['nombre']; ?></td>
				<td><?php echo $row['email']; ?></td>
				<td><?php echo $row['murger']; ?></td>
			</tr>
<?php }

}else{ echo $_SESSION['USUARIO']; }?>
</table>
</div>
</body>
</html>
