{include file="header.tpl"}

<!--{* LISTING companies *********************************************************************** *}-->
    {include file="botonera_up.tpl"}

    {if !empty($smarty.get.msg)}
       
        <div id="warnings">{$smarty.get.msg} </div>

    {/if}
    <table class="adminlist">
    <thead>
        <tr>
            <th></th>
            <th align="left" class="title">{t}Name{/t}</th>
            <th align="left">{t}Fiscal Name{/t}</th>
            <th align="left">{t}Telephone{/t}</th>
            <th align="left">{t}Email{/t}</th>
            <th align="left">{t}Fax{/t}</th>
            <th align="left">{t}State{/t}</th>
            <th align="left">{t}City{/t}</th>
            <th align="center">{t}Update{/t}</th>
            {acl isAllowed="USER_ADMIN"}
                <th align="center">{t}Delete{/t}</th>
            {/acl}
        </tr>
    </thead>

    <tbody>
        
    {section name=c loop=$companies}
        <tr {cycle values="class=row0,class=row1"}>
            <td style="text-align:center;font-size: 11px;;">
                <input type="checkbox" class="minput" id="selected_{$smarty.section.c.iteration}" name="selected_fld[]"
                value="{$companies[c]->pkcompany}" />
            </td>

            
            <td  id="info_{$companies[c]->pkcompany}" style="font-size: 11px;cursor:pointer;cursor: hand;">
                {$companies[c]->name|clearslash}
                
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$companies[c]->fiscalName}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$companies[c]->telf1}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$companies[c]->email1}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$companies[c]->fax}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$companies[c]->state}
            </td>

            <td style="text-align:left;font-size: 11px;">
              {$companies[c]->city}
            </td>

            <td style="text-align:center;">
                <a href="#" onClick="javascript:enviar(this, '_self', 'read', '{$companies[c]->pkCompany}');" title="Modificar ">
                <img src="{php}echo ($this->image_dir);{/php}edit.png" border="0" /></a> 
            </td>

            {acl isAllowed="USER_ADMIN"}
                <td style="text-align:center;">
                    <a href="#" onClick="javascript:confirmar(this, '{$companies[c]->pkCompany}');" title="Eliminar">
                    <img src="{php}echo($this->image_dir);{/php}trash.png" border="0" /></a>
                </td>
            {/acl}
        </tr>
    {sectionelse}
        <tr>
                <td align="center" colspan="10">
                <h2>Ninguna compañia almacenada</h2>
            </td>
        </tr>
    {/section}
    </tbody>

    <tfoot>
        {if count($companies) gt 0}
            <tr>
                <td colspan="10" style="padding:10px;font-size: 12px;" align="center">
                    <br />
                    <div id="pagination">
                    {$paginacion->links}
                    </div> <br />
                </td>
            </tr>
        {/if}
    </tfoot>
    </table>


{include file="footer.tpl"}
