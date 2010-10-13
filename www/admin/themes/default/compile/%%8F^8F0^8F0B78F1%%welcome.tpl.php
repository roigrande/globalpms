<?php /* Smarty version 2.6.18, created on 2010-08-16 13:01:09
         compiled from welcome.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'acl', 'welcome.tpl', 19, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table class="adminform">
    <tbody>
        <tr>
            <td colspan="2">
                <div id="cpanel" >
                    

                	<div style="float: left;">
                        <div class="icon">                            
                            <a href="/admin/customers.php?action=list">
                                <img alt="" src="<?php echo $this->_tpl_vars['params']['IMAGE_DIR']; ?>
/customers.png"/>
                                <span>Clientes</span>
                            </a>                            
                        </div>
                    </div>
             
                    
                    <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                    <div style="float: left;">
                        <div class="icon">
                            <a href="/admin/tracking.php?action=list">
                                <img alt="" src="<?php echo $this->_tpl_vars['params']['IMAGE_DIR']; ?>
opinion.png"/>
                                <span>Incidencias</span>
                            </a>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                     <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                	<div style="float: left;">
                        <div class="icon">
                            <a href="/admin/category.php?action=list">
                                <img alt="" src="<?php echo $this->_tpl_vars['params']['IMAGE_DIR']; ?>
iconos/frontpage_manager.png"/>
                                <span>Secciones</span>
                            </a>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                	<div style="float: left;">
                        <div class="icon">
                            <a href="/admin/user.php?action=new&category=0">
                                <img alt="" src="<?php echo $this->_tpl_vars['params']['IMAGE_DIR']; ?>
advertisement.png"/>
                                <span>Usuarios</span>
                            </a>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                    
                   
                    
                    <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                    <div style="float: left;">
                        <div class="icon">
                            <a href="">
                                <img alt="" src="<?php echo $this->_tpl_vars['params']['IMAGE_DIR']; ?>
iconos/draft_manager.png"/>
                                <span>Logs</span>
                            </a>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
                                       
                    <?php $this->_tag_stack[] = array('acl', array('isAllowed' => 'USER_ADMIN')); $_block_repeat=true;smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
                    <div style="float: left;">
                        <div class="icon">
                            <a href="">
                                <img alt="" src="<?php echo $this->_tpl_vars['params']['IMAGE_DIR']; ?>
newsletter/mail_message_new.png"/>
                                <span>Envío Mail</span>
                            </a>
                        </div>
                    </div>
                    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_acl($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>  
                    
                </div>
            </td>
        </tr>
        
    </tbody>
</table>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>