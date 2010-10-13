
{* Articles Toolbar *}
{if preg_match('/article\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>ueva noticia');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de noticias');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir un nuevo contenido pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}


{if preg_match('/user\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>uevo usuario');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de usuarios');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir un nuevo usuario pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}

{if preg_match('/author\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>uevo usuario');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de usuarios');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir un nuevo usuario pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}

{if preg_match('/privileges\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>uevo permiso');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de permisos ');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir un nuevo permiso pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}

{if preg_match('/user_groups\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>uevo grupo de usuarios');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de los grupos de usuarios ');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir un nuevo grupo de usuarios pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}

{if preg_match('/advertisement\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>ueva publicidad');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de publicidades');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir publicidad pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}

{if preg_match('/comment\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de comentarios');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir publicidad pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}
{if preg_match('/opinion\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>ueva opinion');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de opiniones');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir publicidad pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}

{if preg_match('/pendiente\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>ueva noticia pendiente');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de noticias pendientes');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir publicidad pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}

{if preg_match('/posible\.php/',$smarty.server.SCRIPT_NAME)}
<a href="#" onclick="javascript:salir();" class="logout">
		<img src="themes/default/images/desconectar.gif" alt="Salir" align="absmiddle" border="0">
	</a>
{/if}


{if preg_match('/category\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>ueva Secci&oacute;n');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de Secciones');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir una categoria pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}


{if preg_match('/album\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>uevo album');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de albums');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir un album pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}

{if preg_match('/video\.php/',$smarty.server.SCRIPT_NAME)}
        &nbsp;&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'new', 0);"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>uevo video');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif" border="0" align="absmiddle" /></a>&nbsp;
		<a href="#" onclick="enviar(this, '_self', 'list', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>L</u>istado de videos');" accesskey="L" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/estructura.gif" border="0" align="absmiddle" /></a>&nbsp;

		<img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
		<a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=370;this.T_BORDERCOLOR='#637F63';return escape('<p>Para añadir video pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/nuevo_contenido.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + N</p><p>Para obtener todo el listado pulsa en <img src=\'{php}echo($this->image_dir);{/php}iconos/estructura.gif\' border=\'0\' align=\'absmiddle\' /> o ALT + L</p>');"><img src="{php}echo($this->image_dir);{/php}iconos/ayuda.gif" border="0" align="absmiddle" /></a>
{/if}
{* barra de herramientas de boletin ****************************************** *}
{if preg_match('/bulletin\.php/',$smarty.server.SCRIPT_NAME)}
&nbsp;&nbsp;
        <form action="{$smarty.server.SCRIPT_NAME}" method="POST">
		<a href="#" onclick="confirmar_action(this, 'new', 0, '¿Desea crear un nuevo boletín?\nADVERTENCIA: Perderá los datos del boletín actual.');"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=170;this.T_BORDERCOLOR='#637F63';return escape('<u>N</u>uevo boletín [ALT + MAYÚS + N]');"
			accesskey="N" tabindex="1"><img src="{php}echo($this->image_dir);{/php}iconos/nuevo.gif" border="0" align="absmiddle" /></a>&nbsp;
            <input type="hidden" name="action" value="" />
        </form>
        
        {if $ACTION == 'step0'}
        &nbsp;
        <form action="{$smarty.server.SCRIPT_NAME}" method="POST">
        <a href="#" onclick="this.parentNode.submit();"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=300;this.T_BORDERCOLOR='#637F63';return escape('Recuperar <u>a</u>rchivo [ALT + MAYÚS + A]');"
			accesskey="A" tabindex="3"><img src="{$params.IMAGE_DIR}bulletin/search_archive.gif" border="0" align="absmiddle" /></a>&nbsp;
            <input type="hidden" name="action" value="archive_list" />
        </form>
        {/if}

		{* if $ACTION == 'step1' || $ACTION == 'news' || $ACTION == 'step2' || $ACTION == 'opinions' }
        &nbsp;
        <a href="#" onclick="javascript:newsLoader();"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=300;this.T_BORDERCOLOR='#637F63';return escape('<u>R</u>ecuperar noticias [ALT + MAYÚS + R]');"
			accesskey="R" tabindex="2"><img src="{$params.IMAGE_DIR}bulletin/search_news.gif" border="0" align="absmiddle" /></a>&nbsp;
		{/if *}

        {* if $ACTION == 'step0'}
        &nbsp;
        <a href="#" onclick="javascript:archiveLoader();"
			onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=300;this.T_BORDERCOLOR='#637F63';return escape('Recuperar <u>a</u>rchivo [ALT + MAYÚS + A]');"
			accesskey="A" tabindex="3"><img src="{$params.IMAGE_DIR}bulletin/search_archive.gif" border="0" align="absmiddle" /></a>&nbsp;
        {/if *}
        
        {*
        &nbsp;&nbsp;
        <img src="{$params.IMAGE_DIR}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
        <a href="javascript:void(0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=470;this.T_BORDERCOLOR='#637F63';return escape('<p>Para crear un nuevo boletín pulse <img src=\'{$params.IMAGE_DIR}iconos/nuevo.gif\' border=\'0\' align=\'absmiddle\' /> o [ALT + MAYÚS + N]</p><p>Para recuperar noticias ya publicadas e incorporarlas al boletín pulse <img src=\'{$params.IMAGE_DIR}bulletin/search_news.gif\' border=\'0\' align=\'absmiddle\' /> o [ALT + MAYÚS + R]</p><p>Para recuperar boletines archivados pulse <img src=\'{$params.IMAGE_DIR}bulletin/search_archive.gif\' border=\'0\' align=\'absmiddle\' /> o [ALT + MAYÚS + A]</p>');"><img src="{$params.IMAGE_DIR}ayuda.gif" border="0" align="absmiddle" /></a>
        *}

		{* if $ACTION == 'step1' || $ACTION == 'news' || $ACTION == 'step2' || $ACTION == 'opinions'}
        <div style="position:relative;z-index: 100;">
            <div id="newsLoaderContainer" style="display: none;">
                <div style="float:left;">
                    <label>Título de la noticia: <input type="text" class="campo" id="query" name="query" value="" onkeyup="requestQ();" /></label>
                </div>
                <div style="float:right;">
                    <a href="#" onclick="Element.hide('newsLoaderContainer');" title="Cerrar">
                        <img src="{$params.IMAGE_DIR}bulletin/close.gif" border="0" /></a>
                </div>
                <br class="clearer" />
                <ul id="newsLoaderList"></ul>
            </div>
        </div>
        {/if *}

        {* if $ACTION == 'step0' *}
        {* if $ACTION == 'step1' || $ACTION == 'news' *}
        {* <div style="position:relative;z-index: 100;">            
            <div id="archiveLoaderContainer" style="display: none;">
                <div style="float:left;">
                    <label>Fecha del archivo: <sup>(aaaa-mm-dd)</sup>
                    <input type="text" class="campo" id="queryA" name="queryA" value="" onkeyup="requestA();" maxlength="10" /></label>
                </div>
                <div style="float:right;">
                    <a href="#" onclick="Element.hide('archiveLoaderContainer');" title="Cerrar">
                        <img src="{$params.IMAGE_DIR}bulletin/close.gif" border="0" /></a>
                </div>
                <br class="clearer" />
                <ul id="archiveLoaderList"></ul>
            </div>
        </div>
        {/if *}
{/if}

{if preg_match('/mediamanager\.php/',$smarty.server.SCRIPT_NAME)}
    &nbsp;&nbsp;&nbsp;
    <form action="{$smarty.server.SCRIPT_NAME}">
    <a href="#" onclick="enviar(this, '_self', '', 0);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>S</u>ubir una carpeta ');" accesskey="S" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/subir.gif" border="0" align="absmiddle" /></a>&nbsp;
    <input type="hidden" name="path" value="{$path}../" />
    <input type="hidden" name="listmode" value="{$listmode}" />
    <input type="hidden" name="action" value="" />
    </form>
    &nbsp;&nbsp;
    <form action="{$smarty.server.SCRIPT_NAME}">
    <a href="#" onclick="new_folder(this);" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('Nueva <u>C</u>arpeta ');" accesskey="C" tabindex="2"><img src="{php}echo($this->image_dir);{/php}iconos/nueva_carpeta.gif" border="0" align="absmiddle" /></a>&nbsp;
    <input type="hidden" name="path" value="{$path}" />
    <input type="hidden" name="foldername" value="" /><input type="hidden" name="listmode" value="{$listmode}" />
    <input type="hidden" name="action" value="newDir" />
    </form>

    <img src="{php}echo($this->image_dir);{/php}iconos/separator.gif" border="0" align="absmiddle" />&nbsp;
    <a href="http://www.youtube.com/profile_videos?user=galimundo" target="_blank" onmouseover="this.T_BGCOLOR='#EAEAEA';this.T_FONTCOLOR='#425542';this.T_WIDTH=150;this.T_BORDERCOLOR='#637F63';return escape('<u>V</u>&iacute;deos en YouTube');" accesskey="V" tabindex="2"><img src="{php}echo($this->image_dir);{/php}mediamanager/youtube-mini.gif" border="0" align="absmiddle" /></a>&nbsp;

{/if}

