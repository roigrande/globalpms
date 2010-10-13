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
require_once('./session_bootstrap.php');

error_reporting(E_ALL); 

require_once('./core/application.class.php');
Application::import_libs('*');
$app = Application::load();

// Class Newsletter
require_once('./core/newsletter.class.php');

// Retrieve news for add to the bulletin
require_once('./core/content_manager.class.php');
require_once('./core/content_category_manager.class.php');
require_once('./core/content.class.php');
 

// Check ACL
require_once('./core/privileges_check.class.php');
if(!Acl::_('NEWSLETTER_ADMIN')) {
    Acl::deny();
}

require_once('./core/string_utils.class.php');
String_Utils::disabled_magic_quotes();

$tpl = new TemplateAdmin(TEMPLATE_ADMIN);
$tpl->assign('application_name', 'Boletín de Noticias');

$newsletter = new Newsletter(array('namespace' => 'PConecta_'));
$ccm = ContentCategoryManager::get_instance();

function buildFilter($filters)
{
    if(!isset($filters) || is_null($filters)) {
        return array(array('in_home=1'), 'home_placeholder ASC, home_pos ASC, created DESC');
    }
    
    $fltr = array('`available`=1');
    $order_by = 'created DESC';
    
    
    switch($filters['options']) {
        case 'in_home': {
            $fltr[] = '`in_home`=1';
            $fltr[] = '`frontpage`=1';
            $fltr[] = '`content_status`=1';
            $order_by = 'home_placeholder ASC, home_pos ASC, created DESC';
        } break;
        
        case 'frontpage': {
            $fltr[] = '`frontpage`=1';
            $fltr[] = '`content_status`=1';
            $order_by = 'placeholder ASC, position ASC, created DESC';
        } break;
        
        case 'hemeroteca': {
            $fltr[] = '`content_status`=0';
        } break;
    }
    
    if(isset($filters['q']) && !empty($filters['q'])) {
        $fltr[] = 'MATCH (title,metadata) AGAINST ("'.addslashes($filters['q']).'" IN BOOLEAN MODE)';
    }
    
    if(isset($filters['category']) && !empty($filters['category']) && ($filters['category']>0)) {
        $fltr['category'] = $filters['category'];        
    } elseif(isset($filters['category'])) {
        //$order_by = '`content_categories`.`name` ASC, ' . $order_by; // ???
    }
    
    if(isset($filters['author']) && !empty($filters['author']) && ($filters['author']>0)) {
        $fltr[] = '`opinions`.`fk_author`='.$filters['author'];
    }    
    
    return array($fltr, $order_by);
}

