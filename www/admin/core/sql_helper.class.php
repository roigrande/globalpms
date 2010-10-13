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
 * SqlHelper
 * 
 * @package    OpenNeMas
 * @copyright  Copyright (c) 2009 Openhost S.L. (http://openhost.es)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: PHP-1.php 1 2009-11-25 11:37:15Z vifito $
 */
class SqlHelper
{    
    /**
     * Build "update" query using $fields array to write "set" sentence
     *
     * @see SqlHelper::bindAndUpdate
     * @param string $table
     * @param array $fields Array with name of fields to update ($colname => $value)
     * @param string $filter String for where sentece
     * @param object|null $conn ADOConnection instance 
     */
    public function update($table, $fields, $filter, $conn=null)
    {
        $sql = 'UPDATE `%s` SET %s WHERE %s';
        
        $set = array();
        $values = array();
        foreach($fields as $k => $field) {
            $set[]    = '`' . $k . '` = ?';
            $values[] = $field;
        }
        
        $sql = sprintf($sql, $table, implode(', ', $set), $filter);
        
        $conn = (!is_null($conn))? $conn: $GLOBALS['application']->conn;
        if($conn->Execute($sql, $values) === false) {
            $error_msg = $GLOBALS['application']->conn->ErrorMsg();
            
            throw new Exception($error_msg);
        }
    }
    
    /**
     * Search into $data values that match with keys into $fields to build
     * new array for use SqlHelper::update
     * Also check if values isset and not empty
     *
     * <code>
     *  $filter = '`pk_content` = ' . $pk_content;
     *  $fields = array('starttime', 'endtime', 'content_status', 'available',
     *                   'fk_user_last_editor', 'frontpage', 'in_home', 'permalink');
     *  SqlHelper::bindAndUpdate('contents', $fields, $_POST, $filter);
     * </code>
     * 
     * @uses SqlHelper::update
     * @param string $table
     * @param array $fields Array with name of fields to update
     * @param array $data Array keyField => valueField, equals to POST
     * @param string $filter String for where sentece
     * @param object|null $conn ADOConnection instance 
     */
    public function bindAndUpdate($table, $fields, $data, $filter, $conn=null)
    {
        $merged = array();
        foreach($fields as $field) {
            if(isset($data[$field])) {
                $merged[ $field ] = $data[$field];
            }
        }
        
        SqlHelper::update($table, $merged, $filter, $conn);
    }
}