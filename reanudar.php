<?php
session_start();
  if(!isset($_SESSION["partidas"])){
    header("location: index.html");
  }else{
    $partidas = $_SESSION["partidas"];
    unset($_SESSION["partidas"]);
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Reanudar</title>
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <h2 class="titulo ts">
      Reanudar
    </h2>
    <div class="opciones">
      <?php
        for($x=0;$x < count($partidas);$x++){
          echo "<a href='controladores/partida.php?reanudar=".$partidas[$x]["id"]."'>";
            echo "<div class='partida'>";
            echo "Numero:".$partidas[$x]["id"];
            echo " turno:<span class='p".$partidas[$x]["jugador"]."'>Jugador ".$partidas[$x]["jugador"]."</span>";
            echo "</div>";
          echo "</a>";
        }
      ?>
    </div>
  </body>
</html>
