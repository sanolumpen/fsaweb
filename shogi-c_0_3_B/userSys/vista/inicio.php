<!-- la página de entrada para el usuario, valida credenciales -->
<?php

require_once "controlador/cusuario.php";
$usuario = new CUsuario();
$idUser;
$userN;
$clave;
$nombreC;
$correo;
$idRol;
$estado;
$nacimiento;
$habilidades = "";
$mensaje;

if (isset($_POST['btnJoin'])) {
	
	$yo = $usuario->datosUsuario($_SESSION['usuario'], $_POST['txtClave']);
	//Se verifica si datos usuario ha devuelto valores, si no ha devuelto quiere decir que se ingresó
	//una contraseña errada
	if(isset($yo))
	{
		$idUser = $yo['IdUsuario'];
		$userN = $yo['Usuario'];
		$clave = $yo['Clave'];
		$nombreC = $yo['NombreCompleto'];
		$idRol = $yo['IdRol'];
		$estado = $yo['Estado'];
		
		$correo = $_POST['txtCorreo'];
		$nacimiento = $_POST['txtDate'];

		//variables para casillas de verificación
		if(isset($_POST['skill1']))
		{
			$habilidades = $habilidades.$_POST['skill1'];
		}
		if(isset($_POST['skill2']))
		{
			$habilidades = $habilidades." ".$_POST['skill2'];
		}
		if(isset($_POST['skill3']))
		{
			$habilidades = $habilidades." ".$_POST['skill3'];
		}
		if(isset($_POST['skill4']))
		{
			$habilidades = $habilidades." ".$_POST['skill4'];
		}
		if(isset($_POST['skill5']))
		{
			$habilidades = $habilidades." ".$_POST['skill5'];
		}
		if(isset($_POST['skill6']))
		{
			$habilidades = $habilidades." ".$_POST['skill6'];
		}
		$mensaje =str_replace(PHP_EOL,'<br>', $_POST['txtMensaje']);
		
		$res = $usuario->joinUsC($userN, $nombreC, $correo, $idRol, $idUser,
		$nacimiento, $habilidades, $mensaje);

		if($res)
		{
			echo "<div class='alert alert-succesful alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
			</button>
			<strong>Aplicación enviada</strong> Nuestro equipo evaluará los datos.<br>Nos pondremos en contacto contigo.
		</div>";
		}else{
			echo "<div class='alert alert-danger alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
			</button>
			<strong>Ocurrió un error</strong> Intentalo más tarde, si persiste contacta a soporte joruresu4@gmail.com
		</div>";
		}
	}else
	{
		echo "<div class='alert alert-danger alert-dismissible' role='alert'>
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
		</button>
		<strong>Contraseña errada</strong> Por favor verifica, si persiste contacta a soporte joruresu4@gmail.com
	  </div>";
	}
	
	
	
	//La vista de peticiones y los métodos para inserción del código de membresía
	//A posteriori, crear vistas del usuario, para editar sus datos y clasificar por rol.
}

?>
<center>
	<h2 style="color:#c82e46">¿Quieres ser parte de la federación?</h2>
</center>
<br>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="jumbotron text-center" style="color:#000;">
			<img class="img-circle" src="./images/Copiademapita3.png" alt="" style="width:30%;background-color:#323232">
			<br>
			<br>
			<div style="padding-left:6%;padding-right:6%;">
				<p class="text-justify" style="font-size:large;">
					La <b>Federación Americana de Shogi</b> se siente complacida de tener miembros nuevos. <br>
					Sin embargo, antes de que puedas hacer parte de nuestro equipo y obtener todos
					los beneficios, nos gustaría saber más sobre tí.<br>
					Por favor en unas cuantas líneas escribe por qué quieres ser miembro de la federación
					e ingresa los datos correspondientes.
				</p>
				<div class="form-group" style="padding-left:3%;padding-right:3%;">
					<div class="row">
						<form action="" method="post">

							<div class="col-md-6">
								<label for="">Fecha de nacimiento:</label><br>
								<input type="date" name="txtDate" id="" class="date-picker">
							</div>
							<div class="col-md-6">
								<label for="">Ingresa tu correo:</label>
								<input type="email" name="txtCorreo" placeholder="Correo electrónico" class="form-control">
								<br>
								<br>
								<br>
								<br>
							</div>
							<div class="col-md-6">
								<label for="">¿Por que quieres unirte al equipo?</label>
								<textarea name="txtMensaje" id="" class="form-control" placeholder="Unas palabras para FSA team"></textarea>
							</div>
							<div class="col-md-6">
								<label for="">¿Cual habilidad dominas mejor?</label><br>
								<label for="" class="text-muted">Si no dominas ninguna, no marques</label>
								<br>
								<input type="checkbox" name="skill1" value="programación">
								<label for="skill1">Programación</label><br>
								<input type="checkbox" name="skill2" value="diseño">
								<label for="skill2">Diseño gráfico</label><br>
								<input type="checkbox" name="skill3" value="comunicación">
								<label for="skill3">Comunicación</label><br>
								<input type="checkbox" name="skill4" value="investigación">
								<label for="skill4">Investigación</label><br>
								<input type="checkbox" name="skill5" value="traducción">
								<label for="skill5">Traducción</label><br>
								<input type="checkbox" name="skill6" value="shogi">
								<label for="skill6">Shogi (>1dan)</label><br>
								<br><br>
							</div>
							<div class="col-md-8 col-md-offset-2">
								<label for="">Finalmente, ingresa tu contraseña.<br>Sólo lo hacemos para saber que eres tu.</label>
								<input type="password" name="txtClave" id="" class="form-control" placeholder="Tu contraseña">
								<br>
							</div>
							<div class="col-md-12">
							<button type="submit" class="btn btn-success" name="btnJoin">Postularme</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<br>

		</div>
	</div>
</div>