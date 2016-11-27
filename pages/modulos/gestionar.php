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
	<script src="pages/perfiles/js/nuevo.js"></script>

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


	<div class="modal fade" id="ModalModulos" data-usuario="" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="defaultModalLabel1"></h4>
				</div>
				<div class="modal-body">

					<div class="body">
						<div class="row clearfix">
							<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
								<div class="panel-group" id="accordion_1" role="tablist"
								aria-multiselectable="true">
							<!--		<div class="panel panel-info">
										<div class="panel-heading" role="tab" id="headingOne_0">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" 
												data-parent="#accordion_1"
												href="#collapseOne_0" aria-expanded="true" aria-controls="collapseOne_0">
												COLAPSABLES
											</a>
										</h4>
									</div>
									<div id="collapseOne_0"
									class="panel-collapse collapse in" role="tabpanel" 
									aria-labelledby="headingOne_0">
									<div class="panel-body">
										<small>Selecciona los modulos a los cuales tendra
											ahora acceso el perfil.</small>
										</div>
									</div>
								</div>-->
								<?php
								$vector = Array_Get_Modulos(true,'');
								foreach ($vector as $value) {	
									?>
									<div class="panel panel-primary">
										<div class="panel-heading" role="tab" id="headingOne_<?php echo $value['id_modulos']; ?>">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" 
												data-parent="#accordion_1"
												href="#collapseOne_<?php echo $value['id_modulos']; ?>" 
												aria-expanded="false" aria-controls="collapseOne_<?php echo $value['id_modulos']; ?>">
												<?php echo $value['nombre']; ?>
											</a>
										</h4>
									</div>
									<div id="collapseOne_<?php echo $value['id_modulos']; ?>"
										class="panel-collapse collapse " role="tabpanel" 
										aria-labelledby="headingOne_<?php echo $value['id_modulos']; ?>">
										<div class="panel-body">
											<?php
											$variable = Array_Get_Modulos(False,$value['id_modulos']);
											foreach ($variable as $values) {	
												?>
												<div class="row clearfix">
													<div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
														<input data-id='<?php echo $values['id_modulos']?>' type="checkbox" id="basic_checkbox_<?php echo $values['id_modulos']?>" class="filled-in modulo-<?php echo $values['id_modulos']?>"/>
														<label for="basic_checkbox_<?php echo $values['id_modulos']?>"><?php echo $values['nombre']; ?></label>
													</div>
												</div>
												<?php
											}
											?>
										</div>
									</div>
								</div>

								<?php 
							}
							?>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-info waves-effect guardar">Guardar cambios</button>
						<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
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