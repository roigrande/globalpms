<html>
<head>
<title>..: Panel de Control :..</title>
<meta http-equiv="pragma" content="no-cache" />

<link rel="stylesheet" href="{php}echo($this->css_dir);{/php}admin.css" type="text/css" />
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
	parentEl.accion.value = acc;
	parentEl.idcontenido.value = id;
	
	/* Solucionar el bug de HTMLArea 3 */
	if(editores != null) {
		for(var i=0; i<editores.length; i++) {
			if(typeof(editores[i]) != "undefined")  {
				editores[i].id._textArea.value = editores[i].id.getHTML();
			}
		}
	}	
		
	if(objForm != null) {
		objForm.submit();
	} else {
		parentEl.submit();
	}
}

function confirmar(elto, id) {
	if(confirm('¿Está seguro de querer eliminar este elemento?')) {
		enviar(elto, '_self', 'del', id);
	}
}

function seleccionar_fichero(nombre_campo, tipo) {
	if(dialogo)
	{
		if(!dialogo.closed) dialogo.close();
	}
	
	dialogo = window.open('include/dialogo.archivo.php?campo_retorno='+nombre_campo+'&tipo_archivo='+tipo, 'dialogo', 'toolbar=no, location=no, directories=no, status=no, menub ar=no, scrollbar=no, resizable=no, copyhistory=yes, width=410, height=360, left=100, top=100, screenX=100, screenY=100');
	dialogo.focus();
}
// -->
</script>
{/literal}


</head>
<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">
<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" height="100%">
<tr><td valign="top" align="left"><!-- INICIO: Tabla contenedora -->
<form action="#" method="post" name="formulario">
<table border="0" cellpadding="0" cellspacing="0" align="left" width="100%" height="100%">
<tr>
	<td class="barra_superior">&nbsp;<img src="{php}echo($this->image_dir);{/php}admin_contenido.gif" border="0" align="absmiddle" />&nbsp;{$titulo_barra}</td>
</tr>
<tr>
	<td background="{php}echo($this->image_dir);{/php}barra_vrd.gif" height="25" style="border:1px solid #CACACA;" valign="middle">	
		&nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'frm_set', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>uevo contenido');" accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="?{$smarty.now}" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de contenidos');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;
		{if isset($smarty.post.accion) && $smarty.post.accion eq "frm_upd"}
		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'lst_version', {if isset($idcontenido)}{$idcontenido}{else}0{/if});" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('Listado de <u>V</u>ersiones');" accesskey="V" tabindex="4"><img src="{php}echo($this->image_dir);{/php}iconos/versiones.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'get_relaciones', {if isset($idcontenido)}{$idcontenido}{else}0{/if});" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('Contenidos <u>R</u>elacionados');" accesskey="R" tabindex="5"><img src="{php}echo($this->image_dir);{/php}iconos/relaciones.gif" border="0" align="absmiddle" /></a>&nbsp;		
		{/if}		
		{if $smarty.post.accion eq "set_relaciones" || $smarty.post.accion eq "get_relaciones" || $smarty.post.accion eq "lst_version" || $smarty.post.accion eq "get_version"}
		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;		
		<a href="#" onclick="enviar(this, '_self', 'frm_upd', {if isset($idcontenido)}{$idcontenido}{else}0{/if});" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>E</u>ditar contenido');" accesskey="E" tabindex="3"><img src="{php}echo($this->image_dir);{/php}iconos/editar_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;		
		{/if}		
		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir un nuevo contenido pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a></td>
