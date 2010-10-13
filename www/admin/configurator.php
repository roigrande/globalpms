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
 * @copyright  Copyright (c) 2010 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
error_reporting(E_ALL);
require_once './config.inc.php';
require_once './session_bootstrap.php';

require_once './core/application.class.php';
Application::import_libs('*');
$app = Application::load();

require_once './core/privileges_check.class.php';
if(!Acl::_('BACKEND_ADMIN')) {
    Acl::deny();
}

require_once './core/configurator.class.php';
require_once './core/message.class.php';

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', _('Configuration Panel'));

/* Entries {{{ */
$entries = array(
    'SiteSection' => array(
        'SITE' => array(
            'title' => 'Site URI'
        ),
        /* 'SITE_PATH' => array(
            'title' => 'Filesystem path'
        ), */
        'SITE_TITLE' => array(
            'title' => 'Site Title'
        ),
        'SITE_DESCRIPTION' => array(
            'title' => 'Site Description'
        ),
        'SITE_KEYWORDS' => array(
            'title' => 'Site Keywords'
        ),
    ),
    
    'DatabaseSection' => array(
        'BD_HOST' => array(
            'title' => 'Host'
        ),
        'BD_USER' => array(
            'title' => 'Username'
        ),
        'BD_PASS' => array(
            'title' => 'Password'
        ),
        'BD_INST' => array(
            'title' => 'Database name'
        ),
    ),
    
    'MailSection' => array(
        'MAIL_HOST' => array(
            'title' => 'Host'
        ),
        'MAIL_USER' => array(
            'title' => 'Username'
        ),
        'MAIL_PASS' => array(
            'title' => 'Password'
        ),
    ),
    
    'TemplateSection' => array(
        'TEMPLATE_USER' => array(
            'title' => 'Theme'
        ),
        'ASSET_HOST' => array(
            'title' => 'Asset hosts'
        ),
    ),
    
    'SystemSection' => array(
        'LANG_DEFAULT' => array(
            'title' => 'Default language'
        ),
        
        'SYS_LOG' => array(
            'title' => 'Path to log file'
        ),
        'LOG_ENABLE' => array(
            'title' => 'Enable log <sub>(0=off, 1=on)</sub>'
        ),
        
        'ADVERTISEMENT_ENABLE' => array(
            'title' => 'Enable advertisement <sub>(0=off, 1=on)</sub>'
        ),
        'MUTEX_ENABLE' => array(
            'title' => 'Enable mutext (Experimental!)'
        ),
        
        'FB_APP_APIKEY' => array(
            'title' => 'API key of Facebook application'
        ),
        'FB_APP_SECRET' => array(
            'title' => 'Secret key of Facebook application'
        ),
    ),
);
/* }}} */

$action = (isset($_REQUEST['action']))? $_REQUEST['action']: 'form';
switch($action) {
    
    /* Save changes in configuration form */
    case 'save': {
        $configurator = new Configurator($entries);
        
        if(isset($_REQUEST['entries'])) {
            foreach($_REQUEST['entries'] as $k => $v) {
                $configurator->setEntry($k, $v);
            }
            
            $configurator->save();
        }
        
        Application::forward($_SERVER['SCRIPT_NAME'] . '?action=form');
    } break;
    
    /* Get list of backup files */
    case 'listfiles': {
        // Scan "backups" directory
        $files = Configurator::getBackupConfigFiles( './backups/' );
        
        $tpl->assign('files', $files);
    } break;
    
    /* Recovery */
    case 'recover': {
        $destination = dirname(__FILE__) . '/config.inc.php';
        $source = './backups/' . $_REQUEST['filename'];
        
        if(file_exists($source)) {
            if( @copy($source, $destination) ) {
                Message::add('Backup restored successfully.', 'info');
            } else {
                Message::add('Error restoring backup, check permissions.', 'error');
            }
        } else {
            Message::add('Error: file to recover do not exists.', 'error');
        }
        
        Application::forward($_SERVER['SCRIPT_NAME'] . '?action=form');
    } break;
    
    /* Backup current config file */
    case 'backup': {
        $configurator = new Configurator();
        
        // Save backup into "backups" directory
        if($configurator->backup( './backups/' )) {
            Message::add('Backup save successfully.', 'info');
        } else {
            Message::add('Error saving backup, check permissions.', 'error');
        }
        
        Application::forward($_SERVER['SCRIPT_NAME'] . '?action=form');
    } break;
    
    /* Show configuration form */
    case 'form':
    default: {                
        $configurator = new Configurator($entries);
        $entries = $configurator->getEntries();        
        
        $tpl->assign('entries', $entries);
    } break;
}


$tpl->display('configurator.tpl');
