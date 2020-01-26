<!DOCTYPE html>
<html>
<head>
	<title>Gestión de noticias - Insertar noticia</title>
	<link rel="stylesheet" href="style.css">
	<meta charset="utf-8">
</head>
<body>
<?php
if (!isset($_POST["btnInsertar"]))
{
?>
	<h1>Gestión de noticias</h1>
	<h2><em>Insertar nueva noticia</em></h2>
	<div id="cajaInsertar">
		<form method="post">
			<b>Título: *</b><input type="text" name="txtTitulo" size="50">
			<br><br>
			<b>Texto: *</b><br><textarea name="areaTexto" cols="40" rows="4"></textarea><br><br>
			<b>Categoría:</b><select name="categoria">
								<option value="costas">costas</option>
								<option value="promociones">promociones</option>
								<option value="ofertas">ofertas</option>
							  </select><br><br>
			<b>Imagen:</b> <input type="file" name="imagen"><br><br>
			<input type="hidden" name="fecha" <?php $date=date("d/m/Y"); echo "value=$date";?>>
			<input type="submit" name="btnInsertar">
		</form>
	</div>
<?php
}
else
{
extract($_POST);
session_start();
$conexion = mysqli_connect("localhost","root","","lindavista");
$conexion->set_charset("utf8");
$sql = "INSERT INTO noticias (titulo, texto, categoria, fecha) VALUES ('$txtTitulo', '$areaTexto', '$categoria', $fecha)";

if ($conexion->query($sql))
{
	
	echo "<h1>Gestión de noticias</h1><h2>Resultado de la inserción de nueva noticia</h2>La noticia ha sido recibida correctamente:";
	echo "<ul>
		  <li>Título: $txtTitulo</li>
		  <li>Texto: $areaTexto</li>
		  <li>Categoría: $categoria</li>
		  <li>Fecha: $fecha</li>
		  <li>Imagen: $imagen</li>
	</ul>";
	echo "<br>[ <a href='inserta_noticia.php' title='Insertar otra'>Insertar otra noticia</a> | <a href='login.php' title='Volver'>Menu principal</a> ]";
}
else
{
	echo $sql."<br>".$conexion->error;
}

}
?>







</body>
</html>