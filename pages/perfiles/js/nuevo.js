//	var Creador = '<?php echo $usuario['id_perfiles']; ?>'
$(function() {

	var perfiles = {
		inicio: function () {
			perfiles.recargar();
		},
		recargar: function () {
			perfiles.enviarDatos();
			perfiles.borrarUsuario();
			perfiles.editarItem();
			perfiles.editarModulos();
			perfiles.addPerfil();
		},
		enviarDatos: function () {
			$('.guardar').off('click').on('click', function () {
				$.ajax({
					url: 'pages/perfiles/peticiones/peticiones.php',
					type: 'POST',
					data: {
						bandera: "modificar",
						id_perfiles: $('.select-perfiles option:selected').val(),
						estado: $('.select-estados option:selected').val(),
						id_perfiles: $('#defaultModal').data('usuario')

					},
					success: function (resp) {

						var resp = $.parseJSON(resp);
						if (resp.salida === true && resp.mensaje === true) {
							swal({title: "",
								text: "El usuario se ha modificado exitosamente!",
								type: "success",
								showCancelButton: false,
								confirmButtonColor: "rgb(174, 222, 244)",
								confirmButtonText: "Ok",
								closeOnConfirm: false
							}, function (isConfirm) {
								if (isConfirm) {
									window.location.reload();
								}
							});
						} else {
							swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
						}
					}
				});
			});

		},
		borrarUsuario: function () {
			$('.delete-item').off('click').on('click', function () {
				var valor = $(this);
				swal({
					title: "¿ Esta seguro ?",
					text: "El usuario ya no podra realizar acciones en el aplicativo!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Si,Eliminalo!",
					cancelButtonText: "No,Cancelalo!",
					closeOnConfirm: false,
					closeOnCancel: false
				}, function (isConfirm) {
					if (isConfirm) {
						perfiles.desactivar(valor);
					} else {
						swal("Cancelado", "", "error");
					}
				});

			});


		},
		desactivar: function(valor)
		{
			$.ajax({
				url: 'pages/perfiles/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "eliminar",
					id_perfiles: valor.data('id')

				},
				success: function (resp) {

					var resp = $.parseJSON(resp);
					if (resp.salida === true && resp.mensaje === true) {
						swal({
							title: "",
							text: "El usuario se ha eliminado exitosamente!",
							type: "info",
							showCancelButton: false,
							confirmButtonColor: "rgb(174, 222, 244)",
							confirmButtonText: "Ok",
							closeOnConfirm: false
						}, function (isConfirm) {
							if (isConfirm) {
								window.location.reload();
							}
						});
					} else {
						swal("", "Ha ocurrido un error, intenta nuevamente.", "error");
					}
				}
			});
		},
		cargarModal: function(nombre,nivel,perfil)
		{
			$('.nombre').val(nombre);
			$('.nivel').val(nivel);
			$('#defaultModal').data('perfil',perfil);
			$('#defaultModal').modal('show'); 
			perfiles.recargar();
		},
		cargarModalModulos: function(nombre,perfil,modulos)
		{
			$('#defaultModalLabel1').text('Editar Permisos del perfil : ' + nombre);
			$('#ModalModulos').data('perfil',perfil);
			perfiles.Selecionarmodulos(modulos);
			$('#ModalModulos').modal('show'); 
			perfiles.recargar();
		},
		addPerfil : function()
		{
			$('.add-perfil').off('click').on('click', function () {	
				$('#nuevoPerfil').modal('show'); 
			});

		},
		editarModulos : function()
		{
			$('.edit-modulos').off('click').on('click', function () {	
				var nombre = $(this).data('nombre');
				var perfil = $(this).data('id');
				var modulos = $(this).data('modulos');
				perfiles.cargarModalModulos(nombre,perfil,modulos);
			});
		},

		editarItem : function()
		{
			$('.edit-item').off('click').on('click', function () {
				var nombre = $(this).data('nombre');
				var nivel = $(this).data('nivel');
				var perfil = $(this).data('id');
				perfiles.cargarModal(nombre,nivel,perfil);
			});
		},
		Selecionarmodulos : function(modulos)
		{
			$('input').prop("checked", "");
			for (i = 0; i < modulos.length; i++) { 
				$('div').find("[data-id='"+modulos[i]+"']").prop("checked", "checked");
			}


		}
	};
	$(document).ready(function () {

		perfiles.inicio();

	});

});