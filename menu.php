<?php include_once 'php/funciones.php'; 
if (HayUsuarioAutenticado()){ echo "<div id='usuario_log'> Bienvenido <br>" . $_SESSION['USUARIO'] . "</div>"; } ?>
<div id='redes'>
    <a href='https://www.facebook.com/lamurgacomida?fref=ts' class='face' target="_blank">
        <img src='img/face.png' onmouseover="this.src='img/face_on.png';" onmouseout="this.src='img/face.png';">
    </a>
</div>

<div id="menu">
     
    <div id='tit-en-form'>
        La Penca de La Murger
        
    </div>
    
<?php 
if (HayUsuarioAutenticado()){
?>
   <a href="penca-form.php">Mi Penca</a>&nbsp;&nbsp;|&nbsp;
   <a href="Posiciones.php">Tabla de Posiciones</a>&nbsp;&nbsp;|&nbsp;
   <a href="Reglamento.php">Reglamento</a>&nbsp;&nbsp;&nbsp;|&nbsp
   <a href="Perfil.php">Perfil</a>&nbsp;&nbsp;|&nbsp;     
   <a href="php/salir.php">Salir</a>   
 </div>

<?php } ?>	