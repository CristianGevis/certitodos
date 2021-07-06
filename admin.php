<?php
//error_reporting( 0 );
session_start();
include("conexion.php");

if (!$_SESSION) {
  echo '<script language = javascript>
alert("No tiene permisos para ingresar al sistema")
self.location = "certificados.php"
</script>';
}



// Zebra Pagination
require_once("./Zebra_Pagination-2.2.0/Zebra_Pagination.php");

$resul_prov = mysqli_query($conex, "SELECT * FROM participantes ORDER BY id");
$num_registros = mysqli_num_rows($resul_prov);

$resultados = 18;

$paginacion = new Zebra_Pagination();
$paginacion->records($num_registros);
$paginacion->records_per_page($resultados);
// Quitar ceros en numeros con 1 digito en paginacion
$paginacion->padding(false);

$resul_prov = mysqli_query($conex, "SELECT * FROM participantes ORDER BY id LIMIT " . (($paginacion->get_page() - 1) * $resultados) . ", " . $resultados);


$num_fila = 0;

if ($num_registros == 0) {
  echo "No se han encontrado participantes para mostrar";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <LINK rel=StyleSheet href="./css/estilolistar.css">
  <title>Documento sin título</title>


  <script language="javascript">
    function validar() {
      if (document.getElementById("busca").value == "")

      {
        alert("Por favor escriba la cedula que desea buscar..!");
      } else {
        document.getElementById("form2").submit();
      }
    }

    function validar_nombre() {
      if (document.getElementById("busca1").value == "")

      {
        alert("Por favor escriba el nombre que desea buscar..!");
      } else {
        document.getElementById("form3").submit();
      }
    }
  </script>

</head>

<body>
  <!---------------------Section Header Menu---------------------------------->
  <header class="container__header">
    <section class="container__header--menutop">
      <span class="container__header--menutop-logo"></span>
      <h1 class="container__header--menutop-title">ACFO</h1>
      <button type="button" class="container__header--menutop-boton" onclick="window.location.href='desconectar.php'"> CERRAR SESION</button>
    </section>
    <section class="container__header--menubottom">
      <ul class="container__header--menubottom-nav">
        <li class="container__header--menubottom-navitems"><a href="#">Tabla Paticipantes</a></li>
        <li class="container__header--menubottom-navitems"><a href="#">Cargar Datos</a></li>
      </ul>

    </section>
  </header>

  <!-----------------------Section Main----------------------------------------->
  <div class="container__menu">
    <form action="verbuscado_nombre.php" method="post" name="form3" class="container__menu--formulariobuscar" id="form3">
      <label>Buscar Nombre: </label>
      <input name="busca1" id="busca1" type="text" class="container__formulariobuscar--entrada" autofocus />
      <button type="button" class="container__formulariobuscar--botonbuscar" onClick="validar_nombre()"> Buscar</button>
    </form>

    <form action="verbuscado.php" method="post" name="form2" class="container__menu--formulariobuscar" id="form2">
      <label>Buscar Documento: </label>
      <input name="busca" id="busca" type="text" class="container__formulariobuscar--entrada" autofocus />
      <button type="button" class="container__formulariobuscar--botonbuscar" onClick="validar()"> Buscar</button>
    </form>
  </div>

  <div class="cont1">
    <div id="stylized">
      <p><span style="font-weight:bold; color:#036">PARTICIPANTES: </span></p>
    </div>
    <br /><br /><br />


    <span>
      <table sclass="info">
        <tr id="cabeza">`
          <td>Nombre</td>
          <td>Identificación</td>
          <td>Evento</td>
          <td>Descarga</td>
          <td colspan="3">Editar</td>
        </tr>
        <?php
        while ($fila = mysqli_fetch_array($resul_prov)) {
          if ($num_fila % 2 == 0) {
        ?>
            <tr>
              <td class="margentexto"><?php echo $fila['nombre']; ?></td>
              <td class="margentexto"><?php echo $fila['identi']; ?></td>
              <td class="margentexto">
                <?php
                $resul_congre = mysqli_query($conex, "SELECT idcongreso, nombrecongreso FROM congresos WHERE publicado=1 ORDER BY idcongreso ASC");
                while ($fila1 = mysqli_fetch_row($resul_congre)) {
                  if ($fila1['0'] == $fila['congreso']) {
                    echo $fila1['1'];
                    $eve1 =  $fila1['1'];
                  }
                }
                ?>
              </td>

              <td><?php echo $fila['descarga']; ?></td>
              </td>
              <td><a class="Ntooltip" href="modifica.php?cod=<?php echo $fila['id']; ?>&eve=<?php echo $eve1; ?>"><img src="imagenes/editar.png" style="border:none" /><span>Editar</span></a></td>
            </tr>
          <?php
          } else {
          ?>
            <tr>
              <td class="margentexto"><?php echo $fila['nombre']; ?></td=>
              <td class="margentexto"><?php echo $fila['identi']; ?></td>
              <td class="margentexto">
                <?php
                $resul_congre = mysqli_query($conex, "SELECT idcongreso, nombrecongreso FROM congresos WHERE publicado=1 ORDER BY idcongreso ASC");
                while ($fila1 = mysqli_fetch_row($resul_congre)) {
                  if ($fila1['0'] == $fila['congreso']) {
                    echo $fila1['1'];
                    $eve1 =  $fila1['1'];
                  }
                }
                ?>

              </td>
              <td class="margentexto"><?php echo $fila['descarga']; ?></td>

              </td>
              <td><a class="Ntooltip" href="modifica.php?cod=<?php echo $fila['id']; ?>&eve=<?php echo $eve1; ?>"><img src="imagenes/editar.png" style="border:none" /><span>Editar</span></a></td>
            </tr>
          <?php
          }
          ?>
        <?php
          //aumentamos en uno el número de filas 
          $num_fila++;
        }
        ?>
      </table>
    </span>
    <table>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?php $paginacion->render(); ?></td>
      </tr>
    </table>
  </div>
</body>


</html>