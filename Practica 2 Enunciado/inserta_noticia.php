<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Insertar noticia</title>
</head>
<body>
    
    <h1>Gestión de noticias</h1>
    <h2><i>Insertar una nueva noticia</i></h2>
    <div id="cajaInsertar">
    <form action="inserta_noticia_resultado.php" method="post" enctype="multipart/form-data">
        <div>
            <b>Título:</b><input type="text" name="titulo" size="50" required><br><br>
            <b>Texto:</b><br>
            <textarea name="texto" cols="30" rows="4" required></textarea><br><br>
            <b>Categoría: </b>
                <select name="categoria">
                    <option value="costas">costas</option>
                    <option value="promociones">promociones</option>
                    <option value="ofertas">ofertas</option>
                </select><br><br>
            <b>Imagen: </b><input type="file" name="uploadImagen"><br><br>
            <br><br>
            <input type="submit" name="botonSubmit" value="Insertar Noticia">
        </div>
    </form>
     </div>
    <br>
    [ <a href="login.php">Menu Principal</a> ]
    

</body>
</html>