<?php /* Smarty version 2.6.18, created on 2010-08-16 13:11:27
         compiled from user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'user.tpl', 21, false),array('function', 'cycle', 'user.tpl', 43, false),array('modifier', 'default', 'user.tpl', 172, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (! isset ( $_REQUEST['action'] ) || $_REQUEST['action'] == 'list'): ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table class="adminheading">
	<tr>
		<th nowrap="nowrap" align="right">
            <label>Nombre:
            <input name="filter[name]" onchange="$('action').value='list';this.form.submit();" value="<?php echo $_REQUEST['filter']['name']; ?>
" /></label>                
            &nbsp;&nbsp;&nbsp;

            <label>Login:
            <input name="filter[login]" onchange="$('action').value='list';this.form.submit();" value="<?php echo $_REQUEST['filter']['login']; ?>
" /></label>
            &nbsp;&nbsp;&nbsp;
            
            <label>Grupo:
            <select name="filter[group]" onchange="$('action').value='list';this.form.submit();">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['groupsOptions'],'selected' => $_REQUEST['filter']['group']), $this);?>

            </select></label>            
            
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>
" />
        </th>
	</tr>	
</table>


<table border="0" cellpadding="4" cellspacing="0" class="adminlist">
<thead>
<tr>    
    <th class="title" align="left" style="width:40%;padding:10px;">Nombre Apellidos  </th>
    <th class="title" style="width:20%;padding:10px;">Login</th>
    <th class="title" style="width:20%;padding:10px;">Grupo</th>
    <th class="title" style="width:10%;padding:10px;" align="center">Editar</th>
    <th class="title" style="width:10%;padding:10px;" align="center">Eliminar</th>
</tr>
</thead>

<tbody>
<?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['users']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <input type="checkbox" class="minput"  id="selected_<?php echo $this->_sections['c']['iteration']; ?>
" name="selected_fld[]" value="<?php echo $this->_tpl_vars['users'][$this->_sections['c']['index']]->id; ?>
"  style="cursor:pointer;" ">
		<a href="?action=read&id=<?php echo $this->_tpl_vars['users'][$this->_sections['c']['index']]->id; ?>
" title="Editar usuario">
            <?php echo $this->_tpl_vars['users'][$this->_sections['c']['index']]->name; ?>
&nbsp;<?php echo $this->_tpl_vars['users'][$this->_sections['c']['index']]->firstname; ?>
&nbsp;<?php echo $this->_tpl_vars['users'][$this->_sections['c']['index']]->lastname; ?>
</a>
	</td>
	<td style="padding:10px;"> 
		<?php echo $this->_tpl_vars['users'][$this->_sections['c']['index']]->login; ?>

	</td>
	<td style="padding:10px;"> 
		<?php unset($this->_sections['u']);
$this->_sections['u']['name'] = 'u';
$this->_sections['u']['loop'] = is_array($_loop=$this->_tpl_vars['user_groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['u']['show'] = true;
$this->_sections['u']['max'] = $this->_sections['u']['loop'];
$this->_sections['u']['step'] = 1;
$this->_sections['u']['start'] = $this->_sections['u']['step'] > 0 ? 0 : $this->_sections['u']['loop']-1;
if ($this->_sections['u']['show']) {
    $this->_sections['u']['total'] = $this->_sections['u']['loop'];
    if ($this->_sections['u']['total'] == 0)
        $this->_sections['u']['show'] = false;
} else
    $this->_sections['u']['total'] = 0;
if ($this->_sections['u']['show']):

            for ($this->_sections['u']['index'] = $this->_sections['u']['start'], $this->_sections['u']['iteration'] = 1;
                 $this->_sections['u']['iteration'] <= $this->_sections['u']['total'];
                 $this->_sections['u']['index'] += $this->_sections['u']['step'], $this->_sections['u']['iteration']++):
$this->_sections['u']['rownum'] = $this->_sections['u']['iteration'];
$this->_sections['u']['index_prev'] = $this->_sections['u']['index'] - $this->_sections['u']['step'];
$this->_sections['u']['index_next'] = $this->_sections['u']['index'] + $this->_sections['u']['step'];
$this->_sections['u']['first']      = ($this->_sections['u']['iteration'] == 1);
$this->_sections['u']['last']       = ($this->_sections['u']['iteration'] == $this->_sections['u']['total']);
?>
			<?php if ($this->_tpl_vars['user_groups'][$this->_sections['u']['index']]->id == $this->_tpl_vars['users'][$this->_sections['c']['index']]->fk_user_group): ?>
					<?php echo $this->_tpl_vars['user_groups'][$this->_sections['u']['index']]->name; ?>

	  		<?php endif; ?>
		<?php endfor; endif; ?>
	</td>
	<td style="padding:10px;" align="center">
		<a href="#" onClick="javascript:enviar(this, '_self', 'read', <?php echo $this->_tpl_vars['users'][$this->_sections['c']['index']]->id; ?>
);" title="Modificar">
			<img src="<?php echo($this->image_dir); ?>edit.png" border="0" /></a>
	</td>
	<td style="padding:10px;" align="center">
		<a href="#" onClick="javascript:confirmar(this, <?php echo $this->_tpl_vars['users'][$this->_sections['c']['index']]->id; ?>
);" title="Eliminar">
			<img src="<?php echo($this->image_dir); ?>trash.png" border="0" /></a>
	</td>
</tr>
<?php endfor; else: ?>
<tr colspan="5">
	<td align="center"><b>Ning&uacute;n usuario guardado.</b></td>
</tr>
<?php endif; ?>
</tbody>

<?php if (count ( $this->_tpl_vars['users'] ) > 0): ?>
    <tfoot>
    <tr>
        <td colspan="5" align="center"><?php echo $this->_tpl_vars['paginacion']->links; ?>
</td>
    </tr>
    </tfoot>
<?php endif; ?>

</table>
<?php endif; ?>


<?php if (isset ( $_REQUEST['action'] ) && ( ( $_REQUEST['action'] == 'new' ) || ( $_REQUEST['action'] == 'read' ) )): ?>
<script language="javascript" type="text/javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
SpinnerControl.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
modalbox.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['params']['CSS_DIR']; ?>
modalbox.css" media="screen" />

<?php echo '
<style>
.spinner_button {
    width: 18px;
    height: 18px;
    
    color: #204A87;
    font-weight: bold;
    background-color: #DDD;
    
    border-top: 1px solid #CCC;
    border-right: 1px solid #999;
    border-bottom: 1px solid #999;
    border-left: 1px solid #CCC;
}

.spinner_button:hover {
    background-color: #EEE;
    
    border-top: 1px solid #DDD;
    border-right: 1px solid #CCC;
    border-bottom: 1px solid #CCC;
    border-left: 1px solid #DDD;    
}
</style>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	<table  border="0" cellpadding="4" cellspacing="0" class="fuente_cuerpo" width="100%">
	<tr>
        <td valign="top" width="50%">
            
			<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo">
			<tbody>
                
			<!-- Login -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="login">Login:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="login" name="login" title="Login del usuario"
						value="<?php echo $this->_tpl_vars['user']->login; ?>
" class="required"  size="14" maxlength="20" />
				</td>
			</tr>
            
			<!-- Password -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="password">Password:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="password" id="password" name="password" title="Password"  size="20" autocomplete="off"
						value="" class="<?php if ($_REQUEST['action'] == 'new'): ?>required validate-password<?php endif; ?>" />
				</td>
			</tr>
            
            <!-- Password Confirm-->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="passwordconfirm">Confirmar Password:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="password" id="passwordconfirm" name="passwordconfirm" title="Confirm Password"  size="20"
						value="" autocomplete="off" class="<?php if ($_REQUEST['action'] == 'new'): ?>required<?php endif; ?> validate-password-confirm" />
				</td>
			</tr>
            
            <!-- SessionExpire -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="sessionexpire">Tiempo de expiraci&oacute;n de sesi&oacute;n:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
                    
                    <input type="text" id="sessionexpire" name="sessionexpire" title="Expiraci&oacute;n de Sessi&oacute;n"
						value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['user']->sessionexpire)) ? $this->_run_mod_handler('default', true, $_tmp, '15') : smarty_modifier_default($_tmp, '15')); ?>
" class="required validate-digits" style="text-align:right" size="4" />
                    <input id="up" class="spinner_button" type="button" value="+" />
                    <input id="dn" class="spinner_button" type="button" value="-" />
                    
                    <sub>minutos</sub>
				</td>
			</tr>
            
			<!-- Email -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="email">Correo Electr&oacute;nico:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="email" name="email" title="Correo Electr&oacute;nico"
						value="<?php echo $this->_tpl_vars['user']->email; ?>
" class="required validate-email"  size="50"/>
				</td>
			</tr>
            
			<!-- Nome -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="name">Nombre:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="name" name="name" title="Nombre del usuario"
						value="<?php echo $this->_tpl_vars['user']->name; ?>
" class="required"  size="50"/>
				</td>
			</tr>
            
			<!-- Primeiro apelido -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="firstname">Primer Apellido:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="firstname" name="firstname" title="Primer apellido del usuario"
						value="<?php echo $this->_tpl_vars['user']->firstname; ?>
" class="required"  size="50"/>
				</td>
			</tr>
            
			<!-- Segundo apelido -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="lasname">Segundo Apellido:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="lastname" name="lastname" title="Segundo apellido del usuario"
						value="<?php echo $this->_tpl_vars['user']->lastname; ?>
"  size="50"/>
				</td>
			</tr>
            
			<!-- Direccion -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="address">Direcci&oacute;n:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="address" name="address" title="Direcci&oacute;n del usuario"
						value="<?php echo $this->_tpl_vars['user']->address; ?>
"  size="50"/>
				</td>
			</tr>
            
			<!-- Telefono -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="phone">Tel&eacute;fono:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="phone" name="phone" title="Tel&eacute;fono del usuario" class="validate-digits"
						value="<?php echo $this->_tpl_vars['user']->phone; ?>
"  size="15"/>
				</td>
			</tr>
            
            </tbody>
            </table>
            
        </td>
        <td valign="top" width="50%">
            
            
            <table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="100%">
            </tbody>
            
			<!-- User_Group -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="id_user_group">Grupo al que pertenece:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<select id="id_user_group" name="id_user_group" title="Grupo de usuario" class="validate-selection" onchange="onChangeGroup(this, new Array('comboAccessCategory','labelAccessCategory'));">
                        <option  value ="" selected="selected"> </OPTION>
						<?php unset($this->_sections['user_group']);
$this->_sections['user_group']['name'] = 'user_group';
$this->_sections['user_group']['loop'] = is_array($_loop=$this->_tpl_vars['user_groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['user_group']['show'] = true;
$this->_sections['user_group']['max'] = $this->_sections['user_group']['loop'];
$this->_sections['user_group']['step'] = 1;
$this->_sections['user_group']['start'] = $this->_sections['user_group']['step'] > 0 ? 0 : $this->_sections['user_group']['loop']-1;
if ($this->_sections['user_group']['show']) {
    $this->_sections['user_group']['total'] = $this->_sections['user_group']['loop'];
    if ($this->_sections['user_group']['total'] == 0)
        $this->_sections['user_group']['show'] = false;
} else
    $this->_sections['user_group']['total'] = 0;
if ($this->_sections['user_group']['show']):

            for ($this->_sections['user_group']['index'] = $this->_sections['user_group']['start'], $this->_sections['user_group']['iteration'] = 1;
                 $this->_sections['user_group']['iteration'] <= $this->_sections['user_group']['total'];
                 $this->_sections['user_group']['index'] += $this->_sections['user_group']['step'], $this->_sections['user_group']['iteration']++):
$this->_sections['user_group']['rownum'] = $this->_sections['user_group']['iteration'];
$this->_sections['user_group']['index_prev'] = $this->_sections['user_group']['index'] - $this->_sections['user_group']['step'];
$this->_sections['user_group']['index_next'] = $this->_sections['user_group']['index'] + $this->_sections['user_group']['step'];
$this->_sections['user_group']['first']      = ($this->_sections['user_group']['iteration'] == 1);
$this->_sections['user_group']['last']       = ($this->_sections['user_group']['iteration'] == $this->_sections['user_group']['total']);
?>
							<?php if ($this->_tpl_vars['user_groups'][$this->_sections['user_group']['index']]->id == $this->_tpl_vars['user']->id_user_group): ?>
                                <option  value = "<?php echo $this->_tpl_vars['user_groups'][$this->_sections['user_group']['index']]->id; ?>
" selected="selected"><?php echo $this->_tpl_vars['user_groups'][$this->_sections['user_group']['index']]->name; ?>
</option>
					  		<?php else: ?>
								<option  value = "<?php echo $this->_tpl_vars['user_groups'][$this->_sections['user_group']['index']]->id; ?>
"><?php echo $this->_tpl_vars['user_groups'][$this->_sections['user_group']['index']]->name; ?>
</option>
							<?php endif; ?>
						<?php endfor; endif; ?>
					</select>
                    
                                        <?php echo '
                    <script type="text/javascript">
                    function showGroupUsers(elto) {
                        /* Modalbox.show(\'user_groups.php?action=read&id=\' + $(\'id_user_group\').value, {
                            title: elto.title, width: 800, height: 640}); */
                        /*if( confirm(\'¿Está seguro de querer salir de la edición del usuario?\') ) {
                            window.open(\'user_groups.php?action=read&id=\' + $(\'id_user_group\').value, \'centro\');
                        }*/
                        
                        Modalbox.show(\'<iframe width="100%" height="450" src="user_groups.php?action=read&id=\' + $(\'id_user_group\').value+\'"  frameborder="0" marginheight="0" marginwidth="0"></iframe>\', {title: \'Gestión de grupos de usuarios\', width: 760});
                    }
                    </script>
                    '; ?>

                    
                    <a href="javascript:void(0);" title="Editar grupo y permisos" onclick="showGroupUsers(this);return false;">
                        <img src="<?php echo $this->_tpl_vars['params']['IMAGE_DIR']; ?>
users_edit.png" border="0" style="vertical-align: middle;" /></a>
				</td>
			</tr>
            
       
			
			</tbody>
			</table>
	</td>	
	</tr>
	</table>

    
<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>