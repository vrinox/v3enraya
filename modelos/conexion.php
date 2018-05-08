<?php
class cls_Conexion {

	private $ar_Con;

	/******************** Funcion Conectar ************************************************************************/
	/* Funcion que se utiliza para la conexion 																  */
	/**************************************************************************************************************/
	protected function f_Con(){
		$ls_Serv="sql308.epizy.com";
		$ls_Usr="epiz_22051112";
		$ls_Pass="v21057251";
		$ls_Bd="epiz_22051112_v3enraya";
		$this->ar_Con=new mysqli($ls_Serv,$ls_Usr,$ls_Pass,$ls_Bd);
		if ($this->ar_Con->connect_errno) {
	    echo "Lo siento, este sitio web está experimentando problemas.";

	    echo "Error: Fallo al conectarse a MySQL debido a: \n";
	    echo "Errno: " . $this->ar_Con->connect_errno . "\n";
	    echo "Error: " . $this->ar_Con->connect_error . "\n";

	    exit;
		}
	}

	/******************** Funcion Ejecutar ****************************************/
	/* esta funcion es la encargada de ejecutar las sentencias SQL pasadas como   */
	/* parametro a la funcion y regresar si los ejecuto o no 					  */
	/******************************************************************************/
	protected function f_Ejecutar($ps_Sql){
		return $this->ar_Con->query($ps_Sql);
	}

	/******************** Funcion Filtro ******************************************/
	/* este funcion se encarga realizar las busquedas y retornar el resultado de  */
	/* misma 																	  */
	/******************************************************************************/
	protected function f_Filtro($ps_Sql){
		return $this->ar_Con->query($ps_Sql);
	}

	/******************** Funcion Arreglo *****************************************/
	/* esta funcion se encarga realizar la transformacion de un resultado query   */
	/* en un arreglo asosiativo													  */
	/******************************************************************************/
	protected function f_Arreglo($pr_Tabla){
		 return $pr_Tabla->fetch_assoc();
	}

	/******************** Funcion Cierra  *****************************************/
	/* esta funcion cierra o elimina el resultado de la busqueda para evitar      */
	/* perdida de informacion													  */
	/******************************************************************************/
	protected function f_Cierra($pr_Tabla){
		$pr_Tabla->free();
	}

	/******************** Funcion Desconectar *************************************/
	/* esta funcion cierra la coneccion o Desconecta 						      */
	/******************************************************************************/
	protected function f_Des(){
		$this->ar_Con->close();
	}

	/******************** Funcion Ultimo Id ***************************/
	/* esta funcion retorna el id del ultimo insert 						      */
	/******************************************************************/
	protected function f_ultimo_id(){
		return $this->ar_Con->insert_id;
	}

	/******************** Funcion Registros   *************************************/
	/* esta funcion retorna cantidad de filas devueltas en un query			      */
	/******************************************************************************/
	protected function f_Registro($pr_tabla){
	    return $pr_Tabla->num_rows;
  }

	/******************** Funcion error *******************************************/
	/* funcion para obtener el ultimo error  																			*/
	/******************************************************************************/
	protected function f_Error(){
		 return $this->ar_Con->error;
	}
}

?>
