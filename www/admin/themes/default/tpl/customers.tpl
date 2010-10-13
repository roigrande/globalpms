{include file="header.tpl"}

{* LISTADO *********************************************************************** *}
{if !isset($smarty.request.action) || $smarty.request.action eq "list"}

<div id="{$category}">



    {include file="botonera_up.tpl"}

    {if !empty($smarty.get.msg)}
       
        <div id="warnings">{$smarty.get.msg}
                     {if !empty($smarty.get.id_del) eq 'ok'}
                            {strip}
                                <h3>¿Desea eliminarlos de todos modos?  <br>
                                        <a title='si' href='{$smarty.server.SCRIPT_NAME}?action=confirm_delete&id={$smarty.get.id_del}&page={$smarty.get.page}"'>Si</a> |
                                        <a title='no' href='{$smarty.server.SCRIPT_NAME}?action=list'>No</a>
                                </h3>
                            {/strip}
                        {/if}</div>
        <script type="text/javascript" language="javascript">
            {literal}
                  /* $('warnings').update( ' {/literal} {$smarty.get.msg}
                     {if !empty($smarty.get.id_del) eq 'ok'}
                            {strip}
                                <h3>¿Desea eliminarlos de todos modos?  <br>
                                        <a title='si' href='{$smarty.server.SCRIPT_NAME}?action=confirm_delete&id={$smarty.get.id_del}&page={$smarty.get.page}"'>Si</a> |
                                        <a title='no' href='{$smarty.server.SCRIPT_NAME}?action=list'>No</a>
                                </h3>
                            {/strip}
                        {/if}
                    {literal}' ); */
                   new Effect.Highlight( $('warnings') );
                   new Effect.Opacity( $('warnings'),{ from: 1, to: 0, duration: 16.0} );
            {/literal}
        </script>
    {/if}
    <script type="text/javascript">
    {literal}
    function submitFilters(frm) {
        $('action').value='list';
        $('page').value = {/literal}{$smarty.request.page|default:"1"}{literal};

        frm.submit();
    }
    {/literal}
    </script>

<table class="adminheading">
    <tr>
        <th>
            <div style="display:block;float:left;">
                <label>Buscar: </label>
                <input name="filter[name]" id="filter[name]" onchange="submitFilters(this.form);"
                      type="text"  size="20" value="{$smarty.request.filter.name}" />
                &nbsp;

                <label>{t}Seccion{/t}:</label>
                <select name="filter[category]" id="filter[category]" onchange="submitFilters(this.form);">
                    {html_options options=$filter_options.category
                            selected=$smarty.request.filter.category}
                </select>
                &nbsp;
            </div>
            
            <div style="display:block;float:left;padding:4px;">
                <label>{t}Próxima llamada{/t}:</label>
            </div>
            <div style="display:block;float:left">
                <input type="text" size="18" id="filter[next_date]" name="filter[next_date]" onchange="submitFilters(this.form);"
                    value="{$smarty.request.filter.next_date|date_format:"%Y-%m-%d"}"  title="Fecha próxima llamada" />
            </div>
            <div style="display:block;float:left">
                {acl isAllowed="USER_ADMIN"}
                    &nbsp;
                     <label>{t}Agente{/t}:
                    <select name="filter[agent]" id="filter[agent]" onchange="submitFilters(this.form);">
                        {html_options options=$filter_options.agent
                                selected=$smarty.request.filter.agent}
                    </select></label>
                {/acl}
                &nbsp;
            </div>
            <br /><br />
            <div style="display:block;float:left;padding:4px;">
                <label>{t}Tracking{/t}:
            </div>
            <div style="display:block;float:left;height:20px;">
                <select name="filter[tracking]" id="filter[tracking]" onchange="submitFilters(this.form);">
                    {html_options options=$filter_options.tracking
                            selected=$smarty.request.filter.tracking}
                </select>
            </div>
            </label>
            <div style="display:block;float:left;padding:4px;">
                <label> {t}Fecha{/t}:</label>
            </div>
            <div style="display:block;float:left;height:20px;">
                <input type="text" size="18" id="filter[fecha]" name="filter[fecha]" onchange="submitFilters(this.form);"
                    value="{$smarty.request.filter.fecha|date_format:"%Y-%m-%d"}"  title="Fecha" />
            </div>
            
            <input type="button" id="clear_filters" value="Limpiar">
            <input type="hidden" id="page" name="page" value="{$smarty.request.page|default:"1"}" />
 
        </th>
    </tr>
