{* Botonera Workers -------------------------------------------- *}
{if preg_match('/worker\.php/',$smarty.server.SCRIPT_NAME) && ($smarty.request.action eq "list") }
    <div id="title-menu"><h2>{$titulo_barra}</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            {acl isAllowed="USER_ADMIN"}
                <li>
                    <a href="#" class="admin_add" onClick="javascript:enviar2(this, '_self', 'mdelete', 0);" name="submit_mult" value="Eliminar" title="Eliminar">
                        <img border="0" src="{php}echo($this->image_dir);{/php}trash_button.gif" title="Eliminar" alt="Eliminar"><br />Eliminar
                    </a>
                </li>
            {/acl}
            <li>
                <button type="button" style="cursor:pointer; background-color: #e1e3e5; border: 0px;" onClick="javascript:checkAll(this.form['selected_fld[]'],'select_button');">
                    <img id="select_button" class="icon" src="{php}echo($this->image_dir);{/php}select_button.png" title="Seleccionar Todo" alt="Seleccionar Todo"  status="0">
                </button>
            </li>
            <li>
                <a class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>uevo cliente');" accesskey="N" tabindex="1">
                    <img border="0" src="{$params.IMAGE_DIR}customers_add.png" title="Nuevo" alt="Nuevo"><br />Nuevo Trabajador
                </a>
            </li>
        </ul>
    </div>

{elseif preg_match('/worker\.php/',$smarty.server.SCRIPT_NAME) && (($smarty.request.action eq "new")||($smarty.request.action eq "read")) }
    <div  id="title-menu"><h2>{t}{$smarty.request.action} customer{/t}</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', {$smarty.request.page});" value="Cancelar" title="Cancelar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>           
            <li>
               
                {if isset($worker->id) }
                   <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', '{$worker->id}', 'formulario');">
                       <img border="0" src="{php}echo($this->image_dir);{/php}save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar y salir
                   </a>
                
                {else}
                   <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', '0', 'formulario');">
                       <img border="0" src="{php}echo($this->image_dir);{/php}save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar y salir
                   </a>
                {/if}
                       
              
            </li>
            <li>
                <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '{$worker->id}', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}customers_add.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
            {*
            {if ($smarty.request.action eq "read")}
                 <li>
                    <a href="#" class="admin_add" onClick="saveTracking(this, '_self', 'validate', '{$worker->id}', 'formulario'); javascript:sendFormValidate(this, '_self', 'validate', '{$worker->id}', 'formulario');" value="save trackings" title="save trackings">
                        <img border="0" src="{php}echo($this->image_dir);{/php}article_add.gif" title="Save trackings" alt="Save trackings" ><br />Guardar incidencia y cliente
                    </a>
                </li>
            {/if}
            *}
            </ul>
    </div>
 {* Botonera tracking -------------------------------------------- *}
{elseif preg_match('/tracking\.php/',$smarty.server.SCRIPT_NAME) && ($smarty.request.action eq "list")}
    <div id="title-menu"><h2>{$titulo_barra}</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="javascript:enviar2(this, '_self', 'mdelete', 0);" name="submit_mult" value="Eliminar" title="Eliminar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}trash_button.gif" title="Eliminar" alt="Eliminar" ><br />Eliminar
                </a>
            </li>
            <li>
                <button type="button" style="cursor:pointer; background-color: #e1e3e5; border: 0px;" onClick="javascript:checkAll(this.form['selected_fld[]'],'select_button');">
                    <img id="select_button" class="icon" src="{php}echo($this->image_dir);{/php}select_button.png" title="Seleccionar Todo" alt="Seleccionar Todo"  status="0">
                </button>
            </li>
            <li>
                <a href="#" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>ew tracking');" accesskey="N" tabindex="1">
                    <img border="0" src="{php}echo($this->image_dir);{/php}/opinion.png" title="Nuevo tracking" alt="Nuevo tracking"><br />Nuevo tracking
                </a>
            </li>
        </ul>
    </div>

