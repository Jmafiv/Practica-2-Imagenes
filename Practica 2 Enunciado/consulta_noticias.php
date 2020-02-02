<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Consulta noticias</title>
</head>
<body>
    <h1>Consulta de noticias</h1>
    <hr/>
    <?php
        session_start();
        $conexion = mysqli_connect("localhost","root","","lindavista");
        $conexion->set_charset("utf8");
        $SQL = "SELECT * FROM noticias";
        $resultado = $conexion->query($SQL);

        echo "Numero de resultados encontrados: ".mysqli_num_rows($resultado);
        echo '<br/><br/>';
        echo '<table>';
        echo '<tr class="encabezado"><th>Titulo</th><th>Texto</th><th>Categoria</th><th>Fecha</th><th>Imagen</th></tr>';
        while($fila = $resultado -> fetch_array()){
            extract($fila);
            echo '<tr class="filas">';
                echo '<td>'.$titulo.'</td>';
                echo '<td>'.$texto.'</td>';
                echo '<td>'.$categoria.'</td>';
                echo '<td>'.$fecha.'</td>';
                echo '<td align="center"><a href="imagenes/'.$id.'.jpg"><img src="imagenes/thumbs/'.$id.'.jpg"></a></td>';
            echo '</tr>';
        }
        echo '</table>';

    ?>  
    <br>
    [ <a href="login.php">Menu Principal</a> ]

</body>
</html>