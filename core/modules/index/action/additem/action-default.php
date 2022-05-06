<?php

if(count($_POST)>0){
	$user = new ItemData();
	$user->code = $_POST["code"];
	$user->book_id = $_POST["book_id"];
	$user->status_id = $_POST["status_id"];
	$user->empresa = $_POST["empresa"];
	$user->encargado = $_POST["encargado"];
	$user->tipo = $_POST["tipo"];
	$user->fecha_inicio = $_POST["fecha_inicio"];
	$user->fecha_termino = $_POST["fecha_termino"];
	$user->ultima_mantencion = $_POST["ultima_mantencion"];
	$user->costo = $_POST["costo"];
	$user->add();

print "<script>window.location='index.php?view=items&id=$_POST[book_id]';</script>";


}


?>