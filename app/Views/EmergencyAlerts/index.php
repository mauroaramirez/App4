<div class="separate">
	<h2>Mensajes de Alerta</h2>
	<div class="separate">	
	<table border="1">
		<thead>
			<tr>
				<th>Id-Alerta</th>
				<th>Id_user</th>
				<th>Latitude</th>				
				<th>Longitude</th>
				<th>Tipo Alerta</th>
				<th>Fecha creación</th>
				<th>Tipo Mensaje</th>
				<th>Estado</th>
				<th>Operaciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($params['emergency_alerts'] as $key => $value): ?>			
			<tr>
				<td> <?php echo $value['id'] ?> </td>
				<td> <?php echo $value['id_user'] ?> </td>
				<td> <?php echo $value['latitude'] ?> </td>				
				<td> <?php echo $value['longitude'] ?> </td>
				<td> <?php echo $value['alert_type'] ?> </td>
				<td> <?php echo $value['timestamp'] ?> </td>
				<td> <?php echo $value['id_message'] ?> </td>
				<td> <?php echo $value['id_status'] ?> </td>
				<td>
					<a href="<?php echo "/EmergencyAlerts/show/".$value['id'] ?>" class="btn-accion">Ver</a>
					<?php include '../Views/EmergencyAlerts/delete.php' ?>
				</td>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	</div>
</div>