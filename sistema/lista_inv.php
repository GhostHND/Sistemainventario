<?php include_once "includes/header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Inventario</h1>
		<a href="registro_inv.php" class="btn btn-primary">Nuevo</a>
	</div>

	<div class="row">
		<div class="col-lg-12">

			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table">
					<thead class="thead-dark">
						<tr>
							<th>CODIGO</th>
							<th>CANTIDAD</th>
							<th>DEPARTAMENTO</th>
							<th>DESCRIPCIÓN</th>
							<th>COLOR</th>
							<th>MARCA</th>
							<th>VALOR</th>
							<?php if ($_SESSION['rol'] == 1) { ?>
							<th>ACCIONES</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						include "../conexion.php";

						$query = mysqli_query($conexion, "SELECT * FROM inventario");
						$result = mysqli_num_rows($query);
						if ($result > 0) {
							while ($data = mysqli_fetch_assoc($query)) { ?>
								<tr>
									<td><?php echo $data['codigo']; ?></td>
									<td><?php echo $data['cantidad']; ?></td>
									<td><?php echo $data['depto']; ?></td>
									<td><?php echo $data['descripcion']; ?></td>
									<td><?php echo $data['color']; ?></td>
									<td><?php echo $data['marca']; ?></td>
									<td><?php echo $data['valor']; ?></td>
									<?php if ($_SESSION['rol'] == 1) { ?>
									<td>
										<a href="editar_inv.php?id=<?php echo $data['codigo']; ?>" class="btn btn-success"><i class='fas fa-edit'></i></a>
										<form action="eliminar_inv.php?id=<?php echo $data['codigo']; ?>" method="post" class="confirmar d-inline">
											<button class="btn btn-danger" type="submit"><i class='fas fa-trash-alt'></i> </button>
										</form>
									</td>
									<?php } ?>
								</tr>
						<?php }
						} ?>
					</tbody>

				</table>
			</div>

		</div>
	</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php include_once "includes/footer.php"; ?>