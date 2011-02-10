<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
<head>
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="OpenHost,SL" />
    <meta name="generator" content="GlobalPMS - Global Production Management System" />


    {block name="meta"}
        <title>GlobalPms - Admin section</title>
    {/block}

    <!-- Admin CSS -->
    {block name="header-css"}
       
        <link rel="stylesheet" type="text/css" href="{$smarty.const.TEMPLATE_ADMIN_PATH_WEB}css/admin.css" />
        <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}botonera.css"/>

    {/block}

    <!-- JS Admin library -->
    {block name="header-js"}

    <script type="text/javascript" language="javascript" src="{$params.JS_DIR}prototype.js"></script>
      
    {/block}

</head>
<body>

	{block name="footer-js"}
		{if $smarty.request.action == 'new' || $smarty.request.action == 'read'}
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
		{/if}
	{/block}


</body>
</html>
