<?php
/****************************************************************
*****************************************************************

Copyright (C) 2003  Matthieu MARY
http://www.phplibrairies.com

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

You can found more information about GPL licence at:
http://www.gnu.org/licenses/gpl.html

for contact me:   http://www.phplibrairies.com
****************************************************************
****************************************************************/
/**
 * create the : june 10th 2003.
 * @author      Matthieu MARY
 * version      2.0.1
 */

class dir
{
    /**
	 * array of errors
	 *
	 * @private
	 * @type array
	 **/
    var $aErrors;
    /**
	 * the directory
	 *
	 * @private
	 * @type string
	 **/
    var $dir;
    /**
	 * string parameters
	 *
	 * @private
	 * @type string
	 **/
    var $sParam;
    /**
	 * parameters detected
	 *
	 * @private
	 * @type array
	 **/
    var $aParam;
    /**
	 * does the OS server is a Unix system?
	 *
	 * @private
	 * @type array
	 **/
    var $bUnix;
    /**
	 * builder
	 *
	 * @param string sDirectory required. the directory use
	 * @public
	 * @type void
	 **/
    function dir($sDirectory)
    {
     $this->aErrors = array();
     $this->bUnix = !is_int(strpos(strtoupper(PHP_OS),'WIN'));
     if (!is_dir($sDirectory)) $this->aErrors[] = 'PARAM ['.$sDirectory.'] is not a valid directory';
     $this->dir = str_replace("\\",'/',realpath($sDirectory));
     $this->_PARAM_init();
    }// builder

    /**
	 * for compatilibity with v1.0 only
	 * replaced by the SIZE_selection function
	 *
	 * @public
	 * @type string
	 **/
    function SIZE($bSubfolders=TRUE)
    {
        $this->aParam['bSubfolders'] = $bSubfolders;
        $aFiles = $this->_LIST_files($this->dir);
        $iSum = -1;
        clearstatcache();
        if (count($aFiles)>0){
            foreach($aFiles as $i => $sPath) $iSum += @filesize($sPath);
        }
        if ($iSum == -1){
                  $this->aErrors[] = 'folder ['.$this->dir.'] is empty';
                  return $iSum;
        }
        return $this->_SIZE_format($iSum);
        //return $mSize;
    }// size

     /**
	 * Function that will return size of selection files , according with specified parameters
	 *
	 * @param string sParam optional, default value '';
	 * @param bool bFormat optional, default value TRUZ: does the result must be return in Mo form?
	 * --s : action will affect subfolders too
	 * --e ext1,ext2 : list only theses extensions
     * --ne ext1,ext2 : list all files without theses following extensions
     * --da: access date (fileatime)
     * --dc: creation date (filectime)
     * --uid 500,700: owner
     * --nuid 500, 700: not in the list
     * --gid : group id
	 * @public
	 * @type mixed
	 **/
    function SIZE_selection($sParam='',$bFormat=TRUE)
    {
        $this->_PARAM_get($sParam);
        $aFiles = $this->_LIST_files($this->dir);
        $iSum = -1;
        clearstatcache();
        if (count($aFiles)>0){
            foreach($aFiles as $i => $sPath) $iSum += @filesize($sPath);
        }
        if ($iSum == -1){
                  $this->aErrors[] = 'selection not found : no filesize get';
                  return $iSum;
        }
        $mSize = (($bFormat)? $this->_SIZE_format($iSum):$iSum);
        return $mSize;
    }

     /**
	 * Function that list all the directories in the current directory
	 *
	 * @param string sParam : parameters to list
	 * --s : action will affect subfolders too
     * --da: access date (fileatime)
     * --dc: creation date (filectime)
     * --uid 500,700: owner
     * --nuid 500, 700: not in the list
     * --gid : group id
	 *
	 * @public
	 * @type array
	 **/
	 function LIST_dir($sParam='')
	 {
	   $this->_PARAM_get($sParam);
	   return $this->_LIST_directories($this->dir);
	 }

     /**
	 * Function that list all the files in the current directory
	 *
	 * @param string sParam optional, default value '';
	 * --s : action will affect subfolders too
	 * --e ext1,ext2 : list only theses extensions
     * --ne ext1,ext2 : list all files without theses following extensions
     * --da: access date (fileatime)
     * --dc: creation date (filectime)
     * --uid 500,700: owner
     * --nuid 500, 700: not in the list
     * --gid : group id
	 * @public
	 * @type array
	 **/
    function LIST_files($sParam='')
    {
        $this->_PARAM_get($sParam);
        return $this->_LIST_files($this->dir);
    }// LIST

