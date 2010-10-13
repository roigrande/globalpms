
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>..: Panel de Control :..</title>
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}admin.css?cacheburst=1259173764"/>
        <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}style.css"/>

        <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}botonera.css"/>
        <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}welcomepanel.css?cacheburst=1257955982" />
        <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}datepicker.css"/>
        <link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}prototip.css"/>
        {scriptsection name="head"}
            <script type="text/javascript" language="javascript" src="{$params.JS_DIR}prototype.js"></script>
            <script type="text/javascript" language="javascript" src="{$params.JS_DIR}prototype-date-extensions.js"></script>
            <script type="text/javascript" language="javascript" src="{$params.JS_DIR}scriptaculous/scriptaculous.js?load=effects,dragdrop,controls"></script>            
            <script type="text/javascript" language="javascript" src="{$params.JS_DIR}fabtabulous.js"></script>
            <script type="text/javascript" language="javascript" src="{$params.JS_DIR}prototip/js/prototip/prototip.js"></script>
        {/scriptsection}

        {if $smarty.request.action == 'new' || $smarty.request.action == 'read'}
            <script type="text/javascript" language="javascript" src="{$params.JS_DIR}validation.js"></script>

        {/if}

        <script type="text/javascript" language="javascript" src="{$params.JS_DIR}utils.js"></script>
        <script type="text/javascript" language="javascript" src="{$params.JS_DIR}utils_form.js"></script>

    </head>
    <body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">

        <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" height="100%">
            <tr>
                <td valign="top" align="left"><!-- INICIO: Tabla contenedora -->
                    <form action="#" method="post" name="formulario" id="formulario" {$formAttrs}>
                        <table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" height="100%">
                            <tr>
                                <td style="padding:10px;width:100%;" align="left" valign="top">
                                    {if isset($smarty.session.messages) && !empty($smarty.session.messages)}
                                        {messageboard type="inline"}
                                    {else}
                                        {messageboard type="growl"}
                                    {/if}
