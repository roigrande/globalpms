<?php /* Smarty version Smarty-3.0.6, created on 2011-02-09 13:23:19
         compiled from "/var/www/globalpms/trunk/www/public/admin//themes/default/tpl/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1385786834d528737746e34-22633220%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6181fa082bf73ce7f5c909e84dae9594e5d4514' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public/admin//themes/default/tpl/login.tpl',
      1 => 1297252908,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1385786834d528737746e34-22633220',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-es" lang="es-es" dir="ltr" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>..: Panel de Control - OpenNeMaS:..</title>
    
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
loginadmin.css" type="text/css" />

    <script type="text/javascript" language="javascript" src="<?php echo $_smarty_tpl->getVariable('params')->value['JS_DIR'];?>
prototype.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo $_smarty_tpl->getVariable('params')->value['JS_DIR'];?>
scriptaculous/scriptaculous.js"></script>
    
   
   
</head>

<body class="login">
  <div id="topbar">
  	<a href="/public/" title="Estas perdido?">&larr; Voltar á páxina principal</a>
  </div>
  <div id="login">
    <h1><a href=""><img src="<?php echo $_smarty_tpl->getVariable('params')->value['IMAGE_DIR'];?>
logo-opennemas-big.png"></a></h1>
    
    <?php if (isset($_smarty_tpl->getVariable('message',null,true,false)->value)){?>
        <div id="message" align="middle"><?php echo $_smarty_tpl->getVariable('message')->value;?>
</div>
        <script type="text/javascript">
        document.observe('dom:loaded', function() {
            new Effect.Highlight('message', { startcolor: '#ffff99', endcolor: '#ffffff'});
        });
        </script>
    <?php }?>    
    
    <form method="post" action="login.php" id="loginform" name="loginform">
        <p>
            <label>Nome de Usuario<br/>
            <input tabindex="10" size="20" class="input" name="login" id="user_login" type="text"
                   value="<?php echo $_COOKIE['login_username'];?>
" /></label>
        </p>
        <p>
            <label>Contrasinal<br/>
            <input type="password" tabindex="20" size="20"  class="input" name="password" id="user_pass"
                   value="<?php echo $_COOKIE['login_password'];?>
" /></label>
        </p>
        <?php if (isset($_smarty_tpl->getVariable('captcha',null,true,false)->value)){?>
        <p>
            <img src="<?php echo $_smarty_tpl->getVariable('captcha')->value;?>
" border="0" /><br />
            <input type="text" tabindex="30" size="20" class="input" name="captcha" id="captcha"
                   value="" autocomplete="off" />
        </p>
        <?php }?>
        <p class="forgetmenot"><label>
            <input type="checkbox" tabindex="90" value="forever" id="rememberme" name="rememberme" <?php if (isset($_COOKIE['login_username'])){?>checked="checked" <?php }?>/> Lembrar</label>
        </p>
        <p class="submit">
            <input type="submit" tabindex="100" value="Acceder" id="wp-submit" name="wp-submit"/>
            
            <input type="hidden" id="action" name="action" value="login" />
            <input type="hidden" name="testcookie" value="1" />            
            
            <?php if (isset($_smarty_tpl->getVariable('token',null,true,false)->value)){?>
                <input type="hidden" name="token" value="<?php echo $_smarty_tpl->getVariable('token')->value;?>
" />
            <?php }?>
        </p>
    </form>
  </div>
  <div style="margin:0 auto; color:#666; font-size:.9em; text-align:center; width:300px;">
	Un produto de <a href="http://www.openhost.es" title="OpenHost S.L.">OpenHost S.L.</a><br/>&copy; Todos os dereitos reservados
  </div>
</body>
</html>