</tr>
<tr>
	<td style="padding:10px;" align="left" valign="top">
	
	{if !isset($smarty.post.accion) || $smarty.post.accion eq "lst"}
	<!-- LISTADO -->	
	<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo">
	{section name=c loop=$cont}
	<tr>
		<td style="padding:10px;">
			{$cont[c].desc_contenido}
		</td>
		<td style="padding:10px;">
			<a href="#" onClick="javascript:enviar(this, '_self', 'frm_upd', {$cont[c].idcontenido});" title="Modificar"><img src="{php}echo($this->image_dir);{/php}btn_modificar.gif" border="0" /></a>
		</td>
		<td style="padding:10px;">
			<a href="#" onClick="javascript:confirmar(this, {$cont[c].idcontenido});" title="Eliminar"><img src="{php}echo($this->image_dir);{/php}btn_eliminar.gif" border="0" /></a>
		</td>
	</tr>
	{sectionelse}
	<tr>
		<td align="center"><b>Ningún(a) noticia guardad@ actualmente.</b></td>
	</tr>
	{/section}
    {if count($cont) gt 0}
    <tr>
        <td colspan="3" align="center">{$indice_pagina}</td>
    </tr>
    {/if}
	</table>
	{/if}
	
	{if isset($smarty.post.accion) && $smarty.post.accion eq "frm_set"}
	<!-- FORMULARIO PARA ENGADIR UN CONTENIDO -->	
	<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="600">
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>Título:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap" width="70%">
				<input type="text" class="campo" name="titulo" title="Título de la noticia" value="" />
				</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>Resumen:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap" width="70%">
				<textarea name="resumen" id="resumen" class="campo" title="Resumen de la noticia" style="width:100%; height:20em;"></textarea>
				</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>Cuerpo:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap" width="70%">
				<textarea name="cuerpo" id="cuerpo" class="campo" title="Cuerpo de la noticia" style="width:100%; height:20em;"></textarea>
				</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>URL:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap" width="70%">
				<input type="text" class="campo" name="url" title="URL para más información" value="" />
				</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>Imagen:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap" width="70%">
				<input type="text" name="imagen" value="" title="Imagen" />&nbsp;
		<a href="#" onClick="javascript:seleccionar_fichero('imagen','jpg,jpeg,png,gif');">
			<img src="{php}echo($this->image_dir);{/php}icon_examinar.gif" align="absbottom" border="0" />
		</a>
				</td>
	</tr>
	    <tr>
        <td colspan="2">{include file="contenido.admin.tpl"}</td>
    </tr>    
	<tr>
		<td colspan="2" align="right"><a href="#" onClick="javascript:enviar(this, '_self', 'set', 0);"><img src="{php}echo($this->image_dir);{/php}btn_guardar.gif" border="0" /></a>&nbsp;&nbsp;</td>
	</tr>
	</table>
	{/if}
	
	{if isset($smarty.post.accion) && $smarty.post.accion eq "frm_upd"}
	<!-- FORMULARIO PARA ACTUALIZAR UN CONTENIDO -->	
	<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="600">
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>Título:</label>
		</td>
		<td style="padding:4px;" width="70%">
				<input type="text" class="campo" name="titulo" title="Título de la noticia" value="{$titulo|strip}" />
		        
		</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>Resumen:</label>
		</td>
		<td style="padding:4px;" width="70%">
				<textarea name="resumen" id="resumen" title="Resumen de la noticia" class="campo" style="width:100%; height:20em;">{$resumen|strip}</textarea>
		        
		</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>Cuerpo:</label>
		</td>
		<td style="padding:4px;" width="70%">
				<textarea name="cuerpo" id="cuerpo" title="Cuerpo de la noticia" class="campo" style="width:100%; height:20em;">{$cuerpo|strip}</textarea>
		        
		</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>URL:</label>
		</td>
		<td style="padding:4px;" width="70%">
				<input type="text" class="campo" name="url" title="URL para más información" value="{$url|strip}" />
		        
		</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;" width="30%">
			<label>Imagen:</label>
		</td>
		<td style="padding:4px;" width="70%">
				<input type="text" name="imagen" value="{$imagen|strip}" title="Imagen" />&nbsp;
		<a href="#" onClick="javascript:seleccionar_fichero('imagen','jpg,jpeg,png,gif');">
			<img src="{php}echo($this->image_dir);{/php}icon_examinar.gif" align="absbottom" border="0" />
		</a>
		        
		</td>
	</tr>
	    <tr>
        <td colspan="2">{include file="contenido.admin.tpl"}</td>
    </tr>    
	<tr>
		<td style="padding:4px;"><a href="#" onClick="javascript:enviar(this, '_self', 'save_version', '{$idcontenido}');"><img src="{php}echo($this->image_dir);{/php}btn_guardar_version.gif" border="0" /></a></td>
		<td align="right" style="padding:4px;"><a href="#" onClick="javascript:enviar(this, '_self', 'upd', '{$idcontenido}');"><img src="{php}echo($this->image_dir);{/php}btn_aplicar.gif" border="0" /></a></td>
	</tr>
	</table>
	{/if}

	{if isset($smarty.post.accion) && $smarty.post.accion eq "lst_version"}
	<!-- LISTADO DE VERSIONES -->
	<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo">
	<tr>
		<td valign="top" align="right" style="padding:4px;">
		{if count($versiones)>0}
			<select name="version">
			{section name=v loop=$versiones}
				<option value="{$versiones[v].idversion}" {if $smarty.section.v.first}selected="selected"{/if}>
					{$versiones[v].idusuario}&nbsp;&nbsp;&nbsp;#{$versiones[v].fecha}# 
				</option>
			{/section}
			</select>
            <a href="#" onclick="javascript:enviar(this, '_self', 'get_version', {if isset($idcontenido)}{$idcontenido}{else}0{/if});"><img src="{php}echo($this->image_dir);{/php}btn_ver.gif" border="0" align="absmiddle" /></a>&nbsp;
			<a href="#" onclick="javascript:enviar(this, '_self', 'set_version', {if isset($idcontenido)}{$idcontenido}{else}0{/if});"><img src="{php}echo($this->image_dir);{/php}btn_restaurar.gif" border="0" align="absmiddle" /></a>&nbsp;
			<a href="#" onclick="javascript:enviar(this, '_self', 'del_version', {if isset($idcontenido)}{$idcontenido}{else}0{/if});"><img src="{php}echo($this->image_dir);{/php}btn_eliminar.gif" border="0" align="absmiddle" /></a>
		{else}
			<span style="color:#003333;font-weight:bold;">Ninguna versión disponible.</span>
		{/if}
		</td>
	</tr>
	</table>
	{/if}

	{if isset($smarty.post.accion) && $smarty.post.accion eq "get_version"}
	<!-- VISTA DE UNA VERSION DEL CONTENIDO -->	
	<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo">
		<tr>
		<td valign="top" align="right" style="padding:4px;">
			<label>Título:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap">
            {$cont.titulo|strip}
		</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;">
			<label>Resumen:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap">
            {$cont.resumen|strip}
		</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;">
			<label>Cuerpo:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap">
            {$cont.cuerpo|strip}
		</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;">
			<label>URL:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap">
            {$cont.url|strip}
		</td>
	</tr>
		<tr>
		<td valign="top" align="right" style="padding:4px;">
			<label>Imagen:</label>
		</td>
		<td style="padding:4px;" nowrap="nowrap">
            {$cont.imagen|strip}
		</td>
	</tr>
	    <tr>
        <td colspan="2">{include file="contenido.admin.tpl"}</td>
    </tr>    
	<tr>
		<td colspan="2" align="right"><a href="#" onClick="javascript:enviar(this, '_self', 'set_version', {if isset($idcontenido)}{$idcontenido}{else}0{/if});"><img src="{php}echo($this->image_dir);{/php}btn_restaurar.gif" border="0" /></a>&nbsp;&nbsp;</td>
	</tr>
	</table>
    <input type="hidden" name="version" value="{$version}" />
	{/if}

	{if $smarty.post.accion eq "get_relaciones" || $smarty.post.accion eq "set_relaciones"}
	<!-- LISTADO DE LOS CONTENIDOS RELACIONADOS -->	
	<script language="javascript" type="text/javascript" src="js/relacionados.js"></script>
	<table border="0" cellpadding="2" cellspacing="0" class="fuente_cuerpo">
	<tr>
		<td colspan="2">
			<label>Categorías: <span id="nombre_categoria"></span></label>
		</td>
		<td align="center">
			<label>Contenidos Relacionados</label>
		</td>
	</tr>
	<tr>
		<td align="center">
			<select name="categorias" id="categorias" onChange="javascript:load_contenidos(this);" class="lista">
			<option value="">&nbsp;</option>
			{html_options options=$categorias}
			</select>
			<br />
			<select name="contenidos" id="contenidos" size="10" class="lista">
			</select>		
		</td>
		<td align="center" nowrap="nowrap" valign="top">
			<br /><br />
			<label>Texto del enlace relacionado</label>
			<br />
			<input type="text" name="txt_enlace" id="txt_enlace" value="" />
			<a href="#" onclick="javascript:relacionar_contenidos();" title="&nbsp;&gt;&nbsp;"><img src="{php}echo($this->image_dir);{/php}btn_siguiente.gif" border="0" align="absmiddle" /></a>
		</td>
		<td align="center" valign="top" nowrap="nowrap">
		  <select name="relacionados" id="relacionados" size="11" class="lista">
		  {html_options options=$relacionados}
		  </select>
		  <a href="#" onclick="javascript:eliminar_relacion();" title="Eliminar Contenido Relacionado"><img src="{php}echo($this->image_dir);{/php}btn_eliminar_aspa.gif" border="0" align="top" /></a>	
		</td>
	</tr>
	<tr>
		<td colspan="3" align="right" style="padding-top:20px;"><a href="#" onClick="javascript:enviar(this, '_self', 'set_relaciones', {if isset($idcontenido)}{$idcontenido}{else}0{/if});"><img src="{php}echo($this->image_dir);{/php}btn_aplicar.gif" border="0" /></a></td>
	</tr>
	</table>
	<input type="hidden" name="contenidos_relacionados" id="contenidos_relacionados" value="{$contenidos_relacionados}" size="50" />
	{/if}

	<br />    
	</td>
</tr>
</table>
<input type="hidden" name="accion" value="" /><input type="hidden" name="idcontenido" value="{$idcontenido}" />
</form>
</td></tr>
</table>

<script language="javascript" type="text/javascript" src="{php}echo($this->js_dir);{/php}wz_tooltip.js"></script>
</body>
</html>