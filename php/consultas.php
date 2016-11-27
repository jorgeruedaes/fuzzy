<?php
require('conexion.php');
/**
 * [escape Permite escapar paramtros dentro de una función]
 * @param  [type] $parametro [Parametro a escapar]
 * @return [type]            [description]
 */
function escape($parametro)
{
	global $conexion;
	return	mysqli_real_escape_string($conexion,$parametro);
}
/**
 * [consultar esta funcion permite realizar consultas en la BD]
 * @param  [String] $query [Consulta SQL]
 * @return [Result]        [Resultado de la consulta]
 */
function consultar($query)
{
	global $conexion;
	return mysqli_query($conexion,$query);

	
}
/**
 * [modificar Modifica informacion de la base de datos]
 * @param  [type] $query [Consulta SQL]
 * @return [type]        [description]
 */
function modificar($query)
{
	global $conexion;

	return mysqli_query($conexion,sprintf($query));

	
}
/**
 * [eliminar Elimina algun valor de la base de datos]
 * @param  [type] $query [Consulta SQL]
 * @return [type]        [description]
 */
function eliminar($query)
{
	global $conexion;

	return mysqli_query($conexion,sprintf($query));

	}

/**
 * [insertar Permite registrar en la base de datos]
 * @param  [type] $query [Consulta SQL]
 * @return [type]        [description]
 */
	function insertar($query)
{
	global $conexion;

	return mysqli_query($conexion,sprintf($query));

	
}
/**
 * [Boolean_consultaVacia Ayuda establecer si una consulta tiene resultados]
 * @param [type] $consulta [Consulta SQL]
 */
	function Int_consultaVacia($consulta)
{
	return mysqli_num_rows($consulta);
}




?>