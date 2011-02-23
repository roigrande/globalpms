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

            {literal}
            <!--
            <link rel="stylesheet" type="text/css" href="{$smarty.const.TEMPLATE_ADMIN_PATH_WEB}css/admin.css" />
            -->
            {/literal}
            <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}botonera.css"/>
            <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}index.css"/>
            
            <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}index.css"/>
            <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}loginadmin.css"/>
       
        {/block}

        <!-- Admin flexigrid -->
        {block name="flexigrid"}

        <link rel="stylesheet" type="text/css" href="../themes/default/css/flexigrid/flexigrid.css"/>
        <script type="text/javascript" src="/public/admin/themes/default/js/jquery.js"></script>
        <script type="text/javascript" src="/public/admin/themes/default/js/flexigrid/flexigrid.js"></script>
        {/block}
        <!-- Admin Blueprint -->
        {block name="blueprint-css"}

            <link href="/public/themes/default/css/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection"/>
            <link href="/public/themes/default/css/blueprint/print.css" type="text/css" rel="stylesheet" media="print"/>
            <!--[if lt IE 8]><link rel="stylesheet" href="admin/themes/default/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

        {/block}

            <!-- JS Admin library -->
        {block name="header-js"}
            <script type="text/javascript" src="/public/admin/themes/default/js/utils_form.js"></script>

       
        
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
                    {* este ejemplo para mostar widgets *}
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
                            {block name="body-main"}

                            {/block}
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
    {block name="footer-js"}
    {/block}
      
    </body>
</html>
