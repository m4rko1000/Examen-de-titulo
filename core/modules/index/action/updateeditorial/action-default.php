<?php

if(count($_POST)>0){
	$user = EditorialData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->direccion = $_POST["direccion"];
	$user->contacto = $_POST["contacto"];
	$user->update();
print "<script>window.location='index.php?view=editorials';</script>";


}


?>