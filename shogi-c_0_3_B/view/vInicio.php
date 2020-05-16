<!-- en realidad este documento hace referencia a la sección de noticias -->
<?php

require_once "controller/cNoticias.php";
$consulta = new CNoticia();
$noticias = $consulta->listarN();

if (isset($_POST['btnPage'])) {
    $tablaPagination = $consulta->paginarN($_POST['btnPage']);
} else {
    $tablaPagination = $consulta->paginarN(1);
}

?>
<!-- this page is start point, here u will find a news section -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
    <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FFederaci%25C3%25B3n-de-Shogi-Americana-107893957550442&width=89&layout=box_count&action=like&size=small&share=true&height=65&appId" width="89" height="65" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <!-- the main title of the news section -->
        <div class="jumbotron text-center" style="background-color:#c82e46;">
            <h2><b>Noticias</b></h2>
        </div>
        <!-- that foreach show a list of the news in the database -->
        <p>¿Quieres ser parte de la federación? <a href="./userSys/vista/vCrearU-Pub.php">aplicar</a></p>
        <div id="insertPage">
            <!-- aquí se inserta la noticia -->
        </div>
    </div>
</div>
<br>
    <br>
    <!-- el siguiente bloque php crea un form con los botones de paginación -->
    <center>
        <?php
        echo '<form action"" method="POST">';
        for ($i = 1; $i <= mysqli_num_rows($noticias); $i++) {

            echo '<button name="btnPage" type="submit" style="background-color:transparent; border-color:transparent;" value="' . $i . '"><b>' . $i . '</b> </button>';
        }
        echo '</form>'
        ?>
    </center>

<!-- el bloque de js inserta en el DOM el contenido de la noticia paginada -->
<script type="text/javascript">
    function insertPage(titulo, desc, imagen, autor, fecha) {
        // evalúa si la imágen existe para asignarle las tag de html
        if(imagen != "")
        {
            imagen = '<img src="./userSys/'+imagen+'" alt=\"\" style=\"width:80%;\">';
        }
        // inserta en el DOM de html la noticia en etiquetas html
        $('#insertPage').empty();
        $('<br><div class="jumbotron text-center rounded" style="color:#000;">'+
            '<div class="row">'+
                '<div class="col-md-10 col-md-offset-1">'+
                    '<h3><b>'+titulo+'</b></h3>'+
                    '<hr>'+
                    '<p class="text-justify">'+desc+'</p>'+
                    '<br>'+
                    imagen+
                    '<br>'+
                '</div>'+
            '<div class="col-md-6">'+
            '<p>Publicado por:'+autor+'</p>'+
        '</div>'+
        '<div class="col-md-6">'+
            '<!-- <div class="text-muted"> -->'+
            '<center>'+fecha+'</center>'+
            '<!-- </div> -->'+
        '</div>'+
    '</div>'+
'</div>').appendTo('#insertPage');
    }
</script>

<!-- este bloque de php llama a la función insertPage -->
<?php foreach ($tablaPagination as $key => $value) {
    $imagen = "";
    $descrip;
    if (isset($value['imagen'])) {
        $imagen = $value['imagen'];
    }
    echo '<script type="text/javascript">';
    echo 'insertPage(\'' . addslashes($value['titulo']) . '\',\'' . $value['descripcion'] . '\',\'' . addslashes($imagen) . '\',\'' . addslashes($value['autor']) . '\',\'' . addslashes($value['fecha']). '\');';
    echo '</script>';

} ?>