<!DOCTYPE html>
<html>
<title>Crud Empleados</title>
<head>
  <?php require_once "dependencias.php"; ?>
  
</head>
<body>
	<div class="container">
		<br>
		<h1>CRUD Empleados con MongoDB</h1>
		<hr><br><br><br>
		<div class="row">
			<div class="col-sm-12">
				<div id="tablastores"></div>
			</div>
		</div>
	</div>

  <!--Agregar modal-->
   <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo empleado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<form id="frmAgrega">
            <label>Nombre</label>
            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre">
            <label>Apellido</label>
            <input type="text" class="form-control form-control-sm" name="apellido" id="apellido">
            <label>Edad</label>
            <input type="text" class="form-control form-control-sm" name="edad" id="edad">
            <label>Correo</label>
            <input type="text" class="form-control form-control-sm" name="email" id="email">
            <label>Celular</label>
            <input type="text" class="form-control form-control-sm" name="celular" id="celular">
        	</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-raised btn-primary" id="btnAgregarJuego">Agregar</button>
        </div>
      </div>
    </div>
  </div>


  <!--Editar modal-->
  <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">

          <h5 class="modal-title" id="exampleModalLabel">Actualiza Empleado</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<form id="frmactualiza">
            <input type="text" hidden="" name="id" id="id">
            <label>Nombre</label>
            <input type="text" class="form-control form-control-sm" name="nombre" id="nombreid">
            <label>Apellido</label>
            <input type="text" class="form-control form-control-sm" name="apellido" id="apellidoid">
            <label>Edad</label>
            <input type="text" class="form-control form-control-sm" name="edad" id="edadid">
            <label>Correo</label>
            <input type="text" class="form-control form-control-sm" name="email" id="emailid">
            <label>Celular</label>
            <input type="text" class="form-control form-control-sm" name="celular" id="celularid">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-raised btn-warning" id="btnactualizar">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
</body>
</html>





<script type="text/javascript">
	$(document).ready(function(){
		$('#tablastores').load('tabla.php');

    $('#btnAgregarJuego').click(function(){
      if(validarFormVacio('frmAgrega') > 0){
        alertify.alert("Debes llenar todos los campos por favor!");
        return false;
      }

      datos=$('#frmAgrega').serialize();

      $.ajax({
        type:"POST",
        data:datos,
        url:"../procesos/insertar.php",
        success:function(data){
          if(data){
           $('#frmAgrega')[0].reset();
           $('#tablastores').load('tabla.php');
           alertify.success("Agregado con exito :)");
           $('#addmodal').modal('hide');
         }else{
          alertify.error("No se pudo agregar :(");
          $('#addmodal').modal('hide');
        }
        
      }
    });
    });


  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#btnactualizar').click(function(){

      datos=$('#frmactualiza').serialize();
        $.ajax({
          type:"POST",
          data:datos,
          url:"../procesos/actualizar.php",
          success:function(r){
            if(r==1){
               $('#tablastores').load('tabla.php');
               alertify.success("Actualizado con exito :)");
            }else{
               alertify.error("No se pudo actualizar :(");
            }
           }
        });
    });
  });
</script>

<script type="text/javascript">

  function obtenDatos(id){
    $.ajax({
      type:"POST",
      data:"id=" + id,
      url:"../procesos/obtenerRegistro.php",
      success:function(r){
        datos=jQuery.parseJSON(r);
        $('#id').val(datos['id']);
        $('#nombreid').val(datos['nombre']);
        $('#apellidoid').val(datos['apellido']);
        $('#edadid').val(datos['edad']);
        $('#emailid').val(datos['email']);
        $('#celularid').val(datos['celular']);
      }
    });
  }

  function validarFormVacio(formulario){
    datos=$('#' + formulario).serialize();
    d=datos.split('&');
    vacios=0;
    for(i=0;i< d.length;i++){
      controles=d[i].split("=");
      if(controles[1]=="A" || controles[1]==""){
        vacios++;
      }
    }
    return vacios;
  }

  function elimina(id){
      alertify.confirm('Eliminar empleado', '¿Desea eliminar este registro?', 
              function(){ 
                  $.ajax({
                     type:"POST",
                      data:"id=" + id,
                      url:"../procesos/eliminar.php",
                      success:function(data){
                          if(data){     
                              $('#tablastores').load('tabla.php');
                              alertify.success("Eliminado con exito :)");
                          }else{
                               alertify.error("No se pudo eliminar :(");
                          }
                      }
                  });
              }
              ,function(){ 
                alertify.error('Cancelo')
              });
  }
</script>