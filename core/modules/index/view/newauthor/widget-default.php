<div class="row">
	<div class="col-md-12">
	<h1>Nueva Empresa</h1>
	<br>
		<form class="form-horizontal" method="post" id="addcategory" action="index.php?action=addauthor" role="form">


  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nombre*</label>
    <div class="col-md-6">
      <input type="text" name="name" required class="form-control" id="name" placeholder="Nombre">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Contacto</label>
    <div class="col-md-6">
      <input type="text" name="lastname" required class="form-control" id="lastname" placeholder="+569 (numero)">
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Encargado.</label>
    <div class="col-md-6">
      <input type="text" name="encargado" required class="form-control" id="encargado" placeholder="Nombre">
    </div>
  </div>
  
      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Tipo de Mantencion.</label>
    <div class="col-md-6">
      <input type="text" name="Tipo_mantencion" required class="form-control" id="Tipo_mantencion" placeholder="Tipo de Mantencion">
    </div>
  </div>
  
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Precio.</label>
    <div class="col-md-6">
      <input type="text" name="precio" required class="form-control" id="precio" placeholder="Precio de Mantencion.">
    </div>
  </div>
  
 
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Empresa</button>
    </div>
  </div>
</form>
	</div>
</div>