</table>

<table class="adminlist">
    <thead>
    <tr>
        <th></th>
        <th align="left" class="title">{t}Company_name{/t}</th>       
        <th align="left">{t}Teléfono{/t}</th>
        <th align="left">{t}Email{/t}</th>
        <th align="left">{t}Email2{/t}</th>
        <th align="left">{t}FAX{/t}</th>
        <th align="left">{t}Próxima Llamada{/t}</th>
        {acl isAllowed="USER_ADMIN"}
            <th align="left">{t}Agente{/t}</th>
        {/acl}
        <th align="left">{t}Ultimo tracking{/t}</th>
        <th align="left">{t}Nota{/t}</th>
        <th align="center">{t}Update{/t}</th>
        {acl isAllowed="USER_ADMIN"}
            <th align="center">{t}Delete{/t}</th>
        {/acl}
    </tr>
    </thead>

    <tbody>
    {section name=c loop=$customers}
        <tr {cycle values="class=row0,class=row1"}>
            <td style="text-align:center;font-size: 11px;;">
                <input type="checkbox" class="minput" id="selected_{$smarty.section.c.iteration}" name="selected_fld[]"
                    value="{$customers[c]->pk_customer}" />
                </td>               
                <td  id="info_{$customers[c]->pk_customer}" style="font-size: 11px;cursor:pointer;cursor: hand;">
                        {$customers[c]->company_name|clearslash}
                        {literal}
                            <script type="text/javascript" language="javascript">
                            new Tip({/literal}'info_{$customers[c]->pk_customer}', 'Dirección: {$customers[c]->address1} <br>Ciudad: {$customers[c]->city} <br>Fecha última incidencia:  {$last_trackings[$custom].date|default:'---'}', {literal}
                            {title: 'Más información'                                                      
                            });
                            </script>
                        {/literal}
                </td>
                <td style="text-align:left;font-size: 11px;">
                         {$customers[c]->telf1}
                </td>
                <td style="text-align:left;font-size: 11px;">
                         {$customers[c]->email1}
                </td>
                 <td style="text-align:left;font-size: 11px;">
                         {$customers[c]->email2}
                </td>
                 <td style="text-align:left;font-size: 11px;">
                         {$customers[c]->fax}
                </td>
                <td style="text-align:left;font-size: 11px;">
                         {$customers[c]->next_app_date|default:'---'}
                </td>
                {acl isAllowed="USER_ADMIN"}
                     <td style="text-align:left;font-size: 11px;">
                             {$customers[c]->agent}
                     </td>
                {/acl}
                <td style="text-align:left;font-size: 11px;">
                    {assign var='custom' value=$customers[c]->id}
                    {$last_trackings[$custom].track|default:'---'}
                </td>
                 <td style="text-align:left;font-size: 11px;" id="track_{$customers[c]->pk_customer}">
                    {$last_trackings[$custom].info|clearslash|truncate:36|default:'---'}
                    {if !empty($last_trackings[$custom].info)}
                     {literal}
                            <script type="text/javascript" language="javascript">
                            new Tip({/literal}'track_{$customers[c]->pk_customer}', ' {$last_trackings[$custom].info|clearslash}', {literal}
                            {title: 'Nota'
                            });
                            </script>
                      {/literal}
                    {/if}
                </td>
                <td style="text-align:center;">
                        <a href="#" onClick="javascript:enviar(this, '_self', 'read', '{$customers[c]->id}');" title="Modificar">
                                <img src="{php}echo($this->image_dir);{/php}edit.png" border="0" /></a>
                </td>
                {acl isAllowed="USER_ADMIN"}
                    <td style="text-align:center;">
                            <a href="#" onClick="javascript:confirmar(this, '{$customers[c]->id}');" title="Eliminar">
                                    <img src="{php}echo($this->image_dir);{/php}trash.png" border="0" /></a>
                    </td>
                 {/acl}

        </tr>
        {sectionelse}
        <tr>
                <td align="center" colspan="10">
                <h2>Ningun cliente almacenado</h2>
            </td>
        </tr>
    {/section}
    </tbody>

    <tfoot>
        {if count($customers) gt 0}
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
                 
                 try {
                    $('formulario').page.value = /page=(\d+)/.exec(element.href)[1];
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
                <label for="title">{t}Nombre comercial{/t}:</label>
            </td>
            <td valign="top" nowrap="nowrap" style="width:314px;">
                <input type="text" id="name" name="name" title="name"
                            size="40" value="{$customer->name|clearslash|escape:"html"}" class="required" onBlur=""/>
            </td>
            <td valign="top" style="text-align:right;width:110px;">
                <label for="title">{t}Telefono{/t} 1:</label>
            </td>
            <td valign="top" nowrap="nowrap" style="width:320px;">
                <input type="text" id="telf1" name="telf1" title="telf1" size="10" maxlength="9"
                    onchange="get_unique();" value="{$customer->telf1|clearslash|escape:"html"}" class="required"/>
                    <div id="check_tfno"></div>
            </td>
            <td rowspan="9" valing='top'>
               
                <div class="utilities-conf" style="padding:2px;">
                    <table>
                        <tr>
                            <td valign="top" nowrap="nowrap"  style="text-align:right;">
                                <label for="title">{t}Creado{/t}:</label>
                            </td>
                            <td valign="top">
                                <input type="text" value="{$customer->created}" name="created" disabled />
                                </br>
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
                                            selected=$customer->fk_creator}
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
                                    {if $customer->next_app_date eq '0000-00-00 00:00:00'}
                                         value="" 
                                    {else}
                                        value="{$customer->next_app_date|date_format:"%Y-%m-%d %H:%M"}"
                                    {/if}
                                    title="Fecha proxima llamada" /></label>
                                </br>
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
                                <a href="#" class="admin_add" onClick="saveTracking(this, '_self', 'validate', '{$customer->id}', 'formulario');" value="save trackings" title="save trackings">
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
        </tr>
        <tr>
            <td valign="top"   style="text-align:right;width:90px;">
                <label for="metadata">{t}Metadata{/t}:</label><br />
                <sub>Separadas por comas</sub>
            </td>
            <td valign="top" nowrap="nowrap">
                <input type="text" id="metadata" name="metadata" title="metadata" size="40" value="{$customer->metadata|strip}" />
            </td>
            <td valign="top" style="text-align:right;">
                <label for="title">{t}Telefono{/t} 2:</label>
            </td>
            <td valign="top">
                <input type="text" id="telf2" name="telf2" title="telf2" size="10"  maxlength="9" value="{$customer->telf2|clearslash|escape:"html"}"/>
            </td>
        </tr>
        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title">{t}Nombre Fiscal:{/t}</label>
            </td>
            <td valign="top" >
                <input type="text" id="company_name_fiscal" name="company_name_fiscal" title="company_name_fiscal"
                            size="40" value="{$customer->company_name_fiscal|clearslash|escape:"html"}" />
            </td>
            <td valign="top"  style="text-align:right;">
                <label for="title">{t}Fax{/t}:</label>
            </td>
            <td valign="top">
                <input type="text" id="fax" name="fax" title="fax" size="10"  maxlength="9" value="{$customer->fax|clearslash|escape:"html"}"/>
            </td>
        </tr>
        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title">{t}CIF{/t}:</label>
            </td>
            <td valign="top" >
                <input type="text" id="cif" name="cif" title="cif" size="10" maxlength="9" value="{$customer->cif|clearslash|escape:"html"}" />
            </td>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Email 1{/t}:</label>
            </td>
            <td valign="top">
                <input type="text" id="email1" name="email1" title="email1" size="40" value="{$customer->email1|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>
            <td valign="top" style="text-align:right;">
                <label for="category">{t}Categoria{/t}:</label>
            </td>
            <td valign="top" >
                <select name="category" id="category">
                    {section name=as loop=$allcategories}
                        <option value="{$allcategories[as]->pk_content_category}"
                            {if $category eq $allcategories[as]->pk_content_category}selected="selected"{/if}>
                            {$allcategories[as]->title}
                        </option>
                    {/section}
                </select>
            </td>
            <td valign="top"  style="text-align:right;">
                <label for="title">{t}Email{/t} 2:</label>
            </td>
            <td valign="top"  >
                <input type="text" id="email2" name="email2" title="email2" size="40" value="{$customer->email2|clearslash|escape:"html"}"/>
            </td>
        </tr>
        <tr>
            <td valign="top"  style="text-align:right;">
                <label for="title">{t}Direccion{/t} 1:</label>
            </td>
            <td valign="top" >
                <input type="text" id="address1" name="address1" title="address1" size="40" value="{$customer->address1|clearslash|escape:"html"}" />
            </td>
            <td valign="top"   nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Pagina Web{/t}:</label>
            </td>
            <td valign="top" >
                <input type="text" id="web_page" name="web_page" title="web_page" size="40" value="{$customer->web_page|clearslash|escape:"html"}" />
            </td>
        </tr>
        <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Direccion{/t} 2:</label>
            </td>
            <td valign="top" >
                <input type="text" id="address2" name="address2" title="address2" size="40" value="{$customer->address2|clearslash|escape:"html"}"/>
            </td>
            <td valign="top"  style="text-align:right;">
                <label for="title">{t}Nombre de contacto{/t}:</label>
            </td>
            <td valign="top" >
                <input type="text" id="contact_name" name="contact_name" title="contact_name" size="40" value="{$customer->contact_name|clearslash|escape:"html"}" "/>
            </td>
        </tr>
        <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Ciudad{/t}:</label>
            </td>
            <td valign="top" >
                <input type="text" id="city" name="city" title="city" size="40" value="{$customer->city|clearslash|escape:"html"}" />
            </td>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Observaciones{/t}:</label>
            </td>
            <td valign="top" rowspan="4">
                <textarea name="description" id="description" title="Information" cols="38" rows="8">{$customer->description|clearslash|escape:"html"}</textarea>
            </td>
        </tr>
        <tr>
            <td valign="top" nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Provincia{/t}:</label>
            </td>
            <td valign="top" >
                <input type="text" id="state" name="state" title="state" size="40" value="{$customer->state|clearslash|escape:"html"}" />
            </td>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">&nbsp;</label>
            </td>
            <td valign="top" >&nbsp;</td>
        </tr>
        <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}CP{/t}</label>
            </td>
            <td valign="top"  >
                <input type="text" id="postal_code" name="postal_code" title="postal_code"
                 size="10"  maxlength="5" value="{$customer->postal_code|clearslash|escape:"html"}" />
            </td>            
        </tr>
         <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
            </td>
            <td valign="top"  >
            </td>
        </tr>
        <tr>
            <td colspan="5" style="padding:10px;">
                <h2>{t}Trackings{/t}</h2>
                <div id='div-trackings'>
                    {include file="custom_trackings.tpl"}
                </div>
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
