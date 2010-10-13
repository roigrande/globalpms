{include file="header.tpl"}
<table class="adminform">
    <tbody>
        <tr>
            <td colspan="2">
                <div id="cpanel" >
                    

                	<div style="float: left;">
                        <div class="icon">                            
                            <a href="/admin/customers.php?action=list">
                                <img alt="" src="{$params.IMAGE_DIR}/customers.png"/>
                                <span>Clientes</span>
                            </a>                            
                        </div>
                    </div>
             
                    
                    {acl isAllowed="USER_ADMIN"}
                    <div style="float: left;">
                        <div class="icon">
                            <a href="/admin/tracking.php?action=list">
                                <img alt="" src="{$params.IMAGE_DIR}opinion.png"/>
                                <span>Incidencias</span>
                            </a>
                        </div>
                    </div>
                    {/acl}
                     {acl isAllowed="USER_ADMIN"}
                	<div style="float: left;">
                        <div class="icon">
                            <a href="/admin/category.php?action=list">
                                <img alt="" src="{$params.IMAGE_DIR}iconos/frontpage_manager.png"/>
                                <span>Secciones</span>
                            </a>
                        </div>
                    </div>
                    {/acl}
                    {acl isAllowed="USER_ADMIN"}
                	<div style="float: left;">
                        <div class="icon">
                            <a href="/admin/user.php?action=new&category=0">
                                <img alt="" src="{$params.IMAGE_DIR}advertisement.png"/>
                                <span>Usuarios</span>
                            </a>
                        </div>
                    </div>
                    {/acl}
                    
                   
                    
                    {acl isAllowed="USER_ADMIN"}
                    <div style="float: left;">
                        <div class="icon">
                            <a href="">
                                <img alt="" src="{$params.IMAGE_DIR}iconos/draft_manager.png"/>
                                <span>Logs</span>
                            </a>
                        </div>
                    </div>
                    {/acl}
                                       
                    {acl isAllowed="USER_ADMIN"}
                    <div style="float: left;">
                        <div class="icon">
                            <a href="">
                                <img alt="" src="{$params.IMAGE_DIR}newsletter/mail_message_new.png"/>
                                <span>Envío Mail</span>
                            </a>
                        </div>
                    </div>
                    {/acl}  
                    
                </div>
            </td>
        </tr>
        
    </tbody>
</table>
{include file="footer.tpl"}