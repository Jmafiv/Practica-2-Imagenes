<!DOCTYPE html>
<html>
<head>
	<title>Gestión de Noticias. Menú</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

</body>
</html>
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
		if (!isset($_SESSION["tipo"]))
		{
			$_SESSION["usuario"] = "invitado";
			$_SESSION["clave"] = "invitado";
			$_SESSION["tipo"] = "invitado";
		}
	}
}
echo "<h1>Gestión de noticias</h1><hr>";
echo "<ul>
		<li><a href='consulta_noticias.php' title='Consultar'>Consultar noticias</a></li>";
if ($_SESSION["tipo"] == 'Usuario' || $_SESSION["tipo"] == 'Administrador')
{
	echo "<li><a href='inserta_noticia.php' title='Insertar'>Insertar nueva noticia</a></li>";
}
if ($_SESSION["tipo"] == 'Administrador')
{
	echo "<li><a href='elimina_noticia.php' title='Eliminar'>Eliminar noticias</a></li>";
}
echo "</ul><hr>";
echo "[ <a href='index.php' title='Desconectar'>Desconectar</a> ]";
?>