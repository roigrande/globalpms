<?php
require_once('./config.inc.php');
require_once('./session_bootstrap.php');

$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}
//Application::forward(SITE_URL.'index.php');

session_destroy();
header ('Location: ' . SITE_URL );
//exit(0);

