<?php /* Smarty version 2.6.18, created on 2010-08-16 13:02:43
         compiled from tracking.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'tracking.tpl', 21, false),array('function', 'cycle', 'tracking.tpl', 34, false),array('modifier', 'clearslash', 'tracking.tpl', 39, false),)), $this); ?>
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
	<?php if (! empty ( $_GET['msg'] )): ?>
        <div id="warnings"></div>
        <script type="text/javascript" language="javascript">
            <?php echo '
                   $(\'warnings\').update( \''; ?>
<?php echo $_GET['msg']; ?>
<?php echo '\' );
                   new Effect.Highlight( $(\'warnings\') );
                   new Effect.Opacity( $(\'warnings\'),{ from: 1, to: 0, duration: 4.0} );
            '; ?>

        </script>
    <?php endif; ?>
    <div>
        <table class="adminheading">
            <tr>
                <th nowrap> <?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Trackings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
            </tr>
        </table>

        <table class="adminlist">
            <tr>
                <th class="title" style="width:50px;"></th>
                <th align="left" style="width:400px;"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Title<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
                <th align="center" style="width:50px;">Modificar</th>
                <th align="center" style="width:50px;">Eliminar</th>
            </tr>           
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
                <tr <?php echo smarty_function_cycle(array('values' => "class=row0,class=row1"), $this);?>
  style="cursor:pointer;">
                    <td style="padding:1px; font-size:11px;">
                        <input type="checkbox" class="minput"  id="selected_<?php echo $this->_sections['c']['iteration']; ?>
" name="selected_fld[]" value="<?php echo $this->_tpl_vars['trackings'][$this->_sections['c']['index']]->id; ?>
"  style="cursor:pointer;">
                    </td>	
                    <td style="padding:10px;font-size:11px;"  onClick="javascript:document.getElementById('selected_<?php echo $this->_sections['c']['iteration']; ?>
').click();">
                       <?php echo ((is_array($_tmp=$this->_tpl_vars['trackings'][$this->_sections['c']['index']]->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                    </td>
                    <td style="padding:10px;font-size: 11px;">
                        <?php echo ((is_array($_tmp=$this->_tpl_vars['trackings'][$this->_sections['c']['index']]->description)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                    </td>
                     
                    <td style="padding:1px; font-size:11px;" align="center">
                        <a href="#" onClick="javascript:enviar(this, '_self', 'read', '<?php echo $this->_tpl_vars['trackings'][$this->_sections['c']['index']]->id; ?>
');" title="Modificar">
                                <img src="<?php echo($this->image_dir); ?>edit.png" border="0" /></a>
                    </td>
                    <td style="padding:1px; font-size:11px;" align="center">
                        <a href="#" onClick="javascript:confirmar(this, '<?php echo $this->_tpl_vars['trackings'][$this->_sections['c']['index']]->id; ?>
');" title="Eliminar">
                                <img src="<?php echo($this->image_dir); ?>trash.png" border="0" /></a>
                    </td>
                </tr>

            <?php endfor; else: ?>
                <tr>
                    <td align="center" colspan="8"><br><br><p><h2><b>Ningun tracking guardado</b></h2></p><br><br></td>
                </tr>
            <?php endif; ?>
            <?php if (count ( $this->_tpl_vars['trackings'] ) > 0): ?>
                <tr>
                    <td colspan="8" align="center"><?php echo $this->_tpl_vars['paginacion']->links; ?>
</td>
                </tr>
            <?php endif; ?>
        </table>
        
    </div>

<?php endif; ?>

 
 
<?php if (isset ( $_REQUEST['action'] ) && ( $_REQUEST['action'] == 'new' || $_REQUEST['action'] == 'read' )): ?>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "botonera_up.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="700">
        <tbody>
            <tr>
                <td valign="top" align="right" style="padding:4px;" width="30%">
                        <label for="title">T&iacute;tulo:</label>
                </td>
                <td style="padding:4px;" nowrap="nowrap" width="70%">
                        <input type="text" id="name" name="name" title="Incidencia"   
                                value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tracking']->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>
" class="required" size="100" />
                </td>
            </tr>
                        <tr>
                <td valign="top" align="right" style="padding:4px;" >
                        <label for="title">Descripción:</label>
                </td>
                <td style="padding:4px;" nowrap="nowrap"  >
                        <textarea name="description" id="description" title="Resumen de la noticia" style="width:98%; height:6em;"><?php echo ((is_array($_tmp=$this->_tpl_vars['tracking']->description)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>
</textarea>
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