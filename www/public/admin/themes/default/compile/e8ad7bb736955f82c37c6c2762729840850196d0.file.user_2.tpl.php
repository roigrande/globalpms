<?php /* Smarty version Smarty-3.0.6, created on 2011-02-21 16:44:20
         compiled from "/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user_2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20905954384d6286be037f21-96090092%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8ad7bb736955f82c37c6c2762729840850196d0' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/user/user_2.tpl',
      1 => 1298302181,
      2 => 'file',
    ),
    '7a0f52520c7f73509b725c10b0ac8462f8b23cee' => 
    array (
      0 => '/var/www/globalpms/trunk/www/public//admin//themes/default/tpl/base/admin.tpl',
      1 => 1298303058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20905954384d6286be037f21-96090092',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
    <head>
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="author" content="OpenHost,SL" />
        <meta name="generator" content="GlobalPMS - Global Production Management System" />


        
            <title>GlobalPms - Admin section</title>
        

        <!-- Admin CSS -->
        

            
            <!--
            <link rel="stylesheet" type="text/css" href="{$smarty.const.TEMPLATE_ADMIN_PATH_WEB}css/admin.css" />
            -->
            
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
botonera.css"/>
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
index.css"/>
            
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
index.css"/>
            <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('params')->value['CSS_DIR'];?>
loginadmin.css"/>
       
        

        <!-- Admin flexigrid -->
        

        <link rel="stylesheet" type="text/css" href="../themes/default/css/flexigrid/flexigrid.css"/>
        <script type="text/javascript" src="/public/admin/themes/default/js/jquery.js"></script>
        <script type="text/javascript" src="/public/admin/themes/default/js/flexigrid/flexigrid.js"></script>
        
        <!-- Admin Blueprint -->
        

            <link href="/public/themes/default/css/blueprint/screen.css" type="text/css" rel="stylesheet" media="screen, projection"/>
            <link href="/public/themes/default/css/blueprint/print.css" type="text/css" rel="stylesheet" media="print"/>
            <!--[if lt IE 8]><link rel="stylesheet" href="admin/themes/default/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

        

            <!-- JS Admin library -->
        

       
        
        

    </head>
    <body>
       
            <div id="cabecera">
                <div class="container ">
                    <div class="span-6">
                        <div class="box">
                            Logo
                        </div>
                    </div>
                    <div class="span-18 last">
                        <div class="box">
                            <div  id="elmenu">

                                <a href="index.php?action=index"><span>HOME</span></a>

                                <a href="index.php?action=users"><span>USERS</span></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="span-6">
                    widgets
                 </div>
                <div class="span-18 last">
                    <div class="span-18 last">
                        <div class="box">
                            Opciones
                        </div>
                    </div>
                    <div class="span-18 last">
                        <div class="box">
                            

                            





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

<div class="box">
<table id="flex1" style="display:none"></table>
</div>
<div class="box">
<table id="flex2" style="display:none"></table>
</div>

<script type="text/javascript">

                        $("#flex2").flexigrid
			(
			{
			url: 'user.php?action=list_ajax',
			dataType: 'json',
			colModel : [
				{display: 'ISO', name : 'iso', width : 40, sortable : true, align: 'center'},
				{display: 'Name', name : 'name', width : 180, sortable : true, align: 'left'},
				{display: 'Printable Name', name : 'printable_name', width : 120, sortable : true, align: 'left'},
				{display: 'ISO3', name : 'iso3', width : 130, sortable : true, align: 'left', hide: true},
				{display: 'Number Code', name : 'numcode', width : 80, sortable : true, align: 'right'}
				],
			buttons : [
				{name: 'Add', bclass: 'add', onpress : test},
				{name: 'Delete', bclass: 'delete', onpress : test},
				{separator: true}
				],
			searchitems : [
				{display: 'ISO', name : 'iso'},
				{display: 'Name', name : 'name', isdefault: true}
				],
			sortname: "iso",
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

			$("#flex1").flexigrid
			(
			{
			url: 'post3.php',
			dataType: 'json',
			colModel : [
				{display: 'Pk_user', name : 'pk_user', width :100, sortable : true, align: 'center'},
				{display: 'Name', name : 'name', width : 100, sortable : true, align: 'left'},
				{display: 'Last Name', name : 'lastname', width : 100, sortable : true, align: 'left'},
				{display: 'First Name', name : 'firstname', width : 100, sortable : true, align: 'left'},
				{display: 'Email', name : 'email', width : 100, sortable : true, align: 'right'}
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
			width: 620,
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




                        </div>
                    </div>
                </div>
            </div>
            <div id="pie">
                <div class="container ">
                    <div class="span-24 last">
                        <div class="box">
                                Pie
                        </div>
                    </div>
                </div>
            </div>
        
      
    </body>
</html>
