<?php /* Smarty version 2.6.18, created on 2010-08-13 13:01:27
         compiled from login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'scriptsection', 'login.tpl', 9, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" lang="es-es" dir="ltr" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>..: Panel de Control - OpenNeMaS:..</title>
    
    <link rel="stylesheet" href="<?php echo $this->_tpl_vars['params']['CSS_DIR']; ?>
loginadmin.css" type="text/css" />
    
    <?php $this->_tag_stack[] = array('scriptsection', array('name' => 'head')); $_block_repeat=true;smarty_block_scriptsection($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
prototype.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo $this->_tpl_vars['params']['JS_DIR']; ?>
scriptaculous/scriptaculous.js"></script>
    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_scriptsection($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</head>

<body class="login">
  <div id="topbar">
  	<a href="/" title="Estas perdido?">&larr; Voltar á páxina principal</a>
  </div>
  <div id="login">
    <h1><a href=""><img src="<?php echo $this->_tpl_vars['params']['IMAGE_DIR']; ?>
logo-opennemas-big.png"></a></h1>
    
    <?php if (isset ( $this->_tpl_vars['message'] )): ?>
        <div id="message" align="middle"><?php echo $this->_tpl_vars['message']; ?>
</div>
        <script type="text/javascript"><?php echo '
        document.observe(\'dom:loaded\', function() {
            new Effect.Highlight(\'message\', { startcolor: \'#ffff99\', endcolor: \'#ffffff\'});
        });'; ?>

        </script>
    <?php endif; ?>    
    
    <form method="post" action="login.php" id="loginform" name="loginform">
        <p>
            <label>Nome de Usuario<br/>
            <input tabindex="10" size="20" class="input" name="login" id="user_login" type="text"
                   value="<?php echo $_COOKIE['login_username']; ?>
" /></label>
        </p>
        <p>
            <label>Contrasinal<br/>
            <input type="password" tabindex="20" size="20"  class="input" name="password" id="user_pass"
                   value="<?php echo $_COOKIE['login_password']; ?>
" /></label>
        </p>
        <?php if (isset ( $this->_tpl_vars['captcha'] )): ?>
        <p>
            <img src="<?php echo $this->_tpl_vars['captcha']; ?>
" border="0" /><br />
            <input type="text" tabindex="30" size="20" class="input" name="captcha" id="captcha"
                   value="" autocomplete="off" />
        </p>
        <?php endif; ?>
        <p class="forgetmenot"><label>
            <input type="checkbox" tabindex="90" value="forever" id="rememberme" name="rememberme" <?php if (isset ( $_COOKIE['login_username'] )): ?>checked="checked" <?php endif; ?>/> Lembrar</label>
        </p>
        <p class="submit">
            <input type="submit" tabindex="100" value="Acceder" id="wp-submit" name="wp-submit"/>
            
            <input type="hidden" id="action" name="action" value="login" />
            <input type="hidden" name="testcookie" value="1" />            
            
            <?php if (isset ( $this->_tpl_vars['token'] )): ?>
                                <input type="hidden" name="token" value="<?php echo $this->_tpl_vars['token']; ?>
" />
            <?php endif; ?>
        </p>
    </form>
  </div>
  <div style="margin:0 auto; color:#666; font-size:.9em; text-align:center; width:300px;">
	Un produto de <a href="http://www.openhost.es" title="OpenHost S.L.">OpenHost S.L.</a><br/>&copy; Todos os dereitos reservados
  </div>
</body>
</html>