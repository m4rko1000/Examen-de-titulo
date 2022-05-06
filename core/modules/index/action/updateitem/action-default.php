<?php

if(count($_POST)>0){
	$user = ItemData::getById($_POST["item_id"]);
	$user->code = $_POST["code"];
	$user->status_id = $_POST["status_id"];
	$user->empresa = $_POST["empresa"];
	$user->encargado = $_POST["encargado"];
	$user->tipo = $_POST["tipo"];
	$user->fecha_inicio = $_POST["fecha_inicio"];
	$user->fecha_termino = $_POST["fecha_termino"];
	$user->ultima_mantencion = $_POST["ultima_mantencion"];
	$user->costo = $_POST["costo"];
	$user->update();

print "<script>window.location='index.php?view=items&id=$user->book_id';</script>";


}


?>