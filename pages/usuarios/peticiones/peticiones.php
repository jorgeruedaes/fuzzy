<?php
session_start();
include('../../../php/usuario.php');

if(isset($_SESSION['id_usuarios']))
{
	$resultado = '{"salida":true,';
	$bandera = $_POST['bandera'];


	if ($bandera === "modificar-password") {
		$password = $_POST['password'];
		$query = Boolean_Set_Password($password,$_SESSION['id_usuarios']);
		if ($query) {
			$resultado.='"mensaje":true';
		} else {
			$resultado.='"mensaje":false';
		}
	}
	else if($bandera === "guardar-datos") {
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$pregunta = $_POST['pregunta'];
		$respuesta = $_POST['respuesta'];
		$query = Boolean_Set_Usuario($nombre,$apellido,$email,$pregunta,$respuesta,$_SESSION['id_usuarios']);
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