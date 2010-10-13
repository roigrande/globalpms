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

// see also config.inc.php
//define('SYS_NAME_GROUP_ADMIN', 'Administrador'); 

/**
 * User
 * 
 * @package    OpenNeMas
 * @copyright  Copyright (c) 2009 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: user.class.php 1 2009-11-16 13:56:33Z vifito $
 */
class User
{
    /**#@+
     * User properties
     * 
     * @access public
     * @var string
     */
    var $id               = null;
    var $login            = null;
    var $password         = null;
    var $sessionexpire    = null;
    var $email            = null;
    var $name             = null;
    var $firstname        = null;
    var $lastname         = null;
    var $address          = null;
    var $phone            = null;
    var $id_user_group    = null;
    var $accesscategories = null;
    var $fk_user_group    = null;
    /**#@-*/
    
    /**
     * @var string
     */
    var $authMethod = null;
    var $clientLoginToken = null;
    
    /**
     * Compatible PHP4 constructor
     *
     * @see MethodCacheManager
     * @param int $id User Id
     */
    public function User($id=null)
    {
        if(!is_null($id)) {
            $this->read($id);
        }
        
        // Use MethodCacheManager
//        if( is_null($this->cache) ) {
//            $this->cache = new MethodCacheManager($this, array('ttl' => 60));
//        } else {
//            $this->cache->set_cache_life(60); // 60 seconds
//        }
    }
    
    /**
     * PHP5 constructor
     */
    public function __construct($id=null)
    {
        $this->User($id);
    }
    
