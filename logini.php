<?php
//error_reporting(0);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | ACFO </title>
  <link rel="stylesheet" type="text/css" href="css/usuario.css" />
  <script language="javascript">
    function validar() {
      if (document.formulario.user.value == "" || document.formulario.pass.value == "") {
        alert("Por favor ingrese los dos datos");
      } else {
        document.getElementById("formulario").submit();
      }
    }
  </script>
</head>

<body>
  <main class="container__main">
    <section class="container__head">
      <img class="container__logo" src="./imagenes/logo-acfo.png" alt="Logo ACFO">
      <div class="container__title-login">LOGIN ADMINISTRADOR</div>
    </section>
    <p class="container__title">PARA USO EXCLUSIVO DE ACFO </p>
    <form action="login.php" method="POST" id="formulario"  class="container__form" name="formulario">
      <label class="container__form--label">Usuario</label>
      <input type="text" name="user" class="container__form--input" >
      <label class="container__form--label">Contraseña</label>
      <input type="password" name="pass" class="container__form--input">
      <button type="button" class="container__form--button" id="boton" onClick="validar()">Aceptar</button>
    </form>
  </main>
</body>

</html>