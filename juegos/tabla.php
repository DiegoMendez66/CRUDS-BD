<?php
	require_once "../bd_mysql/conexion.php";
	
	$sql="CALL sp_mostrar";
	$result=mysqli_query($MySQLiconn,$sql);
?>

<span class="btn btn-raised btn-primary btn-lg" data-toggle="modal" data-target="#addmodal">
			<span class="fa fa-plus-circle"></span> Agregar nuevo
		</span>

<table id="example" class="table table-striped table-dark table-bordered">

		<tr style="font-weight: bold; text-align: center; color:white" >
			<td>ID</td>
			<td>NOMBRE</td>
			<td>DESARROLLADOR</td>
			<td>GÉNERO</td>
			<td>AÑO</td>
			<td>PRECIO</td>
			<td style="text-align: center;">EDITAR</td>
			<td style="text-align: center;">ELIMINAR</td>
		</tr>
		<?php
			while($ver=mysqli_fetch_row($result)):
		?>
		<tr style="text-align: center; color:white">
			<td><?php echo $ver[0]; ?></td>
			<td><?php echo $ver[1]; ?></td>
			<td><?php echo $ver[2]; ?></td>
			<td><?php echo $ver[3]; ?></td>
			<td><?php echo $ver[4]; ?></td>
			<td><?php echo $ver[5]; ?></td>
			<td style="text-align: center;">
				<span class="btn btn-raised btn-warning btn-xs" 
				onclick="obtenDatos('<?php echo $ver[0]; ?>')" data-toggle="modal" data-target="#updatemodal">
					<span class="fa-solid fa-square-pen"></span> Editar
				</span>
			</td>
			<td style="text-align: center;">
				<span class="btn btn-raised btn-danger btn-xs" 
					onclick="elimina('<?php echo $ver[0]; ?>')">
					<span class="fa fa-trash"></span> Eliminar
				</span>
			</td>
		</tr>

		<?php
			endwhile;
		?>
</table>