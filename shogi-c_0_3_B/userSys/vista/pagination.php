<?php
require_once "../controlador/cContacto.php";
$contacto = new CContacto();
$tablaContacto = $contacto->listarC();

if (isset($_POST['btnPage'])) {
    $tablaPagination = $contacto->paginarc($_POST['btnPage']);
} else {
    $tablaPagination = $contacto->paginarc(1);
}


if (isset($_POST['btnEliminar'])) {
    $del = $usuario->eliminarU($_POST['txtIdContacto']);
    if ($del == true) {
        $_SESSION['alerta'] = '
        <div class="alert alert-success">
        <strong>Eliminado!</strong> mensaje eliminada con éxito.
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
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>UserSys | FSA</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/2038768ebc.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="./libs/js/jquery-3.4.1.min.js"></script>
</head>
<body>
<div class="x_panel">
    <div class="x_title">
        <h2>Lista de Mensajes <small></small></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <!-- Planeo hacer que js remplace la tabla actual con la tabla del último registro de limit $page -->
                    <table id="datatable" class="table table-bordered" style="width:100%;">
                        <thead style="background-color:#c82e46">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Correo</th>
                                <th>Nombre Completo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <!-- insert page is not defined -->
                        
                        
                        <tbody style="color:#fff;background-color:#555" id="insertPage">

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
                    <h4 class="modal-title" id="myModalLabel2">Eliminar Mensaje</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="background-color:#555555;">

                    <div class="form-group">
                        <p>¿Estas seguro de eliminar el mensaje? <span id="txtUsuarioEli"></span> ?</p>
                        <input type="text" name="txtIdContacto" id="txtIdUsuarioEli" hidden>
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
<?php
echo '<form action"" method="POST">';
for ($i = 1; $i <= mysqli_num_rows($tablaContacto); $i++) {

    echo '<button name="btnPage" type="submit" style="background-color:transparent; border-color:transparent;" value="' . $i . '"><b>' . $i . '</b> </button>';
}
echo '</form>'
?>
<script type="text/javascript">
    function eliminar(nombre, id) {
        $('#txtUsuarioEli').text(nombre);
        $('#txtIdUsuarioEli').val(id);
    }

    function limpiar() {
        $('#resultadoDesc').empty();
    }

    function desc(descripcion) {
        $('<p class="text-justify text-center">' + descripcion + '</p>').appendTo('#resultadoDesc');
    }

    function insertPage(idCon, titulo, desc, correo, nombreC) {
        $('#insertPage').empty();
        $('<tr>\
            <td>' + idCon + '</td>'+
                '<td>' + titulo + '</td>'+
                '<td><button onclick="desc(' + desc + ');" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDes">'+
                    '<i class="fa fa-eye"></i> </button></td>'+
                '<td>' + correo + '</td>'+
                '<td>' + nombreC + '</td>'+
                '<td>'+
                '<button onclick="eliminar(' + nombreC + ', ' + idCon + ');"'+
                 'title="Eliminar" type="button" name="button" class="btn btn-danger btn-sm" data-toggle="modal"'+
                  'data-target=".bs-example-modal-sm"><i class="fa fa-trash"></i> </button>'+
                '</td>'+
            '</tr>').appendTo('#insertPage');
    }
</script>
<?php foreach ($tablaPagination as $key => $value) {
                            echo '<script type="text/javascript">';
                            echo 'insertPage(\'' . $value['idContacto'] . '\',\'' . $value['titulo'] . '\',\'' . $value['descripcion'] . '\',\'' . $value['correo'] . '\',\'' . $value['nombreC'] . '\');';
                            echo '</script>';
} ?>
</body>