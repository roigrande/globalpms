<a href="?action=insert" >insert</a>
<table border=1>
<?php foreach ($data as $key => $values): ?>
	<tr>
    <?php foreach($values as $value):?>
		<td><?=$value?></td>		
	<?php endforeach; ?>
		<td>
    		<a href="?action=update&id=<?=$values['id']?>">update</a> 
    		<a href="?action=delete&id=<?=$values['id']?>">delete</a>
    	</td>
	</tr>
<?php endforeach; ?>
</table>