<?php /* Smarty version 2.6.18, created on 2010-11-19 11:43:23
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'scriptsection', 'header.tpl', 17, false),array('function', 'messageboard', 'header.tpl', 44, false),)), $this); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>..: Panel de Control :..</title>
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['params']['CSS_DIR']; ?>
admin.css?cacheburst=1259173764"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['params']['CSS_DIR']; ?>
style.css"/>

        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['params']['CSS_DIR']; ?>
botonera.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['params']['CSS_DIR']; ?>
welcomepanel.css?cacheburst=1257955982" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['params']['CSS_DIR']; ?>
datepicker.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['params']['CSS_DIR']; ?>
prototip.css"/>
        <?php $this->_tag_stack[] = array('scriptsection', array('name' => 'head')); $_block_repeat=true;smarty_block_scriptsection($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
            <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
prototype.js"></script>
            <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
prototype-date-extensions.js"></script>
            <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
scriptaculous/scriptaculous.js?load=effects,dragdrop,controls"></script>            
            <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
fabtabulous.js"></script>
            
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_scriptsection($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

        <?php if ($_REQUEST['action'] == 'new' || $_REQUEST['action'] == 'read'): ?>
            <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
validation.js"></script>
            <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
datepicker.js"></script>
        <?php endif; ?>

        <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
utils.js"></script>
        <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
utils_form.js"></script>

    </head>
    <body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">

        <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" height="100%">
            <tr>
                <td valign="top" align="left"><!-- INICIO: Tabla contenedora -->
                    <form action="#" method="post" name="formulario" id="formulario" <?php echo $this->_tpl_vars['formAttrs']; ?>
>
                        <table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" height="100%">
                            <tr>
                                <td style="padding:10px;width:100%;" align="left" valign="top">
                                    <?php if (isset ( $_SESSION['messages'] ) && ! empty ( $_SESSION['messages'] )): ?>
                                        <?php echo smarty_function_messageboard(array('type' => 'inline'), $this);?>

                                    <?php else: ?>
                                        <?php echo smarty_function_messageboard(array('type' => 'growl'), $this);?>

                                    <?php endif; ?>