    /**
     * for compatibility with v1.0 only
     * does the same thing without new functions of LIST_files function
     * @public
	 * @type array
     **/
    function LIST_get($bSubfolders=TRUE,$aExtensions=array())
    {
        $this->aParam['bSubfolders'] = $bSubfolders;
        $this->aParam['bExtension'] = (count($aExtensions)>0);
        $this->aParam['aExtension'] = $aExtensions;
        return $this->_LIST_files($this->dir);
    }

    /**
     * for compatibility with v1.0 only
     * does the same thing without new functions of LIST_dir function
     * @public
	 * @type array
     **/
    function LIST_directories()
    {
       return $this->_LIST_directories($this->dir);
    }// LIST

     /**
	 * Function that returns errors
	 *
	 * @public
	 * @type array
	 **/
   function DATA_errors()
   {
            return $this->aErrors;
   }

     /**
	 * Function that returns number of errors
	 *
	 * @public
	 * @type array
	 **/
   function DATA_errors_size()
   {
            return count($this->aErrors);
   }

     /**
	 * Initialise private var
	 *
	 * @private
	 * @type void
	 **/
    function _PARAM_init()
    {
     $this->aParam = array(
            'bSubfolders' => FALSE,
            'bExtension' => FALSE,
            'aExtension' => array(),
            'inExtension' => FALSE,
            'bCreate' => FALSE,
            'dCreatesigne' => '',
            'dCreatevalue' => '',
            'bAccess' => FALSE,
            'dAccesssigne' => '',
            'dAccessvalue' => '',
            'bOwner' => FALSE,
            'aOwner' => array(),
            'inOwner' => FALSE,
            'bGroup' => FALSE,
            'aGroup' => array(),
            'inGroup' => FALSE,
            'iParameters' => 0);
     $this->sParam = '';
    }

     /**
	 * Get specified parameters
	 * --s : action will affect subfolders too
	 * --e ext1,ext2 : list only theses extensions
     * --ne ext1,ext2 : list all files without theses following extensions
     * --da: access date (fileatime)
     * --dc: creation date (filectime)
     * --uid 500,700: owner
     * --nuid 500, 700: not in the list
     * --gid : group id
     *
	 * @private
	 * @type void
	 **/
   function _PARAM_get($sParam='')
   {
         $this->_PARAM_init();
         $this->sParam = preg_replace("/[ ]+/",' ',$sParam);

         //--------------------
         // folders parameters
         //--------------------
         if ((preg_match("/--s /",$this->sParam))||(preg_match("/--s$/",$this->sParam))) $this->aParam['bSubfolders'] = TRUE;

         //--------------------
         // owners
         //--------------------
        if ($this->bUnix)
        {
             // owner
             if (preg_match("/--n?uid /",$this->sParam)){
                $sIN = ((is_int(strpos($this->sParam,'--uid')))?'uid':'nuid');
                $sPattern = "--$sIN ([0-9]{3,4},)*([0-9]{3,4}){1}";
                if ((preg_match("/$sPattern /",$this->sParam))||(preg_match("/$sPattern$/",$this->sParam))){
                             $this->aParam['bOwner'] = TRUE;
                             $this->aParam['aOwner'] = $this->_PARAM_get_extension($sIN);
                             $this->aParam['inOwner'] = ($sIN=='uid');
                             $this->aParam['iParameters']++;
                } //if
                else $this->_PARAM_get_the_error("--$sIN ");
             }
             // group
             if (preg_match("/--n?gid /",$this->sParam)){
                $sIN = ((is_int(strpos($this->sParam,'--uid')))?'gid':'ngid');
                $sPattern = "--$sIN ([0-9]{3},)*([0-9]{3}){1}";
                if ((preg_match("$sPattern ",$this->sParam))||(preg_match("/$sPattern$/",$this->sParam))){
                             $this->aParam['bGroup'] = TRUE;
                             $this->aParam['aGroup'] = $this->_PARAM_get_extension($sIN);
                             $this->aParam['inGroup'] = ($sIN=='gid');
                             $this->aParam['iParameters']++;
                } //if
                else $this->_PARAM_get_the_error("--$sIN ");
             }
         }// if unix
         //--------------------
         // Dates
         //--------------------
         if ((is_int(strpos($this->sParam,'--da ')))|(is_int(strpos($this->sParam,'--dc ')))){
            $sPattern = "--dc [<>=!]{1,2} [0-9]{8}";
            if (preg_match("/$sPattern/",$this->sParam,$matches))
            {
                $string = $matches[0];
                $this->aParam['bCreate'] = TRUE;
                preg_match("/[<>=!]{1,2}/",$string,$matches);
                $this->aParam['dCreatesigne'] = $matches[0];
                preg_match("/[0-9]{8}/",$string,$matches);
                $this->aParam['dCreatevalue'] = $matches[0];
                $this->aParam['iParameters']++;
            }
            $sPattern = "--da [<>=!]{1,2} [0-9]{8}";
            if (preg_match("/$sPattern/",$this->sParam,$matches))
            {
                $string = $matches[0];
                $this->aParam['bAccess'] = TRUE;
                preg_match("/[<>=!]{1,2}/",$string,$matches);
                $this->aParam['dAccesssigne'] = $matches[0];
                preg_match("/[0-9]{8}/",$string,$matches);
                $this->aParam['dAccessvalue'] = $matches[0];
                $this->aParam['iParameters']++;
            }
         }
         //--------------------
         // files parameters
         //--------------------
         if (preg_match("/--n?e /",$this->sParam)){
            $sIN = ((is_int(strpos($this->sParam,'--e ')))?'e':'ne');
            $sMotif = "--$sIN ([a-zA-Z0-9]{3,4},)*([a-zA-Z0-9]{3,4}){1}";
            if ((eregi("$sMotif ",$this->sParam))||(eregi("$sMotif$",$this->sParam))){
                         $this->aParam['bExtension'] = TRUE;
                         $this->aParam['aExtension'] = $this->_PARAM_get_extension($sIN);
                         $this->aParam['inExtension'] = ($sIN=='e');
                         $this->aParam['iParameters']++;
            } //if
            else $this->_PARAM_get_the_error("--$sIN ");
         }
   }// _PARAM_get()

