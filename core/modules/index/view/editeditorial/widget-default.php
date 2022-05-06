<?php $user = EditorialData::getById($_GET["id"]);?>
<div class="row">
	<div class="col-md-12">
	<h1>Editar Sucursal</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=updateeditorial" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Direccion*</label>
    <div class="col-md-6">
      <input type="text" name="direccion" value="<?php echo $user->direccion;?>" class="form-control" id="direccion" placeholder="Direccion">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contacto*</label>
    <div class="col-md-6">
      <input type="text" name="contacto" value="<?php echo $user->contacto;?>" class="form-control" id="contacto" placeholder="Contacto">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="user_id" value="<?php echo $user->id;?>">
      <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </div>
  </div>
</form>
	</div>
</div