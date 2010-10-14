{include file="header.tpl"}

<!--{* LISTADO *********************************************************************** *}-->
{if !isset($smarty.request.action) || $smarty.request.action eq "list"}



    {include file="botonera_up.tpl"}

    {if !empty($smarty.get.msg)}
       
        <div id="warnings">{$smarty.get.msg}
                      </div>

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
                    value="{$workers[c]->pk_worker}" />
                </td>               
                <td  id="info_{$workers[c]->pk_worker}" style="font-size: 11px;cursor:pointer;cursor: hand;">

                                {$workers[c]->name|clearslash}
                        {literal}
                            <script type="text/javascript" language="javascript">
                            new Tip({/literal}'info_{$workers[c]->pk_worker}', 'Apellidos: {$workers[c]->surname} <br>Ciudad: {$workers[c]->city} <br>Fecha de nacimiento:  {$workers[c]->obd}', {literal}
                            {title: 'Más información'                                                      
                            });
                            </script>
                        {/literal}
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
                {*
                {acl isAllowed="USER_ADMIN"}
                     <td style="text-align:left;font-size: 11px;">
                             {$workers[c]->agent}
                     </td>
                {/acl}

                <td style="text-align:left;font-size: 11px;">
                    {assign var='work' value=$workers[c]->id}
                    {$last_trackings[$work].track|default:'---'}
                </td>
                
                 <td style="text-align:left;font-size: 11px;" id="track_{$workers[c]->pk_worker}">
                    {$last_trackings[$work].info|clearslash|truncate:36|default:'---'}
                    {if !empty($last_trackings[$work].info)}
                     {literal}
                            <script type="text/javascript" language="javascript">
                            new Tip({/literal}'track_{$workers[c]->pk_worker}', ' {$last_trackings[$work].info|clearslash}', {literal}
                            {title: 'Nota'
                            });
                            </script>
                      {/literal}
                    {/if}
                </td>
*}
                <td style="text-align:center;">
                        <a href="#" onClick="javascript:enviar(this, '_self', 'read', '{$workers[c]->id}');" title="Modificar">
                                <img src="{php}echo($this->image_dir);{/php}edit.png" border="0" /></a>
                </td>
                {acl isAllowed="USER_ADMIN"}
                    <td style="text-align:center;">
                            <a href="#" onClick="javascript:confirmar(this, '{$workers[c]->id}');" title="Eliminar">
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

<script type="text/javascript" language="javascript">
{literal}

    new Control.DatePicker($('filter[fecha]'), {
        icon: './themes/default/images/template_manager/update16x16.png',
        locale: 'es_ES',
        timePicker: false,
        timePickerAdjacent: true,
        dateFormat: 'yyyy-MM-dd'
    });
    new Control.DatePicker($('filter[next_date]'), {
        icon: './themes/default/images/template_manager/update16x16.png',
        locale: 'es_ES',
        timePicker: false,
        timePickerAdjacent: false,
        dateFormat: 'yyyy-MM-dd'
    });

    document.observe("dom:loaded", function(){
        $('pagination').select('a').each(function(item) {
            item.observe('click', function(event) {
                 Event.stop(event);
                 
                 var element = Event.element(event);
                 $('formulario').setAttribute('action', element.href);

                 $('formulario').action.value = 'list';
                (
                 try {
                    $('formulario').page.value = 2;
                 } catch(ex) {
                    $('formulario').page.value = 1;
                 }
                 
                 $('formulario').submit();

            });
        });

    });

    $('clear_filters').observe('click', function(event){
        $("filter[fecha]").value = "";
        $("filter[name]").value = "";
        $("filter[next_date]").value = "";
        $("filter[tracking]").value = "0";
        $("filter[section]").value = "0";
 
     });

{/literal}
</script>
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
         {*  <td rowspan="9" valing='top'>
               
                <div class="utilities-conf" style="padding:2px;">
                    <table>
                        <tr>
                            <td valign="top" nowrap="nowrap"  style="text-align:right;">
                                <label for="title">{t}Creado{/t}:</label>
                            </td>
                            <td valign="top">
                                <input type="text" value="{$worker->created}" name="created" disabled />
                           </td>
                         </tr>                        
                         <tr>
                            <td valign="top" nowrap="nowrap"  style="text-align:right;padding-bottom:20px;">
                                <label for="title">{t}Agente{/t}:</label>
                            </td>
                            <td valign="top">
                                <input type="text" value="{$user}" name="user" disabled />
                                <br/>
                                {acl isAllowed="USER_ADMIN"}
                                <select name="fk_creator">
                                    {html_options options=$agentsOp
                                            selected=$worker->fk_creator}
                                </select>
                                {/acl}
                            </td>
                        </tr>
                         <tr>
                             <td valign="top" nowrap="nowrap"  style="text-align:right;padding-bottom:20px;">
                                <label for="title">{t}Próxima llamada{/t}:</label>
                            </td>
                            <td valign="top">
                                  <input type="text" size="18" id="next_app_date" name="next_app_date"
                                    {if $worker->next_app_date eq '0000-00-00 00:00:00'}
                                         value="" 
                                    {else}
                                        value="{$worker->next_app_date|date_format:"%Y-%m-%d %H:%M"}"
                                    {/if}
                                    title="Fecha proxima llamada" />
                            </td>
                         </tr>
                        <tr>
                            <td valign="top" style="text-align:right;">
                                <label for="tracking">{t}Trackings{/t}:</label>
                            </td>
                            <td valign="top" >
                                <select name="tracking">
                                     {section name=c loop=$trackings}
                                         <option value="{$trackings[c]->pk_tracking}">{$trackings[c]->name|clearslash|truncate:40:"..."}</option>
                                     {/section}
                                </select>
                            </td>
                      </tr>
                      <tr>
                            <td valign="top" style="text-align:right;">
                                <label for="info">{t}Notas{/t}:</label>
                            </td><td valign="top" rowspan="2">
                                <textarea name="info" id="info" title="Information" cols="30" rows="10"></textarea>
                            </td>
                      <tr>
                        <td valign="bottom" style="text-align:center;">
                            {if ($smarty.request.action eq "read")}
                                <a href="#" class="admin_add" onClick="saveTracking(this, '_self', 'validate', '{$worker->id}', 'formulario');" value="save trackings" title="save trackings">
                                    <img border="0" src="{php}echo($this->image_dir);{/php}article_add.gif" title="Save trackings" alt="Save trackings" >
                                    <br /><b>Guardar incidencia</b>
                                </a>
                            {/if}
                        </td>

                  </tr>
                  
                  </table>
                </div>
                <div id="warnings"></div>
            </td>
                         *}
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
 

    </tbody>
    </table>

    <script type="text/javascript" language="javascript">
    {literal}

    if($('next_app_date')) {
        new Control.DatePicker($('next_app_date'), {
            icon: './themes/default/images/template_manager/update16x16.png',
            locale: 'es_ES',
            timePicker: true,
            timePickerAdjacent: true,
            use24hrs:true,
            dateTimeFormat: 'yyyy-MM-dd HH:mm',
            dateFormat: 'yyyy-MM-dd  HH:mm'
        });

    }
    {/literal}
    </script>
{/if}
{include file="footer.tpl"}
