<?php /* Smarty version Smarty-3.0.6, created on 2011-02-23 10:43:30
         compiled from "/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/base/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6236511694d64d6c27eeb25-46044827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a0f52520c7f73509b725c10b0ac8462f8b23cee' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/base/admin.tpl',
      1 => 1298454143,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6236511694d64d6c27eeb25-46044827',
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
        

            
            <!--
            <link rel="stylesheet" type="text/css" href="{$smarty.const.TEMPLATE_ADMIN_PATH_WEB}css/admin.css" />
            -->
            
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
botonera.css"/>
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
index.css"/>
            
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
index.css"/>
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
loginadmin.css"/>
       
        

        <!-- Admin flexigrid -->
        

        <link rel="stylesheet" type="text/css" href="../themes/default/css/flexigrid/flexigrid.css"/>
        <script type="text/javascript" src="/public/admin/themes/default/js/jquery.js"></script>
        <script type="text/javascript" src="/public/admin/themes/default/js/flexigrid/flexigrid.js"></script>
        
        <!-- Admin Blueprint -->
        

            <link href="/public/themes/default/css/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection"/>
            <link href="/public/themes/default/css/blueprint/print.css" type="text/css" rel="stylesheet" media="print"/>
            <!--[if lt IE 8]><link rel="stylesheet" href="admin/themes/default/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

        

            <!-- JS Admin library -->
        
            <script type="text/javascript" src="/public/admin/themes/default/js/utils_form.js"></script>

       
        
        

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
                        <div class="box">
                            <div  id="elmenu">

                                <a href="index.php?action=index"><span>HOME</span></a>

                                <a href="index.php?action=users"><span>USERS</span></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="span-6">
                    widgets
                 </div>
                <div class="span-18 last">
                    <div class="span-18 last">
                        <div class="box">
                            Opciones
                        </div>
                    </div>
                    <div class="span-18 last">
                        <div class="box">
                            

                            
                        </div>
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
</html>