     /**
	 * Get an extension list
	 *
	 * @param string cParam required; the parameter for the list
	 * @private
	 * @type array
	 **/
   function _PARAM_get_extension($cParam)
   {
   // get the extension in parameters
     $aPatterns = explode("--$cParam ",$this->sParam);
     $aPatterns = explode(' ',$aPatterns[1]);
     $aPatterns = explode(',',$aPatterns[0]);
     // to lowercase
     $aKeys = array_keys($aPatterns);
     for ($i = 0; $i < count($aKeys);$i++) $aPatterns[$aKeys[$i]] = strtolower($aPatterns[$aKeys[$i]]);
     return $aPatterns;
   } //_PARAM_get_extension

     /**
	 * add an error for the mismatch parameter list
	 *
	 * @param string sMotif required ; the motif mismatching
	 * @private
	 * @type void
	 **/
   function _PARAM_get_the_error($sMotif)
   {
         $aPatterns = explode($sMotif,$this->sParam);
         $aPatterns = explode(' ',$aPatterns[1]);
         $this->aErrors[] = $sMotif.' ['.$aPatterns[0].'] mismatch';
   }// __PARAM_get_the_error()

     /**
	 * Function that list files according with specified parameters
	 *
	 * @param string sPath required. the path to list
	 * @private
	 * @type array
	 **/
    function _LIST_files($sPath)
    {
             $aFiles = array();
             $dir = openDir($sPath);
             while ($oObj = readDir($dir))
             {
                $iNumber_found = 0;
                $sComplete_path = $sPath.'/'.$oObj;
                if (is_file($sComplete_path)){
                    // check extension
                    if ($this->aParam['bExtension'])
                    {
                           $dPathinfos = pathinfo($sComplete_path);
                           if (in_array(strtolower($dPathinfos['extension']),$this->aParam['aExtension']) == $this->aParam['inExtension']) $iNumber_found++;
                    } // if Extension
                    // check Access date
                    if ($this->aParam['bAccess'])
                    {
                            $adate = date("dmY",fileatime($sComplete_path));
                            if ($this->_TEST_adate($adate)) $iNumber_found++;
                    }// if bAccess
                    if ($this->aParam['bCreate'])
                    {
                            $adate = date("dmY",filectime($sComplete_path));
                            if ($this->_TEST_cdate($adate)) $iNumber_found++;
                    }// create
                    if ($this->bUnix){
                        $iPerms = $this->_perm_transform($sComplete_path);
                        if ($this->aParam['bOwner']){
                            if (in_array($iPerms,$this->aParam['aOwner']) == $this->aParam['inOwner']) $iNumber_found++;
                        }// if Owner
                        if ($this->aParam['bGroup']){
                            if (in_array($iPerms,$this->aParam['aGroup']) == $this->aParam['inGroup']) $iNumber_found++;
                        }
                    }
                    if ($iNumber_found == $this->aParam['iParameters'])$aFiles[] = $sComplete_path;

                }// if is file
                if ($this->aParam['bSubfolders'] && is_dir($sComplete_path) && ($oObj != ".") && ($oObj != "..")){
                    $aFiles = array_merge($aFiles,$this->_LIST_files($sComplete_path));
                }// if Subfolders
             }//while
             closeDir($dir);
             return $aFiles;
    }// LIST_files

