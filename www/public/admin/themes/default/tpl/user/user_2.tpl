{extends file="base/admin.tpl"}

{block name="body-main" append}


{literal}


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
						Application::forward(SITE_URL.'public/admin/index.php');
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
{/literal}


{/block}