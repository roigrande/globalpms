{include file="header.tpl"}

{* LISTADO ******************************************************************* *}
{if !isset($smarty.request.action) || $smarty.request.action eq "list"}

{include file="botonera_up.tpl"}
{* Filters: filter[name], filter[login], filter[group]  *}
<table class="adminheading">
	<tr>
		<th nowrap="nowrap" align="right">
            <label>Nombre:
            <input name="filter[name]" onchange="$('action').value='list';this.form.submit();" value="{$smarty.request.filter.name}" /></label>                
            &nbsp;&nbsp;&nbsp;

            <label>Login:
            <input name="filter[login]" onchange="$('action').value='list';this.form.submit();" value="{$smarty.request.filter.login}" /></label>
            &nbsp;&nbsp;&nbsp;
            
            <label>Grupo:
            <select name="filter[group]" onchange="$('action').value='list';this.form.submit();">
                {html_options options=$groupsOptions selected=$smarty.request.filter.group}
            </select></label>            
            
            <input type="hidden" name="page" value="{$smarty.request.page}" />
        </th>
	</tr>	
</table>


<table border="0" cellpadding="4" cellspacing="0" class="adminlist">
<thead>
<tr>    
    <th class="title" align="left" style="width:40%;padding:10px;">Nombre Apellidos  </th>
    <th class="title" style="width:20%;padding:10px;">Login</th>
    <th class="title" style="width:20%;padding:10px;">Grupo</th>
    <th class="title" style="width:10%;padding:10px;" align="center">Editar</th>
    <th class="title" style="width:10%;padding:10px;" align="center">Eliminar</th>
</tr>
</thead>

<tbody>
{section name=c loop=$users}
<tr bgcolor="{cycle values="#eeeeee,#ffffff"}">

	<td style="padding:10px;">
                <input type="checkbox" class="minput"  id="selected_{$smarty.section.c.iteration}" name="selected_fld[]" value="{$users[c]->id}"  style="cursor:pointer;" ">
		<a href="?action=read&id={$users[c]->id}" title="Editar usuario">
            {$users[c]->name}&nbsp;{$users[c]->firstname}&nbsp;{$users[c]->lastname}</a>
	</td>
	<td style="padding:10px;"> 
		{$users[c]->login}
	</td>
	<td style="padding:10px;"> 
		{section name=u loop=$user_groups}
			{if $user_groups[u]->id == $users[c]->fk_user_group}
					{$user_groups[u]->name}
	  		{/if}
		{/section}
	</td>
	<td style="padding:10px;" align="center">
		<a href="#" onClick="javascript:enviar(this, '_self', 'read', {$users[c]->id});" title="Modificar">
			<img src="{php}echo($this->image_dir);{/php}edit.png" border="0" /></a>
	</td>
	<td style="padding:10px;" align="center">
		<a href="#" onClick="javascript:confirmar(this, {$users[c]->id});" title="Eliminar">
			<img src="{php}echo($this->image_dir);{/php}trash.png" border="0" /></a>
	</td>
</tr>
{sectionelse}
<tr colspan="5">
	<td align="center"><b>Ning&uacute;n usuario guardado.</b></td>
</tr>
{/section}
</tbody>

{if count($users) gt 0}
    <tfoot>
    <tr>
        <td colspan="5" align="center">{$paginacion->links}</td>
    </tr>
    </tfoot>
{/if}

</table>
{/if}


{* FORMULARIO PARA ENGADIR OU MODIFICAR UN CONTENIDO ************************************** *}
{if isset($smarty.request.action) && (($smarty.request.action eq "new") || ($smarty.request.action eq "read"))}
<script language="javascript" type="text/javascript" src="{$params.JS_DIR}SpinnerControl.js"></script>
<script language="javascript" type="text/javascript" src="{$params.JS_DIR}modalbox.js"></script>

<link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}modalbox.css" media="screen" />

{literal}
<style>
.spinner_button {
    width: 18px;
    height: 18px;
    
    color: #204A87;
    font-weight: bold;
    background-color: #DDD;
    
    border-top: 1px solid #CCC;
    border-right: 1px solid #999;
    border-bottom: 1px solid #999;
    border-left: 1px solid #CCC;
}

.spinner_button:hover {
    background-color: #EEE;
    
    border-top: 1px solid #DDD;
    border-right: 1px solid #CCC;
    border-bottom: 1px solid #CCC;
    border-left: 1px solid #DDD;    
}
</style>
{/literal}

