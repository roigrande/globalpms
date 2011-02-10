<?php
require_once(SITE_ADMIN_PATH.'core/sessionmanager.class.php');
$GLOBALS['Session'] = SessionManager::getInstance(OPENNEMAS_BACKEND_SESSIONS);
$GLOBALS['Session']->bootstrap();
//echo "<br \>variable ".$_SESSION['userid']."<br \>";
//echo "<br \>variable ".$_SERVER['SCRIPT_FILENAME']."<br \>";
if(!isset($_SESSION['userid']) && !preg_match('/login\.php$/', $_SERVER['SCRIPT_FILENAME'])) {
    header('Location: '.SITE_URL_ADMIN.'controllers/login.php');
    exit(0);
}
?>