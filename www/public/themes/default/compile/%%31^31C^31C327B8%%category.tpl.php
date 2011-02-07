<?php /* Smarty version 2.6.18, created on 2010-08-16 13:27:51
         compiled from category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'category.tpl', 14, false),array('function', 'cycle', 'category.tpl', 31, false),array('modifier', 'default', 'category.tpl', 18, false),array('modifier', 'clearslash', 'category.tpl', 37, false),array('modifier', 'escape', 'category.tpl', 37, false),array('block', 't', 'category.tpl', 25, false),)), $this); ?>
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
            <th nowrap="nowrap" align="right">
                <label>Buscar:
                <input type="text" value=""></label>
                <label>Sección:
                <select name="filter[type_customer]" onchange="submitFilters(this.form);">
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['filter_options']['type_customer'],'selected' => $_REQUEST['filter']['type_customer']), $this);?>

                </select></label>

                <input type="hidden" id="page" name="page" value="<?php echo ((is_array($_tmp=@$_REQUEST['page'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
" />
            </th>
        </tr>
    </table>
    <table class="adminlist" id="tabla"  width="100%">
        <tr>
            <th width="5%" class="title"> </th>
            <th width="25%" align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th width="40%" align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th align="center" width="15%"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th align="center" width="15%"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        </tr>
        <?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['categorys']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <td style="padding:4px;font-size: 11px;">
                    <input type="checkbox" class="minput" id="selected_<?php echo $this->_sections['c']['iteration']; ?>
"
                        name="selected_fld[]" value="<?php echo $this->_tpl_vars['categorys'][$this->_sections['c']['index']]->pk_content_category; ?>
" />
                </td>
                <td style="padding:4px;font-size: 11px;">
                    <b> <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['categorys'][$this->_sections['c']['index']]->title)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</b>
                </td>
                <td style="padding:4px;font-size: 11px;">
                      <?php echo ((is_array($_tmp=$this->_tpl_vars['categorys'][$this->_sections['c']['index']]->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                </td>
                <td style="padding:4px;text-align:center;">
                    <a href="#" onClick="javascript:enviar(this, '_self', 'read', <?php echo $this->_tpl_vars['categorys'][$this->_sections['c']['index']]->pk_content_category; ?>
);" title="Modificar">
                        <img src="<?php echo($this->image_dir); ?>edit.png" border="0" />
                    </a>

                </td>
                <td style="padding:4px;" align="center">
                    <a href="#" onClick="javascript:confirmar(this, <?php echo $this->_tpl_vars['categorys'][$this->_sections['c']['index']]->pk_content_category; ?>
);" title="Eliminar">
                       <img src="<?php echo($this->image_dir); ?>trash.png" border="0" />
                    </a>
                </td>
            </tr>
        <?php endfor; else: ?>
            <tr>
                <td colspan="5" style="padding:10px;font-size: 12px;" align="center">
                    <h2><b>Ning&uacute;na secci&oacute;n guardada</b></h2>
                </td></tr>
        <?php endif; ?>
        <?php if (count ( $this->_tpl_vars['categorys'] ) > 0): ?>
            <tr>
                <td colspan="5" style="padding:10px;font-size: 12px;" align="center"><br><?php echo $this->_tpl_vars['paginacion']->links; ?>
<br></td>
            </tr>
        <?php endif; ?>
    </table>
     
<?php endif; ?>


<?php if (isset ( $_REQUEST['action'] ) && ( $_REQUEST['action'] == 'new' || $_REQUEST['action'] == 'read' )): ?>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  
    <table style="margin-left:30px;margin-top:30px;" border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo">
        <tbody>
            <tr>
                <td valign="top" style="padding:4px;text-align:left; width:100px;">
                    <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
                </td>
                <td style="padding:4px;" nowrap="nowrap"  colspan="2">
                    <input type="text" id="title" name="title" title="Título" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['category']->title)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>
"
                        class="required" size="100" />
                </td>
            </tr>
             <tr>
                <td valign="top" style="padding:4px;text-align:left; width:100px;">
                    <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
                </td>
                <td style="padding:4px;" nowrap="nowrap"  colspan="2">
                    <input type="text" id="name" name="name" title="description" 
                      value="<?php echo ((is_array($_tmp=$this->_tpl_vars['category']->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>
" size="100" />
                </td>
            </tr>
              
        </tbody>
    </table>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>