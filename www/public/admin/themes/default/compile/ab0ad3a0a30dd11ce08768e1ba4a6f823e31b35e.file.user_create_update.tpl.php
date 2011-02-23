<?php /* Smarty version Smarty-3.0.6, created on 2011-02-23 11:20:23
         compiled from "/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user_create_update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14357329514d64df6722b474-33865218%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ab0ad3a0a30dd11ce08768e1ba4a6f823e31b35e' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user_create_update.tpl',
      1 => 1298456421,
      2 => 'file',
    ),
    '7a0f52520c7f73509b725c10b0ac8462f8b23cee' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/base/admin.tpl',
      1 => 1298454143,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14357329514d64df6722b474-33865218',
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
       
        
      <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
estilo.css"/>


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

       
        
        

<script type="text/javascript" src="/public/admin/themes/default/js/jqueryforms/jquery.form.js"></script>



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
                            

                            


<form id="myForm" action="contacto.php" method="post">
    <label><?php echo $_smarty_tpl->getVariable('action')->value;?>
</label> <input type="text" name="name" />
    <label>Mensaje:</label> <textarea name="mensaje"></textarea>
    <input type="submit" value="Enviar" /> <div id="ajax_loader"><img id="loader_gif" src="loader.gif" style=" display:none;"/></div>
</form>

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
    
    
        <script type="text/javascript">
        
        // esperamos que el DOM cargue
        $(document).ready(function() {
            // definimos las opciones del plugin AJAX FORM
            var opciones= {
                               beforeSubmit: mostrarLoader, //funcion que se ejecuta antes de enviar el form
                               success: mostrarRespuesta, //funcion que se ejecuta una vez enviado el formulario

            };
             //asignamos el plugin ajaxForm al formulario myForm y le pasamos las opciones
            $('#myForm').ajaxForm(opciones) ;

             //lugar donde defino las funciones que utilizo dentro de "opciones"
             function mostrarLoader(){
                      $("#loader_gif").fadeIn("slow");
             };
             function mostrarRespuesta (responseText){
				           alert("Mensaje enviado: "+responseText);
                          $("#loader_gif").fadeOut("slow");
                          $("#ajax_loader").append("<br>Mensaje: "+responseText);
             };

        });

    </script>
    

      
    </body>
</html>
