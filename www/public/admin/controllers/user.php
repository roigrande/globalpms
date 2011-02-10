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

require_once '../../bootstrap.php';
require_once(SITE_ADMIN_PATH.'controllers/session_bootstrap.php');
$sessions = $GLOBALS['Session']->getSessions();
require_once(SITE_CORE_PATH.'/privileges_check.class.php');
require_once(SITE_CORE_PATH.'/method_cache_manager.class.php');
require_once(SITE_CORE_PATH.'/user.class.php');
require_once(SITE_CORE_PATH.'/user_group.class.php');

$app = Application::load();

/*
// Check ACL {{{
require_once(SITE_ADMIN_PATH.'core/privileges_check.class.php');
if(!Acl::_('USER_ADMIN')) {
    Acl::deny();
}
// }}}
*/
$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('titulo_barra', 'Gesti&oacute;n de Usuarios');

$page = (isset($_REQUEST['page'])? $_REQUEST['page'] : '');

if( isset($_REQUEST['action']) ) {
    switch($_REQUEST['action']) {
        case 'list': {
            //$cm = new ContentManager();
            $user = new User();           
            $filters = (isset($_REQUEST['filter']))? $_REQUEST['filter']: null;            
            $users = $user->get_users($filters);            
            
          //  $users = $cm->paginate_num($users,12);
            $tpl->assign('users', $users);
            
          //  $tpl->assign('paginacion', $cm->pager);
            
            $user_group = new User_group();
            $group      = $user_group->get_user_groups();
            
            $groupsOptions = array();
            $groupsOptions[] = '-- Seleccione un grupo --';
            foreach($group as $cat) {
                $groupsOptions[$cat->id] = $cat->name;
            }
            $tpl->assign('user_groups', $group);
            $tpl->assign('groupsOptions', $groupsOptions);
        } break;        
        
        case 'new': {
            $user = new User( $_REQUEST['id'] );
            $user_group = new User_group();
            $tpl->assign('user', $user);
            $tpl->assign('user_groups', $user_group->get_user_groups());
            
          
            $tpl->assign('content_categories', $tree);
        } break;
        
        case 'read': {
            $user = new User( $_REQUEST['id'] );
            $user_group = new User_group();
            $tpl->assign('user', $user);
            $tpl->assign('user_groups', $user_group->get_user_groups());
            
 
            /*$tpl->assign('categories_options',  $user->get_categories_options());
            $tpl->assign('categories_selected', $user->get_access_categories_id());*/
        } break;
        
        case 'update': {
            // TODO: validar datos
            $user = new User();
            $user->update( $_REQUEST );
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
        } break;
        
        case 'create': {
            $user = new User();
            
            if($user->create( $_POST )) {
                Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
            } else {
                $tpl->assign('errors', $user->errors);
            }
        } break;
        
        case 'delete': {
            $user = new User();
            $user->delete( $_POST['id'] );
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$_REQUEST['page']);
        } break;
        
        case 'validate': {
            $user = null;
            if(empty($_POST["id"])) {
                $user = new User();
                if(!$user->create( $_POST )) {
                    $tpl->assign('errors', $user->errors);        
                }
            } else {
                $user = new User($_POST["id"]);
                $user->update( $_REQUEST );
            }
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=read&id='.$user->id);
        } break;

        case 'mdelete':
                if(isset($_REQUEST['selected_fld']) && count($_REQUEST['selected_fld'])>0)
                {
                    $fields = $_REQUEST['selected_fld'];
                    if(is_array($fields))
                    {
                        $user = new User();
                        foreach($fields as $i )
                        {
                            $user->delete( $i );
                        }
                    }
                }

                Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$page);
        break;


        default: {
            Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$page);
        } break;
    }
    
} else {
    Application::forward($_SERVER['SCRIPT_NAME'].'?action=list&page='.$page);
}

$tpl->display('user/user.tpl');