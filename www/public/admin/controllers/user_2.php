
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Flexigrid</title>
<link rel="stylesheet" type="text/css" href="../themes/default/css/flexigrid/flexigrid.css"/>
<script type="text/javascript" src="/public/admin/themes/default/js/jquery.js"></script>
<script type="text/javascript" src="/public/admin/themes/default/js/flexigrid/flexigrid.js"></script>
</head>

<body>



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

</body>
</html>
