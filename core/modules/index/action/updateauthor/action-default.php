<?php

if(count($_POST)>0){
	$user = AuthorData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
    $user->encargado = $_POST["encargado"];
	$user->Tipo_mantencion = $_POST["Tipo_mantencion"];	
	$user->precio = $_POST["precio"];
	$user->update();
print "<script>window.location='index.php?view=authors';</script>";


}


?>