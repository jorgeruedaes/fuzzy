<?php

/**
 * [Array_Get_Usuario Obtiene los datos no sencibles del usuario]
 * @param [Integer] $usuario [Identificador del Usuario]
 */
function Array_Get_Usuario($usuario)
{

	$usuario = consultar("SELECT `id_usuarios`,`nombre`, `apellido`, `perfil`, `email`, `estado`,pregunta,respuesta FROM `tb_usuarios` WHERE id_usuarios=$usuario ");
	while ($valor = mysqli_fetch_array($usuario)) {
		$id_usuarios = $valor['id_usuarios'];
		$nombre       = $valor['nombre'];
		$apellido          = $valor['apellido'];
		$perfil          = $valor['perfil'];
		$email        = $valor['email'];
		$estado        = $valor['estado'];
		$pregunta   = $valor['pregunta'];
		$respuesta = $valor['respuesta'];
		$datos = array(
			'id_usuarios'=>"$id_usuarios",
			'nombre' => "$nombre",
			'apellido' => "$apellido",
			'perfil' => "$perfil",
			'email' => "$email",
			'estado' => "$estado",
			'pregunta' => "$pregunta",
			'respuesta' => "$respuesta"
			);
	}

	return $datos;	
}

/**
 * [String_Get_Nombre Obtiene el nombre completo del usuario]
 * @param Integer $usuario [Codigo identificador del usuario]
 */
function String_Get_Nombre($usuario)
{
	$usuario = consultar("SELECT `nombre`, `apellido` FROM `tb_usuarios` WHERE id_usuarios=$usuario"); 
	while ($valor = mysqli_fetch_array($usuario)) {
		return $valor['nombre']." ".$valor['apellido'];
	}
}

/**
 * [Array_Get_Usuarios Retorna el grupo de usuarios editables o modificables]
 */
function Array_Get_Usuarios($perfil)
{
	if($perfil==3)
	{
		$usuario = consultar("SELECT `id_usuarios`,`nombre`, `apellido`, `perfil`, `email`, `estado` FROM `tb_usuarios`");
	}

	else
	{
		$usuario = consultar("SELECT `id_usuarios`,`nombre`, `apellido`, `perfil`, `email`, `estado` FROM `tb_usuarios` WHERE perfil!=3  ");	
	}	
	$datos = array();
	while ($valor = mysqli_fetch_array($usuario)) {
		$id_usuarios = $valor['id_usuarios'];
		$nombre       = $valor['nombre'];
		$apellido          = $valor['apellido'];
		$perfil          = $valor['perfil'];
		$email        = $valor['email'];
		$estado        = $valor['estado'];
		$vector = array(
			'id_usuarios'=>"$id_usuarios",
			'nombre' => "$nombre",
			'apellido' => "$apellido",
			'perfil' => "$perfil",
			'email' => "$email",
			'estado' => "$estado"
			);
		array_push($datos, $vector);
	}

	return $datos;	
}
/**
 * [Array_Get_Perfiles Obtiene los nombres de los perfiles]
 * @param [type] $perfil [Codigo que identifica el perfil para saber cuales debo o no mostrar]
 */
function Array_Get_Perfiles($perfil)
{
	if($perfil=='3')
	{
		$perfiles = consultar("SELECT * FROM `tb_perfiles`");
	}
	else
	{
		$perfiles = consultar("SELECT * FROM `tb_perfiles` WHERE id_perfiles!=3");
	}
	$datos = array();
	while ($valor = mysqli_fetch_array($perfiles)) {
		$id_perfiles = $valor['id_perfiles'];
		$nombre       = $valor['nombre'];
		$descripcion          = $valor['descripcion'];
		$nivel          = $valor['nivel'];
		$vector = array(
			'id_perfiles'=>"$id_perfiles",
			'nombre' => "$nombre",
			'descripcion' => "$descripcion",
			'nivel' => "$nivel"
			);
		array_push($datos, $vector);
	}

	return $datos;	

}
/**
 * [String_Get_Nombre_Perfil Obtiene los nombres de los perfiles]
 * @param [type] $perfil [Codigo que identifica el perfil]
 */
function String_Get_Nombre_Perfil($perfil)
{
	$usuario = consultar("SELECT * FROM `tb_perfiles` WHERE id_perfiles=$perfil"); 
	while ($valor = mysqli_fetch_array($usuario)) {
		return $valor['nombre'];
	}	
}
/**
 * [Array_Get_Listado_Perfiles Obtengo el listado de los perfiles disponibles en la pagina]
 * @param [type] $perfil [Perfil con el cual se accedio con el fin de establer cuales perfiles mostrar]
 */
function Array_Get_Listado_Perfiles($perfil)
{
	if($perfil!=3)
	{
		$perfiles = consultar("SELECT * FROM `tb_perfiles` WHERE id_perfiles!=3 ORDER BY nivel");
	}
	else
	{
		$perfiles = consultar("SELECT * FROM `tb_perfiles` ORDER BY nivel");	
	}

	$datos = array();
	while ($valor = mysqli_fetch_array($perfiles)) {
		$id_perfiles = $valor['id_perfiles'];
		$nombre       = $valor['nombre'];
		$descripcion          = $valor['descripcion'];
		$nivel          = $valor['nivel'];
		$vector = array(
			'id_perfiles'=>"$id_perfiles",
			'nombre' => "$nombre",
			'descripcion' => "$descripcion",
			'nivel' => "$nivel"
			);
		array_push($datos, $vector);
	}

	return $datos;	
}
/**
 * [Int_Get_nuevosUsuarios Obtiene la cantidad de nuevos usuarios]
 */
function Int_Get_nuevosUsuarios()
{
	$usuario = consultar("SELECT * FROM `tb_usuarios` WHERE estado='procesando'  ");
	return mysqli_num_rows($usuario);
}

/**
 * [JSON_Get_ModulosxPerfil Permite obtener los modulos asignados a un perfil]
 * @param [type] $perfil [perfil de usuario para obtener permisos]
 */
function JSON_Get_ModulosxPerfil($perfil)
{
	$perfiles = consultar("SELECT * FROM tr_modulosxperfiles WHERE id_perfiles=$perfil ");
	$datos = array();
	while ($valor = mysqli_fetch_array($perfiles)) {
		$id_perfiles = $valor['id_perfiles'];
		$id_modulos       = $valor['id_modulos'];
		$vector = $id_modulos;
		array_push($datos, $vector);
	}

	return json_encode($datos,JSON_HEX_TAG);	
}
?>