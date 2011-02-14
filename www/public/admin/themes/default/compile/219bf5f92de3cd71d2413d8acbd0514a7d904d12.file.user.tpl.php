<?php /* Smarty version Smarty-3.0.6, created on 2011-02-11 18:40:17
         compiled from "/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19152088874d557481812c15-34158826%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '219bf5f92de3cd71d2413d8acbd0514a7d904d12' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user.tpl',
      1 => 1297445935,
      2 => 'file',
    ),
    '7a0f52520c7f73509b725c10b0ac8462f8b23cee' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/base/admin.tpl',
      1 => 1297445473,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19152088874d557481812c15-34158826',
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
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
index.css"/>
            
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
index.css"/>
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
loginadmin.css"/>
       
        

        <!-- Admin Blueprint -->
        

        <link rel="stylesheet" type="text/css" href="../themes/default/css/flexigrid/flexigrid.css"/>
        <script type="text/javascript" src="/public/admin/themes/default/js/jquery.js"></script>
        <script type="text/javascript" src="/public/admin/themes/default/js/flexigrid/flexigrid.js"></script>

        
        <!-- Admin Blueprint -->
        

            <link href="/public/themes/default/css/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection"/>
            <link href="/public/themes/default/css/blueprint/print.css" type="text/css" rel="stylesheet" media="print"/>
            <!--[if lt IE 8]><link rel="stylesheet" href="admin/themes/default/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

        

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

                 </div>
                <div class="span-18 last">
                    <div class="span-18 last">
                        <div class="box">
                            Opciones
                        </div>
                    </div>
                    <div class="span-18 last">
                        <div class="box">
                            

                            

<b>Example 1</b>
<p>
The most basic example with the zero configuration, with a table converted into flexigrid
(<a href="#" onclick="$(this).parent().next().toggle(); return false;">Show sample code</a>)
</p>

<table class="flexme1">
	<thead>
    		<tr>
            	<th width="100">Col 1</th>
            	<th width="100">Col 2</th>
            	<th width="100">Col 3 is a long header name</th>
            	<th width="300">Col 4</th>
            </tr>
    </thead>
    <tbody>
    		<tr>
            	<td>This is data 1 with overflowing content</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>

    </tbody>
</table>
<br />



<table id="flex1" style="display:none"></table>


<script type="text/javascript">
			$('.flexme1').flexigrid();
</script>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3875581-1";
urchinTracker();
</script>


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
        
        
                <?php if ($_REQUEST['action']=='new'||$_REQUEST['action']=='read'){?>
                <script type="text/javascript">
                try {
                        // Activar la validación
                        new Validation('formulario', { immediate : true });
                        Validation.addAllThese([
                                ['validate-password',
                                        'Su password debe contener mas de 5 caracteres y no contener la palabra \'password\' o su nombre de usuario', {
                                        minLength : 6,
                                        notOneOf : ['password','PASSWORD','Password'],
                                        notEqualToField : 'login'
                                }],
                                ['validate-password-confirm',
                                        'Compruebe su primer password, por favor intentelo de nuevo.', {
                                        equalToField : 'password'
                                }]
                        ]);

                        // Para activar los separadores/tabs
                        $fabtabs = new Fabtabs('tabs');
                } catch(e) {
                        // Escondemos los errores
                        //console.log( e );
                }
                 </script>
                <?php }?>
        
    </body>
</html>
