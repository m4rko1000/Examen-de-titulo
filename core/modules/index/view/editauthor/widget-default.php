<?php $user = AuthorData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Empresa</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=updateauthor" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contacto</label>
    <div class="col-md-6">
      <input type="text" name="lastname" value="<?php echo $user->lastname;?>" class="form-control" id="name" placeholder="+569 (numero)">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Encargado.</label>
    <div class="col-md-6">
      <input type="text" name="encargado" value="<?php echo $user->encargado;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  
   <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo de Mantencion.</label>
    <div class="col-md-6">
      <input type="text" name="Tipo_mantencion" value="<?php echo $user->Tipo_mantencion;?>" class="form-control" id="name" placeholder="Tipo de Mantencion.">
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Precio.</label>
    <div class="col-md-6">
      <input type="text" name="precio" value="<?php echo $user->precio;?>" class="form-control" id="name" placeholder="Precio de Mantencion.">
    </div>
  </div>


  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-success">Actualizar Empresa</button>
    </div>
  </div>
</form>
	</div>
</div>