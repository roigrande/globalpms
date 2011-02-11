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

        <link rel="stylesheet" type="text/css" href="themes/default/css/index.css"/>
        <link rel="stylesheet" type="text/css" href="themes/default/css/menu_horizontal.css"/>

    {/block}

    {block name="header-blueprint"}

        <link href="themes/default/css/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection"/>
        <link href="themes/default/css/blueprint/print.css" type="text/css" rel="stylesheet" media="print"/>
        <!--[if lt IE 8]><link rel="stylesheet" href="themes/default/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

    {/block}

    <!-- JS Admin library -->
    {block name="header-js"}

    <script type="text/javascript" language="javascript" src="{$params.JS_DIR}prototype.js"></script>
      
    {/block}

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
            {* este ejemplo para mostar widgets *}

         </div>
        <div class="span-18 last">                        
            <div class="box">
                {block name="body-main"}
                
                {/block}
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
