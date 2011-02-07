<?php /* Smarty version 2.6.18, created on 2010-11-22 11:23:34
         compiled from company/companies_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'company/companies_list.tpl', 15, false),array('block', 'acl', 'company/companies_list.tpl', 23, false),array('function', 'cycle', 'company/companies_list.tpl', 32, false),array('modifier', 'clearslash', 'company/companies_list.tpl', 40, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!---->
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php if (! empty ( $_GET['msg'] )): ?>
       
        <div id="warnings"><?php echo $_GET['msg']; ?>
 </div>

    <?php endif; ?>
    <table class="adminlist">
    <thead>
        <tr>
            <th></th>
            <th align="left" class="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fiscal Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Telephone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fax<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>State<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>City<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th align="center"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <th align="center"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </tr>
    </thead>

    <tbody>
        
    <?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['companies']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                value="<?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->pkcompany; ?>
" />
            </td>

            
            <td  id="info_<?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->pkcompany; ?>
" style="font-size: 11px;cursor:pointer;cursor: hand;">
                <?php echo ((is_array($_tmp=$this->_tpl_vars['companies'][$this->_sections['c']['index']]->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                
            </td>

            <td style="text-align:left;font-size: 11px;">
                <?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->fiscalName; ?>

            </td>

            <td style="text-align:left;font-size: 11px;">
                <?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->telf1; ?>

            </td>

            <td style="text-align:left;font-size: 11px;">
                <?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->email1; ?>

            </td>

            <td style="text-align:left;font-size: 11px;">
                <?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->fax; ?>

            </td>

            <td style="text-align:left;font-size: 11px;">
                <?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->state; ?>

            </td>

            <td style="text-align:left;font-size: 11px;">
              <?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->city; ?>

            </td>

            <td style="text-align:center;">
                <a href="#" onClick="javascript:enviar(this, '_self', 'read', '<?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->pkCompany; ?>
');" title="Modificar ">
                <img src="<?php echo ($this->image_dir); ?>edit.png" border="0" /></a> 
            </td>

            <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <td style="text-align:center;">
                    <a href="#" onClick="javascript:confirmar(this, '<?php echo $this->_tpl_vars['companies'][$this->_sections['c']['index']]->pkCompany; ?>
');" title="Eliminar">
                    <img src="<?php echo($this->image_dir); ?>trash.png" border="0" /></a>
                </td>
            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </tr>
    <?php endfor; else: ?>
        <tr>
                <td align="center" colspan="10">
                <h2>Ninguna compañia almacenada</h2>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>

    <tfoot>
        <?php if (count ( $this->_tpl_vars['companies'] ) > 0): ?>
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


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>