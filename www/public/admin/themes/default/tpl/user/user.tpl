{extends file="base/admin.tpl"}


{block name="body-main" append}

<b>Example 1</b>
<p>
The most basic example with the zero configuration, with a table converted into flexigrid
(<a href="#" onclick="$(this).parent().next().toggle(); return false;">Show sample code</a>)
</p>

<table class="flexme1">
	<thead>
    		<tr>
            	<th width="100">Col 1</th>
            	<th width="100">Col 2</th>
            	<th width="100">Col 3 is a long header name</th>
            	<th width="300">Col 4</th>
            </tr>
    </thead>
    <tbody>
    		<tr>
            	<td>This is data 1 with overflowing content</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>
    		<tr>
            	<td>This is data 1</td>
            	<td>This is data 2</td>
            	<td>This is data 3</td>
            	<td>This is data 4</td>
            </tr>

    </tbody>
</table>
<br />



<table id="flex1" style="display:none"></table>


<script type="text/javascript">
			$('.flexme1').flexigrid();
</script>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3875581-1";
urchinTracker();
</script>

{/block}