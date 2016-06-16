<?php
include_once 'conexion.php';
include_once 'funciones.php';

if (HayUsuarioAutenticado() and $_SESSION['USUARIO']=='admin'){
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    <title>Alta de usuarios</title>
</head>

<body>

<?php
    $qy = 'SELECT `id`, `nombre`, `email` FROM usuario where nombre <>"admin" and nombre <>"admin2";';
    $rs = mysqli_query($c,$qy);
    $SUMA_PRIMERA_FASE = 4;
    $SUMA_CUARTOS_FINAL = 6;
    $SUMA_SEMI_FINAL_FINAL = 8;
    
    $subject = "Actualizacion Puntaje - La Penca de la Murger";
    
    
    while ($row = mysqli_fetch_array($rs)) {
       /*en el bucle superior recorro los usuarios*/
       $puntaje = 0;
       $to = $row['email'];
       $id_usuario = $row['id'];
       
       $messaje = "Estimado " . $row['nombre'] . " te informamos la tabla de puntuaciones \r\nha sido actualizada en este instante!!.\r\n";
       $messaje .= "Ingresa en http://www.lapencadelamurger.hol.es para ver como te fue!!\r\n ";
       $messaje .= "\r\nBuena suerte!! \r\n \r\n La Penca de la Murger.";
       
       $res = mysqli_query($c,'select * from partidos where (ADDTIME(CONVERT_TZ(effdt,"-03:00","+00:00"),"02:00:00")<=CURRENT_TIMESTAMP());');
       //$res = mysqli_query($c,'select * from partidos where mostrar="0";');
       // $res = mysqli_query($c,'select * from partidos');
        
        while ($partido = mysqli_fetch_array($res)) {
           /*en el segundo bucle recorro los partidos*/
           $golA = $partido['golA'];
           $golB = $partido['golB'];
           $id_partido = $partido['id'];
           $fase = $partido['fase'];
           /*Ahora con los datos del partido, y sabiendo que usuario estoy trabajando, debo de ir a buscar la apuesta*/
           $ap = mysqli_query($c,'select golA,golB from partidos_usuarios where id_usuario="'.$id_usuario.'" and id_partido="'.$id_partido.'";');
           $apuesta = mysqli_fetch_array($ap);
           $apuesta_golA = $apuesta['golA'];
           $apuesta_golB = $apuesta['golB'];
           
           /*Con los datos de la apuesta tengo que calcular el incremento del puntaje*/
           
           if (($golA>$golB and $apuesta_golA>$apuesta_golB) || ($golB>$golA and $apuesta_golB>$apuesta_golA) || ($golA==$golB and $apuesta_golA==$apuesta_golB)){
               /*EN ESTE CASO, ADIVINA EL RESULTADO DEL PARTIDO*/
               
               switch ($fase){
                   case 1:   $puntaje = $puntaje + $SUMA_PRIMERA_FASE;
                    break;
                   case 2:   $puntaje = $puntaje + $SUMA_CUARTOS_FINAL;
                    break;
                   case 3:   $puntaje = $puntaje + $SUMA_SEMI_FINAL_FINAL;
                    break;
                   case 4:   $puntaje = $puntaje + $SUMA_SEMI_FINAL_FINAL;
                    break;
               }   
           }
           
           if ($golA==$apuesta_golA){
               /*EN ESTE CASO, ADIVINA LA CANTIDAD DE GOLES DEL PRIMER EQUIPO => SUMA 2 PUNTOS*/
               switch ($fase){
                   case 1:   $puntaje = $puntaje + ($SUMA_PRIMERA_FASE/2);
                    break;
                   case 2:   $puntaje = $puntaje + ($SUMA_CUARTOS_FINAL/2);
                    break;
                   case 3:   $puntaje = $puntaje + ($SUMA_SEMI_FINAL_FINAL/2);
                    break;
                   case 4:   $puntaje = $puntaje + ($SUMA_SEMI_FINAL_FINAL/2);
                    break;
               }   
           }
           
           if ($golB==$apuesta_golB){
               /*EN ESTE CASO, ADIVINA LA CANTIDAD DE GOLES DEL PRIMER EQUIPO => SUMA 2 PUNTOS*/
               switch ($fase){
                   case 1:     $puntaje = $puntaje + ($SUMA_PRIMERA_FASE/2);
                    break;
                   case 2:     $puntaje = $puntaje + ($SUMA_CUARTOS_FINAL/2);
                    break;
                   case 3:   $puntaje = $puntaje + ($SUMA_SEMI_FINAL_FINAL/2);
                    break;
                   case 4:   $puntaje = $puntaje + ($SUMA_SEMI_FINAL_FINAL/2);
                    break;
               }   
           }
           
           
        }
       /*la variable puntajes tiene el puntaje del usuario*/
       $ex = mysqli_query($c,'select * from puntuaciones where id_usuario="'.$id_usuario.'"');
       if (mysqli_num_rows($ex)>0){
           $pt =  mysqli_query($c,'update puntuaciones set puntos="'.$puntaje.'" where id_usuario="'.$id_usuario.'";');
           if (!$pt){
               echo mysqli_error($pt);
           }else{
         
            //$mail = mail($to,$subject,$messaje,'From: LaPencaDeLaMurger');
            
           }
       }else{
        $insert='insert into puntuaciones (puntos,id_usuario) values ("'.$puntaje.'","'.$id_usuario.'");';
        
           $pt =  mysqli_query($c,$insert);
            if (!$pt){
               echo mysqli_error($pt);
           }else{
            
            //$mail = mail($to,$subject,$messaje,'From: LaPencaDeLaMurger');
            
           }
       }
       
    }
}
header('Location: ../Posiciones.php');
?>
</body>
</html>