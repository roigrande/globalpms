<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

require_once('core/privileges_check.class.php');
if( !Privileges_check::CheckPrivileges('NOT_ADMIN')) {
    Privileges_check::AccessDeniedAction();
}

// Ejemplo para tener objeto global
require_once('core/application.class.php');
Application::import_libs('*');
$app = Application::load();

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Subversion control');

function test_url($url) {

    $addr=parse_url($url);
    $host=$addr['host'];
    $path = $addr['path'];

    $headtxt ='';

    if($sock=fsockopen($host,80, $errno, $errstr, 3))
    {
        fputs($sock, "HEAD $path HTTP/1.0\r\nHost: $host\r\n\r\n");
        while(!feof($sock)) $headtxt .= fgets($sock);
    }

    return (stripos($headtxt, "200 OK") || stripos($headtxt, "401 Authorization Required") === false) ? false:true ;
}

if(isset($_REQUEST['action']) ) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $repository = $_REQUEST['repository'];
    $destination = $_REQUEST['destination'];
    $action = $_REQUEST['action'];
    $checkout = '';$result='';

    switch($_REQUEST['action']) {
	case 'co':
        $checkout = 'svn co --username '.$username.' --password '.$password.' '.$repository.' '.$destination;
	break;
    case 'status':
        $checkout = 'svn status '.$destination;
	break;
    case 'update':
        $checkout = 'svn update --username '.$username.' --password '.$password.' '.$destination.'/*';
	break;

	case 'info':
        $checkout = 'svn info  --username '.$username.' --password '.$password.' '.$repository;

	break;

    case 'list':
        $checkout = 'svn list  --username '.$username.' --password '.$password.' '.$repository.' -v';
	break;

	default:
        Application::forward('svn.php');
	break;
	}

    $tpl->assign('checkout', $checkout);
    $tpl->assign('username', $username);
    $tpl->assign('password', $password);
    $tpl->assign('repository', $repository);
    $tpl->assign('destination', $destination);
    $tpl->assign('action', $action);
    

    if (test_url($repository) === false) $tpl->assign('return', "svn-server-error");
    else
    {
        exec($checkout, $return);
        $tpl->assign('return', $return);
    }

} else {
        $username = $_SESSION['username'];
        $password = "XXXXXXXXX";
        $repository = "http://svn.openhost.es/onm-cc/trunk/www/admin";
        $destination = "/var/www/onm-cc/admin";
        $checkout = "svn info --username $username --password $password $repository";

        exec($checkout, $return);

        $tpl->assign('checkout', $checkout);
        $tpl->assign('return', $return);
        $tpl->assign('username', $username);
        $tpl->assign('password', $password);
        $tpl->assign('repository', $repository);
        $tpl->assign('destination', $destination);
        $tpl->assign('action', "info");
}


$tpl->display('svn.tpl');

?>