    public function create($data)
    {
        $sql = "INSERT INTO users (`login`, `password`, `sessionexpire`,
                                      `email`, `name`, `firstname`,
                                      `lastname`, `address`, `phone`,
                                      `fk_user_group`)
                    VALUES (?,?,?,?,?,?,?,?,?,?)";
        $values = array($data['login'], md5($data['password']),  $data['sessionexpire'],
                        $data['email'], $data['name'], $data['firstname'],
                        $data['lastname'], $data['address'], $data['phone'],
                        $data['id_user_group']);   
                        
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return(false);
        }        
        $this->id = $GLOBALS['application']->conn->Insert_ID();
        
        //Insertar las categorias de acceso.
        if(isset($data['ids_category'])) {
            $this->createAccessCategoriesDB($data['ids_category']);
        }
        
        return(true);
    }
    
    public function read($id)
    {
        $sql = 'SELECT * FROM users WHERE pk_user = '.intval($id);
        $rs = $GLOBALS['application']->conn->Execute( $sql );
        
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return;
        }
        
        $this->id               = $rs->fields['pk_user'];
        $this->login            = $rs->fields['login'];
        $this->password         = $rs->fields['password'];
        $this->sessionexpire    = $rs->fields['sessionexpire'];
        $this->email            = $rs->fields['email'];
        $this->name             = $rs->fields['name'];
        $this->firstname        = $rs->fields['firstname'];
        $this->lastname         = $rs->fields['lastname'];
        $this->address          = $rs->fields['address'];
        $this->phone            = $rs->fields['phone'];
        $this->id_user_group    = $rs->fields['fk_user_group'];
        $this->accesscategories = $this->readAccessCategories();
    }

    public function update($data)
    {
        // Init transaction
        $GLOBALS['application']->conn->BeginTrans();
        
        if(isset($data['password']) && (strlen($data['password']) > 0)) {
            $sql = "UPDATE users SET `login`=?, `password`= ?, `sessionexpire`=?,
                                `email`=?, `name`=?, `firstname`=?, `lastname`=?,
                                `address`=?, `phone`=?, `fk_user_group`=?
                    WHERE pk_user=".intval($data['id']);
            
            $values = array($data['login'], md5($data['password']), $data['sessionexpire'],
                        $data['email'], $data['name'], $data['firstname'],
                        $data['lastname'], $data['address'],
                        $data['phone'], $data['id_user_group'] );
            
        } else {
            $sql = "UPDATE users SET `login`=?, `sessionexpire`=?, `email`=?,
                                      `name`=?, `firstname`=?, `lastname`=?,
                                      `address`=?, `phone`=?, `fk_user_group`=?
                    WHERE pk_user=".intval($data['id']);
            
            $values = array($data['login'], $data['sessionexpire'], $data['email'],
                        $data['name'], $data['firstname'], $data['lastname'],
                         $data['address'], $data['phone'], $data['id_user_group'] );
        }
        
        if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
            // Rollback
            $GLOBALS['application']->conn->RollbackTrans();
            
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return;
        }
        
        $this->id = $data['id'];
        if(isset($data['ids_category'])) {
            $this->createAccessCategoriesDB($data['ids_category']);
        }
        
        // Finish transaction
        $GLOBALS['application']->conn->CommitTrans();
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM users WHERE pk_user='.intval($id);
        
        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return false;
        }
        
        return true;
    }

    private function createAccessCategoriesDB($IdsCategory)
    {
        if( $this->deleteAccessCategoriesDB() ) {
            $sql = "INSERT INTO users_content_categories (`pk_fk_user`, `pk_fk_content_category`)
                    VALUES (?,?)";
            
            $values = array();
            for($iIndex=0; $iIndex<count($IdsCategory); $iIndex++) {
                $values[] = array($this->id, $IdsCategory[$iIndex]);
            }
            
            // bulk insert
            if($GLOBALS['application']->conn->Execute($sql, $values) === false) {
                $GLOBALS['application']->conn->RollbackTrans();
                
                $error_msg = $GLOBALS['application']->conn->ErrorMsg();
                $GLOBALS['application']->logger->debug('Error: '.$error_msg);
                $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
                
                return false;
            }
            
            return true;
        }
        
        return false;
    }

    private function readAccessCategories($id=null)
    {
        $id = (!is_null($id))? $id: $this->id;
        $sql = 'SELECT pk_fk_content_category FROM users_content_categories WHERE pk_fk_user = ?';
        $rs = $GLOBALS['application']->conn->Execute( $sql, $id );
        
        if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            
            return null;
        }
        
        $contentCategories = array();
        while(!$rs->EOF) {
            $contentCategory = new ContentCategory($rs->fields['pk_fk_content_category']);
            $contentCategories[] = $contentCategory;
              $rs->MoveNext();
        }
       
        return $contentCategories;
    }


    private function deleteAccessCategoriesDB()
    {
        $sql = 'DELETE FROM users_content_categories WHERE pk_fk_user='.intval($this->id);
        
        if($GLOBALS['application']->conn->Execute($sql)===false) {
            $GLOBALS['application']->conn->RollbackTrans();
            
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return false;
        }
        return true;
    }

    public function login($login, $password, $loginToken=null, $loginCaptcha=null)
    {
        $result = false;
        
        if($this->isValidEmail($login)) {
            $result = $this->authGoogleClientLogin($login, $password, $loginToken=null, $loginCaptcha=null);
        } else {
            $result = $this->authDatabase($login, $password);
        }
        
        return $result;
    }
    
    /**
     * Check email is valid to login
     * 
     * @param string $email
     * @return boolean
     */
    public function isValidEmail($email) {
        // TODO: restrict accounts to @xornaldegalicia.com
        // return preg_match('/.+@xornaldegalicia.com/', $email);
        return preg_match('/.+@.+\..+/', $email);
    }
    
    /**
     * Try authenticate with database
     *
     * @param string $login
     * @param string $password
     * @return boolean Return true if login exists and password match
     */
    public function authDatabase($login, $password)
    {
        $sql = 'SELECT * FROM users WHERE login=\''.strval($login).'\'';
        $rs = $GLOBALS['application']->conn->Execute( $sql );
        
        if(!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return false;
        }
        
        $this->set_values($rs->fields);
        if($this->password === md5($password)) {
            // Set access categories
            $this->accesscategories = $this->readAccessCategories();
            $this->authMethod = 'database';
            return true;
        }
        
        // Reset members properties
        $this->reset_values();
        
        return false;
    }
    
    /**
     * Try authenticate from google account
     *
     * @param string $email
     * @param string $passwd
     * @param string $loginToken
     * @param string $loginCaptcha
     * @return boolean|array
     */
    public function authGoogleClientLogin($email, $passwd, $loginToken=null, $loginCaptcha=null)
    {
        require_once 'Zend/Loader.php';
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        Zend_Loader::loadClass('Zend_Gdata');
        
        try {
            $client = Zend_Gdata_ClientLogin::getHttpClient($email, $passwd, 'xapi', null, 'Zend-ZendFramework',
                                                            $loginToken, $loginCaptcha);
            
            //$_SESSION['logintoken'] = $client->getAuthSubToken();
            // header('Authorization: AuthSub ' . );
            $this->clientLoginToken = $client->getClientLoginToken();
            
            // Check exists account into database
            $data = $this->getUserDataByEmail($email);
            
            if(empty($data)) { // Don't exist into database
                return false;
            }
            
            // Set values to instance $this
            $this->set_values($data);
        } catch (Zend_Gdata_App_CaptchaRequiredException $cre) {
            // Incorrect credentials, retry with captcha challenge
            return array('token'   => $cre->getCaptchaToken(),
                         'captcha' => $cre->getCaptchaUrl() );
        } catch (Zend_Gdata_App_AuthException $ae) {
            return false;
        } catch (Exception $exp) {
            return false;
        }
        
        // If wasn't thrown any exception then return true
        $this->authMethod = 'google_clientlogin';
        return true;
    }
    
    /**
     * Get a password from a login
     *
     * @param string $login
     * @return string Return the password of login
     */
    public function getPwd($login)
    {
        $sql = 'SELECT password FROM users WHERE login=\''.strval($login).'\'';
        $rs = $GLOBALS['application']->conn->Execute( $sql );
        
        if(!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return false;
        }
        
        $this->set_values($rs->fields);
        return $this->password;
    }

    /**
     * Get user data by email
     * 
     * @param string $email
     * @return array|null
     */
    public function getUserDataByEmail($email)
    {
        $sql = 'SELECT * FROM users WHERE email=?';
        $rs  = $GLOBALS['application']->conn->Execute($sql, array($email));
        
        if(!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return null;
        }
        
        return $rs->fields;
    }
    
    /**
     * Set internal status of this object. If $data is empty don't do anything
     *
     * @param Array $data
     * @see User::reset_values
     */
    public function set_values($data)
    {
        if(!empty($data)) {
            $this->id           = $data['pk_user'];
            $this->login        = $data['login'];
            $this->password     = $data['password'];
            $this->sessionexpire= $data['sessionexpire'];
            $this->email        = $data['email'];
            $this->name         = $data['name'];
            $this->firstname    = $data['firstname'];
            $this->lastname     = $data['lastname'];
            $this->address      = $data['address'];
            $this->phone        = $data['phone'];
            $this->fk_user_group= $data['fk_user_group'];
            
            if(isset($data['ids_category'])) {
                $this->accesscategories = $this->setAccessCategories($data['ids_category']);
            }
        }
    }
    
    /**
     * Set member properties to null
     *
     * @see User::set_values
     */
    public function reset_values()
    {
        $this->id           = null;
        $this->login        = null;
        $this->password     = null;
        $this->sessionexpire= null;
        $this->email        = null;
        $this->name         = null;
        $this->firstname    = null;
        $this->lastname     = null;
        $this->address      = null;
        $this->phone        = null;
        $this->fk_user_group= null;
        
        $this->accesscategories = null;
    }    

    public function setAccessCategories($IdsCategory)
    {
        for($iIndex=0; $iIndex<count($IdsCategory); $iIndex++) {
            $contentCategories[] = new ContentCategory($IdsCategory[$iIndex]);
        }
        
        return $contentCategories;
    }
    
    public function get_access_categories_name()
    {
        if(!empty($this->accesscategories))
        {
            foreach($this->accesscategories as $category) {
                $names[] = $category->name;
            }
            
            return names;
        }
        return null;
    }
    
    public function get_access_categories_id($id=null)
    {

        if( empty($this->accesscategories) ) {
            $this->accesscategories = $this->readAccessCategories($id);
        }
        
        $categories = $this->accesscategories;
        function sortInMenu($a, $b) {
          if(isset($a->posmenu) && isset($b->posmenu)) {
            // fin chapuza
            if ($a->posmenu == $b->posmenu) {
                return 0;
            }
            return ($a->posmenu < $b->posmenu) ? -1 : 1;
          }
        }        
        usort($categories, 'sortInMenu');
        
        $ids = array();
        foreach($categories as $category) {
            $ids[] = $category->pk_content_category;
        }
        
        return $ids;
    }
    
    public function users_online()
    {
        $sql = 'SELECT COUNT (*) FROM users WHERE online=1';
        return( $GLOBALS['application']->conn->Execute($sql));
    }
    
    public function get_users($filter=null, $_order_by='ORDER BY 1')
    {
        $items = array();
        $_where = $this->buildFilter($filter);
        
        $sql = 'SELECT * FROM `users` ' . $_where . ' ' . $_order_by;
        
        $rs = $GLOBALS['application']->conn->Execute($sql);
        if($rs !== false) {
            while(!$rs->EOF) {
                $user = new User();
                
                $user->set_values($rs->fields);
                $items[] = $user;
                
                $rs->MoveNext();
            }
        }
        
        return $items;
    }
    
    private function buildFilter($filter)
    {
        $newFilter = '';
        
        if(!is_null($filter) && is_string($filter)) {
            if(preg_match('/^[ ]*where/i', $filter)) {
                $newFilter = ' WHERE ' . $filter;
            }
        } elseif(!is_null($filter) && is_array($filter)) {
            $parts = array();
            if(isset($filter['login']) && !empty($filter['login'])) {
                $parts[] = '`login` LIKE "' . $filter['login'] . '%"';
            }
            
            if(isset($filter['name']) && !empty($filter['name'])) {
                $parts[] = 'MATCH(`name`, `firstname`, `lastname`) AGAINST ("' . $filter['name'] . '")';
            }
            
            if(isset($filter['group']) && intval($filter['group'])>0) {
                $parts[] = '`fk_user_group` = ' . $filter['group'] . '';
            }            
            
            if(count($parts) > 0) {
                $newFilter = ' WHERE ' . implode(' OR ', $parts);
            }
        }
        
        return $newFilter;
    }
    
    public function get_user_name($id)
    {
        $sql = 'SELECT name, login FROM users WHERE pk_user='.$id;
        $rs = $GLOBALS['application']->conn->Execute($sql);
         if (!$rs) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            $GLOBALS['application']->logger->debug('Error: '.$error_msg);
            $GLOBALS['application']->errors[] = 'Error: '.$error_msg;
            return false;
        }
        //Se cambia name por login.
        return $rs->fields['login'];
    }
    
    public function parseGmailInbox($token)
    {
        $messages = array('total' => 0, 'entries' => array());
        
        if(function_exists('curl_init'))
        {
            $curl = curl_init('https://mail.google.com/mail/feed/atom');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            //curl_setopt($curl, CURLOPT_HEADER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_USERPWD, $token); //$username.':'.$password);
            $result = curl_exec($curl);
            $code = curl_getinfo ($curl, CURLINFO_HTTP_CODE);
            
            if($code != 200) {
                return $messages;
            }
            
            $xml = simplexml_load_string($result);
            $messages['total'] = (int)$xml->fullcount;
            
            foreach($xml->entry as $entry) {
                //$link = $entry->xpath('link[@href]');
                $link = $entry->link->attributes();
                $link = $link['href'];
                
                $messages['entries'][] = array(
                    'title'   => (string)$entry->title,
                    'summary' => (string)$entry->summary,
                    'link'    => (string)$link[0],
                    'name'    => (string)$entry->author->name,
                    'email'   => (string)$entry->author->email
                );
            }
            
            return $messages;
        } else {
            return false;
        }
    }
}