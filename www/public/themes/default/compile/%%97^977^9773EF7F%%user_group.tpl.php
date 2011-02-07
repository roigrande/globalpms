<?php /* Smarty version 2.6.18, created on 2010-08-16 13:01:31
         compiled from user_group.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'user_group.tpl', 20, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($_REQUEST['action'] == 'list'): ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table class="adminheading">
	<tr>
		<th nowrap></th>
	</tr>	
</table>
<table border="0" cellpadding="4" cellspacing="0" class="adminlist">
<tr>
<th class="title">Nombre del Grupo </th>
<th class="title">Editar</th>
<th class="title">Eliminar</th>
</tr>
<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['user_groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['c']['show'] = true;
$this->_sections['c']['max'] = $this->_sections['c']['loop'];
$this->_sections['c']['step'] = 1;
$this->_sections['c']['start'] = $this->_sections['c']['step'] > 0 ? 0 : $this->_sections['c']['loop']-1;
if ($this->_sections['c']['show']) {
    $this->_sections['c']['total'] = $this->_sections['c']['loop'];
    if ($this->_sections['c']['total'] == 0)
        $this->_sections['c']['show'] = false;
} else
    $this->_sections['c']['total'] = 0;
if ($this->_sections['c']['show']):

            for ($this->_sections['c']['index'] = $this->_sections['c']['start'], $this->_sections['c']['iteration'] = 1;
                 $this->_sections['c']['iteration'] <= $this->_sections['c']['total'];
                 $this->_sections['c']['index'] += $this->_sections['c']['step'], $this->_sections['c']['iteration']++):
$this->_sections['c']['rownum'] = $this->_sections['c']['iteration'];
$this->_sections['c']['index_prev'] = $this->_sections['c']['index'] - $this->_sections['c']['step'];
$this->_sections['c']['index_next'] = $this->_sections['c']['index'] + $this->_sections['c']['step'];
$this->_sections['c']['first']      = ($this->_sections['c']['iteration'] == 1);
$this->_sections['c']['last']       = ($this->_sections['c']['iteration'] == $this->_sections['c']['total']);
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values' => "#eeeeee,#ffffff"), $this);?>
">
	<td style="padding:10px;">
		<?php echo $this->_tpl_vars['user_groups'][$this->_sections['c']['index']]->name; ?>

	</td>
	<td style="padding:10px;width:75px;">
		<a href="#" onClick="javascript:enviar(this, '_self', 'read', <?php echo $this->_tpl_vars['user_groups'][$this->_sections['c']['index']]->id; ?>
);" title="Modificar">
			<img src="<?php echo($this->image_dir); ?>edit.png" border="0" /></a>
	</td>
	<td style="padding:10px;width:75px;">
		<a href="#" onClick="javascript:confirmar(this, <?php echo $this->_tpl_vars['user_groups'][$this->_sections['c']['index']]->id; ?>
);" title="Eliminar">
			<img src="<?php echo($this->image_dir); ?>trash.png" border="0" /></a>
	</td>
</tr>
<?php endfor; else: ?>
<tr>
	<td align="center"><b>Ningún grupo de usuarios guardado.</b></td>
</tr>
<?php endif; ?>
<?php if (count ( $this->_tpl_vars['user_groups'] ) > 0): ?>
<tr>
    <td colspan="3" align="center"><?php echo $this->_tpl_vars['paginacion']->links; ?>
</td>
</tr>
<?php endif; ?>
</table>
<?php endif; ?>


<?php if (isset ( $_REQUEST['action'] ) && ( ( $_REQUEST['action'] == 'new' ) || ( $_REQUEST['action'] == 'read' ) )): ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="600">
<tbody>
<!-- Id -->
<tr>
	<td valign="top" align="right" style="padding:4px;" width="30%">
		<label for="id"></label>
	</td>
	<td style="padding:4px;" nowrap="nowrap" width="70%">
		<input type="hidden" id="idReadOnly" name="idReadOnly" title="Id"
			value="<?php echo $this->_tpl_vars['user_group']->id; ?>
" readonly />
	</td>
</tr>
<!-- Nome -->
<tr>
	<td valign="top" align="right" style="padding:4px;" width="30%">
		<label for="name">Nombre:</label>
	</td>
	<td style="padding:4px;" nowrap="nowrap" width="70%">
		<input type="text" id="name" name="name" title="Nombre del grupo de usuarios"
			value="<?php echo $this->_tpl_vars['user_group']->name; ?>
" class="required"
            <?php if ($this->_tpl_vars['user_group']->name == @NAME_GROUP_ADMIN): ?>disabled="disabled"<?php endif; ?> />
	</td>
</tr>
<!-- Privileges -->
<tr>
	<td valign="top" align="right" style="padding:4px;" width="30%">
		<label for="privileges">Permisos activados:</label>
	</td>
	<td style="padding:4px;" nowrap="nowrap" width="70%">
		<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="100%">
		<tbody>
		<?php unset($this->_sections['privilege']);
$this->_sections['privilege']['name'] = 'privilege';
$this->_sections['privilege']['loop'] = is_array($_loop=$this->_tpl_vars['privileges']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['privilege']['show'] = true;
$this->_sections['privilege']['max'] = $this->_sections['privilege']['loop'];
$this->_sections['privilege']['step'] = 1;
$this->_sections['privilege']['start'] = $this->_sections['privilege']['step'] > 0 ? 0 : $this->_sections['privilege']['loop']-1;
if ($this->_sections['privilege']['show']) {
    $this->_sections['privilege']['total'] = $this->_sections['privilege']['loop'];
    if ($this->_sections['privilege']['total'] == 0)
        $this->_sections['privilege']['show'] = false;
} else
    $this->_sections['privilege']['total'] = 0;
if ($this->_sections['privilege']['show']):

            for ($this->_sections['privilege']['index'] = $this->_sections['privilege']['start'], $this->_sections['privilege']['iteration'] = 1;
                 $this->_sections['privilege']['iteration'] <= $this->_sections['privilege']['total'];
                 $this->_sections['privilege']['index'] += $this->_sections['privilege']['step'], $this->_sections['privilege']['iteration']++):
$this->_sections['privilege']['rownum'] = $this->_sections['privilege']['iteration'];
$this->_sections['privilege']['index_prev'] = $this->_sections['privilege']['index'] - $this->_sections['privilege']['step'];
$this->_sections['privilege']['index_next'] = $this->_sections['privilege']['index'] + $this->_sections['privilege']['step'];
$this->_sections['privilege']['first']      = ($this->_sections['privilege']['iteration'] == 1);
$this->_sections['privilege']['last']       = ($this->_sections['privilege']['iteration'] == $this->_sections['privilege']['total']);
?>
			<tr>
			<td style="padding:4px;" nowrap="nowrap" width="5%">

		<?php if ($this->_tpl_vars['user_group']->contains_privilege($this->_tpl_vars['privileges'][$this->_sections['privilege']['index']]->id)): ?>
					<input type="checkbox" name="privileges[]" id="privileges[]" value="<?php echo $this->_tpl_vars['privileges'][$this->_sections['privilege']['index']]->id; ?>
" checked>
  		<?php else: ?>
					<input type="checkbox" name="privileges[]" id="privileges[]" value="<?php echo $this->_tpl_vars['privileges'][$this->_sections['privilege']['index']]->id; ?>
">
		<?php endif; ?>
			</td>
			<td valign="top" align="left" style="padding:4px;" width="95%">
				<?php echo $this->_tpl_vars['privileges'][$this->_sections['privilege']['index']]->description; ?>

			</td>
			</tr>
		<?php endfor; endif; ?>
		</tbody>
		</table>
	</td>
</tr>
</tbody>
</table>
</div>
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>