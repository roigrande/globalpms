<?php
error_reporting(E_ERROR);
class Configuration
{
  private $configFile = 'config.inc.php';

  private $items = array();

  function __construct() { $this->parse(); }

  function __get($id) { return $this->items[ $id ]; }
  function __set($id,$v) { $this->items[ $id ] = $v; }


  function get_items() { $vbles = $this->items;return $vbles; }

  function get_items() { $vbles = $this->items;return $vbles; }

  function set_items($vbles) { $this->items = $vbles;

	foreach ($this->items as $key => $vb) 
	{
		//echo $key." ".$vb."<br />";
		if ( $key == "STATUS" ) $this->items['STATUS'] = "\"$vb\"";

		if ( $key == "SITE" ) $this->items['SITE'] = "\"$vb\"";
		if ( $key == "SITE_PATH" ) $this->items['SITE_PATH'] = "\"$vb\"";
		if ( $key == "SITE_ADMIN_DIR" ) $this->items['SITE_ADMIN_DIR'] = "\"$vb\"";
		if ( $key == "SITE_ADMIN_PATH" ) $this->items['SITE_ADMIN_PATH'] = 'SITE_PATH.SITE_ADMIN_DIR';
		if ( $key == "SITE_URL" ) $this->items['SITE_URL'] = '"http://".SITE';
		if ( $key == "SITE_URL_SSL" ) $this->items['SITE_URL_SSL'] = '"https://".SITE';
		if ( $key == "SITE_URL_ADMIN" ) $this->items['SITE_URL_ADMIN'] = 'SITE_URL.SITE_ADMIN_DIR';
		if ( $key == "SITE_URL_ADMIN_SSL" ) $this->items['SITE_URL_ADMIN_SSL'] = 'SITE_URL_SSL.SITE_ADMIN_DIR';
		if ( $key == "SITE_LIBS_PATH" ) $this->items['SITE_LIBS_PATH'] = 'SITE_PATH."/libs/"';
		
		if ( $key == "URL" ) $this->items['URL'] = 'SITE_URL_ADMIN';
		if ( $key == "URL_PUBLIC" ) $this->items['URL_PUBLIC'] = 'SITE_URL';
		if ( $key == "RELATIVE_PATH" ) $this->items['RELATIVE_PATH'] = 'SITE_ADMIN_DIR';
		if ( $key == "PATH_APP" ) $this->items['PATH_APP'] = 'SITE_ADMIN_PATH';


		if ( $key == "ITEMS_PAGE" ) $this->items['ITEMS_PAGE'] = "\"$vb\"";
		if ( $key == "BD_TYPE" ) $this->items['BD_TYPE'] = "\"$vb\"";
		if ( $key == "BD_HOST" ) $this->items['BD_HOST'] = "\"$vb\"";
		if ( $key == "BD_USER" ) $this->items['BD_USER'] = "\"$vb\"";
		if ( $key == "BD_PASS" ) $this->items['BD_PASS'] = "\"$vb\"";
		if ( $key == "BD_INST" ) $this->items['BD_INST'] = "\"$vb\"";
		if ( $key == "BD_DSN" ) $this->items['BD_DSN'] = 'BD_TYPE."://".BD_USER.":".BD_PASS."@".BD_HOST."/".BD_INST';

		if ( $key == "SYS_LOG_DEBUG" ) $this->items['SYS_LOG_DEBUG'] = "\"$vb\"";
		if ( $key == "SYS_LOG_VERBOSE" ) $this->items['SYS_LOG_VERBOSE'] = "\"$vb\"";
		if ( $key == "SYS_LOG_INFO" ) $this->items['SYS_LOG_INFO'] = "\"$vb\"";
		if ( $key == "SYS_LOG" ) $this->items['SYS_LOG'] = "\"$vb\"";
		if ( $key == "SYS_SESSION_TIME" ) $this->items['SYS_SESSION_TIME'] = "\"$vb\"";

		if ( $key == "MEDIA_UPLOAD" ) $this->items['MEDIA_UPLOAD'] = "\"$vb\"";
		if ( $key == "MEDIA_UPLOAD_FLASH" ) $this->items['MEDIA_UPLOAD_FLASH'] = "\"$vb\"";
		if ( $key == "MEDIA_UPLOAD_VIDEO" ) $this->items['MEDIA_UPLOAD_VIDEO'] = "\"$vb\"";
		if ( $key == "MEDIA_EXTENSIONS" ) $this->items['MEDIA_EXTENSIONS'] = "\"$vb\"";
		if ( $key == "MEDIA_MAX_SIZE" ) $this->items['MEDIA_MAX_SIZE'] = "\"$vb\"";
		if ( $key == "MEDIA_DIR" ) $this->items['MEDIA_DIR'] = "\"$vb\"";
		if ( $key == "MEDIA_IMG_DIR" ) $this->items['MEDIA_IMG_DIR'] = "\"$vb\"";
		if ( $key == "MEDIA_PATH" ) $this->items['MEDIA_PATH'] = 'SITE_PATH.MEDIA_DIR';
		if ( $key == "MEDIA_PATH_URL" ) $this->items['MEDIA_PATH_URL'] = 'SITE_URL.MEDIA_DIR';
		if ( $key == "MEDIA_IMG_PATH" ) $this->items['MEDIA_IMG_PATH'] = 'MEDIA_PATH.MEDIA_IMG_DIR';
		if ( $key == "MEDIA_IMG_PATH_URL" ) $this->items['MEDIA_IMG_PATH_URL'] = 'MEDIA_PATH_URL.MEDIA_IMG_DIR';

		if ( $key == "PATH_UPLOAD" ) $this->items['PATH_UPLOAD'] = 'MEDIA_IMG_PATH';
		if ( $key == "URL_UPLOAD" ) $this->items['URL_UPLOAD'] = 'MEDIA_IMG_PATH_URL';

		if ( $key == "BD_TYPE" ) $this->items['BD_TYPE'] = "\"$vb\"";
		if ( $key == "BD_HOST" ) $this->items['BD_HOST'] = "\"$vb\"";
		if ( $key == "BD_USER" ) $this->items['BD_USER'] = "\"$vb\"";
		if ( $key == "BD_PASS" ) $this->items['BD_PASS'] = "\"$vb\"";
		if ( $key == "BD_INST" ) $this->items['BD_INST'] = "\"$vb\"";
		if ( $key == "BD_DSN" ) $this->items['BD_DSN'] = 'BD_TYPE."://".BD_USER.":".BD_PASS."@".BD_HOST."/".BD_INST';

		if ( $key == "TEMPLATE_ADMIN" ) $this->items['TEMPLATE_ADMIN'] = "\"$vb\"";
		if ( $key == "TEMPLATE_USER" ) $this->items['TEMPLATE_USER'] = "\"$vb\"";

		if ( $key == "MAIL_HOST" ) $this->items['MAIL_HOST'] = "\"$vb\"";
		if ( $key == "MAIL_USER" ) $this->items['MAIL_USER'] = "\"$vb\"";
		if ( $key == "MAIL_PASS" ) $this->items['MAIL_PASS'] = "\"$vb\"";

		$this->items[$key] = preg_replace('/\/\//', '/', $this->items[$key]);
		$this->items[$key] = preg_replace('/:\//', '://', $this->items[$key]);
	}

  }

