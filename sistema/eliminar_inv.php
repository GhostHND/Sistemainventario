<?php
if (!empty($_GET['id'])) {
    require("../conexion.php");
    $id = $_GET['id'];
    $query_delete = mysqli_query($conexion, "DELETE FROM inventario  WHERE codigo = $id");
    mysqli_close($conexion);
    header("location: lista_inv.php");
}
?>