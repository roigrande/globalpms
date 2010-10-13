    </td>
</tr>
</table>

<input type="hidden" id="action" name="action" value="" />
<input type="hidden" id="id" name="id" value="{$id}" />
</form>
</td></tr>
</table>

{if $smarty.request.action == 'new' || $smarty.request.action == 'read'}
	<script language="javascript" type="text/javascript">
	{literal}
	try {
		// Activar la validación
		new Validation('formulario', {immediate : true});
	} catch(e) { /* hide errors */ }
	{/literal}
	</script>
{/if}

</body>
</html>