$action = (isset($_REQUEST['action']))? $_REQUEST['action']: 'listArticles';
switch($action) {
    
    case 'send': {
        // save newsletter
        $postmaster = $_REQUEST['postmaster'];
        $newsletter->create(array('data' => $postmaster));
        
        // Ignore user abort and life time to infinite
        $newsletter->setConfigMailing();        
        $htmlContent = $newsletter->render();
        
        $params = array(
            'subject'   => $_REQUEST['subject'],
            'mail_host' => MAIL_HOST,
            'mail_user' => MAIL_USER,
            'mail_pass' => MAIL_PASS,
            'mail_from' => MAIL_USER,
            'mail_from_name' => 'OpenNemas Newsletter System',
        );
        
        // Render page using "PUSH HTTP" technology
        // SEE http://en.wikipedia.org/wiki/Push_technology
        
        // Header
        echo $tpl->fetch('newsletter/header.tpl');
        echo $tpl->fetch('newsletter/actions/send.tpl');
        flush();
                        
        // Mail user by user
        $data = json_decode($postmaster);
        foreach($data->accounts as $mailbox) {
            
            // Replace name destination
            $emailHtmlContent = str_replace('###DESTINATARIO###', $mailbox->name, $htmlContent);
            
            if($newsletter->sendToUser($mailbox, $emailHtmlContent, $params)) {
                echo '<div class="mailing"><strong class="ok">OK</strong> ', $mailbox->name . ' &lt;' . $mailbox->email, '&gt;</div>';
            } else {
                echo '<div class="mailing"><strong class="failed">FAILED</strong> ', $mailbox->name . ' &lt;' . $mailbox->email, '&gt;</div>';
            }
            
            flush();
        }
        
        echo '<h1>Envío finalizado.</h1>';
        flush();
        
        $scriptContent =<<< HTML
<script type="text/javascript">
var postData = {$postmaster};

// Set postmaster value
$('postmaster').value = Object.toJSON(postData);

// Attach click event to button
var botonera = $('menu-acciones-admin').select('ul li a');
botonera[0].setStyle({display: ''});
botonera[0].observe('click', function() {
    $('searchForm').action.value = 'preview';
    $('searchForm').submit();
});
</script>
HTML;

        echo $scriptContent;        
        
        echo $tpl->fetch('newsletter/footer.tpl');
        exit(0);
    } break;
    
    case 'preview': {
        $htmlContent = $newsletter->render();
        $tpl->assign('htmlContent', $htmlContent);
        $layoutContent = $tpl->fetch('newsletter/actions/preview.tpl');
    } break;
    
    case 'listAccounts': {
        $account = $newsletter->getAccountsProvider();
        $accounts = $account->getAccounts();
        
        // Ajax request
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
           ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            header('Content-type: application/json');
            echo json_encode($accounts);
            exit(0);
        }        
        
        $tpl->assign('items', $accounts);
        
        $layoutContent = $tpl->fetch('newsletter/actions/listAccounts.tpl');
    } break;
    
    case 'search': {
        $items = $newsletter->getItemsProvider();
        
        $source = (in_array($_REQUEST['source'], array('Article', 'Opinion')))? $_REQUEST['source']: 'Article';
        list($filter, $order_by) = buildFilter($_REQUEST['filters']);
        
        $articles = $items->getItems($source, $filter, $order_by, '0, 50');
        
        // Ajax request
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
           ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
            header('Content-type: application/json');
            echo json_encode($articles);
            exit(0);
        }                
        
        $tpl->assign('content_categories', $ccm->getCategoriesTreeMenu());
        $tpl->assign('items', $articles);
        
        $layoutContent = $tpl->fetch('newsletter/actions/listArticles.tpl');
    } break;
    
    case 'listOpinions': {        
        $items = $newsletter->getItemsProvider();
        
        // Opinions
        $opinions = $items->getItems('Opinion', array('in_home=1', 'content_status=1'),
                                     'created DESC',
                                     '0, ' . Newsletter::ITEMS_MAX_LIMIT);
        $tpl->assign('items', $opinions);
        
        // Authors
        $author = new Author();
        $authors = $author->all_authors(NULL,'ORDER BY name');        
        $tpl->assign('authors', $authors);
        
        // Postmaster        
        if(isset($_REQUEST['postmaster']) && !empty($_REQUEST['postmaster'])) {
            $tpl->assign('postmaster', json_decode($_REQUEST['postmaster']));
        }
        
        $layoutContent = $tpl->fetch('newsletter/actions/listOpinions.tpl');
    } break;    
    
    case 'listArticles':
    default: {        
        $items = $newsletter->getItemsProvider();
        
        // articles
        $articles = $items->getItems('Article', array('in_home=1', 'content_status=1'),
                                     'home_placeholder ASC, home_pos ASC, created DESC',
                                     '0, ' . Newsletter::ITEMS_MAX_LIMIT);        
        
      //  $tpl->assign('content_categories', $ccm->getCategoriesTreeMenu());
        $tpl->assign('items', $articles);
        
        $layoutContent = $tpl->fetch('newsletter/actions/listArticles.tpl');
    } break;
}

$tpl->assign('layoutContent', $layoutContent);
$tpl->display('newsletter/index.tpl');