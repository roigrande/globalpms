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
 
/**
 * Proxy
 * 
 * @package    OpenNeMas
 * @copyright  Copyright (c) 2009 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: proxy.class.php 1 2009-11-09 12:46:48Z vifito $
 */
class Proxy {
    /**
     * @var string URI
     */
    private $url = null;
    
    private $content = null;
    
    private $contentType = null;
    
    /**
     * @var MethodCacheManager Handler to call method cached
     */
    public $cache = null;
    
    /**
     * constructor
     *
     * @param int $id 
     */
    public function __construct($url=null, $contentType=null)
    {
        if(!is_null($url)) {
            $this->setUrl($url);
        }
        
        if(!is_null($contentType)) {
            $this->setContentType($contentType);
        }
        
        $this->cache = new MethodCacheManager($this, array('ttl' => 60));
    }
    
    /**
     *
     * 
     */
    public function setUrl($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        if($url !== false) {
            $this->url = $url;
        } else {
            throw new Exception('URL not valid');
        }
        
        return $this; // Chaining methods
    }
    
    public function setContentType($content_type)
    {
        $this->contentType = $content_type;
        
        return $this; // Chaining methods
    }
    
    /**
     *
     */
    public function get()
    {
        if(!is_null($this->url)) {
            list($this->content, $this->contentType) = $this->exec($this->url);
        }
        
        return $this; // Chaining methods
    }
    
    public function dump()
    {
        if(!is_null($this->contentType) && !is_null($this->content)) {
            header('Content-type: ' . $this->contentType);
            echo $this->content;
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }
    
    /**
     * Perform HTTP request
     *
     * @param string $url
     * @return string HTML/XML content response
     */
    private function exec($url)
    {
        if(function_exists('curl_init')) {
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            
            $result = curl_exec($curl);
            $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if($code == 200) {
                return array($result, curl_getinfo($curl, CURLINFO_CONTENT_TYPE));
            } else {
                return array(null, null);
            }
        }
    }
    
}
