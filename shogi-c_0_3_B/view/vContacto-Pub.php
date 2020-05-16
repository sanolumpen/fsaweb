<?php

require_once "controller/cContacto.php";
$consulta = new CContacto();

if(isset($_POST['btnEnviarC']))
{
    $res = $consulta->insertarR($_POST['title'], $_POST['desc'], $_POST['email'], $_POST['nombreC']);
    if($res)
    {
        echo '<div class="alert alert-success">
        <strong>Mensaje Enviado!</strong> Tu mensaje ha sido enviado, un admin se comunicará contigo <br>
        para informarte sobre el mismo.
      </div>';
    }else{
        echo '<div class="alert alert-danger">
        <strong>Error</strong> tu mensaje no pudo ser enviado, contáctanos al correo joruresu4@gmail.com.
      </div>';
    }
}
?>
<!-- the bug-report section, the following form send the reports  -->
<div class="container">
    <div class="panel panel-default" style="background-color:#c82e46;border-color:#c82e46;">
        <div class="panel-heading" style="background-color:#c82e46;">
            <center>
                <h3>Contáctanos!</h3>
                <p>Es importante que rellenes todos los campos del formulario<br>
                para poder darte una respuesta adecuada<br>FSA team :)</p>
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
                            <input type="email" name="email" class="form-control" required placeholder="Por favor Ingresa tu email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <label for="">Nombre Completo:</label>
                            <input type="text" name="nombreC" class="form-control" placeholder="Por favor Ingresa tu nombre">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" name="btnEnviarC" class="btn btn-success">Enviar</button>
                            <button type="reset" class="btn btn-danger">Limpiar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>