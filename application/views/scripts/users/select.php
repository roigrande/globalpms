<a href="?controller=users&action=insert" >insert</a><br/>
<a href="?controller=users&action=logout">Logout</a>
<table border=1>
	<tr>
		<th>id</th>
		<th>name</th>
		<th>email</th>
		<th>options</th>
	</tr>			
	<?php foreach ($data as $key => $values): ?>	
	<tr>		
	    	<td><?=$values['id']?></td>
	    	<td><?=$values['name']?></td>
	    	<td><?=$values['email']?></td>	
			<td>
	    		<a href="?controller=users&action=update&id=<?=$values['id']?>">update</a> 
	    		<a href="?controller=users&action=delete&id=<?=$values['id']?>">delete</a>
	    	</td>
	</tr>		
	<?php endforeach; ?>
</table>