<?php /* Smarty version 2.6.18, created on 2010-10-07 20:13:07
         compiled from workers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'workers.tpl', 20, false),array('block', 'acl', 'workers.tpl', 28, false),array('function', 'cycle', 'workers.tpl', 37, false),array('modifier', 'clearslash', 'workers.tpl', 44, false),array('modifier', 'default', 'workers.tpl', 70, false),array('modifier', 'escape', 'workers.tpl', 201, false),array('modifier', 'strip', 'workers.tpl', 295, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!---->
<?php if (! isset ( $_REQUEST['action'] ) || $_REQUEST['action'] == 'list'): ?>



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
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>1</th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>2</th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Telephone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>1</th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Telephone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>2</th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date of birth<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th align="left"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <th align="center"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <th align="center"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></th>
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </tr>
    </thead>

    <tbody>
        
    <?php unset($this->_sections['c']);
$this->_sections['c']['name'] = 'c';
$this->_sections['c']['loop'] = is_array($_loop=$this->_tpl_vars['workers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    value="<?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->pk_worker; ?>
" />
                </td>               
                <td  id="info_<?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->pk_worker; ?>
" style="font-size: 11px;cursor:pointer;cursor: hand;">

                                <?php echo ((is_array($_tmp=$this->_tpl_vars['workers'][$this->_sections['c']['index']]->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)); ?>

                        <?php echo '
                            <script type="text/javascript" language="javascript">
                            new Tip('; ?>
'info_<?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->pk_worker; ?>
', 'Apellidos: <?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->surname; ?>
 <br>Ciudad: <?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->city; ?>
 <br>Fecha de nacimiento:  <?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->obd; ?>
', <?php echo '
                            {title: \'Más información\'                                                      
                            });
                            </script>
                        '; ?>

                </td>
              
                <td style="text-align:left;font-size: 11px;">
                         <?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->email1; ?>

                </td>
                <td style="text-align:left;font-size: 11px;">
                         <?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->email2; ?>

                </td>
                <td style="text-align:left;font-size: 11px;">
                         <?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->telf1; ?>

                </td>
                <td style="text-align:left;font-size: 11px;">
                         <?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->telf2; ?>

                </td>
                 <td style="text-align:left;font-size: 11px;">
                         <?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->dob; ?>

                </td>
                <td style="text-align:left;font-size: 11px;">
                         <?php echo ((is_array($_tmp=@$this->_tpl_vars['workers'][$this->_sections['c']['index']]->description)) ? $this->_run_mod_handler('default', true, $_tmp, '---') : smarty_modifier_default($_tmp, '---')); ?>

                             <td style="text-align:center;">
                        <a href="#" onClick="javascript:enviar(this, '_self', 'read', '<?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->id; ?>
');" title="Modificar">
                                <img src="<?php echo($this->image_dir); ?>edit.png" border="0" /></a>
                </td>
                <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                    <td style="text-align:center;">
                            <a href="#" onClick="javascript:confirmar(this, '<?php echo $this->_tpl_vars['workers'][$this->_sections['c']['index']]->id; ?>
');" title="Eliminar">
                                    <img src="<?php echo($this->image_dir); ?>trash.png" border="0" /></a>
                    </td>
                 <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

        </tr>
        <?php endfor; else: ?>
        <tr>
                <td align="center" colspan="10">
                <h2>Ningun trabajador almacenado</h2>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>

    <tfoot>
        <?php if (count ( $this->_tpl_vars['workers'] ) > 0): ?>
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
                (
                 try {
                    $(\'formulario\').page.value = 2;
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
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" nowrap="nowrap" style="width:314px;">
                <input type="text" id="name" name="name" title="name"
                            size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->name)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="required" onBlur=""/>
            </td>
            <td valign="top" style="text-align:right;width:110px;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Telephono<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 1:</label>
            </td>
            <td valign="top" nowrap="nowrap" style="width:320px;">
                <input type="text" id="telf1" name="telf1" title="telf1" size="10" maxlength="9"
                    onchange="get_unique();" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->telf1)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="required"/>
                    <div id="check_tfno"></div>
            </td>
                 </tr>
        <tr>
            <td valign="top"   style="text-align:right;width:90px;">
                <label for="metadata"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Metadata<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label><br />
                <sub>Separadas por comas</sub>
            </td>
            
            <td valign="top" nowrap="nowrap">
                <input type="text" id="metadata" name="metadata" title="metadata" size="40" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['worker']->metadata)) ? $this->_run_mod_handler('strip', true, $_tmp) : smarty_modifier_strip($_tmp)); ?>
" />
            </td>
            <td valign="top" style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Telephone<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 2:</label>
            </td>
            <td valign="top">
                <input type="text" id="telf2" name="telf2" title="telf2" size="10"  maxlength="9" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->telf2)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
        </tr>
        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>NSS:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
            </td>
            <td valign="top" >
                <input type="text" id="nss" name="nss" title="nss"
                            size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->nss)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
            <td valign="top"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top">
                <input type="text" id="address" name="address" title="address" size="40"  maxlength="9" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->address)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
        </tr>
        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>NIF<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" >
                <input type="text" id="nif" name="nif" title="nif" size="10" maxlength="9" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->nif)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email 1<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top">
                <input type="text" id="email1" name="email1" title="email1" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->email1)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
        </tr>

        <tr>
          
          <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Day of birth<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
            </td>
            <td valign="top"  >
                <input type="text" id="dob" name="dob" title="dob"
                 size="10"  maxlength="10" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->dob)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
              <td valign="top"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 2:</label>
            </td>
            <td valign="top"  >
                <input type="text" id="email2" name="email2" title="email2" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->email2)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>

        </tr>

      <tr>
           <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>City<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" >
                <input type="text" id="city" name="city" title="city" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->city)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" rowspan="4">
                <textarea name="description" id="description" title="Information" cols="38" rows="8"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->description)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</textarea>
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