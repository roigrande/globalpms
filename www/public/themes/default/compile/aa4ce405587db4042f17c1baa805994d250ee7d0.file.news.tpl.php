<?php /* Smarty version Smarty-3.0.6, created on 2011-02-11 12:50:26
         compiled from "/var/www/globalpms/trunk/www/public//themes/default/tpl/news.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9710351994d550ac897f951-21629661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa4ce405587db4042f17c1baa805994d250ee7d0' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//themes/default/tpl/news.tpl',
      1 => 1297418945,
      2 => 'file',
    ),
    '7ebc9729bd9fe7913ee028c8832f6d698d26ec15' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//themes/default/tpl/public.tpl',
      1 => 1297419559,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9710351994d550ac897f951-21629661',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
<head>
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="OpenHost,SL" />
    <meta name="generator" content="GlobalPMS - Global Production Management System" />


    
        <title>GlobalPms - Admin section</title>
    

    <!-- Admin CSS -->
    
       
        <link rel="stylesheet" type="text/css" href="<?php echo @TEMPLATE_ADMIN_PATH_WEB;?>
css/admin.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
botonera.css"/>

        <link rel="stylesheet" type="text/css" href="themes/default/css/index.css"/>
        <link rel="stylesheet" type="text/css" href="themes/default/css/menu_horizontal.css"/>

    

    

        <link href="themes/default/css/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection"/>
        <link href="themes/default/css/blueprint/print.css" type="text/css" rel="stylesheet" media="print"/>
        <!--[if lt IE 8]><link rel="stylesheet" href="themes/default/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

    

    <!-- JS Admin library -->
    

    <script type="text/javascript" language="javascript" src="<?php echo $_smarty_tpl->getVariable('params')->value['JS_DIR'];?>
prototype.js"></script>
      
    

</head>
<body>

	 <div id="cabecera">
        <div class="container ">
            <div class="span-6">
                <div class="box">
                    Logo
                </div>
            </div>
            <div class="span-18 last">
                <div  id="elmenu">

                    <a href="index.php?action=index"><span>HOME</span></a>

                    <a href="index.php?action=news"><span>NEWS</span></a>

                    <a href="index.php?action=contact"><span>CONTACT</span></a>

                    <a href="index.php?action=login"><span>LOGIN</span></a>

                </div>
            </div>
        </div>
    </div>

        <div class="container">
        <div class="span-6">

         </div>
        <div class="span-18 last">                        
            <div class="box">
                
                
                
        news
    
            </div>
            
        </div>
    </div>
    <div id="pie">
        <div class="container ">
            <div class="span-24 last">
                <div class="box">
                        Pie
                </div>
            </div>
        </div>
    </div>
</body>


</body>
</html>
