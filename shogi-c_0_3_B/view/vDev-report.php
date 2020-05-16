<!-- sección de reporte de errores -->

<?php

require_once "controller/cDev-report.php";
$consulta = new CReport();

if(isset($_POST['btnEnviarR']))
{
    $res = $consulta->insertarR($_POST['title'], $_POST['desc'], $_POST['email'], $_POST['enlace']);
    if($res)
    {
        echo '<div class="alert alert-success">
        <strong>Reporte Enviado!</strong> Tu reporte ha sido enviado, un admin se comunicará contigo <br>
        para informarte sobre el mismo.
      </div>';
    }else{
        echo '<div class="alert alert-danger">
        <strong>Error</strong> tu reporte no pudo ser enviado, contáctanos al correo joruresu4@gmail.com.
      </div>';
    }
}
?>
<!-- the bug-report section, the following form send the reports  -->
<div class="container">
    <div class="panel panel-default" style="background-color:#c82e46;border-color:#c82e46;">
        <div class="panel-heading" style="background-color:#c82e46;">
            <center>
                <h3>Contacto al desarrollador</h3>
            </center>
        </div>
        <div class="panel-body" style="background-color:#333;">
            <form action="" method="POST">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="">Título:</label>
                            <input type="text" name="title" class="form-control" required placeholder="Ingrese un título para el mensaje">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="">Descripción:</label>
                            <textarea name="desc" class="form-control" required placeholder="En caso de ser un error o sugerencia, por favor descríbela lo mejor posible"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="">Correo:</label>
                            <input type="email" name="email" class="form-control" required placeholder="Ingresa tu email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="">Enlace roto:</label>
                            <input type="text" name="enlace" class="form-control" placeholder="Sólo si aplica, pon el enlace de la sección reportada">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" name="btnEnviarR" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpiar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>