<?php include_once "includes/header.php";
include "../conexion.php";
if (!empty($_POST)) {
    $alert = "";
    if (empty($_POST['cantidad']) || empty($_POST['descripcion']) ) {
        $alert = '<div class="alert alert-danger" role="alert">
                                    Todo los campos son obligatorio
                                </div>';
    } else {
        $codigo = $_POST['codigo'];
        $cantidad = $_POST['cantidad'];
        $depto= $_POST['depto'];
        $descripcion = $_POST['descripcion'];
        $color = $_POST['color'];
        $marca = $_POST['marca'];
        $valor = $_POST['valor'];
        $usuario_id = $_SESSION['idUser'];

        $result = 0;
        if (is_numeric($codigo) and $codigo != 0) {
            $query = mysqli_query($conexion, "SELECT * FROM inventario where codigo = '$codigo'");
            $result = mysqli_fetch_array($query);
        }
        if ($result > 0) {
            $alert = '<div class="alert alert-danger" role="alert">
                                    El codigo ya existe
                                </div>';
        } else {
            $query_insert = mysqli_query($conexion, "INSERT INTO inventario(codigo,cantidad,depto,descripcion,color,marca,valor, usuario_id) values ('$codigo', '$cantidad','$depto', '$descripcion', '$color','$marca','$valor', '$usuario_id')");
            if ($query_insert) {
                $alert = '<div class="alert alert-primary" role="alert">
                                    inventario Registrado
                                </div>';
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                                    Error al Guardar
                            </div>';
            }
        }
    }
    mysqli_close($conexion);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Inventario</h1>
        <a href="lista_cliente.php" class="btn btn-primary">Regresar</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 m-auto">
            <form action="" method="post" autocomplete="off">
                <?php echo isset($alert) ? $alert : ''; ?>
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="number" placeholder="Ingrese codigo" name="codigo" id="codigo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" placeholder="Ingrese cantidad" name="cantidad" id="cantidad" class="form-control">
                </div>
                <div class="form-group">
           <label>Departamentos</label>
           <?php
            $query_depto = mysqli_query($conexion, "SELECT  depto FROM depto ORDER BY depto ASC");
            $resultado_depto = mysqli_num_rows($query_depto);
            mysqli_close($conexion);
            ?>
           <select id="depto" name="depto" class="form-control">
             <?php
              if ($resultado_depto > 0) {
                while ($depto = mysqli_fetch_array($query_depto)) {
                  // code...
              ?>
                 <option value="<?php echo $depto['depto']; ?>"><?php echo $depto['depto']; ?></option>
             <?php
                }
              }
              ?>
           </select>
         </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" placeholder="Ingrese Descripción" name="descripcion" id="descripcion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" placeholder="Ingrese color" name="color" id="color" class="form-control">
                </div>
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" placeholder="Ingrese Marca" name="marca" id="marca" class="form-control">
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" placeholder="Ingrese Valor" name="valor" id="valor" class="form-control">
                </div>
                <input type="submit" value="Guardar Inventario" class="btn btn-primary">
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "includes/footer.php"; ?>