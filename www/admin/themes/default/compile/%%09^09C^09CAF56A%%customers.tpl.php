<?php /* Smarty version 2.6.18, created on 2010-08-16 13:11:30
         compiled from customers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'customers.tpl', 44, false),array('modifier', 'date_format', 'customers.tpl', 73, false),array('modifier', 'clearslash', 'customers.tpl', 142, false),array('modifier', 'truncate', 'customers.tpl', 176, false),array('modifier', 'escape', 'customers.tpl', 292, false),array('modifier', 'strip', 'customers.tpl', 385, false),array('block', 't', 'customers.tpl', 60, false),array('block', 'acl', 'customers.tpl', 76, false),array('function', 'html_options', 'customers.tpl', 62, false),array('function', 'cycle', 'customers.tpl', 136, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (! isset ( $_REQUEST['action'] ) || $_REQUEST['action'] == 'list'): ?>

<div id="<?php echo $this->_tpl_vars['category']; ?>
">



    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php if (! empty ( $_GET['msg'] )): ?>
       
        <div id="warnings"><?php echo $_GET['msg']; ?>

                     <?php if (! empty ( $_GET['id_del'] ) == 'ok'): ?>
                            <?php echo '<h3>¿Desea eliminarlos de todos modos?  <br><a title=\'si\' href=\''; ?><?php echo $_SERVER['SCRIPT_NAME']; ?><?php echo '?action=confirm_delete&id='; ?><?php echo $_GET['id_del']; ?><?php echo '&page='; ?><?php echo $_GET['page']; ?><?php echo '"\'>Si</a> |<a title=\'no\' href=\''; ?><?php echo $_SERVER['SCRIPT_NAME']; ?><?php echo '?action=list\'>No</a></h3>'; ?>

                        <?php endif; ?></div>
        <script type="text/javascript" language="javascript">
            <?php echo '
                  /* $(\'warnings\').update( \' '; ?>
 <?php echo $_GET['msg']; ?>

                     <?php if (! empty ( $_GET['id_del'] ) == 'ok'): ?>
                            <?php echo '<h3>¿Desea eliminarlos de todos modos?  <br><a title=\'si\' href=\''; ?><?php echo $_SERVER['SCRIPT_NAME']; ?><?php echo '?action=confirm_delete&id='; ?><?php echo $_GET['id_del']; ?><?php echo '&page='; ?><?php echo $_GET['page']; ?><?php echo '"\'>Si</a> |<a title=\'no\' href=\''; ?><?php echo $_SERVER['SCRIPT_NAME']; ?><?php echo '?action=list\'>No</a></h3>'; ?>

                        <?php endif; ?>
                    <?php echo '\' ); */
                   new Effect.Highlight( $(\'warnings\') );
                   new Effect.Opacity( $(\'warnings\'),{ from: 1, to: 0, duration: 16.0} );
            '; ?>

        </script>
    <?php endif; ?>
    <script type="text/javascript">
    <?php echo '
    function submitFilters(frm) {
        $(\'action\').value=\'list\';
        $(\'page\').value = '; ?>
<?php echo ((is_array($_tmp=@$_REQUEST['page'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
<?php echo ';

        frm.submit();
    }
    '; ?>

    </script>

<table class="adminheading">
    <tr>
        <th>
            <div style="display:block;float:left;">
                <label>Buscar: </label>
                <input name="filter[name]" id="filter[name]" onchange="submitFilters(this.form);"
                      type="text"  size="20" value="<?php echo $_REQUEST['filter']['name']; ?>
" />
                &nbsp;

                <label><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Seccion<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
                <select name="filter[category]" id="filter[category]" onchange="submitFilters(this.form);">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['filter_options']['category'],'selected' => $_REQUEST['filter']['category']), $this);?>

                </select>
                &nbsp;
            </div>
            
            <div style="display:block;float:left;padding:4px;">
                <label><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Próxima llamada<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </div>
            <div style="display:block;float:left">
                <input type="text" size="18" id="filter[next_date]" name="filter[next_date]" onchange="submitFilters(this.form);"
                    value="<?php echo ((is_array($_tmp=$_REQUEST['filter']['next_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
"  title="Fecha próxima llamada" />
            </div>
            <div style="display:block;float:left">
                <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                    &nbsp;
                     <label><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Agente<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
                    <select name="filter[agent]" id="filter[agent]" onchange="submitFilters(this.form);">
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['filter_options']['agent'],'selected' => $_REQUEST['filter']['agent']), $this);?>

                    </select></label>
                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                &nbsp;
            </div>
            <br /><br />
            <div style="display:block;float:left;padding:4px;">
                <label><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tracking<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:
            </div>
            <div style="display:block;float:left;height:20px;">
                <select name="filter[tracking]" id="filter[tracking]" onchange="submitFilters(this.form);">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['filter_options']['tracking'],'selected' => $_REQUEST['filter']['tracking']), $this);?>

                </select>
            </div>
            </label>
            <div style="display:block;float:left;padding:4px;">
                <label> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fecha<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </div>
            <div style="display:block;float:left;height:20px;">
                <input type="text" size="18" id="filter[fecha]" name="filter[fecha]" onchange="submitFilters(this.form);"
                    value="<?php echo ((is_array($_tmp=$_REQUEST['filter']['fecha'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
"  title="Fecha" />
            </div>
            
            <input type="button" id="clear_filters" value="Limpiar">
            <input type="hidden" id="page" name="page" value="<?php echo ((is_array($_tmp=@$_REQUEST['page'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
" />
 
        </th>
    </tr>
</table>

<table class="adminlist">
    <thead>
    <tr>
        <th></th>
        <th align="left" class="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Company_name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>       
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Teléfono<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email2<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>FAX<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Próxima Llamada<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Agente<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Ultimo tracking<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Nota<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th align="center"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <th align="center"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </tr>
    </thead>

    <tbody>
    <?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['customers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <tr <?php echo smarty_function_cycle(array('values' => "class=row0,class=row1"), $this);?>
>
            <td style="text-align:center;font-size: 11px;;">
                <input type="checkbox" class="minput" id="selected_<?php echo $this->_sections['c']['iteration']; ?>
" name="selected_fld[]"
                    value="<?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->pk_customer; ?>
" />
                </td>               
                <td  id="info_<?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->pk_customer; ?>
" style="font-size: 11px;cursor:pointer;cursor: hand;">
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['customers'][$this->_sections['c']['index']]->company_name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                        <?php echo '
                            <script type="text/javascript" language="javascript">
                            new Tip('; ?>
'info_<?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->pk_customer; ?>
', 'Dirección: <?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->address1; ?>
 <br>Ciudad: <?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->city; ?>
 <br>Fecha última incidencia:  <?php echo ((is_array($_tmp=@$this->_tpl_vars['last_trackings'][$this->_tpl_vars['custom']]['date'])) ? $this->_run_mod_handler('default', true, $_tmp, '---') : smarty_modifier_default($_tmp, '---')); ?>
', <?php echo '
                            {title: \'Más información\'                                                      
                            });
                            </script>
                        '; ?>

                </td>
                <td style="text-align:left;font-size: 11px;">
                         <?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->telf1; ?>

                </td>
                <td style="text-align:left;font-size: 11px;">
                         <?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->email1; ?>

                </td>
                 <td style="text-align:left;font-size: 11px;">
                         <?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->email2; ?>

                </td>
                 <td style="text-align:left;font-size: 11px;">
                         <?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->fax; ?>

                </td>
                <td style="text-align:left;font-size: 11px;">
                         <?php echo ((is_array($_tmp=@$this->_tpl_vars['customers'][$this->_sections['c']['index']]->next_app_date)) ? $this->_run_mod_handler('default', true, $_tmp, '---') : smarty_modifier_default($_tmp, '---')); ?>

                </td>
                <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                     <td style="text-align:left;font-size: 11px;">
                             <?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->agent; ?>

                     </td>
                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                <td style="text-align:left;font-size: 11px;">
                    <?php $this->assign('custom', $this->_tpl_vars['customers'][$this->_sections['c']['index']]->id); ?>
                    <?php echo ((is_array($_tmp=@$this->_tpl_vars['last_trackings'][$this->_tpl_vars['custom']]['track'])) ? $this->_run_mod_handler('default', true, $_tmp, '---') : smarty_modifier_default($_tmp, '---')); ?>

                </td>
                 <td style="text-align:left;font-size: 11px;" id="track_<?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->pk_customer; ?>
">
                    <?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['last_trackings'][$this->_tpl_vars['custom']]['info'])) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 36) : smarty_modifier_truncate($_tmp, 36)))) ? $this->_run_mod_handler('default', true, $_tmp, '---') : smarty_modifier_default($_tmp, '---')); ?>

                    <?php if (! empty ( $this->_tpl_vars['last_trackings'][$this->_tpl_vars['custom']]['info'] )): ?>
                     <?php echo '
                            <script type="text/javascript" language="javascript">
                            new Tip('; ?>
'track_<?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->pk_customer; ?>
', ' <?php echo ((is_array($_tmp=$this->_tpl_vars['last_trackings'][$this->_tpl_vars['custom']]['info'])) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>
', <?php echo '
                            {title: \'Nota\'
                            });
                            </script>
                      '; ?>

                    <?php endif; ?>
                </td>
                <td style="text-align:center;">
                        <a href="#" onClick="javascript:enviar(this, '_self', 'read', '<?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->id; ?>
');" title="Modificar">
                                <img src="<?php echo($this->image_dir); ?>edit.png" border="0" /></a>
                </td>
                <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                    <td style="text-align:center;">
                            <a href="#" onClick="javascript:confirmar(this, '<?php echo $this->_tpl_vars['customers'][$this->_sections['c']['index']]->id; ?>
');" title="Eliminar">
                                    <img src="<?php echo($this->image_dir); ?>trash.png" border="0" /></a>
                    </td>
                 <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

        </tr>
        <?php endfor; else: ?>
        <tr>
                <td align="center" colspan="10">
                <h2>Ningun cliente almacenado</h2>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>

    <tfoot>
        <?php if (count ( $this->_tpl_vars['customers'] ) > 0): ?>
        <tr>
            <td colspan="10" style="padding:10px;font-size: 12px;" align="center">
                <br />
                <div id="pagination">
                <?php echo $this->_tpl_vars['paginacion']->links; ?>

                </div> <br />
            </td>
        </tr>
        <?php endif; ?>
    </tfoot>

</table>

<script type="text/javascript" language="javascript">
<?php echo '

    new Control.DatePicker($(\'filter[fecha]\'), {
        icon: \'./themes/default/images/template_manager/update16x16.png\',
        locale: \'es_ES\',
        timePicker: false,
        timePickerAdjacent: true,
        dateFormat: \'yyyy-MM-dd\'
    });
    new Control.DatePicker($(\'filter[next_date]\'), {
        icon: \'./themes/default/images/template_manager/update16x16.png\',
        locale: \'es_ES\',
        timePicker: false,
        timePickerAdjacent: false,
        dateFormat: \'yyyy-MM-dd\'
    });

    document.observe("dom:loaded", function(){
        $(\'pagination\').select(\'a\').each(function(item) {
            item.observe(\'click\', function(event) {
                 Event.stop(event);
                 
                 var element = Event.element(event);
                 $(\'formulario\').setAttribute(\'action\', element.href);

                 $(\'formulario\').action.value = \'list\';
                 
                 try {
                    $(\'formulario\').page.value = /page=(\\d+)/.exec(element.href)[1];
                 } catch(ex) {
                    $(\'formulario\').page.value = 1;
                 }
                 
                 $(\'formulario\').submit();

            });
        });

    });

    $(\'clear_filters\').observe(\'click\', function(event){
        $("filter[fecha]").value = "";
        $("filter[name]").value = "";
        $("filter[next_date]").value = "";
        $("filter[tracking]").value = "0";
        $("filter[section]").value = "0";
 
     });

'; ?>

</script>
<?php endif; ?>

<?php if (isset ( $_REQUEST['action'] ) && ( $_REQUEST['action'] == 'new' || $_REQUEST['action'] == 'read' )): ?>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <table border="0" cellpadding="2" cellspacing="2" class="fuente_cuerpo" width="100%">
    <tbody>

        <tr>
            <td valign="top" style="text-align:right;width:90px;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Nombre comercial<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" nowrap="nowrap" style="width:314px;">
                <input type="text" id="name" name="name" title="name"
                            size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="required" onBlur=""/>
            </td>
            <td valign="top" style="text-align:right;width:110px;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Telefono<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 1:</label>
            </td>
            <td valign="top" nowrap="nowrap" style="width:320px;">
                <input type="text" id="telf1" name="telf1" title="telf1" size="10" maxlength="9"
                    onchange="get_unique();" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->telf1)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="required"/>
                    <div id="check_tfno"></div>
            </td>
            <td rowspan="9" valing='top'>
               
                <div class="utilities-conf" style="padding:2px;">
                    <table>
                        <tr>
                            <td valign="top" nowrap="nowrap"  style="text-align:right;">
                                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Creado<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
                            </td>
                            <td valign="top">
                                <input type="text" value="<?php echo $this->_tpl_vars['customer']->created; ?>
" name="created" disabled />
                                </br>
                            </td>
                         </tr>                        
                         <tr>
                            <td valign="top" nowrap="nowrap"  style="text-align:right;padding-bottom:20px;">
                                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Agente<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
                            </td>
                            <td valign="top">
                                <input type="text" value="<?php echo $this->_tpl_vars['user']; ?>
" name="user" disabled />
                                <br/>
                                <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                                <select name="fk_creator">
                                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['agentsOp'],'selected' => $this->_tpl_vars['customer']->fk_creator), $this);?>

                                </select>
                                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                            </td>
                        </tr>
                         <tr>
                             <td valign="top" nowrap="nowrap"  style="text-align:right;padding-bottom:20px;">
                                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Próxima llamada<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
                            </td>
                            <td valign="top">
                                  <input type="text" size="18" id="next_app_date" name="next_app_date"
                                    <?php if ($this->_tpl_vars['customer']->next_app_date == '0000-00-00 00:00:00'): ?>
                                         value="" 
                                    <?php else: ?>
                                        value="<?php echo ((is_array($_tmp=$this->_tpl_vars['customer']->next_app_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M")); ?>
