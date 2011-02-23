{extends file="base/admin.tpl"}

{block name="header-css append"}
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
    {/literal}
{/block}

{block name="body-main" append}

    <div class="box">
    <table id="flex1" style="display:none"></table>
    </div>

{/block}


{block name="footer-js" append}
    {literal}
        <script type="text/javascript">
            $(document).ready(function(){
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
                        {display: 'Email', name : 'email', width : 150, sortable : true, align: 'right'}
                        ],
                buttons : [
                        {name: 'Add', bclass: 'add', onpress : test},
                        {name: 'Delete', bclass: 'delete', onpress : test},
                          {name: 'New', bclass: 'new', onpress : test},
                        {separator: true}
                        ],
                searchitems : [
                        {display: 'Pk_user', name : 'pk_user'},
                        {display: 'Name', name : 'name', isdefault: true}
                        ],
                sortname: "pk_user",
                sortorder: "asc",
                usepager: true,
                title: 'Users',
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
                                    location.href='user.php?action=update';
                                }
                        else if (com=='New')
                                {
                                    location.href='user.php?action=create';
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