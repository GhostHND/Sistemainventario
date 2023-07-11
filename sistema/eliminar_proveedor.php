<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM empleado WHERE codEmple = $id");
    mysqli_close($conexion);
    header("location: lista_proveedor.php");
}
?>