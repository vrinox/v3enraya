<?php
session_start();
include_once("../modelos/partida.php");
  if(count($_GET)>0){
    //instancio el objeto partida
    $partida = new cls_Partida();
    if(isset($_GET['partidas'])){
      $_SESSION["partidas"] = $partida->buscarInconclusas();
      header("location: ../reanudar.php");
    }else if(isset($_GET["reanudar"])){
      $partida->buscar($_GET["reanudar"]);
      $_SESSION["partida"] = $partida->get();
      header("location: ../partida.php?jugador=".$partida->get()["jugador"]);
    }else{
      //y guardo los datos ya existir o creo una nueva de ser necesario
      $partida->set($_SESSION["partida"]);
      //guardo la movida en la base de datos
      //para llevar control del estado de la partida
      if(!$partida->guardarMovida($_GET["celda"])){
        $_SESSION['error'] = "error al guardar movida";
        header("location: ../partida.php?error");
      };
      $ganador = $partida->ganador();
      if($ganador!=0){
        $lb_Hecho = $partida->culminarPartida();
        unset($_SESSION["partida"]);
        header("location: ../gameOver.php?jugador=".$ganador);
      }else{
        if(count($partida->get()["movidas"]) == 9){
          $lb_Hecho = $partida->culminarPartida();
          unset($_SESSION["partida"]);
          header("location: ../gameOver.php?empate");
        }else{
          $_SESSION["partida"] = $partida->get();
          header("location: ../partida.php?jugador=".$partida->get()["jugador"]);
        }
      }
    }
  }else{
    header("location: ../index.html");
  }
 ?>
