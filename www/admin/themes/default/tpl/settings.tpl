{*include file="header.tpl"*}
{* ************************* START HEADER *****************************}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<title>..: Panel de Control :..</title>
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel='stylesheet' type='text/css' href='{$params.CSS_DIR}admin.css' />
<link rel='stylesheet' type='text/css' href='{$params.CSS_DIR}style.css' />
<link rel='stylesheet' type='text/css' href='{$params.JS_DIR}style.css' />
<!--[if IE]>
    <link rel="stylesheet" href="{php}echo($this->css_dir);{/php}ieadmin.css" type="text/css" />
<![endif]-->

<script type="text/javascript" language="javascript" src="{php}echo($this->js_dir);{/php}prototype.js"></script>

<script type='text/javascript' src='{$params.JS_DIR}fabtabulous.js'></script>

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

</script>
{/literal}
</head>
<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<form action="#" method="post" name="formulario" id="formulario"> 
<table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" height="100%">
<tr>
  <td class="barra_superior"><div style="text-align:right; ">Settings&nbsp;<img src="{php}echo($this->image_dir);{/php}admin_contenido.gif" border="0" /></div></td>
</tr>
<tr>
	<td style="padding:10px;" align="left" valign="top">

{*************************** END HEADER ***************************** *}

	<div id="nifty" style="width:930px; margin-left: auto;margin-right: auto; text-align:right;font-size: 12px;">
	<b class="rtop"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b>
		<div id="nifty" style="float:left"><b><em>FICHERO: {$conf_file}</em></b></div>
		<button type="button" style="cursor:pointer;" onClick="javascript:enviar(this, '_self', 'save', 0);" title="Guardar Positions" alt="Guardar Cambios">
		<img class="icon" src="{php}echo($this->image_dir);{/php}save_button.png" title="Save Positions" alt="Guardar Cambios" >
		</button> &nbsp; &nbsp;
	<b class="rbottom"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b>
	</div>

	<div id="1" class="categ" style="margin-left: auto;margin-right: auto;width:930px; padding: 6px 2px;">
	
	<ul id="tabs">
	  <li><a href="#site">Site configuration</a></li>
	  <li><a href="#system">System configuration</a></li>
	  <li><a href="#server">Services configuration</a></li>
	  <li><a href="#permissions">Permissions</a></li>
	</ul>

	<div id="site" class="panel" style="width:900px;">
	  <fieldset style="width:340px;height:65px;display:inline;float:left;overflow:hidden;position:relative;"><legend>Status of the environment</legend>
	    <table width="300px" border=0>	
	      {foreach from=$config_vbles key=k item=v}
		{if $k|truncate:6:"" == 'STATUS'}
		  {if $v == '0' }
		    <tr><td width='21%'>STATUS</td><td with='79%'><input name="STATUS" id="offline0" value="0" checked="checked" type="radio"><label for="offline0">OFF</label>
		    <input name="STATUS" id="offline1" value="1" type="radio"><label for="offline1">ON</label></td></tr>
		  {else}
		    <tr><td width='21%'>STATUS</td><td with='80%'><input name="STATUS" id="offline0" value="0" type="radio"><label for="offline0">OFF</label>
		    <input name="STATUS" id="offline1" value="1" checked="checked" type="radio"><label for="offline1">ON</label></td></tr>
		  {/if}
		{/if}
	      {/foreach}	
	    </table></fieldset>
	  <fieldset style="width:490px;height:65px;display:inline;float:right;overflow:hidden;position:relative;"><legend>Templates</legend>
	    <table width="480px" border=0>	
	      {foreach from=$config_vbles key=k item=v}
		{if $k|truncate:8:"" == 'TEMPLATE'}
		    <tr>{if $k == 'TEMPLATE_USER'}<td width='21%'>FRONTEND</td><td with='80%'><input type="text" name='{$k}' value='{$v}'></td>{/if}</tr>
		    <tr>{if $k == 'TEMPLATE_ADMIN'}<td width='21%'>BACKEND</td><td with='80%'><input type="text" name='{$k}' value='{$v}'></td>{/if}</tr>
		{/if}
	      {/foreach}	
	    </table></fieldset>


	  <fieldset><legend>Site</legend>
	    <table width="750px" align=center border=0>	
	      {foreach from=$config_vbles key=k item=v}
		{if $k == 'SITE'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$SITE}' size=70/></td></tr>{/if}
		{if $k == 'SITE_PATH'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$SITE_PATH}' size=70/></td></tr>{/if}
		{if $k == 'SITE_ADMIN_PATH'}<tr><td>{$k}</td><td><input type=text style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$SITE_ADMIN_PATH}' size=70 readonly="true"/></td></tr>{/if}
		{if $k == 'SITE_ADMIN_DIR'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$SITE_ADMIN_DIR}' size=70/></td></tr>{/if}
		{if $k == 'SITE_URL_ADMIN'}<tr><td>{$k}</td><td><input type=text style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$SITE_URL_ADMIN}' size=70 readonly="true"/></td></tr>{/if}
		{if $k == 'SITE_URL_ADMIN_SSL'}<tr><td>{$k}</td><td><input type=text style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$SITE_URL_ADMIN_SSL}' size=70 readonly="true" /></td></tr>{/if}
		{if $k == 'SITE_URL_SSL'}<tr><td>{$k}</td><td><input type=text style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$SITE_URL_SSL}' size=70 readonly="true" /></td></tr>{/if}
		{if $k == 'SITE_URL'}<tr><td>{$k}</td><td><input type=text style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$SITE_URL}' size=70 readonly="true" /></td></tr>{/if}
		{if $k == 'SITE_LIBS_PATH'}<tr><td>{$k}</td><td><input type=text style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$SITE_LIBS_PATH}' size=70 readonly="true" /></td></tr>{/if}
		{if $k == 'URL'}<input type=hidden style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$URL}' size=70 readonly="true" />{/if}
		{if $k == 'URL_PUBLIC'}<input type=hidden style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$URL_PUBLIC}' size=70 readonly="true" />{/if}
		{if $k == 'RELATIVE_PATH'}<input type=hidden style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$RELATIVE_PATH}' size=70 readonly="true" />{/if}
		{if $k == 'PATH_APP'}<input type=hidden style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$PATH_APP}' size=70 readonly="true" />{/if}
		{if $k == 'ITEMS_PAGE'}<input type=hidden style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$v}' size=70 readonly="true" />{/if}
	      {/foreach}	
	    </table></fieldset>
	</div>
	<div id="system" class="panel" style="width:900px;">
	  <fieldset><legend>System</legend>
	    <table width="750px" align=center border=0>
	      {foreach from=$config_vbles key=k item=v}
		{if $k|truncate:7:"" == 'SYS_LOG'}
		  {if $k == 'SYS_LOG_DEBUG'}
		    {if $v == '0' }
		      <tr><td width='21%'>SYS_LOG_DEBUG</td><td with='79%'><input name="SYS_LOG_DEBUG" id="offline0" value="0" checked="checked" type="radio"><label for="offline0">OFF</label>
		      <input name="SYS_LOG_DEBUG" id="offline1" value="1" type="radio"><label for="offline1">ON</label></td></tr>
		    {else}
		      <tr><td width='21%'>SYS_LOG_DEBUG</td><td with='80%'><input name="SYS_LOG_DEBUG" id="offline0" value="0" type="radio"><label for="offline0">OFF</label>
		      <input name="SYS_LOG_DEBUG" id="offline1" value="1" checked="checked" type="radio"><label for="offline1">ON</label></td></tr>
		    {/if}
		  {/if}
		  {if $k == 'SYS_LOG_VERBOSE'}
		    {if $v == '0' }
		      <tr><td width='21%'>SYS_LOG_VERBOSE</td><td with='79%'><input name="SYS_LOG_VERBOSE" id="offline0" value="0" checked="checked" type="radio"><label for="offline0">OFF</label>
		      <input name="SYS_LOG_VERBOSE" id="offline1" value="1" type="radio"><label for="offline1">ON</label></td></tr>
		    {else}
		      <tr><td width='21%'>SYS_LOG_VERBOSE</td><td with='80%'><input name="SYS_LOG_VERBOSE" id="offline0" value="0" type="radio"><label for="offline0">OFF</label>
		      <input name="SYS_LOG_VERBOSE" id="offline1" value="1" checked="checked" type="radio"><label for="offline1">ON</label></td></tr>
		    {/if}
		  {/if}
		  {if $k == 'SYS_LOG_INFO'}
		    {if $v == '0' }
		      <tr><td width='21%'>SYS_LOG_INFO</td><td with='79%'><input name="SYS_LOG_INFO" id="offline0" value="0" checked="checked" type="radio"><label for="offline0">OFF</label>
		      <input name="SYS_LOG_INFO" id="offline1" value="1" type="radio"><label for="offline1">ON</label></td></tr>
		    {else}
		      <tr><td width='21%'>SYS_LOG_INFO</td><td with='80%'><input name="SYS_LOG_INFO" id="offline0" value="0" type="radio"><label for="offline0">OFF</label>
		      <input name="SYS_LOG_INFO" id="offline1" value="1" checked="checked" type="radio"><label for="offline1">ON</label></td></tr>
		    {/if}
		  {/if}
		  {if $k == 'SYS_LOG'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$SYS_LOG}' size=70/></td></tr>{/if}
		{else}
		  {if $k|truncate:3:"" == 'SYS'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr> {/if}
		{/if}
	      {/foreach}
	    </table>
	  </fieldset>
	  <fieldset><legend>Media</legend>
	    <table width="750px" align=center border=0>
	      {foreach from=$config_vbles key=k item=v}
		  {if $k == 'MEDIA_DIR'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$MEDIA_DIR}' size=70/></td></tr>{/if}
		  {if $k == 'MEDIA_PATH_URL'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$MEDIA_PATH_URL}' size=70 style="border: 1px solid #999; background-color:#ddd" readonly="true"/></td></tr>{/if}
		  {if $k == 'MEDIA_PATH'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$MEDIA_PATH}' size=70 style="border: 1px solid #999; background-color:#ddd;" readonly="true"/></td></tr>{/if}
		  {if $k == 'MEDIA_IMG_DIR'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$MEDIA_IMG_DIR}' size=70/></td></tr>{/if}
		  {if $k == 'MEDIA_IMG_PATH_URL'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$MEDIA_IMG_PATH_URL}' size=70 style="border: 1px solid #999; background-color:#ddd;" readonly="true"/></td></tr>{/if}
		  {if $k == 'MEDIA_IMG_PATH'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$MEDIA_IMG_PATH}' size=70 style="border: 1px solid #999; background-color:#ddd;" readonly="true"/></td></tr>{/if}
		  {if $k == 'MEDIA_EXTENSIONS'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		  {if $k == 'MEDIA_MAX_SIZE'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		  {if $k == 'MEDIA_UPLOAD'}
		    {if $v == '0' }
		      <tr><td width='21%'>MEDIA_UPLOAD</td><td with='79%'><input name="MEDIA_UPLOAD" id="offline0" value="0" checked="checked" type="radio"><label for="offline0">OFF</label>
		      <input name="MEDIA_UPLOAD" id="offline1" value="1" type="radio"><label for="offline1">ON</label></td></tr>
		    {else}
		      <tr><td width='21%'>MEDIA_UPLOAD</td><td with='80%'><input name="MEDIA_UPLOAD" id="offline0" value="0" type="radio"><label for="offline0">OFF</label>
		      <input name="MEDIA_UPLOAD" id="offline1" value="1" checked="checked" type="radio"><label for="offline1">ON</label></td></tr>
		    {/if}
		  {/if}
		  {if $k == 'MEDIA_UPLOAD_FLASH'}
		    {if $v == '0' }
		      <tr><td width='21%'>MEDIA_UPLOAD_FLASH</td><td with='79%'><input name="MEDIA_UPLOAD_FLASH" id="offline0" value="0" checked="checked" type="radio"><label for="offline0">OFF</label>
		      <input name="MEDIA_UPLOAD_FLASH" id="offline1" value="1" type="radio"><label for="offline1">ON</label></td></tr>
		    {else}
		      <tr><td width='21%'>MEDIA_UPLOAD_FLASH</td><td with='80%'><input name="MEDIA_UPLOAD_FLASH" id="offline0" value="0" type="radio"><label for="offline0">OFF</label>
		      <input name="MEDIA_UPLOAD_FLASH" id="offline1" value="1" checked="checked" type="radio"><label for="offline1">ON</label></td></tr>
		    {/if}
		  {/if}
		  {if $k == 'MEDIA_UPLOAD_VIDEO'}
		    {if $v == '0' }
		      <tr><td width='21%'>MEDIA_UPLOAD_VIDEO</td><td with='79%'><input name="MEDIA_UPLOAD_VIDEO" id="offline0" value="0" checked="checked" type="radio"><label for="offline0">OFF</label>
		      <input name="MEDIA_UPLOAD_VIDEO" id="offline1" value="1" type="radio"><label for="offline1">ON</label></td></tr>
		    {else}
		      <tr><td width='21%'>MEDIA_UPLOAD_VIDEO</td><td with='80%'><input name="MEDIA_UPLOAD_VIDEO" id="offline0" value="0" type="radio"><label for="offline0">OFF</label>
		      <input name="MEDIA_UPLOAD_VIDEO" id="offline1" value="1" checked="checked" type="radio"><label for="offline1">ON</label></td></tr>
		    {/if}
		  {/if}
		  {if $k == 'PATH_UPLOAD'}<input type=hidden style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$PATH_UPLOAD}' size=70 readonly="true" />{/if}
		  {if $k == 'URL_UPLOAD'}<input type=hidden style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$URL_UPLOAD}' size=70 readonly="true" />{/if}
	      {/foreach}
	    </table>
	  </fieldset>
	</div>
	<div id="server" class="panel" style="width:900px;">
		<fieldset><legend>Data Base</legend>
		<table width="750px" align=center border=0>
		  {foreach from=$config_vbles key=k item=v}
		    {if $k == 'BD_TYPE'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		    {if $k == 'BD_HOST'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		    {if $k == 'BD_USER'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		    {if $k == 'BD_PASS'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		    {if $k == 'BD_INST'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		    {if $k == 'BD_DSN'}<tr><td>{$k}</td><td><input type=text style="border: 1px solid #999; background-color:#ddd;" name='{$k}' value='{$BD_DSN}' size=70 readonly="true"/></td></tr>{/if}
		  {/foreach}
		</table></fieldset>
		<fieldset><legend>Mail server</legend>
		<table width="750px" align=center border=0>
		  {foreach from=$config_vbles key=k item=v}
		    {if $k == 'MAIL_HOST'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		    {if $k == 'MAIL_USER'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		    {if $k == 'MAIL_PASS'}<tr><td>{$k}</td><td><input type=text name='{$k}' value='{$v}' size=70/></td></tr>{/if}
		  {/foreach}
		</table></fieldset>
	</div>
	<div id="permissions" class="panel" style="width:900px;">
		<fieldset><legend>Permisos</legend>
		<table width="750px" align=center border=0>

		</table></fieldset>
		<fieldset><legend>Mail server</legend>
		<table width="750px" align=center border=0>

		</table></fieldset>
	</div>
	</div>
	<div id="nifty" style="width:830px; margin-left: auto;margin-right: auto; text-align:right;font-size: 12px;">
	<b class="rtop"><b class="r1"></b><b class="r2"></b><b class="r3"></b><b class="r4"></b></b>
		<div id="nifty" style="float:left"><b><em>FICHERO: {$conf_file}</em></b></div>
		<button type="button" style="cursor:pointer;" onClick="javascript:enviar(this, '_self', 'save', 0);" title="Guardar Positions" alt="Guardar Cambios">
		<img class="icon" src="{php}echo($this->image_dir);{/php}save_button.png" title="Save Positions" alt="Guardar Cambios" >
		</button> &nbsp; &nbsp;
	<b class="rbottom"><b class="r4"></b><b class="r3"></b><b class="r2"></b><b class="r1"></b></b>
	</div>

{* *************************** START FOOTER ***************************** 
   </td>
</tr>
</table>
<input type="hidden" id="action" name="action" value="" /><input type="hidden" name="id" value="{$id}" />
</form>

<script language="javascript" type="text/javascript" src="{php}echo($this->js_dir);{/php}wz_tooltip.js"></script>
</body>
</html>
 *************************** END FOOTER ***************************** *}
{include file="footer.tpl"}
