<?php
    require_once "../clases/Conexion.php";
    require_once "../clases/Crud.php";
    $crud = new Crud();
	$datos = $crud->mostrarDatos();
?>

<span class="btn btn-raised btn-primary btn-lg" data-toggle="modal" data-target="#addmodal">
			<span class="fa fa-plus-circle"></span> Agregar nuevo
		</span>

<table id="example" class="table table-striped table-dark table-bordered">

		<tr style="font-weight: bold; text-align: center; color:white" >
			<td>NOMBRE</td>
			<td>APELLIDO</td>
			<td>EDAD</td>
			<td>CORREO</td>
			<td>CELULAR</td>
			<td style="text-align: center;">EDITAR</td>
			<td style="text-align: center;">ELIMINAR</td>
		</tr>
		<?php
			foreach ($datos as $item) {
		?>
		<tr style="text-align: center; color:white">
			<td><?php echo $item->nombre; ?></td>
			<td><?php echo $item->apellido; ?></td>
			<td><?php echo $item->edad; ?></td>
			<td><?php echo $item->email; ?></td>
			<td><?php echo $item->celular; ?></td>
			<td style="text-align: center;">
				<span class="btn btn-raised btn-warning btn-xs" 
				onclick="obtenDatos('<?php echo $item->_id; ?>')" data-toggle="modal" data-target="#updatemodal">
					<span class="fa-solid fa-square-pen"></span> Editar
				</span>
			</td>
			<td style="text-align: center;">
				<input type="text" hidden value="<?php echo $item->_id; ?>" name="id">
				<span class="btn btn-raised btn-danger btn-xs" 
					onclick="elimina('<?php echo $item->_id; ?>')">
					<span class="fa fa-trash"></span> Eliminar
				</span>
			</td>
		</tr>
		<?php
			}
		?>
</table>