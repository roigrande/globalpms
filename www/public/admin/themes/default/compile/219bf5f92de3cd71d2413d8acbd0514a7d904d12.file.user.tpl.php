<?php /* Smarty version Smarty-3.0.6, created on 2011-02-21 11:50:10
         compiled from "/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12418316294d624362cae6d7-05789970%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '219bf5f92de3cd71d2413d8acbd0514a7d904d12' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user.tpl',
      1 => 1298285409,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12418316294d624362cae6d7-05789970',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Flexigrid</title>
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" type="text/css" href="../themes/default/css/flexigrid/flexigrid.css">
<script type="text/javascript" src="../themes/default/js/flexigrid/jquery/jquery.js"></script>
<script type="text/javascript" src="../themes/default/js/flexigrid/flexigrid.js"></script>
</head>

<body>





<style>

	.flexigrid div.fbutton .add
		{
			background: url(css/images/add.png) no-repeat center left;
		}

	.flexigrid div.fbutton .delete
		{
			background: url(css/images/close.png) no-repeat center left;
		}

</style>


<table id="flex1" style="display:none"></table>


<script type="text/javascript">
    $(document).ready(function(){


			$("#flex1").flexigrid
			(
			{
			url: 'post3.php',
			dataType: 'json',
			colModel : [
				{display: 'Pk_user', name : 'pk_user', width : 40, sortable : true, align: 'center'},
				{display: 'Name', name : 'name', width : 180, sortable : true, align: 'left'},
				{display: 'Last Name', name : 'lastname', width : 120, sortable : true, align: 'left'},
				{display: 'First Name', name : 'firstname', width : 130, sortable : true, align: 'left', hide: true},
				{display: 'Email', name : 'email', width : 80, sortable : true, align: 'right'}
				],
			buttons : [
				{name: 'Add', bclass: 'add', onpress : test},
				{name: 'Delete', bclass: 'delete', onpress : test},
				{separator: true}
				],
			searchitems : [
				{display: 'Pk_user', name : 'pk_user'},
				{display: 'Name', name : 'name', isdefault: true}
				],
			sortname: "pk_user",
			sortorder: "asc",
			usepager: true,
			title: 'Countries',
			useRp: true,
			rp: 15,
			showTableToggleBtn: true,
			width: 700,
			height: 200
			}
			);

			function test(com,grid)
			{
				if (com=='Delete')
					{
						confirm('Delete ' + $('.trSelected',grid).length + ' items?')
					}
				else if (com=='Add')
					{
						alert('Add New Item');
					}
			}


		$('b.top').click
		(
			function ()
				{
					$(this).parent().toggleClass('fh');
				}
		);


</script>
</body>
</html>
