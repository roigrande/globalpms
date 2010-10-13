<table id='table-trackings' class="adminlist" style="padding:10px;">
    <tbody>
        <tr>

            <th style="padding:10px;text-align:left;">{t}Número{/t}</th>
            <th style="padding:10px;text-align:left;">{t}Fecha{/t}</th>
            <th style="padding:10px;text-align:left;">{t}Titulo{/t}</th>
            <th style="padding:10px;text-align:left;">{t}Notas{/t}</th>
            {acl isAllowed="TRACKING_ADMIN"}
                <th align="center" style="padding:10px;width:35px;">Eliminar</th>
            {/acl}
        </tr>
        {section name=c loop=$customtracks}
            <tr {cycle values="class=row0,class=row1"}  style="cursor:pointer;">
                <td style="padding:10px;font-size:11px;" >
                   {$smarty.section.c.iteration}
                </td>
                <td style="padding:10px;font-size:11px;" >
                    {$customtracks[c]->date|clearslash}
                </td>
                <td style="padding:10px;font-size:11px;"  >
                    {$customtracks[c]->name|clearslash}
                </td>
                <td style="padding:10px;font-size: 11px;">
                    {$customtracks[c]->info|clearslash}
                </td>
                {acl isAllowed="TRACKING_ADMIN"}
                    <td style="padding:1px; font-size:11px;" align="center">
                        <a  onClick="deleteTracking({$customtracks[c]->id},{$customer->id});" title="Eliminar">
                            <img src="{php}echo($this->image_dir);{/php}trash.png" border="0" /></a>
                    </td>
                {/acl}
            </tr>

        {sectionelse}
            <tr>
                <td align="center" colspan="8"><br><br><p><h2><b>Ningun tracking guardado</b></h2></p><br><br></td>
            </tr>
        {/section}
    <tbody>
</table>