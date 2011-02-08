<?php /* Smarty version Smarty-3.0.6, created on 2011-02-07 18:13:06
         compiled from "/var/www/globalpms/trunk/www/public/themes/default/tpl/indexfrontend.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20595701274d502822530af0-28819665%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef5b2f6227a14cd96e329ce0c1a546a5aa4c4801' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public/themes/default/tpl/indexfrontend.tpl',
      1 => 1297098781,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20595701274d502822530af0-28819665',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Global pms</title>
    <link href="themes/default/css/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection">
    <link href="themes/default/css/blueprint/print.css" type="text/css" rel="stylesheet" media="print">
    <!--[if lt IE 8]><link rel="stylesheet" href="themes/default/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    <link rel="stylesheet" type="text/css" href="themes/default/css/index.css"/>
    <link rel="stylesheet" type="text/css" href="themes/default/css/menu_horizontal.css"/>



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

              <a href="#"><span>Texto del enlace</span></a>

              <a href="#" class="seleccionado"><span>Texto del enlace</span></a>

              <a href="#"><span>Texto del enlace</span></a>

              <a href="#"><span>Texto del enlace</span></a>

              </div>


            </div>
        </div>
    </div>
    <div class="container">
        <div class="span-6">

         </div>
        <div class="span-18 last">
            <div class="span-18 last">
                <div class="box">
                    Opciones
                </div>
            </div>
            <div class="span-18 last">
                <div class="box">
                    marco principal
                    marco principal
                    marco principal
                    marco principal
                    marco principal
                    marco principal2 2 2 2
                    marco principal
                    marco principal
                    <?php echo $_smarty_tpl->getVariable('datos')->value;?>

                    <?php echo $_smarty_tpl->getVariable('probando')->value;?>

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
