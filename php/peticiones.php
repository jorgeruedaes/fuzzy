<?php
session_start();
include('consultas.php');

$resultado = '{"salida":true,';
$bandera = $_POST['bandera'];
if ($bandera === "guardar") {
	$id_usuarios = $_POST['id_usuarios'];
	$query = ingresar("");
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
else if($bandera === "recuperar") {
	$email = $_POST['email'];
	$query = consultar(sprintf("SELECT  id_usuarios,pregunta FROM `tb_usuarios` WHERE email='%s'",escape($email)));
	$values = mysqli_fetch_array($query);
	if (Int_consultaVacia($query)>0) {
		$_SESSION['usuario']=$values['id_usuarios'];
		$_SESSION['pregunta']=$values['pregunta'];
		header("location:../pages/preguntas.php");
	} else {
		session_destroy();
		header("location:../pages/error.php");
	}
}else if($bandera === "validar-respuesta") {
	$respuesta = $_POST['respuesta'];
	$query = consultar(sprintf("SELECT id_usuarios FROM `tb_usuarios` WHERE id_usuarios='%d' and respuesta= '%s' ",escape($_SESSION['usuario']),escape($respuesta)));
	if (Int_consultaVacia($query)>0) {
		$_SESSION['valido']=$_SESSION['usuario'];
		header("location:../pages/nuevacontrasena.php");
	} else {
		session_destroy();
		header("location:../pages/error.php");
	}
}
else if($bandera === "nueva") {
	$contraseña = $_POST['password'];
	$contraseña  =	password_hash($contraseña, PASSWORD_BCRYPT);
	$query = consultar(sprintf("UPDATE `tb_usuarios` SET contraseña='%s' WHERE id_usuarios='%d'",escape($contraseña),escape($$_SESSION['valido'])));
	if ($query) {
		$_SESSION['recuperada']='Si';
		header("location:../pages/recuperada.php");
	} else {
		session_destroy();
		header("location:../pages/error.php");
	}
}
else if($bandera === "conectar") {
	$contraseña= $_POST['password'];
	$usuario = $_POST['username'];
	$usuario_resgistrado=consultar(sprintf("SELECT id_usuarios,perfil,contraseña FROM tb_usuarios WHERE (usuario='%s' or email='%s') and estado='activo' ",escape($usuario),escape($usuario)));
	if(Int_consultaVacia($usuario_resgistrado)>0){
		$values=mysqli_fetch_array($usuario_resgistrado);
		if (password_verify($contraseña,$values['contraseña']))
		{
			session_start();
			$_SESSION['id_usuarios']=$values['id_usuarios'];
			$_SESSION['perfil']=$values['perfil'];
			header("location:../pages/administracion.php");
		}else{
			header("location:../pages/error.php");
		}
	}else{
		header("location:../pages/error.php");
	}
}


$resultado.='}';
echo ($resultado);
?>