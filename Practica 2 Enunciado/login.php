<?php 
session_start();
$conexion = mysqli_connect("localhost","root","","lindavista");
$conexion->set_charset("utf8");
$sql = "SELECT * FROM usuarios";
$result = $conexion->query($sql);

if (isset($_POST["btnEntrar"]))
{
	extract($_POST);
	while ($fila = mysqli_fetch_assoc($result))
	{
		extract($fila);
		// Usuario y Administrador
		if ($txtUsuario == $usuario && $txtClave == $clave)
		{
			$_SESSION["usuario"] = $usuario;
			$_SESSION["clave"] = $clave;
			$_SESSION["tipo"] = $tipo_usuario;
		}
		// Invitado 'No logueado'
		else
		{
			$_SESSION["usuario"] = "invitado";
			$_SESSION["clave"] = "invitado";
			$_SESSION["tipo"] = "invitado";
		}
	}

	print_r($_SESSION);
}




?>