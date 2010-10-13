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

/**
 * Configurator
 * 
 * @package    Onm
 * @subpackage 
 * @copyright  Copyright (c) 2010 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: PHP-1.php 1 2010-04-15 09:38:59Z vifito $
 */
class Configurator
{
    /**
     * @var string  Configuration file name
     */
    private $filename = null;
    
    /**
     * @var array   Keys to parse
     */
    private $entries  = array();
    
    /**
     * @var array   Array of strings
     */
    private $lines    = array();
    
    public function __construct($entries=null, $filename=null)
    {
        if(is_null($filename)) {
            $this->filename = realpath(dirname(__FILE__) . '/../config.inc.php');
        } else {
            $this->filename = $filename;
        }
        
        if(!is_null($entries)) {
            if(!is_array($entries)) {
                throw new Exception('Param "keys" is not an array.');
            }
            
            // Set entries
            $this->setEntries($entries);
            
            // Load file and values
            $this->load(); 
        }
    }
    
    public function setEntries($entries)
    {
        $this->entries = $entries;
    }
    
    public function getEntries()
    {
        return $this->entries;
    }
    
    /**
     * Get list of configuration files
     *
     * <code>
     * $rs = Configurator::getBackupConfigFiles();
     * // array of array('filename' => 'config.inc-1271342940.php', 'time' => 1271342940)
     * </code>
     *
     * @static
     * @param string $dir
     * @param string $patternFile
     * @return array    Array of backup config files with timestamp 
     */
    public static function getBackupConfigFiles($dir, $patternFile=null)
    {
        $backups = array();
        
        if(is_dir($dir)) {
            
            if(is_null($patternFile)) {
                $patternFile = 'config\.inc\-(?P<time>[0-9]{10})\.php';
            }
            
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if(preg_match('/' . $patternFile . '/', $file, $matches)) {
                        $backups[] = array(
                            'filename' => $file,
                            'time'     => $matches['time']
                        );
                    }
                }
                closedir($dh);
            }
        }
        
        return $backups;
    }
    
    /**
     * Backup a config file
     *
     * @param string|null $name  Name of config.inc.php backup
     * @return boolean  Result of operation
     */
    public function backup($dir, $name=null)
    {
        if(is_null($name)) {
            $name = $this->generateBackupFileName();            
        }
        
        $name = $dir . '/' . $name;
        
        return @copy($this->filename, $name);
    }
    
    public function setEntry($key, $value)
    {
        foreach($this->entries as $section => $entries) {
            foreach($entries as $k => $_) {
                if($k == $key) {
                    $this->entries[$section][$k]['value'] = $value;
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public function getEntry($key)
    {
        foreach($this->entries as $section => $entries) {
            foreach($entries as $k => $_) {
                if($k == $key) {
                    return $this->entries[$section][$k]['value'];
                }
            }
        }
        
        return null;
    }
    
    
    public function save($filename=null)
    {
        if(is_null($filename)) {
            $filename = $this->filename;
        }
        
        // Replace changes into $this->entries to $this->lines
        $this->replaceLines();
        
        $fp = fopen($filename, "w");
        if($fp !== false) {
            foreach($this->lines as $line) {
                fwrite($fp, $line);
            }
            
            fclose($fp);
        }                
    }
    
    private function replaceLines()
    {
        $regexKey = '/^define[\s]*\([\s]*["\'](?P<key>.*?)["\'][\s]*\,/';
        
        foreach($this->lines as $i => $line) {
            if(!preg_match('/^define/', $line)) {
                continue;
            }
            
            // Retrieve key
            $matches = array();            
            preg_match($regexKey, $line, $matches);            
            $key = $matches['key'];
            
            // Get value
            $value = $this->getEntry($key);            
            if($value !== null) {
                $regex = '/^(define[\s]*\([\s]*["\']' . preg_quote($key) .
                         '["\'][\s]*\,[\s]*["\']?)(.*?)(["\']?[\s]*\)[\s]*;)/';
                
                $this->lines[$i] = preg_replace($regex, '${1}' . $value . '${3}', $line);
            }
        }        
    }
    
    /**
     * Load
     *
     * @see Configurator::
     */
    public function load()
    {
        if(is_null($this->filename) || !file_exists($this->filename)) {
            throw new Exception('Config file do not exists.');
        }
        
        $this->lines = file($this->filename, FILE_TEXT);
        
        foreach($this->lines as $line) {
            $this->parseLineAndLoadEntry($line);
        }
    }
    
    /**
     * Parse a line of configuration file and load entries array with value
     *
     * @param string $line
     */
    private function parseLineAndLoadEntry($line)
    {
        if(!preg_match('/^define/', $line)) {
            return;
        }
        
        foreach($this->entries as $section => $entries) {
            foreach($entries as $k => $v) {
                $regex = '/^define[\s]*\([\s]*["\']' . preg_quote($k) .
                         '["\'][\s]*\,[\s]*["\']?(?P<value>.*?)["\']?[\s]*\)[\s]*;/';
                $matches = array();
                
                if(preg_match($regex, $line, $matches)) {
                    $this->entries[$section][$k]['value'] = $matches['value'];
                    return;
                }
            }
        }        
    }    
    
    /**
     * Generate a valid path to backup
     *
     * @return string   Path to backup
     */
    private function generateBackupFileName()
    {
        $filename = 'config.inc-' . time() . '.php';
        
        return $filename;
    }
}


