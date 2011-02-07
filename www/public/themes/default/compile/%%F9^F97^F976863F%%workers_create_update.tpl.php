<?php /* Smarty version 2.6.18, created on 2010-11-05 18:45:45
         compiled from worker/workers_create_update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 't', 'worker/workers_create_update.tpl', 14, false),array('modifier', 'clearslash', 'worker/workers_create_update.tpl', 19, false),array('modifier', 'escape', 'worker/workers_create_update.tpl', 19, false),array('modifier', 'strip', 'worker/workers_create_update.tpl', 40, false),array('modifier', 'date_format', 'worker/workers_create_update.tpl', 120, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



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
                 value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->telf1)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
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
           <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>City<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>

            <td valign="top" >
                <input type="text" id="city" name="city" title="city" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->city)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
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
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>1:</label>
            </td>

            <td valign="top">
                <input type="text" id="email1" name="email1" title="email1" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->email1)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
        </tr>

        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>NSS:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
            </td>

            <td valign="top" >
                <input type="text" id="nss" name="nss" title="nss"
                            size="13" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->nss)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>

            <td valign="top"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Email<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 2:</label>
            </td>

            <td valign="top"  >
                <input type="text" id="email2" name="email2" title="email2" size="40                                                            0" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->email2)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"/>
            </td>
        </tr>

        <tr>

            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Day of birth<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
            </td>

            <td valign="top"  >

               <input type="text" size="10" id="dob" name="dob"
                    <?php if ($this->_tpl_vars['worker']->dob == '0000-00-00'): ?>
                         value=""
                    <?php else: ?>
                        value="<?php echo ((is_array($_tmp=$this->_tpl_vars['worker']->dob)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")); ?>
"
                    <?php endif; ?>
                    title="dob" />
            </td>

            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Image<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>

            <td valign="top" >
                <input type="text" id="image" name="image" title="image" size="40" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->image)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
            </td>
           
        </tr>

        <tr>  
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>
            <td valign="top" rowspan="4">
                <SELECT NAME="status">
                   <option value="available" <?php if ($this->_tpl_vars['worker']->status == 'available'): ?> selected ="selected" <?php endif; ?>>available</option>
                   <option value="unvailable"<?php if ($this->_tpl_vars['worker']->status == 'unvailable'): ?> selected ="selected" <?php endif; ?>>unvailable</option>
                </SELECT>
            </td>
         <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title"><?php $this->_tag_stack[] = array('t', array()); $_block_repeat=true;smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Description<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_t($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</label>
            </td>

            <td valign="top" rowspan="4">
                <textarea name="description" id="description" title="description" cols="38" rows="8"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['worker']->description)) ? $this->_run_mod_handler('clearslash', true, $_tmp) : smarty_modifier_clearslash($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</textarea>
            </td>
        </tr>
           
 <script type="text/javascript" language="javascript">
    <?php echo '

    if($(\'dob\')) {
        new Control.DatePicker($(\'dob\'), {
            icon: \'./themes/default/images/template_manager/update16x16.png\',
            locale: \'es_ES\',
            timePicker: false,
            timePickerAdjacent: false,
            use24hrs:false,
            dateFormat: \'yyyy-MM-dd\'
        });

    }
    '; ?>

    </script>
    </tbody>
    </table>
       
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>