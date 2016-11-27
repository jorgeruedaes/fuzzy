
$(function() {

var resgistro = {
	inicio: function () {
		resgistro.recargar();
	},
	recargar: function () {
		resgistro.enviarDatos();
	},
	enviarDatos: function () {
		$('.guardar').off('click').on('click', function () {
			$.ajax({
				url: 'pages/usuarios/peticiones/peticiones.php',
				type: 'POST',
				data: {
					bandera: "guardar",
					id_perfiles: $('.select-perfiles option:selected').val(),
					estado: $('.select-estados option:selected').val(),
					id_usuarios: $('#defaultModal').data('usuario')

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
	validarContraseña: function(){

	},
  ValidarExistenciaUsuario : function(){

  }
};
$(document).ready(function () {

	resgistro.inicio();

});

	});