     /**
	 * Function that list directories according with specified parameters
	 *
	 * @private
	 * @type array
	 **/
    function _LIST_directories($directory)
    {
             $aDir = array();
             $dir = openDir($directory);
             while ($oObj = readDir($dir))
             {
                $iNumber_found = 0;
                $sComplete_path = $directory.'/'.$oObj;
                if (is_dir($sComplete_path) && ($oObj != ".") && ($oObj != ".."))
                {
                  if ($this->aParam['bSubfolders']) $aDir = array_merge($aDir,$this->_LIST_directories($sComplete_path));
                    if ($this->aParam['bAccess'])
                    {
                            $adate = date("dmY",fileatime($sComplete_path));
                            if ($this->_TEST_adate($adate)) $iNumber_found++;
                    }// if bAccess
                    if ($this->aParam['bCreate'])
                    {
                            $adate = date("dmY",filectime($sComplete_path));
                            if ($this->_TEST_cdate($adate)) $iNumber_found++;
                    }// create
                    if ($this->bUnix)
                    {
                        $iPerms = $this->_perm_transform($sComplete_path);
                        if ($this->aParam['bOwner']){
                            if (in_array($iPerms,$this->aParam['aOwner']) == $this->aParam['inOwner']) $iNumber_found++;
                        }// if Owner
                        if ($this->aParam['bGroup']){
                            if (in_array($iPerms,$this->aParam['aGroup']) == $this->aParam['inGroup']) $iNumber_found++;
                        }
                    }
                    if ($iNumber_found == $this->aParam['iParameters'])$aDir[] = $sComplete_path;
                }
             }//while
             closeDir($dir);
             return $aDir;
    }// LIST

     /**
	 * test if a specified date is according with the specified parameters acces date
	 *
	 * @private
	 * @type bool
	 **/
    function _TEST_adate($adate)
    {
         switch($this->aParam['dAccesssigne'])
            {
                case '=':
                {
                    if ($adate == $this->aParam['dAccessvalue']) return TRUE;
                    break;
                }
                case '!=':
                {
                    if ($adate != $this->aParam['dAccessvalue']) return TRUE;
                    break;
                }
                case '>=':
                {
                    if ($adate >= $this->aParam['dAccessvalue']) return TRUE;
                    break;
                }
                case '>':
                {
                    if ($adate > $this->aParam['dAccessvalue']) return TRUE;
                    break;
                }
                case '<':
                {
                    if ($adate<$this->aParam['dAccessvalue']) return TRUE;
                    break;
                }
                case '<=':
                {
                    if ($adate<=$this->aParam['dAccessvalue']) return TRUE;
                    break;
                }
        }// switch
        return FALSE;
    }
     /**
	 * test if a specified date is according with the specified parameters create date
	 *
	 * @private
	 * @type bool
	 **/
    function _TEST_cdate($adate)
    {
        switch($this->aParam['dCreatesigne'])
                            {
                                case '=':
                                {
                                    if ($adate == $this->aParam['dCreatevalue']) return TRUE;
                                    break;
                                }
                                case '!=':
                                {
                                    if ($adate != $this->aParam['dCreatevalue']) return TRUE;
                                    break;
                                }
                                case '>=':
                                {
                                    if ($adate >= $this->aParam['dCreatevalue']) return TRUE;
                                    break;
                                }
                                case '>':
                                {
                                    if ($adate > $this->aParam['dCreatevalue']) return TRUE;
                                    break;
                                }
                                case '<':
                                {
                                    if ($adate < $this->aParam['dCreatevalue']) return TRUE;
                                    break;
                                }
                                case '<=':
                                {
                                    if ($adate<=$this->aParam['dCreatevalue']) return TRUE;
                                    break;
                                }
                            }//switch
        return FALSE;
    }


     /**
	 * Function that convert to Mo the size of a folder
	 *
	 * @param int size required. the size to convert
	 * @private
	 * @type int
	 **/
    function _SIZE_format($size)
    {
             // format a specified number into Mo
             // 1 ko = 1024 bits

             if ($size<=0){
                  $this->aErrors[] = 'specfied size ['.$size.'] is invalid';
                  return;
             }
             return ($size/(1024*1000));
    }// size

     /**
	 * convert perm file from dec->Unix form (777 for example)
	 *
	 * @param string file : the file to analyse
	 * @private
	 * @type int
	 **/
    function _perm_transform($file)
    {
        $perm = decbin(fileperms($file));
        $z = explode('z',wordwrap(substr($perm,(strlen($perm)-9)),3,'z',1));
        return $this->bin2dec($z[0]).$this->bin2dec($z[1]).$this->bin2dec($z[2]);
    }

    function bin2dec($binary_code)
    {
        for($i=1;$i<=strlen($binary_code);$i++)
        {
            if ($binary_code{$i-1} == "1") $x=(2*$x)+1;
            else $x=2*$x;
        }
        $calculated_dec=$x;
        return $calculated_dec;
    }
}// class
?>
