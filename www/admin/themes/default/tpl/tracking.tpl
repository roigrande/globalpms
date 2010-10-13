{include file="header.tpl"}

{* LISTADO ******************************************************************* *}
{if !isset($smarty.request.action) || $smarty.request.action eq "list"}
     

    {include file="botonera_up.tpl"}
	{if !empty($smarty.get.msg)}
        <div id="warnings"></div>
        <script type="text/javascript" language="javascript">
            {literal}
                   $('warnings').update( '{/literal}{$smarty.get.msg}{literal}' );
                   new Effect.Highlight( $('warnings') );
                   new Effect.Opacity( $('warnings'),{ from: 1, to: 0, duration: 4.0} );
            {/literal}
        </script>
    {/if}
    <div>
        <table class="adminheading">
            <tr>
                <th nowrap> {t}Trackings{/t}</th>
            </tr>
        </table>

        <table class="adminlist">
            <tr>
                <th class="title" style="width:50px;"></th>
                <th align="left" style="width:400px;">{t}Title{/t}</th>
                <th align="left">{t}Description{/t}</th>
                <th align="center" style="width:50px;">Modificar</th>
                <th align="center" style="width:50px;">Eliminar</th>
            </tr>           
            {section name=c loop=$trackings}
                <tr {cycle values="class=row0,class=row1"}  style="cursor:pointer;">
                    <td style="padding:1px; font-size:11px;">
                        <input type="checkbox" class="minput"  id="selected_{$smarty.section.c.iteration}" name="selected_fld[]" value="{$trackings[c]->id}"  style="cursor:pointer;">
                    </td>	
                    <td style="padding:10px;font-size:11px;"  onClick="javascript:document.getElementById('selected_{$smarty.section.c.iteration}').click();">
                       {$trackings[c]->name|clearslash}
                    </td>
                    <td style="padding:10px;font-size: 11px;">
                        {$trackings[c]->description|clearslash}
                    </td>
                     
                    <td style="padding:1px; font-size:11px;" align="center">
                        <a href="#" onClick="javascript:enviar(this, '_self', 'read', '{$trackings[c]->id}');" title="Modificar">
                                <img src="{php}echo($this->image_dir);{/php}edit.png" border="0" /></a>
                    </td>
                    <td style="padding:1px; font-size:11px;" align="center">
                        <a href="#" onClick="javascript:confirmar(this, '{$trackings[c]->id}');" title="Eliminar">
                                <img src="{php}echo($this->image_dir);{/php}trash.png" border="0" /></a>
                    </td>
                </tr>

            {sectionelse}
                <tr>
                    <td align="center" colspan="8"><br><br><p><h2><b>Ningun tracking guardado</b></h2></p><br><br></td>
                </tr>
            {/section}
            {if count($trackings) gt 0}
                <tr>
                    <td colspan="8" align="center">{$paginacion->links}</td>
                </tr>
            {/if}
        </table>
        
    </div>

{/if}

 
{* FORMULARIO PARA ENGADIR || ACTUALIZAR *********************************** *}
 
{if isset($smarty.request.action) && ($smarty.request.action eq "new" || $smarty.request.action eq "read")}

    {include file="botonera_up.tpl"}

    <table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="700">
        <tbody>
            <tr>
                <td valign="top" align="right" style="padding:4px;" width="30%">
                        <label for="title">T&iacute;tulo:</label>
                </td>
                <td style="padding:4px;" nowrap="nowrap" width="70%">
                        <input type="text" id="name" name="name" title="Incidencia"   
                                value="{$tracking->name|clearslash}" class="required" size="100" />
                </td>
            </tr>
            {*<tr>
                <td valign="top" align="right" style="padding:4px;">
                        <label for="metadata">Palabras clave: </label>
                </td>
                <td style="padding:4px;" nowrap="nowrap">
                        <input type="text" id="metadata" name="metadata" size="70" title="Metadatos" value="{$tracking->metadata}" />
                        <sub>Separadas por comas</sub>
                </td>                             
            </tr>
            *}
            <tr>
                <td valign="top" align="right" style="padding:4px;" >
                        <label for="title">Descripción:</label>
                </td>
                <td style="padding:4px;" nowrap="nowrap"  >
                        <textarea name="description" id="description" title="Resumen de la noticia" style="width:98%; height:6em;">{ $tracking->description|clearslash}</textarea>
                </td>
            </tr>

        </tbody>
    </table>


{/if}

{include file="footer.tpl"}
