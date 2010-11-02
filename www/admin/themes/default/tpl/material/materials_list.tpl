{include file="header.tpl"}

<!--{* LISTING WORKERS *********************************************************************** *}-->
    {include file="botonera_up.tpl"}

    {if !empty($smarty.get.msg)}
       
        <div id="warnings">{$smarty.get.msg} </div>

    {/if}
    <table class="adminlist">
    <thead>
        <tr>
            <th></th>
            <th align="left" class="title">{t}Name{/t}</th>
            <th align="left">{t}Number{/t}</th>
            <th align="left">{t}Number Available{/t}</th>
            <th align="left">{t}Store{/t}</th>
            <th align="left">{t}Description{/t}</th>
            <th align="center">{t}Update{/t}</th>
            {acl isAllowed="USER_ADMIN"}
                <th align="center">{t}Delete{/t}</th>
            {/acl}
        </tr>
    </thead>

    <tbody>
        
    {section name=c loop=$materials}
        <tr {cycle values="class=row0,class=row1"}>
            <td style="text-align:center;font-size: 11px;;">
                <input type="checkbox" class="minput" id="selected_{$smarty.section.c.iteration}" name="selected_fld[]"
                value="{$materials[c]->pkMaterial}" />
            </td>

            
            <td  id="info_{$materials[c]->pkMaterial}" style="font-size: 11px;cursor:pointer;cursor: hand;">
                {$materials[c]->name|clearslash}
                
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$materials[c]->num}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$materials[c]->numAvailable}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$materials[c]->store}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$materials[c]->description|default:'---'}
            </td>

            <td style="text-align:center;">
                <a href="#" onClick="javascript:enviar(this, '_self', 'read', '{$materials[c]->pkResource}');" title="Modificar ">
                <img src="{php}echo ($this->image_dir);{/php}edit.png" border="0" /></a> 
            </td>

            {acl isAllowed="USER_ADMIN"}
                <td style="text-align:center;">
                    <a href="#" onClick="javascript:confirmar(this, '{$materials[c]->pkResource}');" title="Eliminar">
                    <img src="{php}echo($this->image_dir);{/php}trash.png" border="0" /></a>
                </td>
            {/acl}
        </tr>
    {sectionelse}
        <tr>
                <td align="center" colspan="10">
                <h2>{t}Ningun Material almacenado{/t}</h2>
            </td>
        </tr>
    {/section}
    </tbody>

    <tfoot>
        {if count($materials) gt 0}
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
