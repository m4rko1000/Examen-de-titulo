<?php
?>
<div class="row">
	<div class="col-md-12">
		<a href="index.php?view=newbook" class="btn btn-default pull-right"><i class="fa fa-book"></i> Nueva Sucursal</a>

		<h1>Sucursal</h1>


		<?php
		$books = BookData::getAll();
		if (count($books) > 0) {

		?>
			<table class="table table-bordered table-hover">
				<thead>
					<th>Sucursal</th>
					<th>Categoria / Tamaño</th>
					<th>Costo X Dia</th>
					<th>Ejemplares</th>
					<th>Disponibles</th>
					<th></th>
				</thead>
				<?php
				foreach ($books as $user) {
					$category  = $user->getCategory();
				?>
					<tr>
						<td><?php echo $user->isbn; ?></td>
						<td><?php echo $user->title; ?></td>
						<td><?php echo $user->subtitle; ?></td>
						<td><?php echo ItemData::countByBookId($user->id)->c; ?></td>
						<td><?php echo ItemData::countAvaiableByBookId($user->id)->c; ?></td>

						<td style="width:210px;">
							<a href="index.php?view=items&id=<?php echo $user->id; ?>" class="btn btn-default btn-xs">Ejemplares</a>



							<a href="index.php?view=editbook&id=<?php echo $user->id; ?>" class="btn btn-warning btn-xs">Editar</a>
							<a href="index.php?action=delbook&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs">Eliminar</a>
						</td>
					</tr>
				<?php

				}


				?>
			</table>
		<?php

		} else {
			echo "<p class='alert alert-danger'>No hay bodegas</p>";
		}


		?>


	</div>
</div>