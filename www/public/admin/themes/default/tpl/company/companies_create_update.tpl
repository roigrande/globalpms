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
                            size="40" value="{$company->name|clearslash|escape:"html"}" class="required" onBlur=""/>
            </td>

             <td valign="top" style="text-align:right;width:90px;">
                <label for="title">{t}Fiscal name{/t}:</label>
            </td>

            <td valign="top" nowrap="nowrap" style="width:314px;">
                <input type="text" id="name" name="name" title="name"
                            size="40" value="{$company->fiscalName|clearslash|escape:"html"}" class="required" onBlur=""/>
            </td>
           
        </tr>

        <tr>
            <td valign="top" style="text-align:right;width:110px;">
                <label for="title">{t}CIF{/t}:</label>
            </td>

            <td valign="top" nowrap="nowrap" style="width:320px;">
                <input type="text" id="cif" name="cif" title="cif" size="10" maxlength="9"
                 value="{$company->cif|clearslash|escape:"html"}" class="required"/>
            </td>
            <td valign="top" style="text-align:right;">
                <label for="title">{t}City{/t}:</label>
            </td>

            <td valign="top">
                <input type="text" id="city" name="city" title="city" size="10"  maxlength="9" value="{$company->city|clearslash|escape:"html"}"/>
            </td>
        </tr>


        <tr>
            <td valign="top" style="text-align:right;width:110px;">
                <label for="title">{t}Telephono{/t}1:</label>
            </td>

            <td valign="top" nowrap="nowrap" style="width:320px;">
                <input type="text" id="telf1" name="telf1" title="telf1" size="10" maxlength="9"
                 value="{$company->telf1|clearslash|escape:"html"}" class="required"/>
                <div id="check_tfno"></div>
            </td>      
            <td valign="top" style="text-align:right;">
                <label for="title">{t}Telephone{/t}2:</label>
            </td>

            <td valign="top">
                <input type="text" id="telf2" name="telf2" title="telf2" size="10"  maxlength="9" value="{$company->telf2|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>
           <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}State{/t}:</label>
            </td>

            <td valign="top" >
                <input type="text" id="state" name="state" title="state" size="40" value="{$company->state|clearslash|escape:"html"}" />
            </td>
            
            <td valign="top"  style="text-align:right;">
                <label for="title">{t}address{/t}:</label>

            </td>

            <td valign="top">
                <input type="text" id="address" name="address" title="address" size="40"  maxlength="9" value="{$company->address|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>
            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Email {/t}1:</label>
            </td>

            <td valign="top">
                <input type="text" id="email1" name="email1" title="email1" size="40" value="{$company->email1|clearslash|escape:"html"}"/>
            </td>

            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Email {/t}2:</label>
            </td>

            <td valign="top">
                <input type="text" id="email2" name="email2" title="email2" size="40" value="{$company->email2|clearslash|escape:"html"}"/>
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
