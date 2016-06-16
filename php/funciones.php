<?php
 /*ver si hay un usuario autenticado*/
 session_start();
 function HayUsuarioAutenticado(){
    if (isset($_SESSION['USUARIO'])){
        return true;
        
    }else{
        return false;
    }
    
 };
 
 function comprobar_email($email){ 
   	$mail_correcto = 0; 
   	//compruebo unas cosas primeras 
   	if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){ 
      	if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) { 
         	//miro si tiene caracter . 
         	if (substr_count($email,".")>= 1){ 
            	//obtengo la terminacion del dominio 
            	$term_dom = substr(strrchr ($email, '.'),1); 
            	//compruebo que la terminación del dominio sea correcta 
            	if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){ 
               	//compruebo que lo de antes del dominio sea correcto 
               	$antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
               	$caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
               	if ($caracter_ult != "@" && $caracter_ult != "."){ 
                  	$mail_correcto = 1; 
               	} 
            	} 
         	} 
      	} 
   	} 
   	if ($mail_correcto) 
      	return 1; 
   	else 
      	return 0; 
};

function CalcularPuntos ($golA,$golB,$apuesta_golA,$apuesta_golB,$fase){
    $SUMA_PRIMERA_FASE = 4;
    $SUMA_CUARTOS_FINAL = 6;
    $SUMA_SEMI_FINAL_FINAL = 8;
    $puntaje = 0;
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
           return $puntaje;
};


 
?>