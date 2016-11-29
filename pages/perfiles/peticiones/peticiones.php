<?php
session_start();
include('../../../php/consultas.php');
include('../../../php/perfil.php');

if(isset($_SESSION['id_usuarios']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];

// Modifica uno de los perfiles de usuario.
	if ($bandera === "modificar") {
		$perfil = $_POST['nombre'];
		$nivel = $_POST['nivel'];
		$id_perfiles = $_POST['id_perfiles'];
		$query = Boolean_Set_Perfil($perfil,$nivel,$id_perfiles);
		if ($query) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	// Guarda los datos de un nuevo perfil.
	else if($bandera === "nuevo") {

		$perfil = $_POST['nombre'];
		$nivel = $_POST['nivel'];
		$descripcion = $_POST['descripcion'];

		$id_perfiles = $_POST['id_perfiles'];
		$query = Boolean_New_Perfil($nombre,$nivel,$descripcion);
		if ($query) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	// Permite Eliminar un perfil de usuario.
	else if($bandera === "eliminar") {
		$id_perfiles = $_POST['id_perfiles'];
		$query = Boolean_Delete_Perfil($id_perfiles);
		if ($query) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	// Permite modificar los permisos que tiene un perfil sobre los modulos.
	else if($bandera === "modificar-permisos") {
		$json = json_encode($_POST['json']); 
		$query =Boolean_Set_PerfilxModulos($json,$id_perfiles);
		if ($query) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
}
else
{
	$resultado = '{"salida":false';
}
$resultado.='}';
echo ($resultado);
?>