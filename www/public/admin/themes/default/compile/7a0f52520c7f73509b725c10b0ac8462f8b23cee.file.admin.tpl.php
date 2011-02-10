<?php /* Smarty version Smarty-3.0.6, created on 2011-02-10 17:57:06
         compiled from "/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/base/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1529914404d5418e2c9d2e0-77254286%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a0f52520c7f73509b725c10b0ac8462f8b23cee' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/base/admin.tpl',
      1 => 1297357025,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1529914404d5418e2c9d2e0-77254286',
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

    

    <!-- JS Admin library -->
    

    <script type="text/javascript" language="javascript" src="<?php echo $_smarty_tpl->getVariable('params')->value['JS_DIR'];?>
prototype.js"></script>
      
    

</head>
<body>

	
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
