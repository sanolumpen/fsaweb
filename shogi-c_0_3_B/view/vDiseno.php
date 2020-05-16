<?php

require_once "userSys/controlador/cDiseno.php";
$consulta = new CDiseno();

// Consulto contenido de la tabla diseño, retorna un array asociativo
$diseno = $consulta->listarD();

?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
    <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FFederaci%25C3%25B3n-de-Shogi-Americana-107893957550442&width=89&layout=box_count&action=like&size=small&share=true&height=65&appId" width="89" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    </div>
</div>
<!-- the section of designs, contains posters for common use -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="jumbotron text-center" style="background-color:#c82e46">
            <h2>Diseños</h2>
        </div>
        <!-- this foreach list the designs -->
        <?php foreach ($diseno as $key => $value) : ?>
            <br>
            <div class="jumbotron text-center rounded" style="color:#000;">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h3><b><?php echo $value['titulo'] ?></b></h3>
                        <hr>
                        <p class="text-justify"><?php echo $value['descripcion'] ?></p>
                        <br>
                        <?php if ($value['imagen'] == null) {
                        } else {
                            echo "<img src=./userSys/" . $value['imagen'] . " alt=\"\" style=\"width:80%;\">";
                        } ?>
                        <br>
                    </div>

                    <!-- a link of the g-drive folder with designs -->
                    <div class="col-md-6">
                        <p>Descargar: <a href="<?php echo $value['enlace'] ?>" target="_blank">Google Drive</a></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-2">

    </div>
</div>