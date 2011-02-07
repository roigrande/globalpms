{include file="privilege/header.tpl"}


{* LISTADO ******************************************************************* *}
{if $smarty.request.action eq "list"}

{include file="botonera_up.tpl"}

<table class="adminheading">
	<tr>
		<th nowrap>
            <label>Filtrar por módulo:
                <select name="module" onchange="$('action').value='list';$('formulario').submit();">
                    <option value="">-- TODOS --</option>
                    {section name="mods" loop=$modules}                    
                    <option value="{$modules[mods]}"{if $modules[mods] eq $smarty.request.module} selected="selected"{/if}>{$modules[mods]}</option>
                    {/section}
                </select>
            </label>
        </th>
	</tr>	
</table>

{literal}    
<style>
table.adminlist td,
table.adminlist th {
    padding: 8px;
}
</style>
{/literal}

<table border="0" cellpadding="8" cellspacing="0" class="adminlist">
<tr>
    <th align="left">Nombre del Permiso</th>
    <th align="left">Descripción</th>
    
    <th align="left">Módulo</th>
    
    <th align="center">Editar</th>
    <th align="center">Eliminar</th>
</tr>
{section name=c loop=$privileges}
<tr bgcolor="{cycle values="#eeeeee,#ffffff"}">
    <td>
		{$privileges[c]->name}
	</td>

	<td>
		{$privileges[c]->description}
	</td>

	<td>
		{$privileges[c]->module}
	</td>    
    
	<td align="center">
		<a href="#" onClick="javascript:enviar(this, '_self', 'read', '{$privileges[c]->id}');" title="Modificar">
			<img src="{php}echo($this->image_dir);{/php}edit.png" border="0" /></a>
	</td>
	<td align="center">
		<a href="#" onClick="javascript:confirmar(this, '{$privileges[c]->id}');" title="Eliminar">
			<img src="{php}echo($this->image_dir);{/php}trash.png" border="0" /></a>
	</td>
</tr>
{sectionelse}
<tr>
	<td colspan="5" align="center"><b>Ning&uacute;n permiso guardado.</b></td>
</tr>
{/section}
    {if count($privileges) gt 0}
    <tr>
        <td colspan="5" align="center">{$paginacion->links}</td>
    </tr>
    {/if}
</table>
{/if}

{* FORMULARIO PARA ENGADIR UN permiso ************************************** *}
{if (($smarty.request.action eq "new") || ($smarty.request.action eq "read"))}

<style type="text/css">
{literal}
div.autocomplete {
    margin:0px;
    padding:0px;
    width:250px;
    background:#fff;
    border:1px solid #888;
    position:absolute;
}

div.autocomplete ul {
    margin:0px;
    padding:0px;
    list-style-type:none;
}

div.autocomplete ul li.selected {
    background-color:#ffb;
}

div.autocomplete ul li {
    margin:0;
    padding:2px;
    height:32px;
    display:block;
    list-style-type:none;
    cursor:pointer;    
} 
{/literal}
</style>

{include file="botonera_up.tpl"}

<table border="0" cellpadding="0" cellspacing="0" class="fuente_cuerpo" width="600">
<tbody>

{* Módulo *}
<tr>
	<td valign="top" align="right" style="padding:4px;" width="30%">
		<label for="module">Módulo:</label>
	</td>
	<td style="padding:4px;" nowrap="nowrap" width="70%">
		<input type="text" id="module" name="module" title="Módulo" size="20" maxlength="40"
			value="{$privilege->module}" class="required" />
	</td>
</tr>

{* Name *}
<tr>
	<td valign="top" align="right" style="padding:4px;" width="30%">
		<label for="description">Nombre:</label>
	</td>
	<td style="padding:4px;" nowrap="nowrap" width="70%">
		<input type="text" id="name" name="name" title="Nombre" value="{$privilege->name}" class="required" />
        <sub>(recomendación: MODULO_ACCION)</sub>
	</td>
</tr>

{* Descripcion *}
<tr>
	<td valign="top" align="right" style="padding:4px;" width="30%">
		<label for="description">Descripci&oacute;n:</label>
	</td>
	<td style="padding:4px;" nowrap="nowrap" width="70%">
		<input type="text" id="description" name="description" title="Descripci&oacute;n" size="80" maxlength="100"
			value="{$privilege->description}" class="required" />
	</td>
</tr>
</tbody>
</table>
</div>
  
<script type="text/javascript">
{literal}
/**
 *
 */
var PrivilegeHelper = Class.create({
    initialize: function(module, name, options) {
        this.module  = $(module);
        this.name    = $(name);
        this.modules = options.modules || [];
        
        //<div class="autocomplete" style="display:none"></div>
        divList = new Element('div', {class: 'autocomplete', style: {display: 'none'}});
        this.module.up().insert(divList, {position: 'after'});
        
        new Autocompleter.Local(this.module, divList, this.modules, {ignoreCase: true, partialChars: 3, partialSearch: false});
        
        this._addBehavior();
    },
    
    _addBehavior: function() {
        this.module.observe('keyup', this.updateSpanCallback.bind(this));
        this.module.observe('blur', this.updateSpanCallback.bind(this));
        this.module.observe('change', this.updateSpanCallback.bind(this));                
    },
    
    updateSpanCallback: function() {
        // set to uppercase
        this.module.value = this.module.value.toUpperCase();        
        if(/.+_/.test(this.name.value)) {
            this.name.value = this.module.value + '_' + this.name.value.replace(/[^_]+_(.*?)$/, '$1');                        
        } else {
            this.name.value = this.module.value + '_' + this.name.value;
        }
        
        this.name.value = this.name.value.replace(/_+/g, '_').toUpperCase();
    }
});

new PrivilegeHelper('module', 'name', {modules: {/literal}{json_encode value=$modules}{literal}});
{/literal}
</script>
{/if}

{include file="privilege/footer.tpl"}