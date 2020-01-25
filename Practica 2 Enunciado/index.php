<!DOCTYPE html>
<html>
<head>
	<title>Gestion de Noticias. Página principal</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<p>Esta zona tiene el acceso restringido.<br>Para entrar debe identificarse</p>
	<div id="caja">
		<form action="login.php" method="post">
		<div id="izquierda">
			Usuario: <br><br>
			Clave: <br><br>
		</div>
		<div id="derecha">
			<input type="text" name="txtUsuario"><br><br>
			<input type="text" name="txtClave"><br><br>
		</div>
			<input type="submit" name="btnEntrar" value="Entrar">
		</form>
	</div>
	<p>NOTA: Si no dispone de identificación o tiene problemas para entrar<br>póngase en contact con el <a href="#" title="administrador">administrador</a> del sitio</p>
</body>
</html>
<?php
session_start();
unset($_SESSION);
session_destroy();
?>