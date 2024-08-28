<form style="display:inline;" method="post" action="<?php echo "/EmergencyAlerts/delete/".$value['id'] ?>" onsubmit="return confirm('¿Estas seguro de borrar?');">
	<input type="hidden" name="EmergencyAlerts" value="<?php echo $value['id'] ?>">
	<button type="submit" class="btn-accion" name="submitDeleteEmergencyAlerts">Borrar</button>
</form>