{elseif preg_match('/tracking\.php/',$smarty.server.SCRIPT_NAME) && (($smarty.request.action eq "new")||($smarty.request.action eq "read")) }
    <div  id="title-menu"><h2>{t}{$smarty.request.action} Tracking{/t}</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '{$tracking->id}', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>C</u>ancelar');" value="Cancelar" title="Cancelar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>
            <li>
                <!--
                {if isset($tracking->id) }
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', '{$tracking->id}', 'formulario');">
                {else}
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', '0', 'formulario');">
                {/if}
                    <img border="0" src="{php}echo($this->image_dir);{/php}save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                </a>
            -->
            </li>
        </ul>
    </div>

{* Botonera category -------------------------------------------- *}
{elseif preg_match('/category\.php/',$smarty.server.SCRIPT_NAME) && ($smarty.request.action eq "list") }

    <div style='float:left;margin-left:10px;margin-top:10px;'><h2>{$titulo_barra}</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>ueva Seccion');" accesskey="N" tabindex="1">
                    <img border="0" src="{php}echo($this->image_dir);{/php}advertisement.png" title="Nueva" alt="Nueva"><br />Nueva Sección
                </a>
            </li>
        </ul>
    </div>


{* Botonera category -------------------------------------------- *}
{elseif preg_match('/category\.php/',$smarty.server.SCRIPT_NAME) && (($smarty.request.action eq "read") || ($smarty.request.action eq "new")) }
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="javascript:sendFormValidate(this, '_self', 'validate', '{$category->pk_content_category}', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
            <li>><!--
                {if isset($category->pk_content_category) }
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', {$category->pk_content_category}, 'formulario');">
                {else}
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', 0, 'formulario');">
                {/if}
                    <img border="0" src="{php}echo($this->image_dir);{/php}save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                </a>
                 -->
            </li>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list',{$smarty.request.page});" value="Cancelar" title="Cancelar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>
        </ul>
    </div>
{* Botonera usuarios -------------------------------------------- *}
{elseif preg_match('/user\.php/',$smarty.server.SCRIPT_NAME) && ($smarty.request.action eq "list")}
	<div id="title-menu"><h2>{$titulo_barra}</h2></div>
	<div id="menu-acciones-admin">
            <ul>
                <li>
                    <a href="#" class="admin_add" onClick="javascript:enviar2(this, '_self', 'mdelete', 0);" name="submit_mult" value="Eliminar" title="Eliminar">
                        <img border="0" src="{php}echo($this->image_dir);{/php}trash_button.gif" title="Eliminar" alt="Eliminar" ><br />Eliminar
                    </a>
                </li>
                <li>
                    <button type="button" style="cursor:pointer; background-color: #e1e3e5; border: 0px;" onClick="javascript:checkAll(this.form['selected_fld[]'],'select_button');">
                        <img id="select_button" class="icon" src="{php}echo($this->image_dir);{/php}select_button.png" title="Seleccionar Todo" alt="Seleccionar Todos" status="0">
                    </button>
                </li>
                <li>
                    <a href="#" class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>uevo usuario');" accesskey="N" tabindex="1">
                        <img border="0" src="{php}echo($this->image_dir);{/php}user_add.png" title="Nuevo" alt="Nuevo"><br />Nuevo Usuario
                    </a>
                </li>
            </ul>
	</div>

{elseif preg_match('/user\.php/',$smarty.server.SCRIPT_NAME) && (($smarty.request.action eq "new")||($smarty.request.action eq "read")) }
	<div id="title-menu"></div>
	<div id="menu-acciones-admin">
            <ul>
                <li>
                    <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '{$user->id}', 'formulario');" value="Validar" title="Validar">
                        <img border="0" src="{php}echo($this->image_dir);{/php}user_validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                    </a>
                </li>
                <li>
                    <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>C</u>ancelar');" value="Cancelar" title="Cancelar">
                        <img border="0" src="{php}echo($this->image_dir);{/php}cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                    </a>
                </li>
                <li>
                    {if isset($user->id) }<!--
                        <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', {$user->id}, 'formulario');">
                    {else}
                        <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', 0, 'formulario');">
                    {/if}
                        <img border="0" src="{php}echo($this->image_dir);{/php}save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                    </a>-->
                </li>
            </ul>
	</div>
	
