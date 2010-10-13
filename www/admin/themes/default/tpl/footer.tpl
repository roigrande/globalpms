    </td>
</tr>
</table>
<input type="hidden" id="action" name="action" value="" /><input type="hidden" name="id" id="id" value="{$id}" />
</form>
</td></tr>
</table>

{if $smarty.request.action == 'new' || $smarty.request.action == 'read'}
	<script language="javascript" type="text/javascript">
	{literal}
	try {
		// Activar la validación
		new Validation('formulario', {immediate : true});
        Validation.addAllThese([
							['validate-password', 'Su password debe contener mas de 5 caracteres y no contener la palabra \'password\' o su nombre de usuario', {
								minLength : 6,
								notOneOf : ['password','PASSWORD','Password'],
								notEqualToField : 'login'
							}],
							['validate-password-confirm', 'Compruebe su primer password, por favor intentelo de nuevo.', {
								equalToField : 'password'
							}]
						]);

		// Para activar los separadores/tabs
		$fabtabs = new Fabtabs('tabs');
	} catch(e) {
		// Escondemos los errores
		//console.log( e );
	}
	{/literal}
	</script>
{/if}

</body>
</html>
