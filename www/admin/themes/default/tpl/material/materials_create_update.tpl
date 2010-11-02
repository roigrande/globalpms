{include file="header.tpl"}


{* ******************************************************************************* *}
{* CREATE AND UPDATE MATERIALS ******************************** *}


    {include file="botonera_up.tpl"}

    <table border="0" cellpadding="2" cellspacing="2" class="fuente_cuerpo" width="100%">
    <tbody>

        <tr>
            <td valign="top" style="text-align:right;width:90px;">
                <label for="title">{t}Name{/t}:</label>
            </td>

            <td valign="top" nowrap="nowrap" style="width:314px;">
                <input type="text" id="name" name="name" title="name"
                            size="40" value="{$material->name|clearslash|escape:"html"}" class="required" onBlur=""/>
            </td>

            <td valign="top" style="text-align:right;width:110px;">
                <label for="title">{t}Number{/t}:</label>
            </td>

            <td valign="top" nowrap="nowrap" style="width:320px;">
                <input type="text" id="num" name="num" title="num" size="10" maxlength="9"
                onchange="get_unique();" value="{$material->num|clearslash|escape:"html"}" class="required"/>
                <div id="check_tfno"></div>
            </td>      
        </tr>

        <tr>
            <td valign="top"   style="text-align:right;width:90px;">
                <label for="metadata">{t}Metadata{/t}:</label><br />
                <sub>Separadas por comas</sub>
            </td>
            
            <td valign="top" nowrap="nowrap">
                <input type="text" id="metadata" name="metadata" title="metadata" size="40" value="{$material->metadata|strip}" />
            </td>

            <td valign="top" style="text-align:right;">
                <label for="title">{t}Number available{/t}:</label>
            </td>

            <td valign="top">
                <input type="text" id="numAvailable" name="numAvailable" title="numAvailable" size="10"  maxlength="9" value="{$material->numAvailable|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>
            <td valign="top"   style="text-align:right;">
                <label for="title">{t}Store{/t}:</label>
            </td>

            <td valign="top" >
                <input type="text" id="store" name="store" title="store"
                            size="40" value="{$material->store|clearslash|escape:"html"}" />
            </td>

            <td valign="top"  style="text-align:right;">
                <label for="title">{t}Price{/t}:</label>

            </td>

            <td valign="top">
                <input type="text" id="price" name="price" title="price" size="20"  maxlength="9" value="{$material->price|clearslash|escape:"html"}"/>
            </td>
        </tr>

        <tr>
            <td valign="top"  style="text-align:right;">
                <label for="title">{t}invoice{/t}:</label>

            </td>

            <td valign="top">
                <input type="text" id="invoice" name="invoice" title="invoice" size="40"  maxlength="9" value="{$material->invoice|clearslash|escape:"html"}"/>
            </td>

            <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Description{/t}:</label>
            </td>

            <td valign="top" rowspan="4">
                <textarea name="description" id="description" title="description" cols="38" rows="8">{$material->description|clearslash|escape:"html"}</textarea>
            </td>
        </tr>
        <tr>
        <td valign="top"  nowrap="nowrap"  style="text-align:right;">
                <label for="title">{t}Material type{/t}:</label>
            </td>

            <td valign="top" rowspan="4">
                           <SELECT NAME="fkMaterialType">
                               <option value="gloves" {if $material->fkMAterialType eq 'gloves'} selected ="selected" {/if}>{t}gloves{/t}</option>
                               <option value="helmet"{if $material->fkMaterialType eq 'helmet'} selected ="selected" {/if}>{t}helmet{/t}</option>

                           </SELECT>

            </td>

        </tr>
    </tbody>
    </table>

{include file="footer.tpl"}
