<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');
$sessions = $GLOBALS['Session']->getSessions();

// FIXME: está páxina ten que pasar a ser unha template Smarty
// Prueba
require_once('core/privileges_check.class.php');
require_once('core/method_cache_manager.class.php');
require_once('core/user.class.php');

$RESOURCES_PATH = 'themes/default/';

// Check gmail inbox
$mailbox = null;
if(isset($_SESSION['authGmail'])) {
    $user = new User();
    $mailbox = $user->cache->parseGmailInbox(base64_decode($_SESSION['authGmail']));        
}
// Control de sesiones de usuarios
//require_once('core/user.class.php');


if( Privileges_check::CheckPrivileges('USR_ADMIN') ) {
    // Peticiones por Ajax
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
        $action = (isset($_REQUEST['action']))? $_REQUEST['action']: 'list';
        switch($action) {
            case 'purge':
                if($_SESSION['userid']!=$_REQUEST['userid']) {
                    $GLOBALS['Session']->purgeSession( intval($_REQUEST['userid']) );
                    // Volver a actualizar as sesións
                    $sessions = $GLOBALS['Session']->getSessions();
                }
            
            case 'show_panel':
                $html = '<table width="90%" align="center"><tr></tr>';
$tpl_user =<<< TPLUSER
<tr>
    <td>%s</td>
    <td align="center">%s</td>
    <td align="center">
        <a href="user.php?action=read&id=%s" title="Editar usuario" onclick="Modalbox.hide();" target="centro">
            <img src="{$RESOURCES_PATH}images/users_edit.png" border="0" /></a>  
        <a href="index.php?action=purge&userid=%s" class="modal" title="Purgar sesión">
            <img src="{$RESOURCES_PATH}images/publish_r.png" border="0" /></a>
    </td>
    <td><img src="{$RESOURCES_PATH}images/iconos/%s.gif" border="0" alt="" title="%s" /></td>
</tr>
TPLUSER;
                
$tpl_admin =<<< TPLADMIN
<tr>
    <td>%s</td>
    <td align="center">%s</td>
    <td align="center">-</td>
    <td><img src="{$RESOURCES_PATH}images/iconos/%s.gif" border="0" alt="" title="%s" /></td>
</tr>
TPLADMIN;
                $authMethodTitles = array('database' => 'Base de datos autenticado', 'google_clientlogin' => 'Google autenticado');
                foreach($sessions as $session) {                    
                    $authMethod = (isset($session['authMethod']))? $session['authMethod']: 'database';
                    if(($session['userid']!=$_SESSION['userid']) && ($_SESSION['isAdmin'])) {
                        $html .= sprintf($tpl_user, $session['username'],  date(' H:i ', $session['expire']),
                                         $session['userid'], $session['userid'], $authMethod, $authMethodTitles[$authMethod]);
                    } else {
                        $html .= sprintf($tpl_admin, $session['username'], date(' H:i ', $session['expire']),
                                         $authMethod, $authMethodTitles[$authMethod]);
                    }
                }
                
                $html .= '</table>';
                //echo( $html );
            break;                                    
        
            case 'list':
            default:
                echo json_encode( $sessions );            
            break;        
        }
        
        exit(0); // Finalizar la petición por Ajax
    }
}

//Para crear noticia que vuelva a listado de pendientes.
$_SESSION['desde']='index_portada';
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>..: Panel de Control :..</title>
<link rel="stylesheet" type="text/css" href="<?php echo $RESOURCES_PATH?>css/general.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $RESOURCES_PATH?>css/modalbox.css" media="screen" />


<style type="text/css">
body {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}

#user_activity {
    background:transparent url(<?php echo $RESOURCES_PATH?>images/users_activity.png) top right no-repeat;
    cursor: pointer;
    text-align: right;
    padding:2px 20px 2px 2px ;
    float: left;
	margin:0 5px;
	color:#ccc;
}

#user_mailbox {    
    text-align: right;
    padding:2px 20px 2px 2px ;
    float: left;
	margin:0 5px;
	color:#ccc;
    padding: 2px;
}

#user_box {    
    color: #0B55C4;
    font-size: 12px;
    font-weight: bold;
    float: right;
    margin-right: 4px;
}

#user_live {
    float: left;
    border-right:  1px solid #CCC;
    border-bottom: 1px solid #CCC;
    background-color: inherit;

    width: 20px;
    padding: 2px 2px 2px 2px;
}

#user_live:hover {
    background-color: #FFF;
}
</style>

<script type="text/javascript" src="<?php echo $RESOURCES_PATH?>js/prototype.js"></script>
<script type="text/javascript" src="<?php echo $RESOURCES_PATH?>js/scriptaculous/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="<?php echo $RESOURCES_PATH?>js/modalbox.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo $RESOURCES_PATH?>js/ypSlideOutMenus.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $RESOURCES_PATH?>js/utils.js"></script>
<script language="javascript" type="text/javascript">
<!-- //
sinFrames();
// -->
</script>
<script type="text/javascript" language="javascript">
function salir() {
    if(confirm('¿Desea salir del panel de administración?')) {
        location.href = 'logout.php';
    }
}
</script>
<script type="text/javascript" language="javascript">
//  new ypSlideOutMenu("number menu", "slide position", left, top, width, height)
    //new ypSlideOutMenu("sub1","down",144,44,190,400)
    //new ypSlideOutMenu("sub2","down",265,44,150,200)
    //new ypSlideOutMenu("sub3","down",394,44,150,200)
    //new ypSlideOutMenu("sub4","down",507,44,160,400)
    //new ypSlideOutMenu("sub5","down",628,44,150,200)
    //new ypSlideOutMenu("sub6","down",749,44,150,200)
    //new ypSlideOutMenu("sub7","down",870,44,150,300)
    //new ypSlideOutMenu("sub8","down",991,44,160,300)
    
