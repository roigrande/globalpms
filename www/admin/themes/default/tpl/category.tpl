{include file="header.tpl"}

{* LISTADO ******************************************************************* *}
{if $smarty.request.action eq "list"}
  
    {include file="botonera_up.tpl"}
    <table class="adminheading">
        <tr>
            <th nowrap="nowrap" align="right">
                <label>Buscar:
                <input type="text" value=""></label>
                <label>Sección:
                <select name="filter[type_customer]" onchange="submitFilters(this.form);">
                    {html_options options=$filter_options.type_customer
                                  selected=$smarty.request.filter.type_customer}
                </select></label>

                <input type="hidden" id="page" name="page" value="{$smarty.request.page|default:"1"}" />
            </th>
        </tr>
    </table>
    <table class="adminlist" id="tabla"  width="100%">
        <tr>
            <th width="5%" class="title"> </th>
            <th width="25%" align="left">{t}Title{/t}</th>
            <th width="40%" align="left">{t}Description{/t}</th>
            <th align="center" width="15%">{t}Update{/t}</th>
            <th align="center" width="15%">{t}Delete{/t}</th>
        </tr>
        {section name=c loop=$categorys}
            <tr {cycle values="class=row0,class=row1"}>
                <td style="padding:4px;font-size: 11px;">
                    <input type="checkbox" class="minput" id="selected_{$smarty.section.c.iteration}"
                        name="selected_fld[]" value="{$categorys[c]->pk_content_category}" />
                </td>
                <td style="padding:4px;font-size: 11px;">
                    <b> {$categorys[c]->title|clearslash|escape:"html"}</b>
                </td>
                <td style="padding:4px;font-size: 11px;">
                      {$categorys[c]->name|clearslash}
                </td>
                <td style="padding:4px;text-align:center;">
                    <a href="#" onClick="javascript:enviar(this, '_self', 'read', {$categorys[c]->pk_content_category});" title="Modificar">
                        <img src="{php}echo($this->image_dir);{/php}edit.png" border="0" />
                    </a>

                </td>
                <td style="padding:4px;" align="center">
                    <a href="#" onClick="javascript:confirmar(this, {$categorys[c]->pk_content_category});" title="Eliminar">
                       <img src="{php}echo($this->image_dir);{/php}trash.png" border="0" />
                    </a>
                </td>
            </tr>
        {sectionelse}
            <tr>
                <td colspan="5" style="padding:10px;font-size: 12px;" align="center">
                    <h2><b>Ning&uacute;na secci&oacute;n guardada</b></h2>
                </td></tr>
        {/section}
        {if count($categorys) gt 0}
            <tr>
                <td colspan="5" style="padding:10px;font-size: 12px;" align="center"><br>{$paginacion->links}<br></td>
            </tr>
        {/if}
    </table>
     
{/if}

{* CREATE OR UPDATE FORM ************************************** *}

{if isset($smarty.request.action) && ($smarty.request.action eq "new" || $smarty.request.action eq "read")}

    {include file="botonera_up.tpl"}
  
    <table style="margin-left:30px;margin-top:30px;" border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo">
        <tbody>
            <tr>
                <td valign="top" style="padding:4px;text-align:left; width:100px;">
                    <label for="title">{t}Title{/t}</label>
                </td>
                <td style="padding:4px;" nowrap="nowrap"  colspan="2">
                    <input type="text" id="title" name="title" title="Título" value="{$category->title|clearslash}"
                        class="required" size="100" />
                </td>
            </tr>
             <tr>
                <td valign="top" style="padding:4px;text-align:left; width:100px;">
                    <label for="title">{t}Description{/t}</label>
                </td>
                <td style="padding:4px;" nowrap="nowrap"  colspan="2">
                    <input type="text" id="name" name="name" title="description" 
                      value="{$category->name|clearslash}" size="100" />
                </td>
            </tr>
              
        </tbody>
    </table>

{/if}

{include file="footer.tpl"}