{* Botonera grupos de usuarios -------------------------------------------- *}
{elseif preg_match('/user_groups\.php/',$smarty.server.SCRIPT_NAME) && ($smarty.request.action eq "list")}
    <div id="title-menu"><h2>{$titulo_barra}</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>uevo grupo de usuarios');" accesskey="N" tabindex="1">
                    <img border="0" src="{php}echo($this->image_dir);{/php}group_add.png" title="Nuevo" alt="Nuevo"><br />Nuevo grupo de Usuarios
                </a>
            </li>
        </ul>
    </div>

{elseif preg_match('/user_groups\.php/',$smarty.server.SCRIPT_NAME) && (($smarty.request.action eq "new")||($smarty.request.action eq "read"))}
    <div id="title-menu"></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '{$user_group->id}', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}user_validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>C</u>ancelar');" value="Cancelar" title="Cancelar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>
            <li>
                {if isset($user_group->id) }<!--
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', {$user_group->id}, 'formulario');">
                {else}
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', 0,'formulario');">
                {/if}
                    <img border="0" src="{php}echo($this->image_dir);{/php}save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                </a>-->
            </li>
        </ul>
    </div>

{* Botonera privilegios -------------------------------------------- *}
{elseif preg_match('/privileges\.php/',$smarty.server.SCRIPT_NAME) && ($smarty.request.action eq "list")}
    <div id="title-menu"><h2>{$titulo_barra}</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'new', 0);" onmouseover="return escape('<u>N</u>ueva privilegios');" accesskey="N" tabindex="1">
                    <img border="0" src="{php}echo($this->image_dir);{/php}privilege_add.png" title="Nuevo" alt="Nuevo"><br />Nuevo Privilegio
                </a>
            </li>
        </ul>
    </div>

{elseif preg_match('/privileges\.php/',$smarty.server.SCRIPT_NAME) && (($smarty.request.action eq "new")||($smarty.request.action eq "read"))}	
    <div id="title-menu"></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onClick="sendFormValidate(this, '_self', 'validate', '{$privilege->id}', 'formulario');" value="Validar" title="Validar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}validate.png" title="Guardar y continuar" alt="Guardar y continuar" ><br />Guardar y continuar
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>C</u>ancelar');" value="Cancelar" title="Cancelar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}cancel.png" title="Cancelar" alt="Cancelar" ><br />Cancelar
                </a>
            </li>
            <li>
                {if isset($privilege->id) }
<!--                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'update', '{$privilege->id}', 'formulario');">
                {else}
                    <a href="#" onClick="javascript:sendFormValidate(this, '_self', 'create', '0', 'formulario');">
                {/if}
                    <img border="0" src="{php}echo($this->image_dir);{/php}save.gif" title="Guardar y salir" alt="Guardar y salir"><br />Guardar
                </a>-->
            </li>
        </ul>
    </div>

{* Botonera Search_avanced ----------------------------------------------- *}
 {elseif preg_match('/search_advanced\.php/',$smarty.server.SCRIPT_NAME) && ((!isset($smarty.request.action)) || ($smarty.request.action neq "read"))}
    <div id="title-menu"><h2>{$titulo_barra}</h2></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'search', 0);" onmouseover="return escape('<u>S</u>earch');" accesskey="N" tabindex="1">
                    <img border="0" src="{php}echo($this->image_dir);{/php}checkout.png" title="Search" alt="Search"><br />Search
                </a>
            </li>
        </ul>
    </div>

 {elseif preg_match('/search_advanced\.php/',$smarty.server.SCRIPT_NAME) && ($smarty.request.action eq "read")}
    <div id="title-menu"></div>
    <div id="menu-acciones-admin">
        <ul>
            <li>
                <a href="#" class="admin_add" onclick="enviar(this, '_self', 'search',0);" onmouseover="return escape('<u>S</u>earch');" accesskey="N" tabindex="1">
                    <img border="0" src="{php}echo($this->image_dir);{/php}cancel.png" title="Cancel" alt="Search"><br />Cancelar
                </a>
            </li>
        </ul>
    </div>
    

