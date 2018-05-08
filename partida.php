<?php
  session_start();
  // en caso de ser una nueva partida
  if(isset($_GET["nueva"])){
    unset($_SESSION["partida"]);
  }
  if(!isset($_SESSION["partida"])){
    $_SESSION["partida"]["jugador"] = 1;
    $_SESSION["partida"]["estado"] = 'I';
  }
  $partida = $_SESSION["partida"];
  if(isset($_SESSION["error"])){
      $error = $_SESSION["error"];
      unset($_SESSION["error"]);
  }
  $jugador = $partida["jugador"];
  $query_tag = "?";
  $controlador = "../controladores/partida.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Partida</title>
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div class="cabecera bgp">
      <div class="nombre-juego ts">
        Tres en Raya
      </div>
      <div class="jugador <?php echo "p".$jugador; ?>">
        Jugador <?php echo $jugador; ?>
      </div>
    </div>
    <?php
    //en caso de un error paro la ejecucion
    if(isset($error)){
        echo "<div class='error'>".$error."</div>";
    }else{
      echo "<div class='tablero'>";
      for($x = 1; $x <= 3 ;$x++){
        for($y = 1; $y <= 3 ;$y++){
            $celda = false;
            echo "<div class='celda ";
            if(isset($partida["movidas"])){
              for($z = 0; $z < count($partida["movidas"]);$z++){
                if($partida["movidas"][$z]["celda"]== $x.'-'.$y){
                  $celda = true;
                  echo "p".$partida["movidas"][$z]["jugador"]."'> ";
                }
              }
            }
            if(!$celda){
              echo "'><a href='".$controlador.$query_tag."celda=".$x."-".$y."&jugador=".$jugador."'><button type='button'></button></a>";
            }
            echo "</div>";
        }
      }
      echo "</div>";
    }
    ?>
  </body>
</html>
