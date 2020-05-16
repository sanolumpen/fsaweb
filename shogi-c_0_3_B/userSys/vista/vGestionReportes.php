<?php
require_once "controlador/cDev-Report.php";
$reporte = new CReport();
$tablaReportes = $reporte->listarR();

if (isset($_POST['btnEliminar'])) {
    $del = $usuario->eliminarU($_POST['txtIdReporte']);
    if ($del == true) {
        $_SESSION['alerta'] = '
        <div class="alert alert-success">
        <strong>Eliminado!</strong> Reporte eliminada con éxito.
      </div>
		';
        //header("Location: index.php?vista=vListarU");
    } else {
        $_SESSION['alerta'] = '<div class="alert alert-danger">
        <strong>Error</strong> Ocurrió un error durante la eliminación.
      </div>
';
        //header("Location: index.php?vista=vListarU");
    }
}
?>
<div class="x_panel">
    <div class="x_title">
        <h2>Lista de Reportes <small></small></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">

                    <table id="datatable" class="table table-bordered" style="width:100%;">
                        <thead style="background-color:#c82e46">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Correo</th>
                                <th>Enlace</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody style="color:#fff;background-color:#555">
                            <?php foreach ($tablaReportes as $key => $value) : ?>
                                <tr>
                                    <td><?php echo $value['idReport']; ?></td>
                                    <td><?php echo $value['titulo']; ?></td>
                                    <td><button onclick="desc('<?php echo $value['descripcion']; ?>');" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDes">
                                            <i class="fa fa-eye"></i> </button></td>
                                    <td><?php echo $value['correo']; ?></td>
                                    <td><?php echo $value['enlace']; ?></td>
                                    <td>
                                        <button onclick="eliminar('<?php echo $value['NombreCompleto']; ?>', '<?php echo $value['IdReporte']; ?>');" title="Eliminar" type="button" name="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">
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

<!-- Modal de Descripción -->
<div id="modalDes" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color:#c82e46;">
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
                <button onclick="limpiar()" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Long modal -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="" method="post">

                <div class="modal-header" style="background-color:#c82e46;">
                    <h4 class="modal-title" id="myModalLabel2">Eliminar Reporte</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color:#555555;">

                    <div class="form-group">
                        <p>¿Estas seguro de eliminar el reporte <span id="txtUsuarioEli"></span> ?</p>
                        <input type="text" name="txtIdReporte" id="txtIdUsuarioEli" hidden>
                    </div>

                </div>
                <div class="modal-footer" style="background-color:#555555;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                    <button type="submit" name="btnEliminar" class="btn btn-primary">SI</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

</script>
<script type="text/javascript">
    function eliminar(nombre, id) {
        $('#txtUsuarioEli').text(nombre);
        $('#txtIdUsuarioEli').val(id);
    }
    function limpiar()
    {
        $('#resultadoDesc').empty();
    }
    function desc(descripcion) {
        $('<p class="text-justify text-center">' + descripcion + '</p>').appendTo('#resultadoDesc');
    }
</script>