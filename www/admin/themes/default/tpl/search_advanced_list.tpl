              <table class="adminlist">
                <tr>
                    <th class="title">T&iacute;tulo</th>
                    <th align="center">Tipo de Contenido</th>
                    <th align="center">Secci&oacute;n</th>
                    <th align="center">Fecha</th>
                    <th align="center">Status</th>
                    <th align="center">Editar</th>
                    <th align="center">Recuperar</th>
                    <th align="center">Visualizar</th>
                    <th align="center">Notificar</th>
                </tr>
            {section name=c loop=$arrayResults}
                <tr {cycle values="class=row0,class=row1"}>
                    <td style="padding:10px;font-size: 11px;width:50%;">
                        {$arrayResults[c].titule|clearslash}
                    </td>
                    <td style="padding:10px;font-size: 11px;width:15%;" align="center">
                        {$arrayResults[c].type}
                    </td>
                    <td style="padding:10px;font-size: 11px;width:15%;" align="center">
                        {$arrayResults[c].catName}
                    </td>
                    <td style="padding:10px;font-size: 11px;width:15%;" align="center">
                        {$arrayResults[c].created}
                    </td>
                    <td style="padding:10px;width:10%;" align="center">
                         {if ($arrayResults[c].in_litter == 1) }
                                  <img src="{php}echo($this->image_dir);{/php}trash.png" border="0" alt="En Papelera" title="En Papelera"/>
                         {else}
                            {if ($arrayResults[c].type == 'artigo') }
                                { if ($arrayResults[c].available == 1) && ($arrayResults[c].content_status == 1) }
                                    <img src="{php}echo($this->image_dir);{/php}publish_g.png" border="0" alt="Publicada" title="Publicada"/>
                                {elseif  ($arrayResults[c].available == 1) && ($arrayResults[c].content_status == 0)}
                                    <img src="{php}echo($this->image_dir);{/php}save_hemeroteca_icon.png" border="0" alt="En Hemeroteca" title="En Hemeroteca" />
                                 {else}
                                    <img src="{php}echo($this->image_dir);{/php}publish_r.png" border="0" alt="En Pendientes" title="En Pendientes" />
                                 {/if}
                            {elseif $arrayResults[c].content_type eq 'photo' }
                                {if ($arrayResults[c].content_status == 1) }
                                     <img src="{php}echo($this->image_dir);{/php}publish_g.png" border="0" alt="Publicada" title="Publicada"/>
                                 {else}
                                    <img src="{php}echo($this->image_dir);{/php}publish_r.png" border="0" alt="En Pendientes" title="En Pendientes" />
                                 {/if}
                            {else}
                                 {if ($arrayResults[c].available == 1) }
                                    <img src="{php}echo($this->image_dir);{/php}publish_g.png" border="0" alt="Publicada" title="Publicada"/>
                                 {else}
                                    <img src="{php}echo($this->image_dir);{/php}publish_r.png" border="0" alt="En Pendientes" title="En Pendientes" />
                                 {/if}
                            {/if}
                         {/if}
                    </td>
                    <td style="padding:10px;width:10%;" align="center">
                        {assign var="ct" value=$arrayResults[c].content_type}
                        {if $arrayResults[c].content_type eq 'photo' }
                            <a href="/admin/{$type2res.$ct}?action=image_data&id={$arrayResults[c].id}&category={$arrayResults[c].category}&desde=search&stringSearch={$smarty.request.stringSearch}&page={$smarty.request.page}" title="Editar">
                            <img src="{php}echo($this->image_dir);{/php}edit.png" border="0" /></a>
                        {else}
                            <a href="/admin/{$type2res.$ct}?action=read&id={$arrayResults[c].id}&stringSearch={$smarty.request.stringSearch}&desde=search&page={$smarty.request.page}" title="Editar">
                            <img src="{php}echo($this->image_dir);{/php}edit.png" border="0" /></a>
                        {/if}
                    </td>
                    
                     <td style="padding:10px;width:10%;" align="center">
                         {if ($arrayResults[c].in_litter == 1) }
                               <a href="/admin/litter.php?action=no_in_litter&desde=search&id={$arrayResults[c].id}&category={$arrayResults[c].category}" title="Recuperar de la Papelera">
                                  <img src="{php}echo($this->image_dir);{/php}trash_no.png" border="0" width="24" alt="Recuperar de Papelera" title="Recuperar de Papelera" />
                               </a>
                         {else}
                            {if ($arrayResults[c].type == 'artigo')}
                                {if ($arrayResults[c].available == 1) && ($arrayResults[c].content_status == 0)}
                                    <a href="/admin/{$type2res.$ct}?&action=change_status&status=1&desde=search&id={$arrayResults[c].id}&category={$arrayResults[c].category}" title="Recuperar de la Hemeroteca">
                                        <img src="{php}echo($this->image_dir);{/php}archive_no2.png" border="0" alt="Recuperar Hemeroteca" title="Recuperar de Hemeroteca"/>
                                    </a>
                                {/if}
                             {else}

                             {/if}
                         {/if}
                    </td>
                    <td style="padding:10px;width:10%;" align="center">
                        <a href="#" target="_blank" accesskey="P" onmouseover="return escape('<u>P</u>revisualizar');" onclick="{literal}myLightWindow.activateWindow({href: '{/literal}{$arrayResults[c].permalink}{literal}',title: 'Previsualización',author: 'Xornal.com'});return false;{/literal}" >
                            <img border="0" src="{php}echo($this->image_dir);{/php}preview_small.png" title="Previsualizar" alt="Previsualizar" /></a>
                    </td>
                     <td style="padding:10px;width:10%;" align="center">
                        <a href="#" accesskey="N'" onmouseover="return escape('<u>N</u>otificar');" onclick="send_notify('{$arrayResults[c].id}','confirm_notify');" >
                            <img border="0" src="{php}echo($this->image_dir);{/php}file_alert.png" title="Notificar" alt="Notificar" /></a>
                    </td>
                </tr>
                {sectionelse}
                <tr>
                    <td align="center" colspan=4><br><br><p><h2><b>Ninguna noticia guardada</b></h2></p><br><br></td>
                </tr>
                {/section}
                </table>