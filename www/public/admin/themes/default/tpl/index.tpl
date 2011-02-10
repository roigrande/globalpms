
{extends file="base/admin.tpl"}
{block name="header-css" append}
<link rel="stylesheet" type="text/css" href="{$params.CSS_DIR}utilities.css"/>
{/block}

{block name="footer-js" append}
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}prototype.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}prototype-date-extensions.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}scriptaculous/scriptaculous.js?load=effects,dragdrop"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}fabtabulous.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}validation.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}datepicker.js"></script>
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}MessageBoard.js"></script>

{* Ajax button to change availability *}
<script type="text/javascript" language="javascript" src="{$params.JS_DIR}switcher_flag.js"></script>
<script type="text/javascript" language="javascript">
/* <![CDATA[ */
{literal}
document.observe('dom:loaded', function() {
    $('pagina').select('a.switchable').each(function(item){
        new SwitcherFlag(item);
    });
});
{/literal}
</script>

{literal}
<script language="javascript">
// <![CDATA[
function enviar(frm, trg, acc, id) {
    frm.target = trg;
    
    $('action').value = acc;
    $('id').value = id;

    frm.submit();
}

function validateForm(formID)
{
    var checkForm = new Validation(formID, {immediate:true, onSubmit:true});
    if(!checkForm.validate()) {
        if($$('.validation-advice')) {
            if($('warnings-validation')) {
                $('warnings-validation').update('Existen campos sin cumplimentar o errores en el formulario. Por favor, revise todas las pestañas.');
                new Effect.Highlight('warnings-validation');
            }
        }
        return false;
    } else {        
        if($$('.validation-advice') && $('warnings-validation')) {
            $('warnings-validation').setStyle({display: 'none'});
        }
    }
    return true;
}

function sendFormValidate(elto, trg, acc, id, formID)
{
    if(!validateForm(formID))
        return;
       
    enviar(elto, trg, acc, id);
}

function confirmar() {
    if(confirm('¿Está seguro de querer eliminar este elemento?')) {
        window.location = this.href;
    }
}
// ]]>
</script>
{/literal}
{/block}

{block name="content"}
{literal}
<style>
div#pagina td, div#pagina th {
    font-size:11px;
    height:24px;
    padding:0 10px;
}
</style>
{/literal}

<div id="menu-acciones-admin" style="width:70%;margin:0 auto;">
<div style="float: left; margin-left: 10px; margin-top: 10px;"><h2>{t}Widget Manager{/t}</h2></div>
<ul>
    <li>
        <a href="widget.php?action=new" class="admin_add"
           title="{t}New widget{/t}">
            <img border="0" src="{$params.IMAGE_DIR}list-add.png" title="" alt="" />
            <br />{t}New{/t}
        </a>
    </li>    
</ul>
</div>

<br/>

<table class="adminheading" style="width:70%;margin:0 auto;">
    <tbody>
        <tr>
            <th>{t}Widgets{/t}</th>
        </tr>
    </tbody>
</table>

<div id="pagina">
<table border="0" cellpadding="4" cellspacing="0" class="adminlist" style="width:70%;margin:0 auto;">    
<tbody>
<thead>
    <th class="title">{t}Name{/t}</th>
    <th class="title">{t}Type{/t}</th>
    <th class="title" align="center">{t}Published{/t}</th>
    <th class="title" align="center">Actions</th>
</thead>


{section name=wgt loop=$widgets}
<tr bgcolor="{cycle values="#eeeeee,#ffffff"}">
	<td>
		{$widgets[wgt]->title}
	</td>
    
    <td width="240">
        {$widgets[wgt]->renderlet|upper}
    </td>

	<td width="100" align="center">
        {if $widgets[wgt]->available == 1}
			<a href="?id={$widgets[wgt]->pk_widget}&amp;action=changeavailable" class="switchable" title="{t}Published{/t}">
				<img src="{$params.IMAGE_DIR}publish_g.png" border="0" alt="{t}Published{/t}" /></a>
		{else}
            <a href="?id={$widgets[wgt]->pk_widget}&amp;action=changeavailable" class="switchable" title="{t}Pending{/t}">
				<img src="{$params.IMAGE_DIR}publish_r.png" border="0" alt="{t}Pending{/t}" /></a>
		{/if}        
	</td>	
	
	<td width="24">
		<ul class="action-buttons clearfix">
            
            {if ($widgets[wgt]->renderlet != 'intelligentwidget')}
		    <li>
                <a href="widget.php?action=edit&id={$widgets[wgt]->pk_widget}" title="{t}Edit{/t}">
                <img src="{$params.IMAGE_DIR}edit.png" border="0" /></a>
            </li>
            
		    <li>
                <a href="widget.php?action=delete&id={$widgets[wgt]->pk_widget}" onclick="confirmar()" title="{t}Delete{/t}">
                <img src="{$params.IMAGE_DIR}trash.png" border="0" /></a>
            </li>
            {else}
            <li></li>
            {/if}
            
		</ul>
	</td>
</tr>
{sectionelse}
<tr>
	<td align="center" colspan="5"><b>{t}No widget found{/t}.</b></td>
</tr>
{/section}
</tbody>

<tfoot>
    <tr>
        <td colspan="5" align="center">
            {$pager->links}
        </td>            
    </tr>
</tfoot>
</table>

</div>

{/block}