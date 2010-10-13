{include file="header.tpl"}

{* LISTADO ******************************************************************* *}
{if !isset($smarty.post.action) || $smarty.post.action eq "list"}


    <ul class="tabs">
        <li><a href="litter.php?action=list&mytype=customer" {if $mytype==customer } style="color:#000000; font-weight:bold; background-color:#BFD9BF" {/if}>Customer</a></li>
        <li><a href="litter.php?action=list&mytype=tracking" {if $mytype==tracking } style="color:#000000; font-weight:bold; background-color:#BFD9BF" {/if}>Tracking</a></li>
    </ul>

    <br class="clear"/><br><br />

    {include file="botonera_up.tpl"}

    <br class="clear"/>
    <table class="adminheading">
        <tr>
            <th nowrap>Elementos en la papelera</th>
        </tr>
    </table>

    <div id="pagina">

        <table class="adminlist">
            <tr>
                <th style="width:50px;"> &nbsp;</th>
                <th style="width:300px;" align='left'>T&iacute;tulo</th>
                <th  style="">Description</th>
                <th  style="width:160px;">Fecha</th>
                <th  style="width:60px;">Recuperar</th>
                <th  style="width:60px;">Eliminar</th>
            </tr>

            {section name=c loop=$litterelems}
                <tr {cycle values="class=row0,class=row1"} style="cursor:pointer;" >
                    <td>
                        <input type="checkbox" class="minput"  id="selected{$smarty.section.c.iteration}" name="selected_fld[]" value="{$litterelems[c]->id}"  style="cursor:pointer;">
                    </td>
                    <td style="text-align: left;" onClick="javascript:document.getElementById('selected{$smarty.section.c.iteration}').click();">
                        {$litterelems[c]->name|clearslash}
                    </td>
                    <td style="text-align: left;">
                        {$litterelems[c]->description|clearslash}
                    </td>
                    <td style="text-align: center;">
                        {$litterelems[c]->created}
                    </td>

                    <td style="text-align: center;">
                            <a href="?id={$litterelems[c]->id}&amp;action=no_in_litter&amp;&amp;mytype={$mytype}&amp;page={$paginacion->_currentPage}" title="Recuperar">
                                <img class="portada" src="{php}echo($this->image_dir);{/php}trash_no.png" border="0" alt="Recuperar" width='24px' /></a>
                    </td>
                    <td style="text-align: center;">
                        <a href="#" onClick="javascript:vaciar(this, '{$litterelems[c]->id}');" title="Eliminar"><img src="{php}echo($this->image_dir);{/php}trash.png" border="0" /></a>
                    </td>
                </tr>
            {sectionelse}
                <tr>
                    <td align="center" colspan=6><br><br><p><h3><b>Ningun elemento en la papelera</b></h3></p><br><br></td>
                </tr>
            {/section}
            <tr>
                <td colspan="5" align="center">{$paginacion->links}</td>
            </tr>
        </table>

    </div>

{/if}

{include file="footer.tpl"}

       					 