<?php /* Smarty version Smarty-3.0.6, created on 2011-02-10 11:26:37
         compiled from "/var/www/globalpms/trunk/www/public/themes/default/tpl/contact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17380582374d53bd5dc797f5-59727209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19858bb6aa4b05272431a42ff1d0ba67ab0950e5' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public/themes/default/tpl/contact.tpl',
      1 => 1297333560,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17380582374d53bd5dc797f5-59727209',
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
            <div class="span-18 last">
                <div class="box">
                    Opciones
                </div>
            </div>
            <div class="span-18 last">
                <div class="box">
                   <FORM action="http://globalpms.es/public/index" method="post">
                            <P>
                            <LABEL for="nombre">Nombre: </LABEL>
                                      <INPUT type="text" id="nombre"><BR>
                            <LABEL for="apellido">Apellido: </LABEL>
                                      <INPUT type="text" id="apellido"><BR>
                            <LABEL for="email">email: </LABEL>
                                      <INPUT type="text" id="email"><BR>
                            <INPUT type="radio" name="sexo" value="Varón"> Varón<BR>
                            <INPUT type="radio" name="sexo" value="Mujer"> Mujer<BR>
                            <INPUT type="submit" value="Enviar"> <INPUT type="reset">
                            </P>
                    </FORM>
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
