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
            <th align="left">{t}Email{/t}1</th>
            <th align="left">{t}Email{/t}2</th>
            <th align="left">{t}Telephone{/t}1</th>
            <th align="left">{t}Telephone{/t}2</th>
            <th align="left">{t}Date of birth{/t}</th>
            <th align="left">{t}Description{/t}</th>
            <th align="center">{t}Update{/t}</th>
            {acl isAllowed="USER_ADMIN"}
                <th align="center">{t}Delete{/t}</th>
            {/acl}
        </tr>
    </thead>

    <tbody>
        
    {section name=c loop=$workers}
        <tr {cycle values="class=row0,class=row1"}>
            <td style="text-align:center;font-size: 11px;;">
                <input type="checkbox" class="minput" id="selected_{$smarty.section.c.iteration}" name="selected_fld[]"
                value="{$workers[c]->pkWorker}" />
            </td>

            
            <td  id="info_{$workers[c]->pkWorker}" style="font-size: 11px;cursor:pointer;cursor: hand;">
                {$workers[c]->name|clearslash}
                
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$workers[c]->email1}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$workers[c]->email2}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$workers[c]->telf1}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$workers[c]->telf2}
            </td>


            <td style="text-align:left;font-size: 11px;">
                {$workers[c]->dob}
            </td>

            <td style="text-align:left;font-size: 11px;">
                {$workers[c]->description|default:'---'}
            </td>

            <td style="text-align:center;">
                <a href="#" onClick="javascript:enviar(this, '_self', 'read', '{$workers[c]->pkResource}');" title="Modificar ">
                <img src="{php}echo ($this->image_dir);{/php}edit.png" border="0" /></a> 
            </td>

            {acl isAllowed="USER_ADMIN"}
                <td style="text-align:center;">
                    <a href="#" onClick="javascript:confirmar(this, '{$workers[c]->pkResource}');" title="Eliminar">
                    <img src="{php}echo($this->image_dir);{/php}trash.png" border="0" /></a>
                </td>
            {/acl}
        </tr>
    {sectionelse}
        <tr>
                <td align="center" colspan="10">
                <h2>Ningun trabajador almacenado</h2>
            </td>
        </tr>
    {/section}
    </tbody>

    <tfoot>
        {if count($workers) gt 0}
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
