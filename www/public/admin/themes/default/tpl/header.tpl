<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>..: Panel de Control :..</title>
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}admin.css"/>
<link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}style.css"/>
<!--[if IE]>
    <link rel="stylesheet" href="{$params.CSS_DIR}ieadmin.css" type="text/css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}botonera.css"/>
<link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}lightview.css" />
<link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}datepicker.css"/>
<link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}lightwindow.css" media="screen" />

<link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}messageboard.css" media="screen" />

<script type="text/javascript" language="javascript" src="{$params.JS_DIR}prototype.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}prototype-date-extensions.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}scriptaculous/scriptaculous.js?load=effects,dragdrop,controls"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}fabtabulous.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}control.maxlength.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}datepicker.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}MessageBoard.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}validation.js"></script>

{literal}
<script language="javascript">
 
<!-- //
var objForm = null;
var dialogo = null;
var editores = null;

function enviar(elto, trg, acc, id) {
    var parentEl = elto.parentNode;
    while(parentEl.nodeName != "FORM") {
        parentEl = parentEl.parentNode;
    }

    parentEl.target = trg;
    parentEl.action.value = acc;
    parentEl.id.value = id;

    if(objForm != null) {
        objForm.submit();
    } else {
        parentEl.submit();
    }
}

function validateForm(formID)
{
    var checkForm = new Validation(formID, {immediate:true, onSubmit:true});
    if(!checkForm.validate()) {
        if($$('.validation-advice')) {
            if($('warnings-validation')) {
                $('warnings-validation').update('Existen campos sin cumplimentar o errores en el formulario. Por favor, revise todas las pestañas.');
                new Effect.Highlight('warnings-validation');
            }
        }
        return false;
    } else {        
        if($$('.validation-advice') && $('warnings-validation')) {
            $('warnings-validation').setStyle({display: 'none'});
        }
    }
    return true;
}

function sendFormValidate(elto, trg, acc, id, formID)
{
    if(!validateForm(formID))
        return;
       
    enviar(elto, trg, acc, id);
}

function preview(elto, trg, acc, id)
{
    this.blur();
    try { UserVoice.PopIn.show(id); return false; }
    catch(e){}

}

function confirmar(elto, id) {
    if(confirm('¿Está seguro de querer eliminar este elemento?')) {
        enviar(elto, '_self', 'delete', id);
    }
}
// -->
</script>


{/literal}

</head>
<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
 
<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" height="100%">
<tr><td valign="top" align="left"><!-- INICIO: Tabla contenedora -->
<form action="#" method="post" name="formulario" id="formulario"> 
<table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" height="100%">
 
<tr>
    <td style="padding:10px;" align="left" valign="top">

{if isset($smarty.session.messages) && !empty($smarty.session.messages)}
    {messageboard type="growl"}
{else}
    {messageboard type="growl"}
{/if}
