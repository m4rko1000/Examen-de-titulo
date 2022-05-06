<?php 
$item = ItemData::getById($_GET["id"]);
$book = BookData::getById($item->book_id);
$author	= AuthorData :: getbyId($item->author_id);?>
<div class="row">
	<div class="col-md-12">
	<h1><?php echo $book->title; ?> <small>Editar Ejemplar</small></h1>
	<br>
	<form class="form-horizontal" method="post" id="addcategory" action="./index.php?action=updateitem" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Codigo*</label>
    <div class="col-md-6">
      <input type="text" name="code" required value="<?php echo $item->code; ?>" class="form-control" id="code" placeholder="Codigo">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Status*</label>
    <div class="col-md-6">
<select name="status_id" class="form-control">
  <?php foreach(StatusData::getAll() as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($item->status_id==$p->id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Author</label>
    <div class="col-md-6">
<select name="author_id" class="form-control">
  <?php foreach(AuthorData::getAll() as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if($author->author_id==$p->id){ echo "selected"; }?>><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
 
 
<h1><?php echo $book->title; ?> <small>Aplicar Mantencion.</small></h1>
 
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Empresa</label>
    <div class="col-md-6">
      <input type="text" name="empresa" " class="form-control" id="empresa" placeholder="Empresa">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Encargado</label>
    <div class="col-md-6">
      <input type="text" name="encargado" " class="form-control" id="encargado" placeholder="encargado">
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo</label>
    <div class="col-md-6">
      <input type="text" name="tipo" " class="form-control" id="tipo" placeholder="tipo">
    </div>
  </div>
  
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de inicio</label>
    <div class="col-md-6">
      <input type="text" name="fecha_inicio" " class="form-control" id="fecha_inicio" placeholder="Fecha de inicio">
    </div>
  </div>
  
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha de Termino</label>
    <div class="col-md-6">
      <input type="text" name="fecha_termino" " class="form-control" id="fecha_termino" placeholder="Fecha de termino">
    </div>
  </div>
  
  
<h1>  <small>Al aplicar alguna mantencion, cambiar el estado de la bodega.</small></h1>

<h1><?php echo $book->title; ?> <small>Ultima Mantencion.</small></h1>
<h2>  <small>Rellenar estos campos por favor.</small></h2>

     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Ultima mantencion</label>
    <div class="col-md-6">
      <input type="text" name="ultima_mantencion" required value="<?php echo $item->fecha_termino; ?>" class="form-control" id="ultima_mantencion" placeholder="Ultima mantencion">
    </div>
  </div>
  
       <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Empresa</label>
    <div class="col-md-6">
      <input type="text" name="empresa" required value="<?php echo $item->empresa; ?>" class="form-control" id="empresa" placeholder="Empresa de la mantencion">
    </div>
  </div>
  
     <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Costo de la mantencion</label>
    <div class="col-md-6">
      <input type="text" name="costo" required value="<?php echo $item->costo; ?>" class="form-control" id="costo" placeholder="Costo">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="item_id" value="<?php echo $item->id; ?>">
      <button type="submit" class="btn btn-success">Actualizar Ejemplar</button>
    </div>
  </div>
</form>
	</div>
</div>