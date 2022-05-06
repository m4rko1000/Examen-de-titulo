<div class="row">
	<div class="col-md-12">
<h1>Reportes</h1>
<br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="reports">
  <div class="form-group">
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon">INICIO</span>
		  <input type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>
    <div class="col-lg-3">
		<div class="input-group">
		  <span class="input-group-addon">FIN</span>
		  <input type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>
    <div class="col-lg-6">
    <button class="btn btn-primary btn-block">Procesar</button>
    </div>

  </div>
</form>
<?php
if(isset($_GET["start_at"]) && $_GET["start_at"]!="" && isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){
	$users = OperationData::getByRange($_GET["start_at"],$_GET["finish_at"]);
		if(count($users)>0){
			// si hay usuarios
			$_SESSION["report_data"] = $users;
			?>
			<div class="panel panel-default">
			<div class="panel-heading">
			Reportes</div>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Sucursal</th>
			<th>Bodega</th>
			<th>Cliente</th>
			<th>Fecha Inicio</th>
			<th>Fecha Termino</th>
			<th>Fecha de Retorno</th>
			<th>Precio por dia</th>
			<th>Ultima Mantencion</th>
			<th>Empresa de la mantencion</th>
			<th>Costo de la mantencion</th>
			</thead>
			<?php
			$total = 0;
			foreach($users as $user){
				$item  = $user->getItem();
				$client  = $user->getClient();
				$book = $item->getBook();
				
				
				
				?>
				<tr>
				
				<td><?php echo $book->isbn; ?></td>
				<td><?php echo $item->code; ?></td>
				<td><?php echo $client->name." ".$client->lastname; ?></td>
				<td><?php echo $user->start_at; ?></td>
				<td><?php echo $user->finish_at; ?></td>
				<td><?php echo $user->returned_at; ?></td>
				<td><?php echo $book->subtitle; ?></td>
				<td><?php echo $item->ultima_mantencion; ?></td>
				<td><?php echo $item->empresa; ?></td>
				<td><?php echo $item->costo; ?></td>
				
				
				</tr>
				<?php

			}
			echo "</table>";
			?>
			<?php
		}else{
			echo "<p class='alert alert-danger'>No hay datos.</p>";
		}
		}else{
			echo "<p class='alert alert-danger'>Debes seleccionar un rango de fechas.</p>";
		}


		?>


	</div>
</div>