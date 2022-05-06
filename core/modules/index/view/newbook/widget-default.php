<?php
$book = BookData::getAll();
$categories = CategoryData::getAll();
$authors = AuthorData::getAll();
$editorials = EditorialData::getAll();

?>

<div class="row">
<div class="col-md-12">
<h1>Nueva Sucursal</h1>
<form class="form-horizontal" role="form" method="post" action="./?action=addbook" id="addbook">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Sucursal</label>
    <div class="col-lg-10">
      <input type="text" name="isbn" class="form-control" id="inputEmail1" placeholder="Sucursal">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria / Tamaño</label>
    <div class="col-lg-10">
      <input type="text" name="title" required class="form-control" id="inputEmail1" placeholder="Categoria (Tamaño x M2)">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Costo por Dia</label>
    <div class="col-lg-10">
      <input type="text" name="subtitle" class="form-control" id="inputEmail1" placeholder="Costo X Dia">
    </div>
  </div>

   <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo de la Camara</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="codCamara" placeholder="Codigo (ip)"></textarea>
    </div>
  </div>
    <label for="inputEmail1" class="col-lg-2 control-label">A&ntilde;o de la bodega</label>
    <div class="col-lg-4">
      <input type="text" name="year" class="form-control" id="inputEmail1" placeholder="A&ntilde;o">
    </div>

  </div>
    







  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Empresa</button>
      <button type="reset" class="btn btn-default" id="clear">Limpiar Campos</button>
    </div>
  </div>
</form>

</div>
</div>
