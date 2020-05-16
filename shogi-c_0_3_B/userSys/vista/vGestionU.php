<?php
require_once "controlador/cusuario.php";
$usuario = new CUsuario();
$tablaUsuarios = $usuario->listarU();
$roles = $usuario->listarRoles();
if (isset($_POST['btnEditar'])) {
	$up = $usuario->editarU(
		$_POST['txtUsuario'],
		$_POST['txtNombre'],
		$_POST['txtCorreo'],
		$_POST['selRoles'],
		$_POST['txtIdUsuario']
	);
	if ($up == true) {
		$_SESSION['alerta'] = '
					swal({
							title: "Actualización exitosa",
							type: "success",
							confirmButtonText: "Aceptar",
							closeOnConfirm: false,
							closeOnCancel: false
					},
					function(isConfirm){
						if(isConfirm){
							window.location = "index.php?vista=vListarU";
						}
				});
			';
		//header("Location: index.php?vista=vListarU");

	} else {
		$_SESSION['alerta'] = 'swal({
					title: "Error al actualizar",
					type: "error",
					confirmButtonText: "Aceptar",
					closeOnConfirm: false,
					closeOnCancel: false
			},
			function(isConfirm){
				if(isConfirm){
					window.location = "index.php?vista=vListarU";
				}
		});
	';
		//header("Location: index.php?vista=vListarU");

	}
}

if (isset($_POST['btnEliminar'])) {
	$del = $usuario->eliminarU($_POST['txtIdUsuarioEli']);
	if ($del == true) {
		$_SESSION['alerta'] = '
				swal({
						title:"El usuario fue eliminado correctamente",
						type: "success",
						confirmButtonText: "Aceptar",
						closeOnConfirm: false,
						closeOnCancel: false
				},
				function(isConfirm){
					if(isConfirm){
						window.location = "index.php?vista=vListarU";
					}
			});
		';
		//header("Location: index.php?vista=vListarU");
	} else {
		$_SESSION['alerta'] = 'swal({
				title: "Error al eliminar el usuario",
				type: "error",
				confirmButtonText: "Aceptar",
				closeOnConfirm: false,
				closeOnCancel: false
		},
		function(isConfirm){
			if(isConfirm){
				window.location = "index.php?vista=vListarU";
			}
	});
';
		//header("Location: index.php?vista=vListarU");
	}
}

if (isset($_POST['btnCambiarEstado'])) {
	$est = $usuario->cambiarE($_POST['txtIdUsuarioCam']);
	if ($est == true) {
		$_SESSION['alerta'] = '
				swal({
						title:"Se cambio el estado correctamente",
						type: "success",
						confirmButtonText: "Aceptar",
						closeOnConfirm: false,
						closeOnCancel: false
				},
				function(isConfirm){
					if(isConfirm){
						window.location = "index.php?vista=vListarU";
					}
			});
		';
	} else {
		$_SESSION['alerta'] = 'swal({
				title: "Error al cambiar estado",
				type: "error",
				confirmButtonText: "Aceptar",
				closeOnConfirm: false,
				closeOnCancel: false
		},
		function(isConfirm){
			if(isConfirm){
				window.location = "index.php?vista=vListarU";
			}
	});
';
	}
}
if (isset($_POST['btnGuardar'])) {
	$insert = $usuario->insertarU(
		$_POST['txtUsuario'],
		$_POST['txtClave'],
		$_POST['txtNombre'],
		$_POST['txtCorreo'],
		$_POST['selRoles'],
		1
	);
	if ($insert == true) {
		//libreria para generar una alerta (sweetalert)
		$_SESSION['alerta'] = '
          swal({
              title: "Registro exitoso",
              type: "success",
              confirmButtonText: "Aceptar",
              closeOnConfirm: false,
              closeOnCancel: false
          });
      ';
	} else {
		$_SESSION['alerta'] = '
      swal({
          title: "Error en el registro comuniquese con soporte",
          type: "error",
          confirmButtonText: "Aceptar",
          closeOnConfirm: false,
          closeOnCancel: false
      });
    ';
	}
}
?>
<div class="x_panel">
	<div class="x_title">
		<h2>Lista de Usuarios <small></small></h2>
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
								<th>Nombre Completo</th>
								<th>Correo</th>
								<th>Usuario</th>
								<th>Rol</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>

						<tbody style="color:#fff;background-color:#555">
							<?php foreach ($tablaUsuarios as $key => $value) : ?>
								<tr>
									<td><?php echo $value['IdUsuario']; ?></td>
									<td><?php echo $value['NombreCompleto']; ?></td>
									<td><?php echo $value['Correo']; ?></td>
									<td><?php echo $value['Usuario']; ?></td>
									<td><?php echo $value['Rol']; ?></td>
									<td>
										<?php if ($value['Estado'] == 1) : ?>
											<span class="badge badge-success">Activo</span>
										<?php else : ?>
											<span class="badge badge-danger">Inactivo</span>
										<?php endif; ?>
									</td>
									<td>
										<button onclick="datos('<?php echo $value['NombreCompleto']; ?>', '<?php echo $value['Correo']; ?>', '<?php echo $value['Usuario']; ?>', '<?php echo $value['IdRol']; ?>', '<?php echo $value['IdUsuario']; ?>');" title="Editar" type="button" name="button" class="btn btn-info btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg">
											<i class="fa fa-edit"></i> </button>
										<?php if ($_SESSION['rol'] == 1) : ?>
											<button onclick="eliminar('<?php echo $value['NombreCompleto']; ?>', '<?php echo $value['IdUsuario']; ?>');" title="Eliminar" type="button" name="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bs-example-modal-sm">
												<i class="fa fa-trash"></i> </button>
											<button onclick="cambiarEstado('<?php echo $value['NombreCompleto']; ?>', '<?php echo $value['IdUsuario']; ?>');" data-toggle="modal" data-target="#modal1" title="Cambiar Estado" type="button" class="btn btn-warning btn-sm" name="button">
												<i class="fa fa-exchange"></i>
											</button>
										<?php endif; ?>
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

