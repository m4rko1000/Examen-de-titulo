<?php

if(count($_POST)>0){
	$user = new CamaraData();
	$user->code = $_POST["codigo"];
	$user->book_id = $_POST["book_id"];
	
	$user->add();

print "<script>window.location='index.php?view=items&id=$_POST[book_id]';</script>";


}


?>