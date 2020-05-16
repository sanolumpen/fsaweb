<?php

require_once dirname(__DIR__)."/controlador/cNoticias.php";
$noticia = new CNoticia();
$img = "";
$tablaBusqueda;

if (isset($_POST['btnGuardar'])) {
    $descrip = $_POST['txtContenido'];
    $descrip = str_replace(PHP_EOL,'<br>', $descrip);
    $img = str_replace(' ', '-','images/' . $_FILES['archivo']['name']);
    $insert = $noticia->insertarN(
        $_POST['txtTitulo'],
        $descrip,
        strval($img),
        $_POST['txtAutor']
    );
    //this if storage the image of the form in images folder
    if ($insert == true) {

        $archivo = $_FILES['archivo']['name'];
        //Si el archivo contiene algo y es diferente de vacio
        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
            } else {
                //Si la imagen es correcta en tamaño y tipo
                //Se intenta subir al servidor
                if (move_uploaded_file($temp, 'images/' . $archivo)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    chmod('images/' . $archivo, 0777);
                    //Mostramos el mensaje de que se ha subido co éxito
                    echo '<div><b>Se ha subido correctamente la imagen.  </b><a href="log.php?vista=vNoticias"><button class="btn btn-danger">Recargar</button></a></div>';
                    //Mostramos la imagen subida
                    echo '<p><img src="images/' . $archivo . '"></p>';
                } else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                }
            }
        }
        // header("Location: index.php?vista=vNoticias");
    } else {
        // header("Location: index.php?vista=vNoticias");
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<h3>Hubo un error al procesar la solicitud, intenta de nuevo</h3>";
        echo $insert;
    }
}


//Buscar noticia
if (isset($_POST['btnBuscar'])) {

    if ($_POST['txtTituloB'] != "") {
        $tablaBusqueda = $noticia->listarNTi($_POST['txtTituloB']);
    }elseif($_POST['txtFechaB'] != "")
    {
        $tablaBusqueda = $noticia->listarNFe($_POST['txtFechaB']);
    }elseif($_POST['txtFechaB'] != "" && $_POST['txtTituloB'] != "")
    {
        $tablaBusqueda = $noticia->listarNTiFe($_POST['txtTituloB'],$_POST['txtFechaB']);
    }else{
        $tablaBusqueda = $noticia->listarN();
    }
}
if(isset($_POST['btnEliminar']))
{
    $noticia->eliminarN($_POST['txtIdEli']);
}
?>
<div class="container" data-spy="scroll" data-target=".navbar" data-offset="50">

    <!-- The navbar - The <a> elements are used to jump to a section in the scrollable area -->

    <div class="panel" style="background-color:#c82e46;">
        <div class="panel-header" style="background-color:#c82e46;">
            <div class="panel-title">
                <center>
                    <h3>Creación de Noticias</h3>
                    <p><b>NOTA:</b> para dar formato al texto puede usar etiquetas de html<br>tales como:"b" o "i" entre otras de formato de texto</p>
                </center>
            </div>
        </div>
        <!-- Formulario action="./upload/subirArchivo.php" -->
        <!-- this form upload news to server -->
        
        <div class="panel-body" style="background-color:#555;">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Título</label>
                    <input type="text" class="form-control" name="txtTitulo" id="txtTitulo" placeholder="Título de la noticia">
                    <label for="">Contenido</label>
                    <textarea class="form-control" name="txtContenido" id="txtContenido" placeholder="Cuerpo de la noticia"></textarea>
                    <label for="">Autor</label>
                    <input type="text" class="form-control" name="txtAutor" id="txtAutor" placeholder="Nombre del Autor">
                    <label for="">Imagen</label>
                    <input name="archivo" 1 id="archivo" type="file" />
                </div>
                <div class="form-group">
                    <button type="reset" class="btn btn-danger">Limpiar</button>
                    <button type="submit" name="btnGuardar" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- this form is for editing the news, filter them in time and title -->
    <div class="panel" style="background-color:#c82e46;">
        <div class="panel-header" style="background-color:#c82e46;">
            <div class="panel-title">
                <center>
                    <h3>Edición de Noticias</h3>
                </center>
            </div>
        </div>
        <!-- Formulario action="./upload/subirArchivo.php" -->
        <div class="panel-body" style="background-color:#555;">
            <form action="?vista=vNoticias" method="post">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label for="">Buscar Título</label>
                            <input type="text" class="form-control" name="txtTituloB" id="txtTituloB" placeholder="Título de la noticia">
                        </div>
                        <div class="col-md-6">
                            <label for="">Buscar Fecha</label>
                            <input type="text" class="form-control" name="txtFechaB" id="txtFechaB" placeholder="AAAA/MM/DD">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="reset" class="btn btn-danger">Limpiar</button>
                    <button type="submit" name="btnBuscar" class="btn btn-success">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- list the news and the operations aplicables -->
    <?php if (!empty($tablaBusqueda)) : ?>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">

                        <table id="datatable" class="table table-striped table-bordered text-center" style="width:100%">
                            <thead style="background-color:#00bb6b;">
                                <tr>
                                    <th>Título</th>
                                    <th>Contenido</th>
                                    <th>Imágen</th>
                                    <th>Autor</th>
                                    <th>Fecha</th>
                                    <th>Gestionar</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($tablaBusqueda as $key => $value) : ?>
                                    <tr style="background-color:#555555;">
                                        <td><?php echo $value['titulo']; ?></td>
                                        <td><button onclick="desc('<?php echo $value['descripcion']; ?>');" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDes">
                                                <i class="fa fa-eye"></i> </button></td>
                                        <td><button onclick="imag('<?php echo $value['imagen']; ?>');" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalImg">
                                                <i class="fa fa-eye"></i> </button></td>
                                        <td><?php echo $value['autor']; ?></td>
                                        <td><?php echo $value['fecha']; ?></td>
                                        <td>
                                            <button onclick="ed('<?php echo $value['idNoticia']; ?>','<?php echo addslashes($value['titulo']); ?>',
                                            '<?php echo addslashes($value['descripcion']); ?>','<?php echo addslashes($value['imagen']); ?>',
                                            '<?php echo addslashes($value['autor']); ?>')" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalE">
                                                <i class="fa fa-edit"></i> </button>
                                            <button onclick="el('<?php echo $value['idNoticia']; ?>')" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEL">
                                                <i class="fa fa-trash"></i> </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