</script>
</head>

<body margin="0" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">

<table style="border: 1px solid rgb(0, 75, 142); width: 100%;" width="100%" height="100%" cellpadding="0" cellspacing="0">
<tbody>
	<tr>
		<td id="ocultar" height="100%" valign="top">
				<table id="topbar-admin" cellpadding="0" cellspacing="0">
				<tr>
					<td id="logoonm">
						<a href="index.php"  class="logout" title="Ir a la página principal de administración">
							<img src="<?php echo $RESOURCES_PATH?>images/logo-opennemas.png" border="0" align="absmiddle" alt="Inicio" width="136" height=30"" />&nbsp;
						</a>
					</td>
					<td>                                                
                        <?php
                            require_once( SITE_ADMIN_PATH.'libs/menu.class.php');
                            $menu = new Menu();
                            require 'include/menu.php';
                            
                            $ypMenu = $menu->getMenu('YpMenu', $menuXml, 1);
                            
                            echo $ypMenu;                             
                        ?>                            
					</td>

                    <td style="font-size: 12px;width:100%; color: #666;" nowrap="nowrap">
                        <div id="user_box" style="width:auto;">
                            
                            <div id="name-box" style="float:left; margin-right:5px;">
                              <strong>
                                Bienvenido 
                                <a href="/admin/user.php?action=read&id=<?php echo($_SESSION['userid']); ?>" target="centro">
                                	<?php echo($_SESSION['username']); ?>
                                </a>
                                <?php if($_SESSION['isAdmin']): ?>
                                    <img src="<?php echo $RESOURCES_PATH?>images/key.png" border="0" align="absmiddle"
                                        title="Permisos de administrador" alt="" />
                                <?php endif; ?>
                              </strong>
                            </div><!--end name-box-->
                            
                            <?php if(Acl::_('BACKEND_ADMIN')): ?>                        
                            <div style="padding-right:4px; float:left;" nowrap="nowrap">						
                                <div id="user_activity" title="Usuarios activos na sección de administración">
                                    <?php echo count($sessions) ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        
                            <div id="session-actions" style="float:left;">
                              <a href="javascript:salir();" class="logout" title="Salir del panel de control">
                                  <img src="<?php echo $RESOURCES_PATH?>images/logout.png" border="0"
                                      align="absmiddle" alt="Salir del Panel de Administración" /> Salir
                              </a>
                            </div><!--end session-actions -->
                        </div>
                        
                        <?php if(!is_null($mailbox)): ?>
                        <div id="user_mailbox">                            
                            <a href="https://www.google.com/accounts/ServiceLoginAuth?service=mail&Email=<?php echo $_SESSION['email'] ?>&continue=https%3A%2f%2fmail.google.com%2fmail"
                               title="Ir a GMail &lt;<?php echo $_SESSION['email'] ?>&gt;"
                               target="_blank">
                                    <span><?php echo $mailbox['total'] ?></span>
                                    <img src="<?php echo $RESOURCES_PATH?>images/gmail_ico.png" border="0" align="absmiddle" />
                            </a>
                        </div>
                        <?php endif; ?>
                    </td>
				</tr>

				<tr>
					<td valign="top" align="left" width="100%" height="100%" colspan="4">
                        <?php
                        $defaultUri = 'welcome.php';
                        if(isset($_REQUEST['go'])) {
                            $defaultUri = $_REQUEST['go'];
                        }
                        ?>
                        <iframe onload="get_height(this);" name="centro" width="100%" height="550" src="<?php echo $defaultUri; ?>"
                                frameborder="0" marginheight="0" marginwidth="0" align="top" scrolling="auto">
                            Para el panel de administración necesita un navegador que soporte iframes</iframe>
                        
                    </td>
				</tr>
				</table>

		</td>
	</tr>
</tbody>
</table>


<script type="text/javascript">
/* <![CDATA[ */
new YpSlideOutMenuHelper();

<?php if(Acl::_('USR_ADMIN')): ?>
var users_online = [];
function linkToMB() {
    $('MB_content').select('td a.modal').each(function(item) {
        item.observe('click', function(event) {
            Event.stop(event);

            Modalbox.show(this.href, {
                title: 'Usuarios activos',
                afterLoad: linkToMB,
                width: 300
            });
        });
    });
}

document.observe('dom:loaded', function() {
    if( $('user_activity') ) {
        $('user_activity').observe('click', function() {
            Modalbox.show('./index.php?action=show_panel', {
                title: 'Usuarios activos',
                afterLoad: linkToMB,
                width: 300
            });
        });

        new PeriodicalExecuter( function(pe) {
            $('user_activity').update('<img src="<?php echo $RESOURCES_PATH?>images/loading.gif" border="0" width="16" height="16" />');
            new Ajax.Request('index.php', {
                onSuccess: function(transport) {
                    // Actualizar o número de usuarios en liña e gardar o array en users_online
                    eval('users_online = ' + transport.responseText + ';');
                    $('user_activity').update( users_online.length );

                    //new Effect.Hightlight('user_activity', {startcolor: '#ffff99', endcolor: '#ffffff'});
                }
            });
            //pe.stop();
        }, 5*60); // Actualizar cada 2*60 segundos
    }
});
<?php endif; ?>
/* ]]> */
</script>

</body>
</html>