  function get_conf_file() { return $this->configFile; }

  function parse()
  {
    $fh = fopen( $this->configFile, 'r' );
    while( $l = fgets( $fh ) )
    {
      if ( preg_match( '/^#/', $l ) == false && preg_match( '/^define/', $l ) == true)
      {
	if ( preg_match( '/^define \(\'(.*?)\', (.*?)\);$/', $l, $found ) == true )
	{
	  $found[2] = preg_replace('/\/\//', '/', $found[2]);
	  $found[2] = preg_replace('/:\//', '://', $found[2]);

	  $found[2] = preg_replace('/"/', '', $found[2]);
	  $this->items[ $found[1] ] = $found[2];

	}
	//echo $l;
	//echo  "('".$found[1]."',"." ". $found[2].")<br />";	
      }
    }

    fclose( $fh );
    return;
  }

  function save()
  {
    //$vbles = $this->items;

    $nf = '';
    $fh = fopen( $this->configFile, 'r' );
    while( $l = fgets( $fh ) )
    {
      if ( preg_match( '/^#/', $l ) == false && preg_match( '/^define/', $l ) == true )
      {
	if (preg_match( '/^define \(\'(.*?)\', \'(.*?)\'\);$/', $l, $found ) == true )
	{ $nf .= "define ('".$found[1]."', '".$this->items[$found[1]]."');\n"; }
	else
	{ preg_match( '/^define \(\'(.*?)\', .*\);$/', $l, $found );
	$nf .= "define ('".$found[1]."', ".$this->items[$found[1]].");\n"; }
	//echo "define ('".$found[1]."', ".$this->items[$found[1]].");<br>";
      }
      else {$nf .= $l;
	//echo $l."<br>";
	 }
    }
	
    fclose( $fh );
    copy( $this->configFile, $this->configFile.'.bak' );
    $fh = fopen( $this->configFile, 'w' );
    fwrite( $fh, $nf );
    fclose( $fh );
  }

}
?>