<!-- Modal de Descripción -->
<div id="modalDes" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bb6b;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Descripción</h4>
            </div>
            <div class="modal-body" style="background-color:#555555;">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1" id="resultadoDesc">

                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#555555;">
                <button onclick="limpiar()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal de Imagen -->
<div id="modalImg" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bb6b;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Imágen</h4>
            </div>
            <div class="modal-body" style="background-color:#555555;">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1" id="resultadoImg">
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#555555;">
                <button onclick="limpiar()" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- Modal de Edición -->
<div id="modalE" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bb6b;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Gestion de Noticias</h4>
            </div>
            <div class="modal-body" style="background-color:#555555;">
                <div class="row">
                    <form action="" method="POST">
                        <div class="col-md-10 col-md-offset-1">
                            <input type="text" name="txtIdE" id="txtIdE">
                            <label for="">Título</label>
                            <input type="text" name="txtTituloE" id="txtTituloE" class="form-control">
                            <label for="">Descripción</label>
                            <textarea name="txtDescE" id="txtDescE" class="form-control"></textarea>
                            <label for="">Imagen (URL)</label>
                            <input type="text" name="txtImagenE" id="txtImagenE" class="form-control">
                            <label for="">Autor</label>
                            <input type="text" name="txtAutorE" id="txtAutorE" class="form-control">
                            <button type="submit" name="btnEditar" class="btn btn-success">Editar</button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#555555;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal de Eliminación -->
<div id="modalEL" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:#00bb6b;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminando Noticia</h4>
            </div>
            <div class="modal-body" style="background-color:#555555;">
                <div class="row">
                    <form action="" method="POST">
                        <div class="col-md-10 col-md-offset-1">
                            <input type="text" name="txtIdEli" id="txtIdEli">
                            <p>Está seguro de eliminar esta noticia?<p>
                            <button type="submit" name="btnEliminar" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#555555;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    function desc(descripcion) {
        $('<p class="text-justify text-center">' + descripcion + '</p>').appendTo('#resultadoDesc');
    }

    function imag(imagen) {
        $('<img src="' + imagen + '" style="width:100%;"/>').appendTo('#resultadoImg');
    }
    function el(idEl)
    {
        $('#txtIdEli').val(idEl);
    }
    // función
    function ed(idEd, title, descr, img,autor) {
        $('#txtIdE').val(idEd);
        $('#txtTituloE').val(title);
        $('#txtDescE').text(descr);
        $('#txtImagenE').val(img);
        $('#txtAutorE').val(autor);
    }
    function limpiar() {
		$('#resultadoImg').empty();
		$('#resultadoDesc').empty();
	}
</script>
