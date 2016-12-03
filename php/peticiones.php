<?php
session_start();
include('consultas.php');
include('usuario.php');
$resultado = '{"salida":true,';
$bandera = $_POST['bandera'];


// Permite guardar el nuevo usuario en la BD.
if ($bandera === "guardar") {

	$nombre = $_POST['nombre'];
	$apeliido = $_POST['apellido'];
	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$pregunta = $_POST['pregunta'];
	$respuesta = $_POST['respuesta'];
	$email = $_POST['email'];

	list ($query,$mensaje) = Boolean_Insertar_Usuario($nombre,$apellido,$username,$password,$pregunta,$respuesta,$email);	

	if ($query) {
		$resultado.='"mensaje":true';
		$resultado.=',"comentario":'.$mensaje.'';
	} else {
		$resultado.='"mensaje":false';
		$resultado.=',"comentario":'.$mensaje.'';
	}
}
// Permite saber si se puede o no registrar el nuevo usuario con ese nombre y email.
else if($bandera === "validar-usuario") {
	$email = $_POST['email'];
	$username = $_POST['username'];
	list($query,$mensaje) = Boolean_Existencia_Usuario($username,$email); 
	if ($query) {
		$resultado.='"mensaje":false';
		$resultado.=',"comentario":'.$mensaje.'';
	} else {
		$resultado.='"mensaje":true';
	}
	// Permite recuperar la contraseña
}else if($bandera === "recuperar") {
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
	// Valida la respuesta del usuario.
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
// Permite crear una nueva contraseña.
else if($bandera === "nueva") {
	$password = $_POST['password'];
	$query = Boolean_Set_Password($password,$_SESSION['valido']);
	if ($query) {
		$_SESSION['recuperada']='Si';
		header("location:../pages/recuperada.php");
	} else {
		session_destroy();
		header("location:../pages/error.php");
	}
}
// Permite el inicio de sesión.
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
			$_SESSION['Id']=Int_New_Sesion($values['id_usuarios']);
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