<?php
/* -*- Mode: PHP; tab-width: 4 -*- */
/**
 * OpenNeMas project
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   OpenNeMas
 * @package    OpenNeMas
 * @copyright  Copyright (c) 2009 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
 
require_once('./config.inc.php');
require_once(SITE_ADMIN_PATH.'session_bootstrap.php');

require_once(SITE_ADMIN_PATH.'core/method_cache_manager.class.php');
require_once(SITE_ADMIN_PATH.'core/proxy.class.php');

if(filter_has_var(INPUT_GET, 'url')) {    
    $proxy = new Proxy($_REQUEST['url']);
    
    // get content and return to browser 
    $proxy->get()->dump();    
}