{include file="header.tpl"}

{* ******************************************************************************* *}
{* CREATE AND UPDATE WORKERS ******************************** *}


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
                 value="{$worker->telf1|clearslash|escape:"html"}" class="required"/>
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
           <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}City{/t}:</label>
            </td>

            <td valign="top" >
                <input type="text" id="city" name="city" title="city" size="40" value="{$worker->city|clearslash|escape:"html"}" />
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
            <td valign="top"   style="text-align:right;">
                <label for="title">{t}NSS:{/t}</label>
            </td>

            <td valign="top" >
                <input type="text" id="nss" name="nss" title="nss"
                            size="13" value="{$worker->nss|clearslash|escape:"html"}" />
            </td>

            <td valign="top"  style="text-align:right;">
                <label for="title">{t}Email{/t} 2:</label>
            </td>

            <td valign="top"  >
                <input type="text" id="email2" name="email2" title="email2" size="40                                                            0" value="{$worker->email2|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>

            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Day of birth{/t}</label>
            </td>

            <td valign="top"  >

               <input type="text" size="10" id="dob" name="dob"
                    {if $worker->dob eq '0000-00-00'}
                         value=""
                    {else}
                        value="{$worker->dob|date_format:"%Y-%m-%d"}"
                    {/if}
                    title="dob" />
            </td>

            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Image{/t}:</label>
            </td>

            <td valign="top" >
                <input type="text" id="image" name="image" title="image" size="40" value="{$worker->image|clearslash|escape:"html"}" />
            </td>
           
        </tr>

        <tr>  
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Status{/t}:</label>
            </td>
            <td valign="top" rowspan="4">
                <SELECT NAME="status">
                   <option value="available" {if $worker->status eq 'available'} selected ="selected" {/if}>available</option>
                   <option value="unvailable"{if $worker->status eq 'unvailable'} selected ="selected" {/if}>unvailable</option>
                </SELECT>
            </td>
         <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Description{/t}:</label>
            </td>

            <td valign="top" rowspan="4">
                <textarea name="description" id="description" title="description" cols="38" rows="8">{$worker->description|clearslash|escape:"html"}</textarea>
            </td>
        </tr>
           
 <script type="text/javascript" language="javascript">
    {literal}

    if($('dob')) {
        new Control.DatePicker($('dob'), {
            icon: './themes/default/images/template_manager/update16x16.png',
            locale: 'es_ES',
            timePicker: false,
            timePickerAdjacent: false,
            use24hrs:false,
            dateFormat: 'yyyy-MM-dd'
        });

    }
    {/literal}
    </script>
    </tbody>
    </table>
       
{include file="footer.tpl"}
