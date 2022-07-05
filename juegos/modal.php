<!DOCTYPE html>
<html>
<title>Crud Juegos</title>
<head>
  <?php require_once "dependencias.php"; ?>
  
</head>
<body>
	<div class="container">
		<br>
		<h1>CRUD Juegos con Procedimientos Almacenados en MySQL</h1>
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
          <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo juego</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<form id="frmAgrega">
            <label>Nombre</label>
            <input type="text" class="form-control form-control-sm" name="nombre" id="nombre">
            <label>Desarrollador</label>
            <input type="text" class="form-control form-control-sm" name="desarrollador" id="desarrollador">
            <label>Género</label>
            <input type="text" class="form-control form-control-sm" name="genero" id="genero">
            <label>Año</label>
            <input type="text" class="form-control form-control-sm" name="año" id="año">
            <label>Precio</label>
            <input type="text" class="form-control form-control-sm" name="precio" id="precio">
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

          <h5 class="modal-title" id="exampleModalLabel">Actualiza Juego</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        	<form id="frmactualiza">
            <input type="text" hidden="" name="id" id="id">
            <label>Nombre</label>
            <input type="text" class="form-control form-control-sm" name="nombre" id="nombreid">
            <label>Desarrollador</label>
            <input type="text" class="form-control form-control-sm" name="desarrollador" id="desarrolladorid">
            <label>Género</label>
            <input type="text" class="form-control form-control-sm" name="genero" id="generoid">
            <label>Año</label>
            <input type="text" class="form-control form-control-sm" name="año" id="añoid">
            <label>Precio</label>
            <input type="text" class="form-control form-control-sm" name="precio" id="precioid">
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
        url:"../bd_mysql/insertar.php",
        success:function(r){
          if(r==1){
           $('#frmAgrega')[0].reset();
           $('#tablastores').load('tabla.php');
           alertify.success("Agregado con exito :)");
         }else{
          alertify.error("No se pudo agregar :(");
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
          url:"../bd_mysql/actualizar.php",
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
      url:"../bd_mysql/obtenerRegistro.php",
      success:function(r){
        datos=jQuery.parseJSON(r);

        $('#id').val(datos['id']);
        $('#nombreid').val(datos['nombre']);
        $('#desarrolladorid').val(datos['desarrollador']);
        $('#generoid').val(datos['genero']);
        $('#añoid').val(datos['año']);
        $('#precioid').val(datos['precio']);
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
      alertify.confirm('Eliminar juego', '¿Desea eliminar este registro?', 
              function(){ 
                  $.ajax({
                     type:"POST",
                      data:"id=" + id,
                      url:"../bd_mysql/eliminar.php",
                      success:function(r){
                          if(r==1){     
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