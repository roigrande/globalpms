<?php /* Smarty version Smarty-3.0.6, created on 2011-02-21 10:57:08
         compiled from "/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user_1.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11384769444d6236f43a1b15-39533306%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1e89a947119d77764f404e4359ea678a34c5e5fd' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user_1.tpl',
      1 => 1297443374,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11384769444d6236f43a1b15-39533306',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_html_options')) include '/var/www/globalpms/trunk/www/libs/smarty/plugins/function.html_options.php';
if (!is_callable('smarty_function_cycle')) include '/var/www/globalpms/trunk/www/libs/smarty/plugins/function.cycle.php';
if (!is_callable('smarty_block_php')) include '/var/www/globalpms/trunk/www/libs/smarty/plugins/block.php.php';
?><?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<?php if (!isset($_REQUEST['action'])||$_REQUEST['action']=="list"){?>

<?php $_template = new Smarty_Internal_Template("botonera_up.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>
<table class="adminheading">
	<tr>
		<th nowrap="nowrap" align="right">
            <label>Nombre:
            <input name="filter[name]" onchange="$('action').value='list';this.form.submit();" value="<?php echo $_REQUEST['filter']['name'];?>
" /></label>                
            &nbsp;&nbsp;&nbsp;

            <label>Login:
            <input name="filter[login]" onchange="$('action').value='list';this.form.submit();" value="<?php echo $_REQUEST['filter']['login'];?>
" /></label>
            &nbsp;&nbsp;&nbsp;
            
            <label>Grupo:
            <select name="filter[group]" onchange="$('action').value='list';this.form.submit();">
                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->getVariable('groupsOptions')->value,'selected'=>$_REQUEST['filter']['group']),$_smarty_tpl);?>

            </select></label>            
            
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'];?>
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
<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['c']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['name'] = 'c';
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('users')->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['c']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['c']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['c']['total']);
?>
<tr bgcolor="<?php echo smarty_function_cycle(array('values'=>"#eeeeee,#ffffff"),$_smarty_tpl);?>
">

	<td style="padding:10px;">
                <input type="checkbox" class="minput"  id="selected_<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['c']['iteration'];?>
" name="selected_fld[]" value="<?php echo $_smarty_tpl->getVariable('users')->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]->id;?>
"  style="cursor:pointer;" ">
		<a href="?action=read&id=<?php echo $_smarty_tpl->getVariable('users')->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]->id;?>
" title="Editar usuario">
            <?php echo $_smarty_tpl->getVariable('users')->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]->name;?>
&nbsp;<?php echo $_smarty_tpl->getVariable('users')->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]->firstname;?>
&nbsp;<?php echo $_smarty_tpl->getVariable('users')->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]->lastname;?>
</a>
	</td>
	<td style="padding:10px;"> 
		<?php echo $_smarty_tpl->getVariable('users')->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]->login;?>

	</td>
	<td style="padding:10px;"> 
		<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['u']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['name'] = 'u';
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('user_groups')->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['u']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['u']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['u']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['u']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['u']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['u']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['u']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['u']['total']);
?>
			<?php if ($_smarty_tpl->getVariable('user_groups')->value[$_smarty_tpl->getVariable('smarty')->value['section']['u']['index']]->id==$_smarty_tpl->getVariable('users')->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]->fk_user_group){?>
					<?php echo $_smarty_tpl->getVariable('user_groups')->value[$_smarty_tpl->getVariable('smarty')->value['section']['u']['index']]->name;?>

	  		<?php }?>
		<?php endfor; endif; ?>
	</td>
	<td style="padding:10px;" align="center">
		<a href="#" onClick="javascript:enviar(this, '_self', 'read', <?php echo $_smarty_tpl->getVariable('users')->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]->id;?>
);" title="Modificar">
			<img src="<?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; smarty_block_php(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
echo($this->image_dir);<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_php(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
edit.png" border="0" /></a>
	</td>
	<td style="padding:10px;" align="center">
		<a href="#" onClick="javascript:confirmar(this, <?php echo $_smarty_tpl->getVariable('users')->value[$_smarty_tpl->getVariable('smarty')->value['section']['c']['index']]->id;?>
);" title="Eliminar">
			<img src="<?php $_smarty_tpl->smarty->_tag_stack[] = array('php', array()); $_block_repeat=true; smarty_block_php(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
echo($this->image_dir);<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_php(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
trash.png" border="0" /></a>
	</td>
</tr>
<?php endfor; else: ?>
<tr colspan="5">
	<td align="center"><b>Ning&uacute;n usuario guardado.</b></td>
</tr>
<?php endif; ?>
</tbody>

<?php if (count($_smarty_tpl->getVariable('users')->value)>0){?>
    <tfoot>
    <tr>
        <td colspan="5" align="center"><?php echo $_smarty_tpl->getVariable('paginacion')->value->links;?>
</td>
    </tr>
    </tfoot>
<?php }?>

</table>
<?php }?>
<?php if (isset($_REQUEST['action'])&&(($_REQUEST['action']=="new")||($_REQUEST['action']=="read"))){?>
<script language="javascript" type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('params')->value['JS_DIR'];?>
SpinnerControl.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('params')->value['JS_DIR'];?>
modalbox.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
modalbox.css" media="screen" />


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


<?php $_template = new Smarty_Internal_Template("botonera_up.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>

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
						value="<?php echo $_smarty_tpl->getVariable('user')->value->login;?>
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
						value="" class="<?php if ($_REQUEST['action']=="new"){?>required validate-password<?php }?>" />
				</td>
			</tr>
            
            <!-- Password Confirm-->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="passwordconfirm">Confirmar Password:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="password" id="passwordconfirm" name="passwordconfirm" title="Confirm Password"  size="20"
						value="" autocomplete="off" class="<?php if ($_REQUEST['action']=="new"){?>required<?php }?> validate-password-confirm" />
				</td>
			</tr>
            
            <!-- SessionExpire -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="sessionexpire">Tiempo de expiraci&oacute;n de sesi&oacute;n:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
                    
                    <input type="text" id="sessionexpire" name="sessionexpire" title="Expiraci&oacute;n de Sessi&oacute;n"
						value="<?php echo (($tmp = @$_smarty_tpl->getVariable('user')->value->sessionexpire)===null||$tmp==='' ? "15" : $tmp);?>
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
						value="<?php echo $_smarty_tpl->getVariable('user')->value->email;?>
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
						value="<?php echo $_smarty_tpl->getVariable('user')->value->name;?>
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
						value="<?php echo $_smarty_tpl->getVariable('user')->value->firstname;?>
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
						value="<?php echo $_smarty_tpl->getVariable('user')->value->lastname;?>
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
						value="<?php echo $_smarty_tpl->getVariable('user')->value->address;?>
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
						value="<?php echo $_smarty_tpl->getVariable('user')->value->phone;?>
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
						<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['name'] = 'user_group';
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('user_groups')->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['user_group']['total']);
?>
							<?php if ($_smarty_tpl->getVariable('user_groups')->value[$_smarty_tpl->getVariable('smarty')->value['section']['user_group']['index']]->id==$_smarty_tpl->getVariable('user')->value->id_user_group){?>
                                <option  value = "<?php echo $_smarty_tpl->getVariable('user_groups')->value[$_smarty_tpl->getVariable('smarty')->value['section']['user_group']['index']]->id;?>
" selected="selected"><?php echo $_smarty_tpl->getVariable('user_groups')->value[$_smarty_tpl->getVariable('smarty')->value['section']['user_group']['index']]->name;?>
</option>
					  		<?php }else{ ?>
								<option  value = "<?php echo $_smarty_tpl->getVariable('user_groups')->value[$_smarty_tpl->getVariable('smarty')->value['section']['user_group']['index']]->id;?>
"><?php echo $_smarty_tpl->getVariable('user_groups')->value[$_smarty_tpl->getVariable('smarty')->value['section']['user_group']['index']]->name;?>
</option>
							<?php }?>
						<?php endfor; endif; ?>
					</select>
                    
                    
                    <script type="text/javascript">
                    function showGroupUsers(elto) {
                        /* Modalbox.show('user_groups.php?action=read&id=' + $('id_user_group').value, {
                            title: elto.title, width: 800, height: 640}); */
                        /*if( confirm('¿Está seguro de querer salir de la edición del usuario?') ) {
                            window.open('user_groups.php?action=read&id=' + $('id_user_group').value, 'centro');
                        }*/
                        
                        Modalbox.show('<iframe width="100%" height="450" src="user_groups.php?action=read&id=' + $('id_user_group').value+'"  frameborder="0" marginheight="0" marginwidth="0"></iframe>', {title: 'Gestión de grupos de usuarios', width: 760});
                    }
                    </script>
                    
                    
                    <a href="javascript:void(0);" title="Editar grupo y permisos" onclick="showGroupUsers(this);return false;">
                        <img src="<?php echo $_smarty_tpl->getVariable('params')->value['IMAGE_DIR'];?>
users_edit.png" border="0" style="vertical-align: middle;" /></a>
				</td>
			</tr>
            
       
			
			</tbody>
			</table>
	</td>	
	</tr>
	</table>

<?php }?>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php $_template->updateParentVariables(0);?><?php unset($_template);?>