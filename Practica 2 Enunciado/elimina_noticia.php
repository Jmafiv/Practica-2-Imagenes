<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Eliminar noticia</title>
</head>
<body>
    
    <h1>Eliminación de noticias</h1>
    <form action="elimina_noticia_seleccionada.php" method="post">
        <?php
            session_start();
            $conexion = mysqli_connect("localhost","root","","lindavista");
            $conexion->set_charset("utf8");
            $SQL = "SELECT * FROM noticias";
            $resultado = $conexion->query($SQL);

            echo '<table>';
            echo '<tr class="encabezado"><th>Titulo</th><th>Texto</th><th>Categoria</th><th>Fecha</th><th>Imagen</th><th>Borrar</th></tr>';
            while($fila = $resultado -> fetch_array()){
                extract($fila);
                echo '<tr class="filas">';
                    echo '<td>'.$titulo.'</td>';
                    echo '<td>'.$texto.'</td>';
                    echo '<td>'.$categoria.'</td>';
                    echo '<td>'.$fecha.'</td>';
                    echo '<td align="center"><a href="imagenes/'.$id.'.jpg"><img src="imagenes/thumbs/'.$id.'.jpg"></a></td>';
                    echo '<td>
                              <input type="checkbox" name="seleccionado[]" value="'.$id.'">
                              <input type="hidden" name="id[]" value="'.$id.'">
                              <input type="hidden" name="titulo[]" value="'.$titulo.'">
                              <input type="hidden" name="texto[]" value="'.$texto.'">
                              <input type="hidden" name="categoria[]" value="'.$categoria.'">
                              <input type="hidden" name="fecha[]" value="'.$fecha.'">
                          </td>';
                echo '</tr>';
            }
            echo '</table>';
        ?>
        <br>
        <input type="submit" value="Eliminar noticias marcadas">
        <br>
        <br>
        [ <a href="login.php">Menu Principal</a> ]
    </form>
</body>
</html>
