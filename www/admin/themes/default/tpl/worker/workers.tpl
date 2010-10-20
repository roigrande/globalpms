{include file="header.tpl"}

<!--{* LISTADO *********************************************************************** *}-->
{if !isset($smarty.request.action) || $smarty.request.action eq "list"}

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
{/if}

{* ******************************************************************************* *}
{* CREATE AND UPDATE CUSTOMERS ******************************** *}
{if isset($smarty.request.action) && ($smarty.request.action eq "new" || $smarty.request.action eq "read")}

    {include file="botonera_up.tpl"}

    <table border="0" cellpadding="2" cellspacing="2" class="fuente_cuerpo" width="100%">
    <tbody>

        <tr>
            <td valign="top" style="text-align:right;width:90px;">
                <label for="title">{t}Name{/t}:</label>
            </td>

            <td valign="top" nowrap="nowrap" style="width:314px;">
                <input type="text" id="name" name="name" title="name"
                            size="40" value="{$worker->name|clearslash|escape:"html"}" class="required" onBlur=""/>
            </td>

            <td valign="top" style="text-align:right;width:110px;">
                <label for="title">{t}Telephono{/t} 1:</label>
            </td>

            <td valign="top" nowrap="nowrap" style="width:320px;">
                <input type="text" id="telf1" name="telf1" title="telf1" size="10" maxlength="9"
                onchange="get_unique();" value="{$worker->telf1|clearslash|escape:"html"}" class="required"/>
                <div id="check_tfno"></div>
            </td>      
        </tr>

        <tr>
            <td valign="top"   style="text-align:right;width:90px;">
                <label for="metadata">{t}Metadata{/t}:</label><br />
                <sub>Separadas por comas</sub>
            </td>
            
            <td valign="top" nowrap="nowrap">
                <input type="text" id="metadata" name="metadata" title="metadata" size="40" value="{$worker->metadata|strip}" />
            </td>

            <td valign="top" style="text-align:right;">
                <label for="title">{t}Telephone{/t} 2:</label>
            </td>

            <td valign="top">
                <input type="text" id="telf2" name="telf2" title="telf2" size="10"  maxlength="9" value="{$worker->telf2|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title">{t}NSS:{/t}</label>
            </td>

            <td valign="top" >
                <input type="text" id="nss" name="nss" title="nss"
                            size="40" value="{$worker->nss|clearslash|escape:"html"}" />
            </td>

            <td valign="top"  style="text-align:right;">
                <label for="title">{t}address{/t}:</label>

            </td>

            <td valign="top">
                <input type="text" id="address" name="address" title="address" size="40"  maxlength="9" value="{$worker->address|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title">{t}NIF{/t}:</label>
            </td>

            <td valign="top" >
                <input type="text" id="nif" name="nif" title="nif" size="10" maxlength="9" value="{$worker->nif|clearslash|escape:"html"}" />
            </td>

            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Email {/t}1:</label>
            </td>

            <td valign="top">
                <input type="text" id="email1" name="email1" title="email1" size="40" value="{$worker->email1|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Day of birth{/t}</label>
            </td>

            <td valign="top"  >
                <input type="text" id="dob" name="dob" title="dob"
                 size="10"  maxlength="10" value="{$worker->dob|clearslash|escape:"html"}" />
            </td>

            <td valign="top"  style="text-align:right;">
                <label for="title">{t}Email{/t} 2:</label>
            </td>

            <td valign="top"  >
                <input type="text" id="email2" name="email2" title="email2" size="40" value="{$worker->email2|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}City{/t}:</label>
            </td>

            <td valign="top" >
                <input type="text" id="city" name="city" title="city" size="40" value="{$worker->city|clearslash|escape:"html"}" />
            </td>

            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Description{/t}:</label>
            </td>

            <td valign="top" rowspan="4">
                <textarea name="description" id="description" title="description" cols="38" rows="8">{$worker->description|clearslash|escape:"html"}</textarea>
            </td>
        </tr>

        <tr>
             <td valign="top" rowspan="4">
                               <SELECT NAME="status">
                                   <option value="available" {if $worker->status eq 'available'} selected ="selected" {/if}>available</option>
                                   <option value="unvailable"{if $worker->status eq 'unvailable'} selected ="selected" {/if}>unvailable</option>

                                </SELECT>
           
             </td>
        </tr>
    </tbody>
    </table>

  
{/if}
{include file="footer.tpl"}
