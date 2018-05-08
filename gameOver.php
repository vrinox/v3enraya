<?php
  if(isset($_GET["jugador"])){
    $ganador =  '<div class="ganador p'.$_GET["jugador"].'">Jugador'.$_GET["jugador"].' ha ganado</div>';
  }else if(isset($_GET["empate"])){
    $ganador = "";
  }else{
    header("location: index.html");
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <title>ganador</title>
  </head>
  <body>
    <h2 class="titulo ts">
      Game Over
    </h2>
    <?php
      echo $ganador;
    ?>
    <div class="opciones">
      <div class="opcion">
        <a href="partida.php?nueva"><button type="button" name="button" class="bgp">Partida Nueva</button></a>
      </div>
      <div class="opcion">
        <a href="index.html"><button type="button" name="button" class="bgp">Volver al Menu</button></a>
      </div>
    </div>
  </body>
</html>
