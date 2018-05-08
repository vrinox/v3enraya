<?php
include_once('conexion.php');
class cls_Movida extends cls_Conexion{
  private $aa_Atributos;

  public function __construct($pa_Atributos){
    $this->aa_Atributos=Array();
    if(!isset($pa_Atributos["id"])){
      $pa_Atributos["id"] = $this->crear($pa_Atributos);
    }
    $this->set($pa_Atributos);
  }

  public function set($pa_Atributos){
    $this->aa_Atributos = $pa_Atributos;
  }

  public function get(){
    return $this->aa_Atributos;
  }

  public function crear($pa_Atributos){
    $ls_Sql="INSERT INTO movida (celda,jugador,id_partida)";
		$ls_Sql.="VALUES";
		$ls_Sql.="('".$pa_Atributos['celda']."','".$pa_Atributos['jugador']."',";
		$ls_Sql.="'".$pa_Atributos['id_partida']."')";
    $this->f_Con();
		$lb_Hecho=$this->f_Ejecutar($ls_Sql);
    $id = $this->f_ultimo_id();
		$this->f_Des();
    return $id;
  }
}
?>
