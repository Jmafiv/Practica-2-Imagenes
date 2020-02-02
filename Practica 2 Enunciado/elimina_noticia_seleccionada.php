<?php
session_start();
$conexion = mysqli_connect("localhost","root","","lindavista");
$conexion->set_charset("utf8");
extract($_POST);
echo "<h1>Eliminación de noticias</h1>";
echo "Noticias eliminadas:";
foreach ($seleccionado as $indice => $valor) {
    foreach ($id as $indice2 => $valor2) {
        if($valor == $valor2){
            echo "<ul>";
                echo "<li>Titulo: ".$titulo[$indice2]."</li>";
                echo "<li>Texto: ".$texto[$indice2]."</li>";
                echo "<li>Categoría: ".$categoria[$indice2]."</li>";
                echo "<li>Fecha: ".$fecha[$indice2]."</li>";
                echo "<li>Imagen: ".$id[$indice2].".jpg</li>";
            echo "</ul>";
            echo "<hr>";

            unlink('imagenes/'.$id[$indice2].'.jpg');
            unlink('imagenes/thumbs/'.$id[$indice2].'.jpg');

            $SQL = "DELETE FROM `noticias` WHERE `id` = '".$id[$indice2]."'";
            $conexion->query($SQL);

            $idCorto = ltrim($id[$indice2], '0');
            $SQL = "DELETE FROM `images` WHERE `image_id` = '".ltrim($idCorto, '0')."'";
            $conexion->query($SQL);
        }
    }
}
echo "Número de noticias eliminadas: ".count($seleccionado);
?>
<p>[ <a href="elimina_noticia.php">Eliminar otra noticia</a> | <a href="login.php">Menú Principal</a> ]</p>