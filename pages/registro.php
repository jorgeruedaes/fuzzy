<?php
require('../php/principal.php');
?>
<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Registro | <?php echo String_Get_Valores('titulo') ?> - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="../<?php echo String_Get_Valores('favico') ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />


    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>TEAM</b></a>
            <small><?php echo String_Get_Valores('titulo') ?> - Material Design</small>
        </div>
        <div class="card">
        	<div class="body">
        		<form id="sign_up" name="registration" method="POST">
        			<div class="msg"><small>Recuerda que para poder ingresar el usuario debe ser autorizado por un administrador.</small></div>

                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                        	<input type="text" class="form-control" name="namesurname" placeholder="Nombre de usuario" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                        	<input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">touch_app</i>
                        </span>
                        <select class="form-control show-tick" required>
                            <option value="">-- Selecciona una pregunta --</option>
                            <?php 
                            $vector = Array_Get_Preguntas();
                            foreach ($vector as  $value)
                            {
                               ?>
                             <option value="<?php echo $value['id_preguntas']; ?>"><?php echo $value['pregunta']; ?></option>
                             <?php
                             } 
                         ?>                           
                     </select>
                 </div>
                 <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">question_answer</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" name="respuesta" placeholder="Respuesta" required>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                       <input type="password" class="form-control" name="password" minlength="8" placeholder="Contraseña" required>
                   </div>
               </div>
               <div class="input-group">
                <span class="input-group-addon">
                    <i class="material-icons">lock</i>
                </span>
                <div class="form-line">
                   <input type="password" class="form-control" name="confirm" minlength="8" placeholder="Confirmar contraseña" required>
               </div>
           </div>
           <div class="form-group">
            <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
            <label for="terms">Ya he leido, acepto los <a href="javascript:void(0);">terminos de uso</a>.</label>
        </div>

        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">Registrarse</button>

        <div class="m-t-25 m-b--5 align-center">
            <a href="inicio.php">¿ Ya estas registrado ?</a>
        </div>
    </form>
</div>
</div>
</div>

<!-- Jquery Core Js -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="../plugins/bootstrap/js/bootstrap.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="../plugins/node-waves/waves.js"></script>

<!-- Validation Plugin Js -->
<script src="../plugins/jquery-validation/jquery.validate.js"></script>

<!-- Select Plugin Js -->
<script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Validation Js -->
<script src="../js/registro.js"></script>

<!-- Custom Js -->
<script src="../js/admin.js"></script>
<script src="../js/pages/examples/sign-up.js"></script>
</body>

</html>