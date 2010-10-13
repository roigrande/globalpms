<?php /* Smarty version 2.6.18, created on 2010-08-16 13:01:26
         compiled from litter.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'litter.tpl', 36, false),array('modifier', 'clearslash', 'litter.tpl', 41, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (! isset ( $_POST['action'] ) || $_POST['action'] == 'list'): ?>


    <ul class="tabs">
        <li><a href="litter.php?action=list&mytype=customer" <?php if ($this->_tpl_vars['mytype'] == customer): ?> style="color:#000000; font-weight:bold; background-color:#BFD9BF" <?php endif; ?>>Customer</a></li>
        <li><a href="litter.php?action=list&mytype=tracking" <?php if ($this->_tpl_vars['mytype'] == tracking): ?> style="color:#000000; font-weight:bold; background-color:#BFD9BF" <?php endif; ?>>Tracking</a></li>
    </ul>

    <br class="clear"/><br><br />

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <br class="clear"/>
    <table class="adminheading">
        <tr>
            <th nowrap>Elementos en la papelera</th>
        </tr>
    </table>

    <div id="pagina">

        <table class="adminlist">
            <tr>
                <th style="width:50px;"> &nbsp;</th>
                <th style="width:300px;" align='left'>T&iacute;tulo</th>
                <th  style="">Description</th>
                <th  style="width:160px;">Fecha</th>
                <th  style="width:60px;">Recuperar</th>
                <th  style="width:60px;">Eliminar</th>
            </tr>

            <?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['litterelems']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
 style="cursor:pointer;" >
                    <td>
                        <input type="checkbox" class="minput"  id="selected<?php echo $this->_sections['c']['iteration']; ?>
" name="selected_fld[]" value="<?php echo $this->_tpl_vars['litterelems'][$this->_sections['c']['index']]->id; ?>
"  style="cursor:pointer;">
                    </td>
                    <td style="text-align: left;" onClick="javascript:document.getElementById('selected<?php echo $this->_sections['c']['iteration']; ?>
').click();">
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['litterelems'][$this->_sections['c']['index']]->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                    </td>
                    <td style="text-align: left;">
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['litterelems'][$this->_sections['c']['index']]->description)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                    </td>
                    <td style="text-align: center;">
                        <?php echo $this->_tpl_vars['litterelems'][$this->_sections['c']['index']]->created; ?>

                    </td>

                    <td style="text-align: center;">
                            <a href="?id=<?php echo $this->_tpl_vars['litterelems'][$this->_sections['c']['index']]->id; ?>
&amp;action=no_in_litter&amp;&amp;mytype=<?php echo $this->_tpl_vars['mytype']; ?>
&amp;page=<?php echo $this->_tpl_vars['paginacion']->_currentPage; ?>
" title="Recuperar">
                                <img class="portada" src="<?php echo($this->image_dir); ?>trash_no.png" border="0" alt="Recuperar" width='24px' /></a>
                    </td>
                    <td style="text-align: center;">
                        <a href="#" onClick="javascript:vaciar(this, '<?php echo $this->_tpl_vars['litterelems'][$this->_sections['c']['index']]->id; ?>
');" title="Eliminar"><img src="<?php echo($this->image_dir); ?>trash.png" border="0" /></a>
                    </td>
                </tr>
            <?php endfor; else: ?>
                <tr>
                    <td align="center" colspan=6><br><br><p><h3><b>Ningun elemento en la papelera</b></h3></p><br><br></td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="5" align="center"><?php echo $this->_tpl_vars['paginacion']->links; ?>
</td>
            </tr>
        </table>

    </div>

<?php endif; ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

       					 