{* Botonera Papelera -------------------------------------------- *}
{elseif preg_match('/litter\.php/',$smarty.server.SCRIPT_NAME)}
    <div id="title-menu"><h2>{$titulo_barra}</h2></div>
    <div id="menu-acciones-admin">
        <ul>
             <li>
                <a href="#" class="admin_add" onClick="javascript:enviar2(this, '_self', 'mremove', 6);"  onmouseover="return escape('<u>E</u>liminar todos');" name="submit_mult" value="Eliminar todos">
                    <img border="0" src="{php}echo($this->image_dir);{/php}trash_button.gif" alt="Eliminar todos"><br />Eliminar todos
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="javascript:enviar3(this, '_self', 'mremove', 0);" name="submit_mult" value="Eliminar" title="Eliminar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}trash_button.gif" title="Eliminar" alt="Eliminar"><br />Eliminar
                </a>
            </li>
            <li>
                <a href="#" class="admin_add" onClick="javascript:enviar3(this, '_self', 'm_no_in_litter', 0);" name="submit_mult" value="Recuperar" title="Recuperar">
                    <img border="0" src="{php}echo($this->image_dir);{/php}trash_no.png" title="Recuperar" alt="Recuperar"><br />Recuperar
                </a>
            </li>
            <li>
                <button type="button" style="cursor:pointer; background-color: #e1e3e5; border: 0px;" onClick="javascript:checkAll(this.form['selected_fld[]'],'select_button');">
                    <img id="select_button" class="icon" src="{php}echo($this->image_dir);{/php}select_button.png" title="Seleccionar Todo" alt="Seleccionar Todo"  status="0">
                </button>
            </li>
        </ul>
    </div>

 {* Botonera Subversion -------------------------------------------- *}
 {elseif preg_match('/svn\.php/',$smarty.server.SCRIPT_NAME)}
	<div style="float:left"></div>
	<div id="menu-acciones-admin">
		<ul>
			<li>
				<a href="#" class="admin_add" onclick="enviar(this, '_self', 'status', 0);" onmouseover="return escape('<u>S</u>tatus');" accesskey="N" tabindex="1">
					<img border="0" src="{php}echo($this->image_dir);{/php}checkout.png" title="Status" alt="Status"><br />Status
				</a>
			</li>
			<li>
				<a href="#" class="admin_add" onclick="enviar(this, '_self', 'update', 0);" onmouseover="return escape('<u>U</u>pdate');" accesskey="N" tabindex="1">
					<img border="0" src="{php}echo($this->image_dir);{/php}checkout.png" title="Update" alt="Update"><br />Update
				</a>
			</li>
			<li>
				<a href="#" class="admin_add" onclick="enviar(this, '_self', 'co', 0);" onmouseover="return escape('<u>C</u>heckout');" accesskey="N" tabindex="1">
					<img border="0" src="{php}echo($this->image_dir);{/php}checkout.png" title="Checkout" alt="Checkout"><br />Checkout
				</a>
			</li>
			{* <li>
				<a href="#" class="admin_add" onclick="enviar(this, '_self', 'info', 0);" onmouseover="return escape('<u>I</u>nfo');" accesskey="N" tabindex="1">
					<img border="0" src="{php}echo($this->image_dir);{/php}info.png" title="Info" alt="Info"><br />Info
				</a>
			</li> *}
            <li>
				<a href="#" class="admin_add" onclick="enviar(this, '_self', 'list', 0);" onmouseover="return escape('<u>L</u>ist');" accesskey="N" tabindex="1">
					<img border="0" src="{php}echo($this->image_dir);{/php}list.png" title="List" alt="List"><br />List
				</a>
			</li>
		</ul>
	</div>

{/if}
