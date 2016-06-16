<?php
 include_once '../php/conexion.php';
include_once '../php/funciones.php';
header("Content-type: text/html; charset=utf8");
if (HayUsuarioAutenticado()){
    //$qs = 'select * from partidos where mostrar="1";';
    $qs = 'select * from partidos where (ADDTIME(CONVERT_TZ(effdt,"-03:00","+00:00"),"-01:00:00")>=CURRENT_TIMESTAMP());';   
    $rs = mysqli_query($c,$qs);
    
    while ($row = mysqli_fetch_array($rs)) {
        $id_partido = $row['id'];
        $selA = $row['selA'];
        $selB = $row['selB'];
        $usuario = $_SESSION['USUARIO'];
        $id_usuario = $_SESSION['ID'];
        
        $indA = $id_partido . $selA; 
        $golA = $_POST[$indA];
        
        $indB = $id_partido . $selB; 
        $golB = $_POST[$indB];
        
        /*************
        echo  "id_partido: " . $id_partido . "<br>";
        echo  "selA :" . $selA . "<br>";
        echo  "selB :" .$selB . "<br>";
        echo  "usuario :" .$usuario . "<br>";
        echo  "id_usuario :" .$id_usuario . "<br>";
        echo  "golA :" . $golA. "<br>";
         echo "golB :" . $golB. "<br>";
         echo   "<br>";
        **********************/
        
        $q2 = 'select * from partidos_usuarios where id_usuario="'.$id_usuario.'" and id_partido="'.$id_partido.'";';
        $Hay_Registro = mysqli_query($c,$q2);
        if (mysqli_num_rows($Hay_Registro)>0){
            
            /*Ya hay un registro del partido, por lo que hay que hacer un update*/
            if ($usuario=='admin'){
                $updatePartidos = 'UPDATE partidos set golA="'.$golA.'", golB="'.$golB.'" where id="'.$id_partido.'";';
                $upPartidos = mysqli_query($c,$updatePartidos);
                if ($upPartidos){
                    $update = 'UPDATE partidos_usuarios set golA="'.$golA.'", golB="'.$golB.'" where id_usuario="'.$id_usuario.'" and id_partido="'.$id_partido.'";';
                    $up = mysqli_query($c,$update);
                    
                    if (!$up){
                        echo "Error el actualizar el Resultado.";
                    }
                }else{
                    echo mysqli_error($upPartidos) . "<br><br>";
                }
                
            }else{
                $update = 'UPDATE partidos_usuarios set golA="'.$golA.'", golB="'.$golB.'" where id_usuario="'.$id_usuario.'" and id_partido="'.$id_partido.'";';
                $up = mysqli_query($c,$update);
                if ($up){
                   
                }
            }
            
        }else{
            
                $insert = 'INSERT into partidos_usuarios (id_usuario,id_partido,golA,golB) values ("'.$id_usuario.'","'.$id_partido.'","'.$golA.'","'.$golB.'");';
                $is = mysqli_query($c,$insert);
                if ($is){
                    echo "OK";
                    
                }else{
                    echo mysqli_error($is);
                }
        }
    
    }
$to = $_SESSION['EMAIL'];
    $subject = "Actualizacion - La Penca de la Murger";
    $messaje = "Le informamos que ell puntaje se actualizo correctamente. \r\n \r\n";
$messaje .= "Muchas Suerte!! \r\n La Penca de la Murger.";
    $mail = mail($to,$subject,$messaje,'From: LaPencaDeLaMurger');
                     if ($mail){
                       header('Location: ../penca-form.php');
                     }else{
                      header('Location: ../penca-form.php');
                     }

} 
?>		