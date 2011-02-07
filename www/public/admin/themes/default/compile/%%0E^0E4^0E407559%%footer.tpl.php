<?php /* Smarty version 2.6.18, created on 2010-11-08 14:45:32
         compiled from footer.tpl */ ?>
    </td>
</tr>
</table>
<input type="hidden" id="action" name="action" value="" />
<input type="hidden" name="id" id="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
</form>
</td></tr>
</table>

<?php if ($_REQUEST['action'] == 'new' || $_REQUEST['action'] == 'read'): ?>
	<script language="javascript" type="text/javascript">
	<?php echo '
	try {
		// Activar la validación
		new Validation(\'formulario\', {immediate : true});
        Validation.addAllThese([
							[\'validate-password\', \'Su password debe contener mas de 5 caracteres y no contener la palabra \\\'password\\\' o su nombre de usuario\', {
								minLength : 6,
								notOneOf : [\'password\',\'PASSWORD\',\'Password\'],
								notEqualToField : \'login\'
							}],
							[\'validate-password-confirm\', \'Compruebe su primer password, por favor intentelo de nuevo.\', {
								equalToField : \'password\'
							}]
						]);

		// Para activar los separadores/tabs
		$fabtabs = new Fabtabs(\'tabs\');
	} catch(e) {
		// Escondemos los errores
		//console.log( e );
	}
	'; ?>

	</script>
<?php endif; ?>

</body>
</html>