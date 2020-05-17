<a name="top"></a>
# FSA WEB PAGE

## Instrucciones de trabajo    

### By FSA-TEAM

#### Indice


##### [1. PHP y MySQL](#phpmysql)

##### [2. METODOLOGIA DE TRABAJO](#mdt)

##### [3. MODELO](#mod)

##### [4. CONTROLADOR](#con)

##### [5. VISTAS](#vis)

##### [6. REFERENCIAS](#ref)


---

<a name="phpmysql"></a>
##### 1. PHP y MySQL

Php es un lenguaje de programación para la web escrito del lado del servidor, es usado más comúnmente
para la interacción con las bases de datos, escritas en mysql.
Php es orientado a objetos, lo cual quiere decir que hace uso de clases, interfaces (clases heredadas),
métodos, funciones y bloque dirigidos al control de flujo de datos.

MySql es un gestor de base de datos, en el cual construimos un modelo para nuestra estructura de datos y lo almacenamos.
Sin el uso de una base de datos, los datos en un programa son de 1 sólo uso, pues se guardan los datos en las memorias temporales del dispositivo (ram y caché).

Para escribir php y mysql lo primero que se debe tener a mano es un editor de código y el programa [xampp](https://www.apachefriends.org/download.html) descargado e instalado, xampp nos ayudará en la gestión de servidores y bases de datos.
Para acceder al panel de control de xampp en windows, basta con buscar el icono en inicio, en linux se usa panel desde terminal, puedes usar los siguientes comandos como superusuario: 
```sh 
user@user-pc:~$ sudo /opt/lampp/lampp start

user@user-pc:~$ sudo /opt/lampp/lampp start [procesos especificos]

user@user-pc:~$ sudo /opt/lampp/lampp stop

user@user-pc:~$ sudo /opt/lampp/lampp restart

user@user-pc:~$ sudo /opt/lampp/lampp panel  (Este comando no funciona en todas las versiones de linux)
```

Entiendase opt como la carpeta de desempaquetado o instalación.

[top](#top)

---


<a name="mdt"></a>
##### 2. Metodologia de Trabajo

Para la construcción de la página web de la federación
usaremos una metodología conocida como modelo-vista-controlador o MVC.
El uso de esta metodología incrementa la velocidad con que se procesan los datos, a la vez que facilita la corrección
de errores y aumenta la seguridad.
Al momento de crear la carpeta del proyecto, esta debe ser creada en la ruta de instalación de xampp,
en la carpeta relativa ./htdocs, usualmente en C:\xampp\htdocs

Cuando se vaya a revisar en el navegador, con el xampp activado consultamos la dirección

http://localhost/nombreProyecto/

[top](#top)

---
<a name="mod"></a>
##### 3. Modelo
A pesar de que esta sección sólo debería hablar del modelo, también se hablará de una parte fundamental para el funcionamiento de este.
La conexión con la base de datos, usualmente se define en una clase, en php las clases se definen así:

```php
    <?php
       class nombreClase { }
    ?>
```
    
en este caso, sería la clase Conexión, la cual se encarga de hacer el puente entre la aplicación web y mysql.
Creemos la clase Conexión:

```php

<?php
 
class Conexion{
    private $host = "";
    private $usuario = "";
    private $clave = "";
    private $db = "";
    private $con;
    function __construct()
    {
       $this->host = "localhost";
       $this->usuario = "root";
       $this->clave = "";
       $this->db = "kawaii";
       $this->con = new mysqli($this->host, $this->usuario, $this->clave, $this->db);
    }
 
    public function setQuery($query)
    {
        $res = $this->con->query($query);
        return $res;
    }
}
 
?> 
```
Con la clase conexión creada, procedemos a crear el modelo de los datos:

```php
<?php
 
require_once "conexion.php";
 
class MUsuario
{
    function __construct()
    {
        $this->conexion = new Conexion();
    }
 
    private $nombre;
    private $apellido;
    private $correo;
    private $id;
    private $conexion;
    public function _SET($arg, $value)
    {
        $this->$arg = $value;
    }
    public function _GET($arg)
    {
        return $this->$arg;
    }
 
    public function insertarU()
    {
        $sql = "INSERT INTO usuario(nombre, apellido, correo) VALUES (
            '{$this->nombre}', '{$this->apellido}', '{$this->correo}'
        );";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }
    public function listarU()
    {
        $sql = "SELECT * FROM usuario;";
        $res = $this->conexion->setQuery($sql);
        return $res;
    }
}
 
?>
```

La clase modelo, mapea la base de datos, crea variables para almacenar cada campo a insertar o consultar
en la tabla de sql, así como los ‘querys’ de mysql, las variables que hacen selecciones retornan tablas.


[top](#top)


---

<a name="con"></a>
##### 4. Controlador  

En la capa del controlador se realiza un cierto ‘procesamiento de datos’, tal como lo es la encriptación de contraseñas
o la corrección de errores inevitables p.ej que el usuario ingrese un caracter especial.

La clase controlador, en general, se construye así:

```php
     <?php
require_once "modelo.php";
 
class CUsuario
{
    function __construct()
    {
        $this->mUsuario = new MUsuario();
    }
    private $mUsuario;
    public function insertarUSer($nombre, $apellido, $correo)
    {
        $this->mUsuario->_SET('nombre', $nombre);
        $this->mUsuario->_SET('apellido', $apellido);
        $this->mUsuario->_SET('correo', $correo);
        $res = $this->mUsuario->insertarU();
        return $res;
    }
    public function listarUSer()
    {
        $res = $this->mUsuario->listarU();
        return $res;
    } 
}
 
?>
``` 

[top](#top)

---

<a name="vis"></a>
##### 5. VISTAS 

Las vistas son la meta final, son la interacción con el usuario, la capa que contiene el front,
aquí a pesar de usar php, es código no tan vital para el funcionamiento normal de la página.
una vista, usualmente mezcla php, html, css y javascript o jquery.
En nuestro caso, la vista corresponde al index de la página y allí importamos el framework  de bootstrap.

```php
<?php
 
require_once "conexion.php";
require_once "controlador.php";
$controller = new CUsuario();
 
$tablaUsuarios;
 
$nombre;
$apellido;
$correo;
 
if(isset($_POST['btnEnviar']))
{
    $nombre = $_POST['txtNombre'];
    $apellido = $_POST['txtApellido'];
    $correo = $_POST['txtCorreo'];
 
    $res = $controller->insertarUSer($nombre, $apellido, $correo);
 
    if($res)
    {
        echo '<div class="alert alert-success">
        <strong>Exito!</strong> La consulta fue ingresada con exito.
      </div>';
    }else{
        echo '<div class="alert alert-danger">
        <strong>Error :(</strong> La consulta no fue ingresada con exito.
      </div>';
    }
}
 
if(isset($_POST['btnListar']))
{
    $tablaUsuarios = $controller->listarUSer();
}
 
?>
 
 
<!DOCTYPE html>
<html lang="es">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicas</title>
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</head>
 
<body>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Ingrese sus datos</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form action="" method="POST" class="form-group">
                            <label for="txtNombre">Ingrese su nombre</label>
                            <input name="txtNombre" type="text" class="form-control">
                            <label for="txtApellido">Ingrese su apellido</label>
                            <input name="txtApellido" type="text" class="form-control">
                            <label for="txtCorreo">Ingrese su correo</label>
                            <input name="txtCorreo" type="text" class="form-control">
 
                            <button type="submit" name="btnEnviar" class="btn btn-succesful">Registrar</button>
                            <button type="reset" class="btn btn-danger">Limpiar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
 
        
         <form action="" method="POST">
            <button type="submit" class="successful" name="btnListar">
                Listado de Usuarios
            </button>
         </form>
 
         <?php 
            if(isset($tablaUsuarios))
            {
                foreach($tablaUsuarios as $key => $value)
                {
                    echo "nombre: ".$value['nombre']."<br>apellido: ".$value['apellido']."<br>correo".$value['correo'];
                }
            }
         ?>
</body>
 
</html>
```
Nótese el header con la importación del bootstrap, también el uso repetitivo de clases en casi todo elemento p.ej
`<div class=”jumbotron”>` que es el modo en que se obtiene la información de los estilos predefinidos por bootstrap.

[top](#top)


---
<a name="ref"></a>
##### 6. Referencias 

  1. [Bootstrap, pagina oficial](http://www.getbootstrap.com)
  
  
  2. [w3Schools, tutoriales de "todo"](http://www.w3schools.com)
  
  
  3. localhost es el editor “phpmyadmin” para gestionar bases de datos.
  
