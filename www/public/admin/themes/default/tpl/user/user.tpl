{extends file="base/admin.tpl"}

{block name="body-main" append}

<table class="flexme1"></table>


{literal}
<script type="text/javascript">
    $(document).ready(function(){

		$("#flexme1").flexigrid
                    (
                    {
                    url: 'post3.php',
                    dataType: 'json',
                    colModel : [
                            {display: 'Pk_user', name : 'pk_user', width : 100, sortable : true, align: 'center'},
                            {display: 'Name', name : 'name', width : 100, sortable : true, align: 'left'},
                            {display: 'Last Name', name : 'lastname', width : 100, sortable : true, align: 'left'},
                            {display: 'First Name', name : 'firstname', width : 100, sortable : true, align: 'left'},
                            {display: 'Email', name : 'email', width : 200, sortable : true, align: 'right'}
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
                    width: 600,
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
       
    });

</script>
{/literal}



{/block}