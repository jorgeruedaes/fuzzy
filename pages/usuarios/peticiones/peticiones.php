<?php
session_start();
include('../../../php/principal.php');
include('../../../php/usuario.php');

$id_modulos ="16";
if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];
	if ($bandera === "eliminar") {
		$id_usuarios = $_POST['id_usuarios'];
		$query = modificar("UPDATE `tb_usuarios` SET `estado`='inactivo' WHERE id_usuarios=$id_usuarios");
		if ($query) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	else if($bandera === "modificar") {
		$id_usuarios = $_POST['id_usuarios'];
		$estado = $_POST['estado'];
		$id_perfiles = $_POST['id_perfiles'];
		$query = modificar("UPDATE `tb_usuarios` SET `estado`='$estado', `perfil` =$id_perfiles WHERE id_usuarios=$id_usuarios");
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