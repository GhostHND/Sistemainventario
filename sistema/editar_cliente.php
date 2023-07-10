<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['cantidad']) || empty($_POST['descripcion']) ) {
    $alert = '<p class"error">Todo los campos son requeridos</p>';
  } else {
    $codigo = $_POST['codigo'];
        $cantidad = $_POST['cantidad'];
        $depto= $_POST['depto'];
        $descripcion = $_POST['descripcion'];
        $color = $_POST['color'];
        $marca = $_POST['marca'];
        $valor = $_POST['valor'];

    $result = 0;
    if (is_numeric($codigo) and $codigo != 0) {

      $query = mysqli_query($conexion, "SELECT * FROM inventario where codigo = '$codigo'");
      $result = mysqli_fetch_array($query);
      $resul = mysqli_num_rows($query);
    }

    if ($resul >= 1) {
      $alert = '<p class"error">El codigo ya existe</p>';
    } else {
      if ($codigo == '') {
        $codigo = 0;
      }
      $sql_update = mysqli_query($conexion, "UPDATE inventario SET  = cantidad = '$cantidad' , depto = '$depto', descripcion = '$descripcion', color = '$color' , marca = '$marca', valor = '$valor' WHERE codigo = $codigo");

      if ($sql_update) {
        $alert = '<p class"exito">Inventario Actualizado correctamente</p>';
      } else {
        $alert = '<p class"error">Error al Actualizar el Inventario</p>';
      }
    }
  }
}
// Mostrar Datos

if (empty($_REQUEST['id'])) {
  header("Location: lista_cliente.php");
}
$codigo = $_REQUEST['id'];
$sql = mysqli_query($conexion, "SELECT * FROM inventario WHERE codigo = $codigo");
$result_sql = mysqli_num_rows($sql);
if ($result_sql == 0) {
  header("Location: lista_cliente.php");
} else {
  while ($data = mysqli_fetch_array($sql)) {
    $codigo = $data['codigo'];
        $cantidad = $data['cantidad'];
        $depto= $data['depto'];
        $descripcion = $data['descripcion'];
        $color = $data['color'];
        $marca = $data['marca'];
        $valor = $data['valor'];
  }
}
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-6 m-auto">

              <form class="" action="" method="post">
                <?php echo isset($alert) ? $alert : ''; ?>
                <input type="hidden" name="id" value="<?php echo $codigo; ?>">
                <div class="form-group">
                  <label for="cantidad">cantidad</label>
                  <input type="number" placeholder="Ingrese cantidad" name="cantidad" id="cantidad" class="form-control" value="<?php echo $cantidad; ?>">
                </div>
                <div class="form-group">

              <label for="nombre">Departamento</label>
              <?php $query_depto = mysqli_query($conexion, "SELECT * FROM depto ORDER BY depto ASC");
              $resultado_depto = mysqli_num_rows($query_depto);
              mysqli_close($conexion);
              ?>
              <select id="depto" name="depto" class="form-control">
                <option value="<?php echo $data_producto['id_depto']; ?>" selected><?php echo $data_producto['depto']; ?></option>
                <?php
                if ($resultado_depto > 0) {
                  while ($depto = mysqli_fetch_array($query_depto)) {
                    // code...
                ?>
                    <option value="<?php echo $depto['id_depto']; ?>"><?php echo $depto['depto']; ?></option>
                <?php
                  }
                }
                ?>
              </select>
            </div>

                <div class="form-group">
                  <label for="descripcion">descripcion</label>
                  <input type="text" placeholder="Ingrese descripcion" name="descripcion" class="form-control" id="descripcion" value="<?php echo $descripcion; ?>">
                </div>
                <div class="form-group">
                  <label for="color">color</label>
                  <input type="text" placeholder="Ingrese color" name="color" class="form-control" id="color" value="<?php echo $color; ?>">
                </div>
                <div class="form-group">
                  <label for="marca">marca</label>
                  <input type="text" placeholder="Ingrese marca" name="marca" class="form-control" id="marca" value="<?php echo $marca; ?>">
                </div>
                <div class="form-group">
                  <label for="direccion">valor</label>
                  <input type="number" placeholder="Ingrese valor" name="valor" class="form-control" id="valor" value="<?php echo $valor; ?>">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Editar Inventario</button>
              </form>
            </div>
          </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <?php include_once "includes/footer.php"; ?>