{include file="botonera_up.tpl"}

	<table  border="0" cellpadding="4" cellspacing="0" class="fuente_cuerpo" width="100%">
	<tr>
        <td valign="top" width="50%">
            
			<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo">
			<tbody>
                
			<!-- Login -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="login">Login:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="login" name="login" title="Login del usuario"
						value="{$user->login}" class="required"  size="14" maxlength="20" />
				</td>
			</tr>
            
			<!-- Password -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="password">Password:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="password" id="password" name="password" title="Password"  size="20" autocomplete="off"
						value="" class="{if $smarty.request.action eq "new"}required validate-password{/if}" />
				</td>
			</tr>
            
            <!-- Password Confirm-->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="passwordconfirm">Confirmar Password:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="password" id="passwordconfirm" name="passwordconfirm" title="Confirm Password"  size="20"
						value="" autocomplete="off" class="{if $smarty.request.action eq "new"}required{/if} validate-password-confirm" />
				</td>
			</tr>
            
            <!-- SessionExpire -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="sessionexpire">Tiempo de expiraci&oacute;n de sesi&oacute;n:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
                    
                    <input type="text" id="sessionexpire" name="sessionexpire" title="Expiraci&oacute;n de Sessi&oacute;n"
						value="{$user->sessionexpire|default:"15"}" class="required validate-digits" style="text-align:right" size="4" />
                    <input id="up" class="spinner_button" type="button" value="+" />
                    <input id="dn" class="spinner_button" type="button" value="-" />
                    
                    <sub>minutos</sub>
				</td>
			</tr>
            
			<!-- Email -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="email">Correo Electr&oacute;nico:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="email" name="email" title="Correo Electr&oacute;nico"
						value="{$user->email}" class="required validate-email"  size="50"/>
				</td>
			</tr>
            
			<!-- Nome -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="name">Nombre:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="name" name="name" title="Nombre del usuario"
						value="{$user->name}" class="required"  size="50"/>
				</td>
			</tr>
            
			<!-- Primeiro apelido -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="firstname">Primer Apellido:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="firstname" name="firstname" title="Primer apellido del usuario"
						value="{$user->firstname}" class="required"  size="50"/>
				</td>
			</tr>
            
			<!-- Segundo apelido -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="lasname">Segundo Apellido:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="lastname" name="lastname" title="Segundo apellido del usuario"
						value="{$user->lastname}"  size="50"/>
				</td>
			</tr>
            
			<!-- Direccion -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="address">Direcci&oacute;n:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="address" name="address" title="Direcci&oacute;n del usuario"
						value="{$user->address}"  size="50"/>
				</td>
			</tr>
            
			<!-- Telefono -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="phone">Tel&eacute;fono:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<input type="text" id="phone" name="phone" title="Tel&eacute;fono del usuario" class="validate-digits"
						value="{$user->phone}"  size="15"/>
				</td>
			</tr>
            
            </tbody>
            </table>
            
        </td>
        <td valign="top" width="50%">
            
            
            <table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="100%">
            </tbody>
            
			<!-- User_Group -->
			<tr>
				<td valign="top" align="right" style="padding:4px;" width="40%">
					<label for="id_user_group">Grupo al que pertenece:</label>
				</td>
				<td style="padding:4px;" nowrap="nowrap" width="60%">
					<select id="id_user_group" name="id_user_group" title="Grupo de usuario" class="validate-selection" onchange="onChangeGroup(this, new Array('comboAccessCategory','labelAccessCategory'));">
                        <option  value ="" selected="selected"> </OPTION>
						{section name=user_group loop=$user_groups}
							{if $user_groups[user_group]->id == $user->id_user_group}
                                <option  value = "{$user_groups[user_group]->id}" selected="selected">{$user_groups[user_group]->name}</option>
					  		{else}
								<option  value = "{$user_groups[user_group]->id}">{$user_groups[user_group]->name}</option>
							{/if}
						{/section}
					</select>
                    
                    {* FIXME: separar todo a un fichero js que tenga las funcionalidades de los usuarios *}
                    {literal}
                    <script type="text/javascript">
                    function showGroupUsers(elto) {
                        /* Modalbox.show('user_groups.php?action=read&id=' + $('id_user_group').value, {
                            title: elto.title, width: 800, height: 640}); */
                        /*if( confirm('¿Está seguro de querer salir de la edición del usuario?') ) {
                            window.open('user_groups.php?action=read&id=' + $('id_user_group').value, 'centro');
                        }*/
                        
                        Modalbox.show('<iframe width="100%" height="450" src="user_groups.php?action=read&id=' + $('id_user_group').value+'"  frameborder="0" marginheight="0" marginwidth="0"></iframe>', {title: 'Gestión de grupos de usuarios', width: 760});
                    }
                    </script>
                    {/literal}
                    
                    <a href="javascript:void(0);" title="Editar grupo y permisos" onclick="showGroupUsers(this);return false;">
                        <img src="{$params.IMAGE_DIR}users_edit.png" border="0" style="vertical-align: middle;" /></a>
				</td>
			</tr>
            
       
			
			</tbody>
			</table>
	</td>	
	</tr>
	</table>

    {*literal}
    <script type="text/javascript" language="javascript">
        document.observe('dom:loaded', function(){
            onChangeGroup( document.formulario.id_user_group, new Array('comboAccessCategory','labelAccessCategory') );
            
            // Refrescar los elementos seleccionados
            $('ids_category').select('option').each(function(item){
                if( item.getAttribute('selected') ) {
                    item.selected=true;
                    item.setAttribute('selected', 'selected');
                }
            });
            
            new SpinnerControl('sessionexpire', 'up', 'dn', {interval: 5,  min: 15, max: 250});
        });
        
    </script>
    {/literal*}

{/if}

{include file="footer.tpl"}