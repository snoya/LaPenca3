<!DOCTYPE html>
<?php
include_once 'php/conexion.php';
include_once 'php/funciones.php';

if (HayUsuarioAutenticado()){?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>Posiciones</title>
</head>

<body>

	<?php
	include 'menu.php'
	;?>



<div class="datagrid"><table>


<thead>
    <tr><th>Posicion</th>
        <th>Usuario</th>
        <th>Puntaje</th>
    </tr>
</thead>
<tbody>
<?php

$rs = mysqli_query($c,'select a.puntos, b.nombre from puntuaciones a,usuario b where a.id_usuario=b.id and b.nombre<>"admin" and b.nombre<>"admin2" order by puntos desc');
$pos = 1;
while ($row = mysqli_fetch_array($rs)) {
			
		?>
			<tr<?php if  (($pos%2)==0){echo ' class="alt"';}?>>
				<td><?php echo $pos ?></td>
				<td><?php echo $row['nombre']; ?></td>
				<td><?php echo $row['puntos']; ?></td>
			</tr>
        <?php
        $pos = $pos + 1;
}
?>
</tbody>
</table></div>
<?php
if($_SESSION['USUARIO']=='admin'){
        ?>
            <form id="contact_form" action="php/ActualizarPuntaje.php" method="POST" enctype="multipart/form-data">
                <input id="submit_button" class='btn' type="submit" value="Actualizar Posiciones" />
            </form>
        <?php
        }

}?>
</div>
</body>
</html>
