<?php
include_once('conexion.php');
include_once('movida.php');
class cls_Partida extends cls_Conexion{
  private $aa_Atributos;

  public function __construct(){
    $this->aa_Atributos=Array();
  }

  public function set($pa_Atributos){
    if(!isset($pa_Atributos['id'])){
      $pa_Atributos['id'] = $this->crear();
    }
    $this->aa_Atributos = $pa_Atributos;
  }

  public function get(){
    return $this->aa_Atributos;
  }

  public function buscar($id){
    $ls_Sql = "SELECT * FROM partida WHERE id=".$id;
    $lb_Enc = false;
    $this->f_Con();
    $lr_Tabla = $this->f_Filtro($ls_Sql);
    if($la_Tupla=$this->f_Arreglo($lr_Tabla)){
      $this->aa_Atributos['id']=$la_Tupla["id"];
      //me dice el jugador que esta en turno
      $this->aa_Atributos['jugador']=$la_Tupla["jugador"];
      $this->aa_Atributos['estado']=$la_Tupla["estado"];
      $lb_Enc = true;
    }
    $this->f_Cierra($lr_Tabla);
    $this->f_Des();
    $this->aa_Atributos["movidas"] = $this->buscarMovidas();
    return $lb_Enc;
  }

  public function buscarInconclusas(){
    //todas las que esten inconclusas
    $ls_Sql = "SELECT * FROM partida WHERE estado='I'";
    $this->f_Con();
    $lr_Tabla = $this->f_Filtro($ls_Sql);
    $x = 0;
    while($la_Tupla=$this->f_Arreglo($lr_Tabla)){
      $la_Registros[$x]['id']=$la_Tupla["id"];
      //me dice el jugador que esta en turno
      $la_Registros[$x]['jugador']=$la_Tupla["jugador"];
      $la_Registros[$x]['estado']=$la_Tupla["estado"];
      $x++;
    }
    $this->f_Cierra($lr_Tabla);
    $this->f_Des();
    return $la_Registros;
  }


  public function buscarMovidas(){
    $movidas = array();
    //me dice si consiguio alguna movida
    $ls_Sql = "SELECT * FROM movida WHERE id_partida=".$this->aa_Atributos["id"];
    $x = 0;
    $this->f_Con();
    $lr_Tabla = $this->f_Filtro($ls_Sql);
    while($la_Tupla=$this->f_Arreglo($lr_Tabla)){
      $movida = new cls_Movida($la_Tupla);
      $movidas[$x] = $movida->get();
      $x++;
    }
    $this->f_Cierra($lr_Tabla);
    $this->f_Des();
    return $movidas;
  }

  public function guardarMovida($celda){
    $lb_Hecho = false;
    $atributos = array(
      'celda'     =>  $celda,
      'id_partida'=>  $this->aa_Atributos['id'],
      'jugador'   =>  $this->aa_Atributos["jugador"]
    );
    $movida = new cls_Movida($atributos);
    //si no esta incializado
    if(!isset($this->aa_Atributos["movidas"])){
      //lo inizializo
      $this->aa_Atributos["movidas"] = array();
    }
    //relleno el arreglo con la nueva movida
    $this->aa_Atributos["movidas"][] = $movida->get();
    $this->aa_Atributos["jugador"] = ($this->aa_Atributos["jugador"]==1)?2:1;
    $lb_Hecho=$this->actualizar();
    return $lb_Hecho;
  }

  public function crear(){
    $ls_Sql="INSERT INTO partida (jugador,estado) VALUES (1,'I')";
    $this->f_Con();
		$lb_Hecho=$this->f_Ejecutar($ls_Sql);
    if($lb_Hecho){
        $id = $this->f_ultimo_id();
    }else{
      echo $this->f_Error();
    }
		$this->f_Des();
    return $id;
  }

  public function actualizar(){
    $lb_Hecho = false;
    $estado = $this->aa_Atributos['estado'];
    $jugador = $this->aa_Atributos['jugador'];
    $ls_Sql="UPDATE partida SET estado='$estado', jugador='$jugador' WHERE id=".$this->aa_Atributos["id"];
    $this->f_Con();
    $lb_Hecho=$this->f_Ejecutar($ls_Sql);
    $this->f_Des();
    return $lb_Hecho;
  }

  public function culminarPartida(){
      $lb_Hecho = false;
      $this->aa_Atributos['estado'] = 'C';
      $lb_Hecho = $this->actualizar();
      return  $lb_Hecho;
  }

  public function ganador(){
    $movidas = $this->aa_Atributos["movidas"];
    //relleno el tablero con valores aleatorios para que no influya
    //en la evaluacion del ganador
    $tablero = array(
      1=>array(1=>10,2=>11,3=>12),
      2=>array(1=>13,2=>14,3=>15),
      3=>array(1=>16,2=>17,3=>18),
    );
    //lleno el tablero
    //generalmente es mala practica colocar 3 ciclos uno dentro de otro pero
    //en este caso al ser un numero limitado y pequeño no afecta demasiado
    for($y=1;$y<=3;$y++){
      for($z=1;$z<=3;$z++){
        for($x = 0; $x < count($movidas);$x++){
          if($movidas[$x]["celda"] == $y."-".$z){
            $tablero[$y][$z] = $this->aa_Atributos["movidas"][$x]["jugador"];
          }
        }
      }
    }
    //determino verticales
    for($a=1;$a<=3;$a++){
  		if(($tablero[$a][1]==$tablero[$a][2]) && ($tablero[$a][2]== $tablero[$a][3])){
  		    return $tablero[$a][1];
      }
    }
    //determino horizontales
  	for($a=1;$a<=3;$a++){
  		if(($tablero[1][$a]==$tablero[2][$a]) && ($tablero [2][$a]==$tablero[3][$a])){
  		    return $tablero[2][$a];
      }
    }
    //determino diagonales
    	if(($tablero[1][1]==$tablero[2][2]) && ($tablero[2][2]==$tablero[3][3])){
          return $tablero[3][3];
      }

    	if(($tablero[0][2]==$tablero[1][1]) && ($tablero[1][1]==$tablero[2][0])){
        return $tablero[0][2];
      }

  	return 0;
  }
}
?>