"
                                    <?php endif; ?>
                                    title="Fecha proxima llamada" /></label>
                                </br>
                            </td>
                         </tr>
                        <tr>
                            <td valign="top" style="text-align:right;">
                                <label for="tracking"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Trackings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
                            </td>
                            <td valign="top" >
                                <select name="tracking">
                                     <?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['trackings']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                         <option value="<?php echo $this->_tpl_vars['trackings'][$this->_sections['c']['index']]->pk_tracking; ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['trackings'][$this->_sections['c']['index']]->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "...") : smarty_modifier_truncate($_tmp, 40, "...")); ?>
</option>
                                     <?php endfor; endif; ?>
                                </select>
                            </td>
                      </tr>
                      <tr>
                            <td valign="top" style="text-align:right;">
                                <label for="info"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notas<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
                            </td><td valign="top" rowspan="2">
                                <textarea name="info" id="info" title="Information" cols="30" rows="10"></textarea>
                            </td>
                      <tr>
                        <td valign="bottom" style="text-align:center;">
                            <?php if (( $_REQUEST['action'] == 'read' )): ?>
                                <a href="#" class="admin_add" onClick="saveTracking(this, '_self', 'validate', '<?php echo $this->_tpl_vars['customer']->id; ?>
', 'formulario');" value="save trackings" title="save trackings">
                                    <img border="0" src="<?php echo($this->image_dir); ?>article_add.gif" title="Save trackings" alt="Save trackings" >
                                    <br /><b>Guardar incidencia</b>
                                </a>
                            <?php endif; ?>
                        </td>
                  </tr>
                  
                  </table>
                </div>
                <div id="warnings"></div>
            </td>
        </tr>
        <tr>
            <td valign="top"   style="text-align:right;width:90px;">
                <label for="metadata"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Metadata<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label><br />
                <sub>Separadas por comas</sub>
            </td>
            <td valign="top" nowrap="nowrap">
                <input type="text" id="metadata" name="metadata" title="metadata" size="40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['customer']->metadata)) ? $this->_run_mod_handler('strip', true, $_tmp) : smarty_modifier_strip($_tmp)); ?>
