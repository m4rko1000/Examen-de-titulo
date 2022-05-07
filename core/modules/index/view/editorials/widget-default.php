<div class="row">
	<div class="col-md-12">
		<div class="btn-group pull-right">
			<a href="index.php?view=neweditorial" class="btn btn-default"><i class='fa fa-th-list'></i> Agregar sucursales.</a>
		</div>
		<h1>Sucursales</h1>
		<br>
		<?php

		$users = EditorialData::getAll();
		if (count($users) > 0) {

		?>

			<table class="table table-bordered table-hover">
				<thead>
					<th>Sucursal</th>
					<th>Dirección</th>
					<th>Contacto</th>
					<th>Bodegas</th>
					<th>Disponibles</th>
				</thead>
				<?php
				foreach ($users as $user) {
				?>
					<tr>
						<td><?php echo $user->name; ?></td>
						<td><?php echo $user->direccion; ?></td>
						<td><?php echo $user->contacto; ?></td>
						<td><?php echo ItemData::countByBookId($user->id)->c; ?></td>
						<td><?php echo ItemData::countAvaiableByBookId($user->id)->c; ?></td>
						<td style="width:130px;"><a href="index.php?view=editeditorial&id=<?php echo $user->id; ?>" class="btn btn-warning btn-xs">Editar Sucursal</a>
							<a href="index.php?view=newbook&id=<?php echo $user->id; ?>" class="btn btn-default btn-xs">Bodegas</a>
							<a href="index.php?action=deleditorial&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs">Eliminar Sucursal</a>
					</tr>
				<?php

				} ?>
			</table>
		<?php
		} else {
			echo "<p class='alert alert-danger'>No hay Editoriales</p>";
		}


		?>


	</div>
</div>