<!-- Long modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button> -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form class="" method="post">

				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Nombre completo</label>
								<input type="text" class="form-control" name="txtNombre" id="txtNombre" value="">
								<input type="text" name="txtIdUsuario" id="txtIdUsuario" hidden>
							</div>
							<div class="form-group">
								<label for="">Correo</label>
								<input type="text" class="form-control" name="txtCorreo" id="txtCorreo" value="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Usuario</label>
								<input type="text" class="form-control" name="txtUsuario" id="txtUsuario" value="">
							</div>
							<div class="form-group">
								<?php if ($_SESSION['rol'] == 1) : ?>

									<label for="">Rol</label>
									<select class="form-control" name="selRoles" id="selRoles" required="required">
										<option selected="selected" value="">Seleccione</option>
										<!--foreach-->
										<?php foreach ($roles as $key => $value) : ?>
											<option value="<?php echo $value['IdRol']; ?>">
												<?php echo $value['Rol']; ?>
											</option>
										<?php endforeach; ?>
									</select>

								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="submit" name="btnEditar" class="btn btn-primary">Guardar Cambios</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Small modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button> -->

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form class="" method="post">

				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel2">Eliminar Usuario</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<p>¿Estas seguro de eliminar el usuario <span id="txtUsuarioEli"></span> ?</p>
						<input type="text" name="txtIdUsuarioEli" id="txtIdUsuarioEli" hidden>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
					<button type="submit" name="btnEliminar" class="btn btn-primary">SI</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!--//modal cambiar estado-->
<div class="modal fade bs-example-modal-sm" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<form class="" method="post">

				<div class="modal-header">
					<h4 class="modal-title" id="myModalLabel2">Cambiar Estado</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<p>¿Estas seguro de cambiar el estado del usuario <span id="txtUsuarioCam"></span> ?</p>
						<input type="text" name="txtIdUsuarioCam" id="txtIdUsuarioCam" hidden>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
					<button type="submit" name="btnCambiarEstado" class="btn btn-success">SI</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div>
	<div class="x_panel">
		<div class="x_title">
			<h2>Registro Usuario <small></small></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<br />
			<form class="form-label-left input_mask" method="post">

				<div class="form-group row">
					<label class="col-form-label col-md-3 col-sm-3 ">Nombre Completo</label>
					<div class="col-md-9 col-sm-9 ">
						<input type="text" class="form-control" name="txtNombre" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-3 col-sm-3 ">Correo</label>
					<div class="col-md-9 col-sm-9 ">
						<input type="email" class="form-control" name="txtCorreo" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-3 col-sm-3 ">Usuario</label>
					<div class="col-md-9 col-sm-9 ">
						<input type="text" class="form-control" name="txtUsuario" required>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-3 col-sm-3 ">Contraseña<span class="required"></span>
					</label>
					<div class="col-md-9 col-sm-9 ">
						<input class="form-control" required="required" id="pass1" name="txtClave" type="password">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-3 col-sm-3 ">Confirmar Contraseña<span class="required"></span>
					</label>
					<div class="col-md-9 col-sm-9 ">
						<input class="form-control" required="required" id="pass2" name="txtClave" type="password">
					</div>
				</div>

				<div class="form-group row">
					<label class="col-form-label col-md-3 col-sm-3 ">Rol<span class="required"></span>
					</label>
					<div class="col-md-9 col-sm-9 ">

						<select class="form-control" name="selRoles" required="required">
							<option selected="selected" value="">Seleccione</option>
							<!--foreach-->
							<?php foreach ($roles as $key => $value) : ?>
								<option value="<?php echo $value['IdRol']; ?>">
									<?php echo $value['Rol']; ?>
								</option>
							<?php endforeach; ?>
						</select>

					</div>
				</div>

				<div class="ln_solid"></div>
				<div class="form-group row">
					<div class="col-md-9 col-sm-9  offset-md-3">
						<button type="button" class="btn btn-primary">Cancelar</button>
						<button class="btn btn-primary" type="reset">Limpiar</button>
						<button type="submit" name="btnGuardar" class="btn btn-success"> Guardar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">

</script>
<script type="text/javascript">
	function datos(nombre, correo, usuario, idrol, idu) {
		$('#txtNombre').val(nombre);
		$('#txtCorreo').val(correo);
		$('#txtUsuario').val(usuario);
		$('#selRoles').val(idrol);
		$('#txtIdUsuario').val(idu);
	}

	function eliminar(nombre, id) {
		$('#txtUsuarioEli').text(nombre);
		$('#txtIdUsuarioEli').val(id);
	}

	function cambiarEstado(nombre, id) {
		$('#txtUsuarioCam').text(nombre);
		$('#txtIdUsuarioCam').val(id);
	}
	var pass1, pass2;
	pass1 = document.getElementById('pass1');
	pass2 = document.getElementById('pass2');
	pass1.onchange = pass2.onkeyup = passwordMatch;

	function passwordMatch() {
		if (pass1.value !== pass2.value) {
			pass2.setCustomValidity('Las contraseñas no coinciden');
		} else {
			pass2.setCustomValidity('');
		}
	}
</script>