" />
            </td>
            <td valign="top" style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Telefono<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 2:</label>
            </td>
            <td valign="top">
                <input type="text" id="telf2" name="telf2" title="telf2" size="10"  maxlength="9" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->telf2)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
        </tr>
        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Nombre Fiscal:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
            </td>
            <td valign="top" >
                <input type="text" id="company_name_fiscal" name="company_name_fiscal" title="company_name_fiscal"
                            size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->company_name_fiscal)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
            <td valign="top"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fax<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top">
                <input type="text" id="fax" name="fax" title="fax" size="10"  maxlength="9" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->fax)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
        </tr>
        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>CIF<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" >
                <input type="text" id="cif" name="cif" title="cif" size="10" maxlength="9" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->cif)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email 1<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top">
                <input type="text" id="email1" name="email1" title="email1" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->email1)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
        </tr>

        <tr>
            <td valign="top" style="text-align:right;">
                <label for="category"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Categoria<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" >
                <select name="category" id="category">
                    <?php unset($this->_sections['as']);
$this->_sections['as']['name'] = 'as';
$this->_sections['as']['loop'] = is_array($_loop=$this->_tpl_vars['allcategories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['as']['show'] = true;
$this->_sections['as']['max'] = $this->_sections['as']['loop'];
$this->_sections['as']['step'] = 1;
$this->_sections['as']['start'] = $this->_sections['as']['step'] > 0 ? 0 : $this->_sections['as']['loop']-1;
if ($this->_sections['as']['show']) {
    $this->_sections['as']['total'] = $this->_sections['as']['loop'];
    if ($this->_sections['as']['total'] == 0)
        $this->_sections['as']['show'] = false;
} else
    $this->_sections['as']['total'] = 0;
if ($this->_sections['as']['show']):

            for ($this->_sections['as']['index'] = $this->_sections['as']['start'], $this->_sections['as']['iteration'] = 1;
                 $this->_sections['as']['iteration'] <= $this->_sections['as']['total'];
                 $this->_sections['as']['index'] += $this->_sections['as']['step'], $this->_sections['as']['iteration']++):
$this->_sections['as']['rownum'] = $this->_sections['as']['iteration'];
$this->_sections['as']['index_prev'] = $this->_sections['as']['index'] - $this->_sections['as']['step'];
$this->_sections['as']['index_next'] = $this->_sections['as']['index'] + $this->_sections['as']['step'];
$this->_sections['as']['first']      = ($this->_sections['as']['iteration'] == 1);
$this->_sections['as']['last']       = ($this->_sections['as']['iteration'] == $this->_sections['as']['total']);
?>
                        <option value="<?php echo $this->_tpl_vars['allcategories'][$this->_sections['as']['index']]->pk_content_category; ?>
"
                            <?php if ($this->_tpl_vars['category'] == $this->_tpl_vars['allcategories'][$this->_sections['as']['index']]->pk_content_category): ?>selected="selected"<?php endif; ?>>
                            <?php echo $this->_tpl_vars['allcategories'][$this->_sections['as']['index']]->title; ?>

                        </option>
                    <?php endfor; endif; ?>
                </select>
            </td>
            <td valign="top"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 2:</label>
            </td>
            <td valign="top"  >
                <input type="text" id="email2" name="email2" title="email2" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->email2)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
        </tr>
        <tr>
            <td valign="top"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Direccion<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 1:</label>
            </td>
            <td valign="top" >
                <input type="text" id="address1" name="address1" title="address1" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->address1)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
            <td valign="top"   nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Pagina Web<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" >
                <input type="text" id="web_page" name="web_page" title="web_page" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->web_page)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
        </tr>
        <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Direccion<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 2:</label>
            </td>
            <td valign="top" >
                <input type="text" id="address2" name="address2" title="address2" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->address2)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
            <td valign="top"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Nombre de contacto<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" >
                <input type="text" id="contact_name" name="contact_name" title="contact_name" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->contact_name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" "/>
            </td>
        </tr>
        <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Ciudad<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" >
                <input type="text" id="city" name="city" title="city" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->city)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Observaciones<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" rowspan="4">
                <textarea name="description" id="description" title="Information" cols="38" rows="8"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->description)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</textarea>
            </td>
        </tr>
        <tr>
            <td valign="top" nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Provincia<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" >
                <input type="text" id="state" name="state" title="state" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->state)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">&nbsp;</label>
            </td>
            <td valign="top" >&nbsp;</td>
        </tr>
        <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>CP<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
            </td>
            <td valign="top"  >
                <input type="text" id="postal_code" name="postal_code" title="postal_code"
                 size="10"  maxlength="5" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['customer']->postal_code)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>            
        </tr>
         <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
            </td>
            <td valign="top"  >
            </td>
        </tr>
        <tr>
            <td colspan="5" style="padding:10px;">
                <h2><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Trackings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h2>
                <div id='div-trackings'>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "custom_trackings.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </div>
            </td>
        </tr>
    </tbody>
    </table>

    <script type="text/javascript" language="javascript">
    <?php echo '

    if($(\'next_app_date\')) {
        new Control.DatePicker($(\'next_app_date\'), {
            icon: \'./themes/default/images/template_manager/update16x16.png\',
            locale: \'es_ES\',
            timePicker: true,
            timePickerAdjacent: true,
            use24hrs:true,
            dateTimeFormat: \'yyyy-MM-dd HH:mm\',
            dateFormat: \'yyyy-MM-dd  HH:mm\'
        });

    }
    '; ?>

    </script>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>