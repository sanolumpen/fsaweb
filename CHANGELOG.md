<a name="top"></a>
# FSA WEBPAGE CHANGELOG

###### v0.1a by FSA TEAM

---

### Indice:
 
 ##### [1. Correcciones](#corrections) 

 ##### [2. Modificaciones de archivos](#mods)

 ##### [3. Notas de Version](#ndv)

 ##### [4. Fechas de reunion/entrega de proyectos](#fechasreuniones)

 ##### [5. Tareas](#task)

  ---

#### 1. Correcciones: 


[Subir](#top)

---
<a name="mods"></a>
#### 2. Modificaciones de archivos

**enrutador.php** cambia a su versión 0.1b con los siguientes cambios:

Se modifico la 'función' cargarVista(), con lo que ahora filtra la variable $vista, según su $idRol, 
que es definido por un 'int' en la tabla \`roles\` de la base de datos shogi1, se definieron los siguientes valores:

		1 - "admin" que va a tener total acceso a la pagina.
		2 - "trans" que va a tener acceso a toda la pagina del lado del cliente.
		3 - "rrhh" que va a tener acceso a inicio, vGestionU, vGestionJoinUs, vCrearU-Pub, vGestionContacto.
		4 - "diffu" que va a tener acceso a inicio, vNoticias, vCrearU-Pub.
		5 - "design" que va a tener acceso a inicio, vGestionDi, vCrearU-Pub.
		6 - "common" que va a tener acceso a inicio solamente por el momento.

con lo que el codigo queda pasó de:
 		
```php
  <?php
  
 	public function cargarVista($vista){
 	switch ($vista){}
 	}
  ?>
 ``` 
 a ser:
    
 ```php
  <?php
 
 		public function cargarVista($vista, $idRol){
      if($idRol == "int"){ //si se usa '' en vez de "" da error
        switch ($vista){
          case '$vista': //donde vista son los archivos que estan ./userSys/vistas
            require_once "vista/".$vista.".php"; //aca los carga directo del source
          break;
    }
   }
  }
  ?>
  ```

  Se agrego un nueva 'función' llamada cargarMUS(), (MUS = Menu de userSys) que lo que hace es filtrar la vista
  y el acceso a los botones del MUS con respecto a su $idRol por lo que el codigo queda de la siguiente manera:
```php
<?php 

 	public function cargarMUS($idRol){
   if($idRol == "int"){
   echo 'el boton mismo no? acordarse que siempre arranca con la vista del boton de inicio';
   }
  }
 }
 
 ?>
```

__home.php__ cambia a su versión 0.1a con los siguientes cambios:

Las lineas 62 y 64 fueron cambiadas para que $enrutador haga un chequeo del 'rol' que tienen a la hora de cargar las vistas con la superglobal $\_SESSION con lo que el codigo quedo así:

```php
<? php
 62 > $enrutador->cargarVista($\_GET['vista'],$\_SESSION['rol']);
 64 > $enrutador->cargarVista("inicio",$\_SESSION['rol']);
?>
 
 ```
 		
 y ahora si un usuario con $idRol == 'common' inicia sesion, sera redirigido a inicio.php y solo vera
 sus respectivas $vistas del MUS

 Siguiendo el comentario en la linea 41, que dice que empieza el menu izquierdo 
 modificamos a partir de la linea 44 comentando todo lo que es la parte HTML de los botones hasta la linea 53, 
 sacamos del documento esa parte para dejarla de referencia de los botones:
 
![href](https://i.ibb.co/vHPgb9y/hrefvistas.jpg "asi quedo en el archivo")

 por lo que ahora lo que maneja las vistas es nuestro cargarMUS() por ende hacemos lo siguiente:
    
  ```php
 		<?php
 		  $enrutador->cargarMUS($\_SESSION['rol']);
 		?>
  ```

 con lo que el codigo dentro de <div class="col-md-2"> quedaria simplemente:

```php.html

 		<div class="col-md-2">
     
        <center><span style="color:#fff"><b>Bienvenido,</b><br><?php echo $_SESSION['nombreUsuario']; ?></span></center>
        <?php
        $enrutador->cargarMUS($_SESSION['rol']);
        ?>
        </div>
 ```

base de datos fue modificada para que dentro de ` ROLES ` haya solo los 6 detallados en enrutador.php

[Subir](#top)

---

<a name="ndv"></a>
	3. Notas de version
  
[Subir](#top)

---

<a name="fechasreuniones"></a>
	4. Fechas de entrega - dias de reuniones
  
[Subir](#top)

---

<a name="task"></a>
	5. Tareas
  
[Subir](#top)

