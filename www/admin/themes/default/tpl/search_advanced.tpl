{include file="header.tpl"}

<div>

    {include file="botonera_up.tpl"}

    {if !isset($smarty.request.action) ||
        $smarty.request.action eq "load"}

        <table class="adminheading" style="margin:0 auto; margin-top:30px; float:none; width:70%">
            <tr>
                <th nowrap>Busqueda Avanzada</th>
            </tr>
        </table>       
        <table class="adminlist" style="margin:0 auto; float:none; width:70%">
           
            <tr>
                <td colspan="2" style="padding:20px;" nowrap="nowrap" colspan='3'>
                    <label for="title" >Busqueda en el catálogo de información:</label><br/><br/>
                <input type="text" id="stringSearch" name="stringSearch" title="stringSearch"
                        class="required" size="80%" onkeypress="return onSearchKeyEnter(event, this, '_self', 'search', 0);"/>
                </td>
            </tr>
            <tr>
                <td style="padding:20px; padding-top:0; vertical-align:middle" nowrap="nowrap">
                    {foreach name=contentTypes item=type from=$arrayTypes}
                      {if $type[0] != 5 && $type[0] != 10 }
                        {if $type[0] == 1 || $type[0] == 4 }
                            <input class="{$type[0]}" name="{$type[1]}" id="{$type[1]}" type="checkbox" valign="center" checked="true"/>{$type[2]|capitalize:true}
                        {else}
                            <input class="{$type[0]}" name="{$type[1]}" id="{$type[1]}" type="checkbox" valign="center"/>{$type[2]|capitalize:true}
                        {/if}
                {/if}
                    {/foreach}
                </td>
            </tr>
        </table>
        
    {elseif $smarty.request.action eq "search"}
        <div style="margin:20px auto; width:70%">
            <table class="adminheading">
                <tr>
                    <th nowrap>Busqueda Avanzada</th>
                </tr>
            </table>
            <table class="adminlist">
                <tr>
                    <td valign="top" align="right" style="padding:4px;" width="25%">

                    </td>
                    <td style="padding:4px;vertical-align:middle" nowrap="nowrap" width="70%" colspan='3'>
                        {$htmlCheckedTypes}
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="right" style="padding:4px;" width="25%">
                        <label for="title" >Buscar en el cátalogo:</label>
                    </td>
                    <td style="padding:4px;" nowrap="nowrap" width="70%" colspan='3'>
                        <input type="text" id="stringSearch" name="stringSearch" title="stringSearch" value="{$smarty.request.stringSearch|escape:"html"|clearslash}"
                            class="required" size="100%" onkeypress="return onSearchKeyEnter(event, this, '_self', 'search', 0);"/>
                    </td>
                </tr>
                <tr><td colspan="2"><br />

                </td></tr>
                </table>
        </div>
        <br/><br/><br/>
        <div class="resultsSearch" id="resultsSearch" name="resultsSearch">
            {if !isset($arrayResults) || empty($arrayResults)}
                <div>
                    <p>No se encontró ningún contenido con todos los términos de su búsqueda.</p>
                    <p>Su búsqueda - <b>{$smarty.request.stringSearch|clearslash}</b> - no produjo ningún documento.</p>
                    <p style="margin-top: 1em;">Sugerencias:</p>
                    <ul style=""><li>&nbsp&nbsp&nbsp&nbsp Asegúrese de que todas las palabras estén escritas correctamente.</li>
                        <li>&nbsp&nbsp&nbsp&nbsp Intente usar otras palabras.</li>
                        <li>&nbsp&nbsp&nbsp&nbsp Intente usar palabras más generales.</li>
                    </ul>
                </div>

            {else}
           
            <table class="adminheading">
                <tr>
                    <td><b>Resultados de la búsqueda&nbsp&nbsp</b><em>'{$smarty.request.stringSearch|clearslash}'</em></td><td style="font-size: 10px;" align="right"></td>
                </tr>
            </table>
            
            {if count($arrayResults) gt 0}
                <table align="right">
                    <tr>
                        <td style="font-size: 12px;" align="center">{$pagination}</td>
                    </tr>
                </table>
             {/if}

          

               {include file=search_advanced_list.tpl}
            
            {if count($arrayResults) gt 0}
                <table align="right">
                    <tr>
                        <td colspan="4" style="padding:10px;font-size: 12px;" align="center"><br><br>{$pagination}<br><br></td>
                    </tr>
                </table>
             {/if}

            {/if}
        </div>


    {elseif isset($smarty.request.action) && $smarty.request.action eq "read"}
        <div   id="edicion-contenido" style="width:720px">
        <table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="700">
        <tbody>
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">T&iacute;tulo:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <input type="text" id="title" name="title" title="T&iacute;tulo de la noticia"
                    value="{$article->title|clearslash}" readonly size="100" />
            </td>
        </tr>
          {if $article->subtitle}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">Antet&iacute;tulo:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <input type="text" id="subtitle" name="subtitle" title="antetítulo"
                    value="{$article->subtitle|clearslash}" readonly size="100" />
            </td>
        </tr>
          {/if}
            {if $article->agency}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">Firma:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <input type="text" id="agency" name="agency" title="Agencia"
                    value="{$article->agency|clearslash}" readonly size="100" />
            </td>
        </tr>
          {/if}
          {if $article->fk_author}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">Autor:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <input type="text" id="agency" name="agency" title="Agencia"
                        {section name=as loop=$todos}
                                         {if $article->fk_author eq $todos[as]->pk_author} value="{$todos[as]->name}" {/if}
                                {/section}
                     readonly size="100" />
            </td>
        </tr>
          {/if}
          {if $article->in_home}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">En home:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <input type="text" id="agency" name="agency" title="Agencia"
                    {if $article->in_home eq 1} value="SI" {else} value="NO"  {/if}
                     readonly size="100" />
            </td>
        </tr>
          {/if}
             {if $article->metadata}
            <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="metadata">Palabras clave: </label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <input type="text" id="metadata" name="metadata" size="100" title="Metadatos" value="{$article->metadata}"  readonly/>
            </td>
        </tr>
        {/if}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">Secci&oacute;n:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <input type="text" id="agency" name="agency" title="Agencia"
                     readonly size="100"
                            {section name=as loop=$allcategorys}
                                     {if $article->category eq $allcategorys[as]->pk_content_category} value="{$allcategorys[as]->name}"{/if}
                                    {section name=su loop=$subcat[as]}
                                              {if $category eq $subcat[as][su]->pk_content_category} value="{$subcat[as][su]->name}" {/if}
                                        {/section}
                                 {/section}
                />
            </td>
        </tr>
        {if $article->summary neq ""}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="summary">Entradilla:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <textarea name="summary" id="summary" readonly
                    title="Resumen de la noticia" style="width:100%; height:8em;">{$article->summary|clearslash}</textarea>
            </td>
        </tr>
        {/if}
        {if $article->img1}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">Imagen de Portada:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
            <table border='0' width="96%">
                            <tr><td>
                                <h2 style="color:#2f6d9d;">Imagen de Portada:</h2></td>
                                <input type="hidden" id="input_img1" name="img1" title="Imagen" value="{$article->img1}" size="70"/>
                              <td> </td>

                             </tr><tr>
                             <td align='left'>
                                  <div id="droppable_div1">
                                        <img src="{$photo1->path_file}/{$photo1->name}" id="change1" border="0" width="300px" />
                                    </div>
                            </td><td nowrap colspan="2">
                                    <div id="informa" style="display: inline; width:380px; height:30px;">
                                            <b>Archivo: {$photo1->name}</b> <br><b>Ancho:</b> {$photo1->width}<br><b>Alto:</b> {$photo1->height}<br>
                                            <b>Peso:</b> {$photo1->size} Kb<br><b>Fecha de creaci&oacute;n:</b> {$photo1->created}<br>
                                    </div>
                                    <div id="noimag" style="display: inline; width:380px; height:30px;"></div>
                                <div id="noinfor" style="display: none; width:100%;  height:30px;"></div>
                        </td></tr></table>
            </td>
        </tr>
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">Pie imagen de portada:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <input type="text" id="img1_footer" name="img1_footer" title="Imagen" readonly value="{$article->img1_footer}" size="100" />
            </td>
        </tr>
        {/if}
        {if $article->img2}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">Imagen Interior:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                 <table border='0' width="96%">
                             <tr><td>
                            <h2 style="color:#2f6d9d;">Imagen Interior:</h2></td>
                             <td> </td>
                             </tr><tr>
                             <td align='left'>

                                <input type="hidden" id="input_img2" name="img2" value="{$article->img2}" size="100">
                               <div id="droppable_div2">
                                 <img src="{$photo2->path_file}/{$photo2->name}" id="change2" border="0" width="300px" />
                                </div>
                            </td>	<td nowrap colspan="2">
                                  <div id="informa2" style="display: inline; width:380px; height:30px;">
                                            <b>Archivo: {$photo2->name}</b> <br><b>Ancho:</b> {$photo2->width}<br><b>Alto:</b> {$photo2->height}<br>
                                            <b>Peso:</b> {$photo2->size} Kb<br><b>Fecha de creaci&oacute;n:</b> {$photo2->created}<br>
                                    </div>
                                 <div id="noimag2" style="display: inline; width:380px; height:30px;">	</div>
                                 <div id="noinfor2" style="display: none; width:100%; height:30px;"></div>
                            </td></tr></table>
            </td>
        </tr>
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="title">Pie imagen interior:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <input type="text" id="img2_footer" name="img2_footer" title="Imagen" readonly value="{$article->img2_footer}" size="100" />
            </td>
        </tr>
        {/if}

        {if $article->body}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="body">Cuerpo:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <textarea name="body" id="body" readonly disabled
                    title="Cuerpo de la noticia" style="width:100%; height:20em;">{$article->body|clearslash}</textarea>

            </td>
        </tr>
        {/if}

        {if $losrel}
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
               <label for="body">Articulos-relacionados en Portada:</label></td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                <ul >
                    {section name=n loop=$losrel}
                     <li> {$losrel[n]->title|clearslash}  </li>
                    {/section}
                  </ul>
            </td>
            </tr>
            {/if}

        {if $intrel}
            <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
               <label for="body">Articulos-relacionados en Interior:</label></td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                 <ul>
                    {section name=n loop=$intrel}
                     <li>{$intrel[n]->title|clearslash}  </li>
                    {/section}
                  </ul>
            </td>
            </tr>
            {/if}

        {if $adjuntospor}
            <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
                <label for="body">Elementos-relacionados en Portada:</label></td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                    <ul>
                        {section name=n loop=$adjuntospor}
                             <li>  {$adjuntospor[n]->title|clearslash} </li>
                          {/section}
                    </ul>
            </td>
            </tr>
            {/if}

        {if $adjuntosint}
            <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
            <label>Elementos-relacionados en Portada:</label></td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                    <ul>
                        {section name=n loop=$adjuntosint}
                                 <li> {$adjuntosint[n]->title|clearslash} </li>
                          {/section}
                    </ul>
        </td>
        </tr>
        {/if}
        {if $comments}
            <tr>
            <td valign="top" align="right" style="padding:4px;" width="30%">
            <label>Comentarios:</label></td>
            <td style="padding:4px;" nowrap="nowrap" width="70%">
                    <ul>
                        {section name=c loop=$comments}
                                 <li> {$comments[c]->title|clearslash} - {$comments[c]->changed}) </li>
                          {/section}
                    </ul>
        </td>
        </tr>
        {/if}


        </tbody>
        </table>
        </div>

        <script type="text/javascript" src="{$params.JS_DIR}/tiny_mce/opennemas-config.js"></script>
        {literal}
        <script type="text/javascript" language="javascript">		
            tinyMCE_GZ.init( OpenNeMas.tinyMceConfig.tinyMCE_GZ );
        </script>
                
        <script type="text/javascript" language="javascript">    
            OpenNeMas.tinyMceConfig.advanced.elements = "body";
            tinyMCE.init( OpenNeMas.tinyMceConfig.advanced );                        
        </script>
        {/literal}

        <table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="600">
        <tbody>
        <tr>
            <td colspan="2" align="right">
                <a href="#" onClick="javascript:enviar(this, '_self', '', {$article->id});">
                    <img src="{php}echo($this->image_dir);{/php}btn_volver.gif" border="0" /></a>&nbsp;&nbsp;
            </td>
        </tr>
        </tbody>
        </table>


        {/if}

</div>

{include file="footer.tpl"}