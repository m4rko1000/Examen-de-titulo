<?php
$imagenCodificada = file_get_contents("php:
if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");

$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));



$imagenDecodificada = base64_decode($imagenCodificadaLimpia);


$nombreImagenGuardada = "foto_" . uniqid() . ".png";


file_put_contents($nombreImagenGuardada, $imagenDecodificada);


exit($nombreImagenGuardada);
?>