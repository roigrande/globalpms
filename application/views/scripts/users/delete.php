<form  action="?action=delete" method="post" id="devilform" 
		enctype="multipart/form-data">
<p>
	Estas seguro que quieres borrar al usuario:<?=$data['name']?>
	con email: <?=$data['email']?>
</p>

<p>
	<label for="website">Id:</label>
	<input type="hidden" name="id" id="id" value="<?=$data['id']?>"  />
</p>
                    
<p>
	<input type="submit"  name="delete"  id="submit" value="Borrar" />
</p>
<p>
	<input type="submit"  name="cancel" id="submit" value="Cancelar" />
</p>
</form>