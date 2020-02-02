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

    
    [ <a href="inserta_noticia.php">Insertar otra noticia</a> | <a href="login.php">Menú Principal</a> ]
    <?php


        $conexion = mysqli_connect('localhost', 'root', '') or die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($conexion,'lindavista') or die(mysqli_error($conexion));

        $dir="imagenes";
        $thumbdir = $dir . '/thumbs';
    
        if ($_FILES['uploadImagen']['error'] != UPLOAD_ERR_OK){
            switch ($_FILES['uploadImagen']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    die('Tamaño máximo del archivo no soportado.' );
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    die('El tamaño  del archivo cargado excede el permitido por la directiva  MAX_FILE_SIZE establecida en  el formulario HTML.');
                    break;
                case UPLOAD_ERR_PARTIAL:
                    die('El archivo se ha cargado parcialmente ');
                    break;
                case UPLOAD_ERR_NO_FILE:
                    die('No ha cargado ningún archivo');
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    die('No se encuentra el directorio temporal del servidor ');
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    die('El servidor ha fallado al intentar escribir el archivo en el disco');
                    break;
                case UPLOAD_ERR_EXTENSION:
                    die('Subida detenida por la extensión');
                    break;
            }
        }

        $caption = substr($_FILES['uploadImagen']['name'], 0, -4);
        $image_date = @date('Y-m-d');
        list($width, $height, $type, $attr) = getimagesize($_FILES['uploadImagen']['tmp_name']);

        $error = 'Tipo de archivo no soportado (debe ser GIF, JPEG o PNG)';
        switch ($type) {
        case IMAGETYPE_GIF:
            $image = imagecreatefromgif($_FILES['uploadImagen']['tmp_name']) or
                die($error);
            break;
        case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($_FILES['uploadImagen']['tmp_name']) or
                die($error);
            break;
        case IMAGETYPE_PNG:
            $image = imagecreatefrompng($_FILES['uploadImagen']['tmp_name']) or
                die($error);
            break;
        default:
            die($error);
        }

        $fecha = date('Y-m-d');
        $SQL = "INSERT INTO `noticias`(`titulo`, `texto`, `categoria`, `fecha`) VALUES ('".$_POST['titulo']."','".$_POST['texto']."','".$_POST['categoria']."','".$fecha."')";
        mysqli_query($conexion, $SQL);

        $SQL = "SELECT MAX(id) AS id FROM noticias";
        $rset = mysqli_query($conexion, $SQL);
        $row = mysqli_fetch_assoc($rset);
        $IDimag = str_pad($row['id'], 8, 0, STR_PAD_LEFT);

        $SQL = "INSERT INTO `images`(`image_id`, `image_caption`, `image_username`) VALUES ('".$IDimag."','".$caption."','".$_SESSION['usuario']."')";
        $rset = mysqli_query($conexion, $SQL);

        $last_id = mysqli_insert_id($conexion);
        $image_id = $last_id;
        imagejpeg($image, $dir.'/'.$IDimag.'.jpg');

        $thumb_width = $width * 0.10;
        $thumb_height = $height * 0.10;

        $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
        imagecopyresampled($thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height,$width, $height);
        imagejpeg($thumb, $thumbdir.'/'.$IDimag.'.jpg', 100);
        imagedestroy($thumb);
        imagedestroy($image);

    ?>

    <br><h1>Gestión de noticias</h1>
    <h2><i>Resultado de insertar una nueva notícia</i></h2>
    <br>La noticia ha sido creada correctamente:<br><br>
    <ul>
        <li>Título: <?= $_POST['titulo'] ?></li>
        <li>Texto: <?= $_POST['texto'] ?></li>
        <li>Categoría: <?= $_POST['categoria'] ?></li>
        <li>Fecha: <?= date('Y-m-d'); ?></li>
        <li>Imagen: <?= $_FILES['uploadImagen']['name'] ?></li>
    </ul>

</body>
</html>