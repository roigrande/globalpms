<?php
error_reporting(E_ALL);
if (preg_match('/config\.inc\.php/', $_SERVER['PHP_SELF'])) {
	die();
}

if(preg_match('/BLP_bbot/i', $_SERVER['HTTP_USER_AGENT'])) {
    header('Location: /404.html');
    exit(0);
}

$_defined_url = @defined(URL);
if( !$_defined_url ) { // definir las constantes sin identar

/* [ GENERAL ] *************************************************************** */
// http://localhost/newspaper/www/admin/
// TODO: cargar dinámicamente estas constantes para evitar problemas
//STATUS: ON==1 , OFF==0
define ('STATUS', "1");

define ('CHARSET', "text/html; charset=UTF-8");

//SITE_SEPARATOR (SS)
define ('SS', "/");

define ('SITE', "rumgest.roi");
define ('SITE_NAME', "Gestor de recursos para eventos");
define ('SITE_PATH',  "/var/www/rumgest/trunk/www" );
define ('SITE_ADMIN_DIR', "admin");
define ('SITE_ADMIN_TMP_DIR', "tmp");
define ('SITE_ADMIN_PATH', SITE_PATH.SS.SITE_ADMIN_DIR.SS);
define ('SITE_ADMIN_TMP_PATH', SITE_ADMIN_PATH.SITE_ADMIN_TMP_DIR.SS);

$protocol = 'http://';
if(preg_match('@^/admin/@', $_SERVER['REQUEST_URI'])) {
    $protocol = (!empty($_SERVER['HTTPS']))? 'https://': 'http://';
}

define ('SITE_URL', $protocol.SITE.SS);
define ('SITE_URL_ADMIN', $protocol.SITE.'/admin/');

define ('SITE_LIBS_PATH', SITE_ADMIN_PATH.SS."libs".SS);
define ('SITE_PATH_WEB', "/");
define ('SITE_TITLE', "OpenNemas - News Management System - Sistema de gestión de Noticias");
define ('SITE_DESCRIPTION', "Noticias de Ultima hora sobre la actualidad, nacional, economia, deportes, cultura, sociedad. Adema vieos, fotos, graicos, entrevistas y encuestas de opinio. xxxxxxxxxx.com, xxxxxxxxxxxxxxx.");
define ('SITE_KEYWORDS', "opennemas, demo.opennemas.com, diario, periodico, prensa, press, daily, newspaper, noticias, news, breaking news, Spain, internacional, titulares, headlines, albums, videos, sociedad, cultura, opinion, ultimas noticias, deportes, sport, encuestas, gente, politica, tendencias, tiempo, weather, buscador, especiales");

define ('URL', SITE_URL_ADMIN);
define ('URL_PUBLIC', SITE_URL);
define ('RELATIVE_PATH', SITE_ADMIN_DIR);
define ('PATH_APP', SITE_ADMIN_PATH);

/* [ SESION USUARIO ] ******************************************************** */
$GLOBALS['USER_ID'] = NULL;
$GLOBALS['conn'] = NULL;

/* [ ESTABLECER INCLUDE_PATH ] *********************************************** */
$slash		= (strtoupper(substr(PHP_OS, 0,3) == 'WIN'))? DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR:DIRECTORY_SEPARATOR;
$separador	= PATH_SEPARATOR;
function __filtro_libs($var){ return $var!=''; }
$dirs = array_filter(explode($separador, ini_get('include_path')), "__filtro_libs");
$dirs[count($dirs)] = PATH_APP."libs".$slash;
ini_set('include_path', implode($dirs, $separador));

/* [PAGER] ****************************************************************** */
define ('ITEMS_PAGE', "20");

/* [ BASE DE DATOS ] **********************************************************/
define ('BD_TYPE', "mysql");
define ('BD_HOST', "localhost");
define ('BD_USER', "root");
define ('BD_PASS', "hola");
define ('BD_INST', "bdcmp");
define ('BD_DSN', BD_TYPE."://".BD_USER.":".BD_PASS."@".BD_HOST."/".BD_INST);

/* [ SYSTEM CONFIGURATION ] ********************************************************* */
define ('SYS_LOG_DEBUG', "1");
define ('SYS_LOG_VERBOSE', "0");
define ('SYS_LOG_INFO', "1");

//define ('SYS_LOG', SITE_ADMIN_PATH."/log.txt");
define ('SYS_LOG', '/var/lib/opennemas/rumgest/log/application.log');
define ('LOG_ENABLE', 1);

define ('SYS_SESSION_TIME', "15");
define ('SYS_LOG_EMAIL', 'desarrollo@openhost.es');
define ('SYS_NAME_GROUP_ADMIN', 'Administrador');

/* [TEMPLATES] *********************************************************** */ 
define ('TEMPLATE_USER', "lucidity");
define ('TEMPLATE_USER_PATH', SITE_PATH."themes/".TEMPLATE_USER.SS);
define ('TEMPLATE_USER_PATH_WEB', SITE_PATH_WEB."themes/".TEMPLATE_USER.SS);
define ('TEMPLATE_USER_URL', SITE_URL."themes/".TEMPLATE_USER.SS);

define ('TEMPLATE_ADMIN', "default");
define ('TEMPLATE_ADMIN_PATH', SITE_ADMIN_PATH."themes/default/");
define ('TEMPLATE_ADMIN_PATH_WEB', SITE_PATH_WEB.SITE_ADMIN_DIR.SS."themes/default/");

/* [MAIL] *******************************************************************  */
#217.76.146.62, ssl://smtp.gmail.com:465, ssl://smtp.gmail.com:587
define ('MAIL_HOST', "localhost");
#sbq7782, correo@xornaldegalicia.com
define ('MAIL_USER', "");
#mss, Pau5Dav4Ant3Alb2
define ('MAIL_PASS', "");

}

/* [ASSSET SERVERS] *********************************************************  */
define('ASSET_HOST','assets%02d.opennemas.com');




/*  INTERNACIONALIZACION: GETTEXT CONFIGURATION  ************************************************* */
// I18N support information here
$language = (isset($_REQUEST['lang']))? $_REQUEST['lang']: 'es_ES';
//$language = $language . '.UTF-8';
$language = 'es_ES' . '.UTF-8'; //Forzado

putenv('LANG=' . $language);
setlocale(LC_ALL, $language);

$domain = 'messages';
bind_textdomain_codeset($domain, 'UTF-8');
bindtextdomain($domain, SITE_ADMIN_PATH . 'themes/default/locale');
textdomain($domain);
/***************************************************************************** */

