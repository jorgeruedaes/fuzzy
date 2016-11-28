<?php  
$ubicacion ="../";
$id_modulos="20";
include("../menuinicial.php");
if(Boolean_Get_Modulo_Permiso($id_modulos,$_SESSION['perfil'])){
	?>

	<!-- JQuery DataTable Css -->
	<link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">


	<section class="content">
		<div class="container-fluid">
			<div class="block-header">
				<h2>
					<ol class="breadcrumb">
						<li>
							<a href="pages/administracion.php">
								<!--<i class="material-icons">home</i>-->
								Administración
							</a>
						</li>
						<?php
						$vector = Array_Get_PadreHijo($id_modulos);
						foreach ($vector as $value)
						{
							?>
							<li>
								<a href="<?php echo $value['ruta'] ?>" class="active">
									<!--<i class="material-icons"><?php echo $value['icono'] ?></i>-->
									<?php echo $value['nombre'] ?>
								</a>
							</li>
							<?php
						}
						?>
					</ol>
				</h2>
			</div>
			<!-- Basic Examples -->
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2>
								GESTIÓN DE MODULOS
							</h2>
						</div>
						<div class="body">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Tipo</th>
										<th>Padre</th>
										<th>Ruta</th>
										<th>Icono</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$vector = Array_Get_Modulos_All();
									$i=1;
									foreach ($vector as $value) {
										?>
										<tr>
											<td><?php echo $i ?></td>
											<td><?php echo $value['nombre'] ?></td>
											<td><?php echo ($value['submenu']==1)?"Principal":"Submenu" ?></td>
											<td><?php echo String_Get_NombreModulo($value['padre']); ?></td>
											<td><?php echo $value['ruta']; ?></td>
											<td><i class="material-icons"><?php echo $value['icono']; ?></i></td>
											<td>
												<div class="btn-group btn-group-xs" role="group" aria-label="Extra-small button group">
													<button data-id="<?php echo $value['id_modulos']?>"  type="button" class="btn bg-blue waves-effect edit-modulo" data-toggle="modal" > <i class="material-icons">edit</i></button>

													<button data-id="<?php echo $value['id_modulos']?>" type="button" class="btn bg-red waves-effect delete-modulo"> <i class="material-icons">delete</i></button>
												</div>	
												
											</td>
										</tr>
										<?php
										$i++; 
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- JS ====================================================================================================================== -->
	<!--  Js-principal -->
	<script src="pages/modulos/js/modulos.js"></script>

	<!-- Jquery DataTable Plugin Js -->
	<script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
	<script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<!-- Custom Js -->
	<script src="js/pages/tables/jquery-datatable.js"></script>



	<!-- Modal Dialogs ====================================================================================================================== -->
	<!-- Default Size -->
	<div class="modal fade" id="defaultModal" data-perfil="" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel">Edición perfíl</h4>
				</div>
				<div class="modal-body">

					<div class="body">
						<form>
							<label for="perfil">Perfil</label>
							<div class="form-group">
								<div class="form-line">
									<input type="text" class="form-control nombre" placeholder="Nombre perfil" />
								</div>
							</div>
							<label for="estado">Nivel</label>
							<div class="form-group ">
								<div class="form-line">
									<input type="number" class="form-control nivel" placeholder="Nivel" />
								</div>
							</div>

						</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info waves-effect guardar">Guardar cambios</button>
					<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	


<?php
}else
{
	require("../sinpermiso.php");
}
?>