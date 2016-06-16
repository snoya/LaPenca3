<!DOCTYPE html>
<?php
include_once 'php/funciones.php';
include_once 'php/conexion.php';
header("Content-type: text/html; charset=utf8");
if (HayUsuarioAutenticado()){

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html charset=utf-8" />
    <meta name="author" content="Penca de La Murger King - by German Ríos" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <script type="text/javascript" src="js/funciones.js"></script>
    <title>La Penca de la Múrger</title>
</head>

<body>
    
	
	
	<?php
	    include 'menu.php'
	;?>
	
	
	<div class="ronda">
	    <div class="bar" id="primera" onclick="Habilitar(this.id);"><a href="#" >1ra Fase</a></div>
	    <div class="bar" id="cuartos" onclick="Habilitar(this.id);"><a href="#" >Cuartos</a></div>
	    <div class="bar" id="semis" onclick="Habilitar(this.id);"><a href="#" >Semifinal</a></div>
	    <div class="bar" id="final" onclick="Habilitar(this.id);"><a href="#" >Final</a></div>
	</div>
    <div class='form' >
    <form action="php/guardar-resultado.php" method="POST" enctype="multipart/form-data">
<div id="primeraFase">
<TABLE  class='tabla'>
	<?php
	    for($s=65;$s<=68;$s++){
		$grupo = chr($s);
		?>
		<TR>
		    <TH COLSPAN=2 class='titulo-grupo'>Grupo <?php echo $grupo ?></TH>
	    	</TR>
		<?php
		$id_usuario = $_SESSION['ID'];
		
		$qy = 'SELECT  `id` , CASE WHEN (ADDTIME( CONVERT_TZ( effdt,  "-03:00",  "+00:00" ) ,  "-01:00:00" ) >= CURRENT_TIMESTAMP( )) THEN 1 ELSE 0 END AS ver, `mostrar` , ';
		$qy .= 'DATE_FORMAT(DATE( effdt ),"%d/%m/%Y") fecha, TIME_FORMAT( TIME( effdt ) ,  "%H:%i" ) hora,CASE WHEN (ADDTIME( CONVERT_TZ( effdt,  "-03:00",  "+00:00" ) ,  "02:00:00" ) <= CURRENT_TIMESTAMP( )) THEN 1 ELSE 0 END AS puntaje ,';
		$qy .= '`selA` ,  `selB` ,  `golA` ,  `golB` ,  `fase` ,  `grupo` FROM  `partidos` WHERE grupo="'.$grupo.'" order by effdt';
		
		//$qy = 'SELECT `id`, `mostrar`, `selA`, `selB`, `golA`, `golB`, `fase`, `grupo` FROM `partidos` WHERE grupo="'.$grupo.'" order by effdt';
		$rs = mysqli_query($c,$qy);
		while ($row = mysqli_fetch_array($rs)) {
		    $id_partido = $row['id'];
		    $ver = $row['ver'];
		    $mostrar=$row['mostrar'];
		    $ver_puntos = $row['puntaje'];
		    $fecha = $row['fecha'];
		    $hora = $row['hora'];
		    $OficialGolA = $row['golA'];
		    $OficialGolB = $row['golB'];
		    $q2 = 'SELECT nombre FROM `selecciones` WHERE sel="'.$row['selA'].'"';
		    $r2 = mysqli_query($c,$q2);
		    $row2 = mysqli_fetch_array($r2);
		    $selA = ($row2['nombre']);
		    
		    $q3 = 'SELECT `nombre` FROM `selecciones` WHERE sel="'.$row['selB'].'"';
		    $r3 = mysqli_query($c,$q3);
		    $row3 = mysqli_fetch_array($r3);
		    $selB = ($row3['nombre']);
		    
		    $resultado_Partido_Usuario = 'select golA, golB from partidos_usuarios where id_partido="'.$id_partido.'" and id_usuario="'.$id_usuario.'"';
		    $rsUsuario = mysqli_query($c,$resultado_Partido_Usuario);
		    $rowUsuario = mysqli_fetch_array($rsUsuario);
		    
		    $golA = $rowUsuario['golA'];
		    $golB = $rowUsuario['golB'];;
		    
		    ?> 
			<tr>
			    <td colspan='6' class='separador'></td>
			</tr>
			<tr>
			    <td class='detalle' colspan='6'><?php echo "Fecha $fecha &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Hora: $hora &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Resultado oficial: ";
							    if ($ver_puntos == "1") {
								    echo "[$OficialGolA] - [$OficialGolB] &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Puntos: " . CalcularPuntos($OficialGolA,$OficialGolB,$golA,$golB,1);
								}else{
								    echo "&nbsp Partido Pendiente ";
								}
								
								
								?>
			    </td>
			</tr>
			<TR>
				<TD class='bandera'><img src='img/<?php echo $row['selA'] ?>.png' width='100%' ></TD> <TD class='seleccion'><?php echo $selA ?></TD><TD class='resultado'>
					<select class='inp'	name='<?php echo $row['id'] . $row['selA'] . "' ";
							    if($ver=="0"){ echo "disabled='true'";}; ?>  >
					
					<?php
					
					for($i=0;$i<=10;$i++){
					    if ($golA==$i){?>
						<option value="<?php echo $i ?>" selected='true' class='option'><?php echo $i ?></option>
					    <?php }else{?>
						<option value="<?php echo $i ?>" class='option'><?php echo $i ?></option>
					    <?php }
					}?>
					    
					</select>
				</TD>
				
			<TD class='resultado'>
					<select class='inp' name='<?php echo $row['id'] . $row['selB'] . "' ";
							    if($ver=="0"){ echo "disabled='true'";}; ?>  >
					    <?php
					for($i=0;$i<=10;$i++){
					    if ($golB==$i){  ?>
						
						<option value="<?php echo $i ?>" selected='true' class='option'><?php echo $i ?></option>
					    <?php }else{?>
						<option value="<?php echo $i ?>" class='option'><?php echo $i ?></option>
					    <?php }
					}?>
					</select>
				
				</TD> <TD  class='seleccion'><?php echo $selB ?></TD> <TD class='bandera'><img src='img/<?php echo $row['selB'] ?>.png' width='100%' ></TD> 
			</TR>
		    
		    
		    <?php
		}
	    }
	
	?>
        
</TABLE>
</div>













	
<!-- FASE FINAL DEL CAMPEONATO -->











<div id="cuartosFinal">
<TABLE  class='tabla'>
	<?php
	    
		$grupo = "G";
		?>
		<TR>
		    <TH COLSPAN=2 class='titulo-grupo'>Cuartos de Final</TH>
	    	</TR>
		<?php
		$id_usuario = $_SESSION['ID'];
		
		$qy = 'SELECT  `id` , CASE WHEN (ADDTIME( CONVERT_TZ( effdt,  "-03:00",  "+00:00" ) ,  "-01:00:00" ) >= CURRENT_TIMESTAMP( )) THEN 1 ELSE 0 END AS ver, `mostrar` , ';
		$qy .= 'DATE_FORMAT(DATE( effdt ),"%d/%m/%Y") fecha, TIME_FORMAT( TIME( effdt ) ,  "%H:%i" ) hora,CASE WHEN (ADDTIME( CONVERT_TZ( effdt,  "-03:00",  "+00:00" ) ,  "02:00:00" ) <= CURRENT_TIMESTAMP( )) THEN 1 ELSE 0 END AS puntaje ,';
		$qy .= '`selA` ,  `selB` ,  `golA` ,  `golB` ,  `fase` ,  `grupo` FROM  `partidos` WHERE grupo="'.$grupo.'" order by effdt';
		
		//$qy = 'SELECT `id`, `mostrar`, `selA`, `selB`, `golA`, `golB`, `fase`, `grupo` FROM `partidos` WHERE grupo="'.$grupo.'" order by effdt';
		$rs = mysqli_query($c,$qy);
		while ($row = mysqli_fetch_array($rs)) {
		    $id_partido = $row['id'];
		    $ver = $row['ver'];
		    $mostrar=$row['mostrar'];
		    $ver_puntos = $row['puntaje'];
		    $fecha = $row['fecha'];
		    $hora = $row['hora'];
		    $OficialGolA = $row['golA'];
		    $OficialGolB = $row['golB'];
		    $q2 = 'SELECT nombre FROM `selecciones` WHERE sel="'.$row['selA'].'"';
		    $r2 = mysqli_query($c,$q2);
		    $row2 = mysqli_fetch_array($r2);
		    $selA = ($row2['nombre']);
		    
		    $q3 = 'SELECT `nombre` FROM `selecciones` WHERE sel="'.$row['selB'].'"';
		    $r3 = mysqli_query($c,$q3);
		    $row3 = mysqli_fetch_array($r3);
		    $selB = ($row3['nombre']);
		    
		    $resultado_Partido_Usuario = 'select golA, golB from partidos_usuarios where id_partido="'.$id_partido.'" and id_usuario="'.$id_usuario.'"';
		    $rsUsuario = mysqli_query($c,$resultado_Partido_Usuario);
		    $rowUsuario = mysqli_fetch_array($rsUsuario);
		    
		    $golA = $rowUsuario['golA'];
		    $golB = $rowUsuario['golB'];;
		    
		    ?> 
			<tr>
			    <td colspan='6' class='separador'></td>
			</tr>
			<tr>
			    <td class='detalle' colspan='6'><?php echo "Fecha $fecha &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Hora: $hora &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Resultado oficial: ";
							    if ($ver_puntos == "1") {
								    echo "[$OficialGolA] - [$OficialGolB] &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Puntos: " . CalcularPuntos($OficialGolA,$OficialGolB,$golA,$golB,1);
								}else{
								    echo "&nbsp Partido Pendiente ";
								}
								
								
								?>
			    </td>
			</tr>
			<TR>
				<TD class='bandera'><img src='img/<?php echo $row['selA'] ?>.png' width='100%' ></TD> <TD class='seleccion'><?php echo $selA ?></TD><TD class='resultado'>
					<select class='inp'	name='<?php echo $row['id'] . $row['selA'] . "' ";
							    if($ver=="0"){ echo "disabled='true'";}; ?>  >
					
					<?php
					
					for($i=0;$i<=10;$i++){
					    if ($golA==$i){?>
						<option value="<?php echo $i ?>" selected='true' class='option'><?php echo $i ?></option>
					    <?php }else{?>
						<option value="<?php echo $i ?>" class='option'><?php echo $i ?></option>
					    <?php }
					}?>
					    
					</select>
				</TD>
				
			<TD class='resultado'>
					<select class='inp' name='<?php echo $row['id'] . $row['selB'] . "' ";
							    if($ver=="0"){ echo "disabled='true'";}; ?>  >
					    <?php
					for($i=0;$i<=10;$i++){
					    if ($golB==$i){  ?>
						
						<option value="<?php echo $i ?>" selected='true' class='option'><?php echo $i ?></option>
					    <?php }else{?>
						<option value="<?php echo $i ?>" class='option'><?php echo $i ?></option>
					    <?php }
					}?>
					</select>
				
				</TD> <TD  class='seleccion'><?php echo $selB ?></TD> <TD class='bandera'><img src='img/<?php echo $row['selB'] ?>.png' width='100%' ></TD> 
			</TR>
		    
		    
		    <?php
		}
	    
	
	?>
        
</TABLE>
</div>

<div id="semiFinales">
<TABLE  class='tabla'>
	<?php
	    
		$grupo = "S";
		?>
		<TR>
		    <TH COLSPAN=2 class='titulo-grupo'>Semi - Finales</TH>
	    	</TR>
		<?php
		$id_usuario = $_SESSION['ID'];
		
		$qy = 'SELECT  `id` , CASE WHEN (ADDTIME( CONVERT_TZ( effdt,  "-03:00",  "+00:00" ) ,  "-01:00:00" ) >= CURRENT_TIMESTAMP( )) THEN 1 ELSE 0 END AS ver, `mostrar` , ';
		$qy .= 'DATE_FORMAT(DATE( effdt ),"%d/%m/%Y") fecha, TIME_FORMAT( TIME( effdt ) ,  "%H:%i" ) hora,CASE WHEN (ADDTIME( CONVERT_TZ( effdt,  "-03:00",  "+00:00" ) ,  "02:00:00" ) <= CURRENT_TIMESTAMP( )) THEN 1 ELSE 0 END AS puntaje ,';
		$qy .= '`selA` ,  `selB` ,  `golA` ,  `golB` ,  `fase` ,  `grupo` FROM  `partidos` WHERE grupo="'.$grupo.'" order by effdt';
		
		//$qy = 'SELECT `id`, `mostrar`, `selA`, `selB`, `golA`, `golB`, `fase`, `grupo` FROM `partidos` WHERE grupo="'.$grupo.'" order by effdt';
		$rs = mysqli_query($c,$qy);
		while ($row = mysqli_fetch_array($rs)) {
		    $id_partido = $row['id'];
		    $ver = $row['ver'];
		    $mostrar=$row['mostrar'];
		    $ver_puntos = $row['puntaje'];
		    $fecha = $row['fecha'];
		    $hora = $row['hora'];
		    $OficialGolA = $row['golA'];
		    $OficialGolB = $row['golB'];
		    $q2 = 'SELECT nombre FROM `selecciones` WHERE sel="'.$row['selA'].'"';
		    $r2 = mysqli_query($c,$q2);
		    $row2 = mysqli_fetch_array($r2);
		    $selA = ($row2['nombre']);
		    
		    $q3 = 'SELECT `nombre` FROM `selecciones` WHERE sel="'.$row['selB'].'"';
		    $r3 = mysqli_query($c,$q3);
		    $row3 = mysqli_fetch_array($r3);
		    $selB = ($row3['nombre']);
		    
		    $resultado_Partido_Usuario = 'select golA, golB from partidos_usuarios where id_partido="'.$id_partido.'" and id_usuario="'.$id_usuario.'"';
		    $rsUsuario = mysqli_query($c,$resultado_Partido_Usuario);
		    $rowUsuario = mysqli_fetch_array($rsUsuario);
		    
		    $golA = $rowUsuario['golA'];
		    $golB = $rowUsuario['golB'];;
		    
		    ?> 
			<tr>
			    <td colspan='6' class='separador'></td>
			</tr>
			<tr>
			    <td class='detalle' colspan='6'><?php echo "Fecha $fecha &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Hora: $hora &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Resultado oficial: ";
							    if ($ver_puntos == "1") {
								    echo "[$OficialGolA] - [$OficialGolB] &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Puntos: " . CalcularPuntos($OficialGolA,$OficialGolB,$golA,$golB,1);
								}else{
								    echo "&nbsp Partido Pendiente ";
								}
								
								
								?>
			    </td>
			</tr>
			<TR>
				<TD class='bandera'><img src='img/<?php echo $row['selA'] ?>.png' width='100%' ></TD> <TD class='seleccion'><?php echo $selA ?></TD><TD class='resultado'>
					<select class='inp'	name='<?php echo $row['id'] . $row['selA'] . "' ";
							    if($ver=="0"){ echo "disabled='true'";}; ?>  >
					
					<?php
					
					for($i=0;$i<=10;$i++){
					    if ($golA==$i){?>
						<option value="<?php echo $i ?>" selected='true' class='option'><?php echo $i ?></option>
					    <?php }else{?>
						<option value="<?php echo $i ?>" class='option'><?php echo $i ?></option>
					    <?php }
					}?>
					    
					</select>
				</TD>
				
			<TD class='resultado'>
					<select class='inp' name='<?php echo $row['id'] . $row['selB'] . "' ";
							    if($ver=="0"){ echo "disabled='true'";}; ?>  >
					    <?php
					for($i=0;$i<=10;$i++){
					    if ($golB==$i){  ?>
						
						<option value="<?php echo $i ?>" selected='true' class='option'><?php echo $i ?></option>
					    <?php }else{?>
						<option value="<?php echo $i ?>" class='option'><?php echo $i ?></option>
					    <?php }
					}?>
					</select>
				
				</TD> <TD  class='seleccion'><?php echo $selB ?></TD> <TD class='bandera'><img src='img/<?php echo $row['selB'] ?>.png' width='100%' ></TD> 
			</TR>
		    
		    
		    <?php
		}
	    
	
	?>
        
</TABLE>
</div>


<div id="faseFinal">
<TABLE  class='tabla'>
	<?php
	    
		$grupo = "F";
		$id_usuario = $_SESSION['ID'];
		
		$qy = 'SELECT  `id` , CASE WHEN (ADDTIME( CONVERT_TZ( effdt,  "-03:00",  "+00:00" ) ,  "-01:00:00" ) >= CURRENT_TIMESTAMP( )) THEN 1 ELSE 0 END AS ver, `mostrar` , ';
		$qy .= 'DATE_FORMAT(DATE( effdt ),"%d/%m/%Y") fecha, TIME_FORMAT( TIME( effdt ) ,  "%H:%i" ) hora,CASE WHEN (ADDTIME( CONVERT_TZ( effdt,  "-03:00",  "+00:00" ) ,  "02:00:00" ) <= CURRENT_TIMESTAMP( )) THEN 1 ELSE 0 END AS puntaje ,';
		$qy .= '`selA` ,  `selB` ,  `golA` ,  `golB` ,  `fase` ,  `grupo` FROM  `partidos` WHERE grupo="'.$grupo.'" order by effdt';
		
		//$qy = 'SELECT `id`, `mostrar`, `selA`, `selB`, `golA`, `golB`, `fase`, `grupo` FROM `partidos` WHERE grupo="'.$grupo.'" order by effdt';
		$rs = mysqli_query($c,$qy);
		while ($row = mysqli_fetch_array($rs)) {
		    $id_partido = $row['id'];
		    $ver = $row['ver'];
		    $mostrar=$row['mostrar'];
		    $ver_puntos = $row['puntaje'];
		    $fecha = $row['fecha'];
		    $hora = $row['hora'];
		    $OficialGolA = $row['golA'];
		    $OficialGolB = $row['golB'];
		    $q2 = 'SELECT nombre FROM `selecciones` WHERE sel="'.$row['selA'].'"';
		    $r2 = mysqli_query($c,$q2);
		    $row2 = mysqli_fetch_array($r2);
		    $selA = ($row2['nombre']);
		    
		    $q3 = 'SELECT `nombre` FROM `selecciones` WHERE sel="'.$row['selB'].'"';
		    $r3 = mysqli_query($c,$q3);
		    $row3 = mysqli_fetch_array($r3);
		    $selB = ($row3['nombre']);
		    
		    $resultado_Partido_Usuario = 'select golA, golB from partidos_usuarios where id_partido="'.$id_partido.'" and id_usuario="'.$id_usuario.'"';
		    $rsUsuario = mysqli_query($c,$resultado_Partido_Usuario);
		    $rowUsuario = mysqli_fetch_array($rsUsuario);
		    
		    $golA = $rowUsuario['golA'];
		    $golB = $rowUsuario['golB'];;
		    
		    
		    if ($row["selA"]=="f1" and $row["selB"]=="f2"){
			$titulo_partido = "Final";
		    }else{
			$titulo_partido="Tercer Puesto";
		    };
		    echo "<TR>";
			echo "<TH COLSPAN=2 class='titulo-grupo'>$titulo_partido</TH>";
		    echo "</TR>";
		    ?> 
			<tr>
			    <td colspan='6' class='separador'></td>
			</tr>
			<tr>
			    <td class='detalle' colspan='6'><?php echo "Fecha $fecha &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Hora: $hora &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Resultado oficial: ";
							    if ($ver_puntos == "1") {
								    echo "[$OficialGolA] - [$OficialGolB] &nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp Puntos: " . CalcularPuntos($OficialGolA,$OficialGolB,$golA,$golB,1);
								}else{
								    echo "&nbsp Partido Pendiente ";
								}
								
								
								?>
			    </td>
			</tr>
			<TR>
				<TD class='bandera'><img src='img/<?php echo $row['selA'] ?>.png' width='100%' ></TD> <TD class='seleccion'><?php echo $selA ?></TD><TD class='resultado'>
					<select class='inp'	name='<?php echo $row['id'] . $row['selA'] . "' ";
							    if($ver=="0"){ echo "disabled='true'";}; ?>  >
					
					<?php
					
					for($i=0;$i<=10;$i++){
					    if ($golA==$i){?>
						<option value="<?php echo $i ?>" selected='true' class='option'><?php echo $i ?></option>
					    <?php }else{?>
						<option value="<?php echo $i ?>" class='option'><?php echo $i ?></option>
					    <?php }
					}?>
					    
					</select>
				</TD>
				
			<TD class='resultado'>
					<select class='inp' name='<?php echo $row['id'] . $row['selB'] . "' ";
							    if($ver=="0"){ echo "disabled='true'";}; ?>  >
					    <?php
					for($i=0;$i<=10;$i++){
					    if ($golB==$i){  ?>
						
						<option value="<?php echo $i ?>" selected='true' class='option'><?php echo $i ?></option>
					    <?php }else{?>
						<option value="<?php echo $i ?>" class='option'><?php echo $i ?></option>
					    <?php }
					}?>
					</select>
				
				</TD> <TD  class='seleccion'><?php echo $selB ?></TD> <TD class='bandera'><img src='img/<?php echo $row['selB'] ?>.png' width='100%' ></TD> 
			</TR>
		    
		    
		    <?php
		}
	    
	
	?>
        
</TABLE>
</div>

<input id="submit_button" class='btn' type="submit" value="Guardar" />
</form> 
</div>
<?php }else{
	    echo 'Debe de estar autenticado para poder loguearse';
    } ?>
    
