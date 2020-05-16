<?php

require_once dirname(__DIR__) . "/controlador/cDiseno.php";
$diseno = new CDiseno();
$img = "";
$tablaBusqueda = $diseno->listarD();

if (isset($_POST['btnGuardar'])) {
    $img = str_replace(' ', '-','images/' . $_FILES['archivo']['name']);
    $insert = $diseno->insertarD(
        $_POST['txtTitulo'],
        $_POST['txtContenido'],
        strval($img),
        $_POST['txtEnlace']
    );

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
                if (move_uploaded_file($temp, dirname(__DIR__).'\\images\\' . str_replace(' ','-',$archivo))) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    chmod(dirname(__DIR__).'\\images\\' . str_replace(' ','-',$archivo), 0777);
                    echo 'images/' . $archivo;
                } else {
                    //Si no se ha podido subir la imagen, mostramos un mensaje de error
                    echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                }
            }
        }

        // header("Location: index.php?vista=vdisenos");
    } else {
        // header("Location: index.php?vista=vdisenos");
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<h3>Hubo un error al procesar la solicitud, intenta de nuevo</h3>";
        echo $insert;
    }
}
if(isset($_POST['btnEditar']))
{
    $res = $diseno->editarD($_POST['txtIdE'],$_POST['txtTituloE'],
    $_POST['txtDescE'], $_POST['txtImagenE'],$_POST['txtEnlaceE']);
    if($res)
    {
        echo "<div class='alert alert-success alert-dismissible' role='alert'>
         <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
         </button>
         <strong>Editado correctamente</strong>
       </div>";
    }else{
        echo "<div class='alert alert-danger alert-dismissible' role='alert'>
         <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
         </button>
         <strong>Error al editar</strong> contacte a KurahaSho.
       </div>";
    }
}
if(isset($_POST['btnEliminar']))
{
    $res = $diseno->eliminarD($_POST['txtIdEli']);
    if($res)
    {
        header("Location: ?vista=vGestionDi");
    }
}
?>

<div class="container" data-spy="scroll" data-target=".navbar" data-offset="50">

    <!-- The navbar - The <a> elements are used to jump to a section in the scrollable area -->

    <div class="panel" style="background-color:#c82e46;">
        <div class="panel-header" style="background-color:#c82e46;">
            <div class="panel-title">
                <center>
                    <h3>Creación de Diseños</h3>
                    <p><b>NOTA:</b> para dar formato al texto puede usar etiquetas de html<br>tales como:"b" o "i" entre otras de formato de texto</p>
                </center>
            </div>
        </div>
        <!-- Formulario action="./upload/subirArchivo.php" -->
        <div class="panel-body" style="background-color:#555;">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Título</label>
                    <input type="text" class="form-control" name="txtTitulo" id="txtTitulo" placeholder="Título del diseño">
                    <label for="">Contenido</label>
                    <textarea class="form-control" name="txtContenido" id="txtContenido" placeholder="Cuerpo del diseño"></textarea>
                    <label for="">Enlace</label>
                    <input type="text" class="form-control" name="txtEnlace" id="txtEnlace" placeholder="Enlace de descarga">
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


    <div class="panel" style="background-color:#c82e46;">
        <div class="panel-header" style="background-color:#c82e46;">
            <div class="panel-title">
                <center>
                    <h3>Edición de Diseños</h3>
                </center>
            </div>
        </div>
        <!-- Formulario action="./upload/subirArchivo.php" -->
        <div class="panel-body" style="background-color:#555;">
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                            <table id="datatable" class="table table-bordered text-center" style="width:100%">
                                <thead style="background-color:#c82e46;">
                                    <tr>
                                        <th>Título</th>
                                        <th>Contenido</th>
                                        <th>Imágen</th>
                                        <th>Enlace</th>
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
                                            <td><?php echo $value['enlace']; ?></td>
                                            <td>
                                                <button onclick="ed('<?php echo $value['idContent']; ?>','<?php echo addslashes($value['titulo']); ?>',
                                            '<?php echo addslashes($value['descripcion']); ?>','<?php echo addslashes($value['imagen']); ?>',
                                            '<?php echo addslashes($value['enlace']); ?>')" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalE">
                                                    <i class="fa fa-edit"></i> </button>
                                                    <button onclick="el('<?php echo $value['idContent']; ?>')" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEli">
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
        </div>
    </div>


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
                <button onclick="limpiar();" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            <input type="text" name="txtIdE" id="txtIdE" hidden=""/>
                            <label for="">Título</label>
                            <input type="text" name="txtTituloE" id="txtTituloE" class="form-control">
                            <label for="">Descripción</label>
                            <textarea name="txtDescE" id="txtDescE" class="form-control"></textarea>
                            <label for="">Imagen (URL)</label>
                            <input type="text" name="txtImagenE" id="txtImagenE" class="form-control">
                            <label for="">Autor</label>
                            <input type="text" name="txtEnlaceE" id="txtEnlaceE" class="form-control">
                            <button type="submit" name="btnEditar" class="btn btn-success">Editar</button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#555555;">
                <a href="?vista=vGestionDi"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></a>
            </div>
        </div>

    </div>
</div>

<!-- Modal de Eliminación -->
<div id="modalEli" class="modal fade" role="dialog">
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
                            <input type="text" name="txtIdEli" id="txtIdEli" hidden>
                            <p>Está seguro de eliminar este diseño?<p>
                            <button type="submit" name="btnEliminar" class="btn btn-danger">Eliminar</button>

                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#555555;">
                <button onclick="limpiar();" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    // función
    function ed(idEd, title, descr, img, autor) {
        $('#txtIdE').val(idEd);
        $('#txtTituloE').val(title);
        $('#txtDescE').text(descr);
        $('#txtImagenE').val(img);
        $('#txtEnlaceE').val(autor);
    }
    function el(idEli) {
        $('#txtIdEli').val(idEli);
    }
    function limpiar()
    {
        $('#resultadoImg').empty();
        $('#resultadoDesc').empty();
    }
</script>