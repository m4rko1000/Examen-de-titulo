<?php
$book = BookData::getById($_GET["id"]);
$categories = CategoryData::getAll();
$authors = AuthorData::getAll();
$editorials = EditorialData::getAll();

?>

<div class="row">
<div class="col-md-12">
<h1><?php echo $book->title; ?> <small>Editar Bodega</small></h1>
<form class="form-horizontal" role="form" method="post" action="./?action=updatebook" id="addbook">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Sucursal</label>
    <div class="col-lg-10">
      <input type="text" name="isbn" class="form-control" value="<?php echo $book->isbn; ?>" id="inputEmail1" placeholder="Sucursal">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Categoria / Tamaño</label>
    <div class="col-lg-10">
      <input type="text" name="title" required class="form-control" value="<?php echo $book->title; ?>" id="inputEmail1" placeholder="Categoria (Tamaño x M2)">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Precio de la bodega</label>
    <div class="col-lg-10">
      <input type="text" name="subtitle" class="form-control" value="<?php echo $book->subtitle; ?>" id="inputEmail1" placeholder="Precio de la bodega">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Ultima Mantencion</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="description" placeholder="Fecha de la ultima mantencion"><?php echo $book->description; ?></textarea>
    </div>
	   <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo de la Camara</label>
   <div class="col-lg-10">
	    <textarea class="form-control" name="codCamara" placeholder="Codigo (ip)"><?php echo $book->codCamara; ?></textarea>
    </div>
  </div>
    <label for="inputEmail1" class="col-lg-2 control-label">A&ntilde;o de la bodega.</label>
    <div class="col-lg-4">
      <input type="text" name="year" class="form-control" id="inputEmail1" value="<?php echo $book->year; ?>" placeholder="A&ntilde;o">
    </div>

  </div>

  </div>






  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="id" value="<?php echo $book->id; ?>">
      <button type="submit" class="btn btn-success">Actualizar Bodega</button>
      <button type="reset" class="btn btn-default" id="clear">Limpiar Campos</button>
    </div>
  </div>
</form>

</div>
</div>
