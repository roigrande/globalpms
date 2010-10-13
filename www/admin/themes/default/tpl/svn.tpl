{include file="header.tpl"}
<div>
    {include file="botonera_up.tpl"}
    <table class="adminheading">
        <tr>
            <th nowrap>Subversion configuration</th>
        </tr>
    </table>
    <table class="adminlist">
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="10%">
                <label for="title" >User:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="90%" colspan='3'>
                <input type="text" id="username" name="username" title="Username"
                    value="{$username}" class="required" size="100" />
            </td>
        </tr>
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="10%">
                <label for="title" >Pass:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="90%" colspan='3'>
                <input type="password" id="password" name="password" title="Password"
                    value="{$password}" class="required" size="100" />
            </td>
        </tr>
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="10%">
                <label for="title" >Svn:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="90%" colspan='3'>
                <input type="text" id="repository" name="repository" title="Svn-server"
                    value="{$repository}" class="required" size="100" />
            </td>
        </tr>
        <tr>
            <td valign="top" align="right" style="padding:4px;" width="10%">
                <label for="title" >Folder destination:</label>
            </td>
            <td style="padding:4px;" nowrap="nowrap" width="90%" colspan='3'>
                <input type="text" id="destination" name="destination" title="Destination"
                    value="{$destination}" class="required" size="100" />
            </td>
        </tr>
        <tr><td colspan="2"><br />

        </td></tr>
        </table>
{if isset($return) && !empty($return)}
    <h3>{if $action == 'co'}Checking out{elseif $action == 'info'}Getting SVN info{elseif $action == 'update'}Updating SVN {elseif $action == 'list'}Listing SVN files{/if}</h3>
    <b>{$checkout}</b><br />
    <pre style="background:#F7F7F7 none repeat scroll 0 0;border:1px solid #D7D7D7;padding:0;margin:0.5em 1em;overflow:auto;">
    <p>
    {foreach from=$return item=foo}
    {$foo}
    {/foreach}
    </p>
    </pre>
{else}
    <b>{$checkout}</b><br />
     <pre style="background:#F7F7F7 none repeat scroll 0 0;border:1px solid #D7D7D7;padding:0;margin:0.5em 1em;overflow:auto;">
        <div style="text-align:center"><h3>There is an error in the SVN connection. Please check your SVN seetings</h3></div>
    </pre>
{/if}
</div>

{include file="footer.tpl"}