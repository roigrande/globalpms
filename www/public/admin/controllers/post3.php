<?php

function runSQL($rsql) {

	$db['default']['hostname'] = "localhost";
	$db['default']['username'] = 'root';
	$db['default']['password'] = "hola";
	$db['default']['database'] = "bdglobalpms";

	$db['live']['hostname'] = 'localhost';
	$db['live']['username'] = 'root';
	$db['live']['password'] = 'hola';
	$db['live']['database'] = 'bdglobalpms';

	$active_group = 'default';

	$base_url = "http://".$_SERVER['HTTP_HOST'];

        $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

        if (strpos($base_url,'webplicity.net')){ $active_group = "live";
        }
	$connect = mysql_connect($db[$active_group]['hostname'],$db[$active_group]['username'],$db[$active_group]['password']) or die ("Error: could not connect to database");

        $db = mysql_select_db($db[$active_group]['database']);
           
	$result = mysql_query($rsql) or die ($rsql);
    
        return $result;

	mysql_close($connect);
}

function countRec($fname,$tname) {
	$sql = "SELECT count($fname) FROM $tname ";
	$result = runSQL($sql);
	while ($row = mysql_fetch_array($result)) {
		return $row[0];
	}
}
$page = (isset($_POST[ 'page' ])) ? $_POST[ 'page' ] : 1;
$rp = (isset($_POST[ 'rp' ])) ? $_POST[ 'rp' ] : 15;
$sortname = (isset($_POST[ 'sortname' ])) ? $_POST[ 'sortname' ] : "";
$sortorder = (isset($_POST[ 'sortorder' ])) ? $_POST[ 'sortorder' ] : "";




if (!$sortname) $sortname = 'name';
if (!$sortorder) $sortorder = 'desc';

$sort = "ORDER BY $sortname $sortorder";

if (!$page) $page = 1;
if (!$rp) $rp = 10;

$start = (($page-1) * $rp);

$limit = "LIMIT $start, $rp";

$query = (isset($_POST[ 'query' ])) ? $_POST[ 'query' ] : "";
$qtype = (isset($_POST[ 'qtype' ])) ? $_POST[ 'qtype' ] : "";

$where = "";
if ($query) $where = " WHERE $qtype LIKE '%$query%' ";

$sql = "SELECT pk_user,name,lastname,firstname,email FROM users $where $sort $limit";


$result = runSQL($sql);
$total = countRec("pk_user","users $where");

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" );
header("Cache-Control: no-cache, must-revalidate" );
header("Pragma: no-cache" );
header("Content-type: text/x-json");
$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "total: $total,\n";
$json .= "rows: [";
$rc = false;
while ($row = mysql_fetch_array($result)) {
	if ($rc) $json .= ",";
	$json .= "\n{";
	$json .= "id:'".$row['pk_user']."',";
	$json .= "cell:['".$row['pk_user']."'";
	$json .= ",'".addslashes($row['name'])."'";
	$json .= ",'".addslashes($row['lastname'])."'";
	$json .= ",'".addslashes($row['firstname'])."'";
	$json .= ",'".$row['email']."']";
	$json .= "}";
	$rc = true;
}
$json .= "]\n";
$json .= "}";

echo($json);
?>