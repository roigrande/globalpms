<?php /* Smarty version 2.6.18, created on 2010-08-16 13:35:50
         compiled from custom_trackings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'custom_trackings.tpl', 5, false),array('block', 'acl', 'custom_trackings.tpl', 9, false),array('function', 'cycle', 'custom_trackings.tpl', 14, false),array('modifier', 'clearslash', 'custom_trackings.tpl', 19, false),)), $this); ?>
<table id='table-trackings' class="adminlist" style="padding:10px;">
    <tbody>
        <tr>

            <th style="padding:10px;text-align:left;"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Número<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th style="padding:10px;text-align:left;"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fecha<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th style="padding:10px;text-align:left;"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Titulo<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <th style="padding:10px;text-align:left;"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Notas<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'TRACKING_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                <th align="center" style="padding:10px;width:35px;">Eliminar</th>
            <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </tr>
        <?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['customtracks']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  style="cursor:pointer;">
                <td style="padding:10px;font-size:11px;" >
                   <?php echo $this->_sections['c']['iteration']; ?>

                </td>
                <td style="padding:10px;font-size:11px;" >
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['customtracks'][$this->_sections['c']['index']]->date)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                </td>
                <td style="padding:10px;font-size:11px;"  >
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['customtracks'][$this->_sections['c']['index']]->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                </td>
                <td style="padding:10px;font-size: 11px;">
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['customtracks'][$this->_sections['c']['index']]->info)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                </td>
                <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'TRACKING_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                    <td style="padding:1px; font-size:11px;" align="center">
                        <a  onClick="deleteTracking(<?php echo $this->_tpl_vars['customtracks'][$this->_sections['c']['index']]->id; ?>
,<?php echo $this->_tpl_vars['customer']->id; ?>
);" title="Eliminar">
                            <img src="<?php echo($this->image_dir); ?>trash.png" border="0" /></a>
                    </td>
                <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            </tr>

        <?php endfor; else: ?>
            <tr>
                <td align="center" colspan="8"><br><br><p><h2><b>Ningun tracking guardado</b></h2></p><br><br></td>
            </tr>
        <?php endif; ?>
    <tbody>
</table>