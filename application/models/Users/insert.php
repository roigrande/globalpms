<form method="post" id="devilform" 
		enctype="multipart/form-data">
<p>
	<label for="name">Name:</label>
	<input type="text" name="name" id="name" value="<?=$data['name'];?>"  />
</p>
<p>
	<label for="email">Email:</label>
	<input type="text" name="email" id="email" value="<?=$data['email'];?>"  />
</p>
<p>
	<label for="email">Phone:</label>
	<input type="text" name="phone" id="phone" value="<?=$data['phone'];?>" />
</p>
<p>
	<label for="email">Address:</label>
	<input type="text" name="address" id="address" value="<?=$data['address'];?>"  />
</p>
<p>
	<label for="postalcode">Postal Code:</label>
	<input type="text" name="postalcode" id="postalcode" value="<?=$data['postalcode'];?>"  />
</p>
<p>
	<label for="city">City:</label>
	<input type="text" name="city" id="city" value="<?=$data['city'];?>" />
</p>
<?php if(!isset($data['id'])):?>
<p>
	<label for="password">Password:</label>
	<input type="password" name="password" id="password" value="" />
</p>
<?php endif;?>
<?php if(isset($data['id'])):?>
<p>
	<label for="firm">Firm:</label>
	<input type="hidden" name="firm" id="firm" value="<?=$data['firm'];?>"  />
</p>
<?php endif;?>

<p>
	<label for="id">Id:</label>
	<input type="hidden" name="id" id="id" value="<?=$data['id'];?>"  />
</p>
<p>
	<label for="website">Likes:</label>
	<input type="checkbox" name="likes[]" id="website" value="1"  <?=(in_array('1',$data['likes']))?("checked=\"checked\""):('');?>/>cinema
	<input type="checkbox" name="likes[]" id="website" value="2"  <?=(in_array('2',$data['likes']))?("checked=\"checked\""):('');?>/>music
	<input type="checkbox" name="likes[]" id="website" value="3"  <?=(in_array('3',$data['likes']))?("checked=\"checked\""):('');?>/>sports
	<input type="checkbox" name="likes[]" id="website" value="4"  <?=(in_array('4',$data['likes']))?("checked=\"checked\""):('');?>/>travel
	<input type="checkbox" name="likes[]" id="website" value="5"  <?=(in_array('5',$data['likes']))?("checked=\"checked\""):('');?>/>dance
</p>
<p>
	<label for="website">Gender:</label>
	<input type="radio" name="gender" id="website" value="1"  <?=($data['gender']==1)?("checked=\"checked\""):('');?>/>Female
	<input type="radio" name="gender" id="website" value="2"  <?=($data['gender']==2)?("checked=\"checked\""):('');?>/>Male
	<input type="radio" name="gender" id="website" value="3"  <?=($data['gender']==3)?("checked=\"checked\""):('');?>/>Others
</p>
<p>
	<label for="region">State/Region:</label>
	<select name="province" >
	<option value="3" <?=($data['provinces_id']==3)?("selected=\"selected\""):('');?>>Aragón</option>
	<option value="2" <?=($data['provinces_id']==2)?("selected=\"selected\""):('');?>>Catalunya</option>
	<option value="1" <?=($data['provinces_id']==1)?("selected=\"selected\""):('');?>>Galicia</option>
	</select>	
</p>
<p>
	<label for="langueges">Languages:</label>
	<select multiple name="languages[]" >
	<option value="1" <?=(in_array('1',$data['languages']))?("selected=\"selected\""):('');?>>Castellano</option>
	<option value="2" <?=(in_array('2',$data['languages']))?("selected=\"selected\""):('');?>>English</option>
	<option value="3" <?=(in_array('3',$data['languages']))?("selected=\"selected\""):('');?>>Dutch</option>
	</select>	
</p>
<p>
	<label for="comment">Description:</label>
	<textarea name="description" id="description" rows="10" cols="10"><?=trim($data['description']);?>
	</textarea> 
</p>
<?php if(isset($data['id'])):?>
<p>
	<label for="firm">Image:</label>
	<img width=100px height=100px src="<?='/assets/uploads/'.$data['image'];?>" />
</p>
<?php endif;?>
<p>
	<label for="comment">Image:</label>
	<input type="file" name="image"  />
</p>                     
<p>
	<input type="submit"  id="submit" value="Post!" />
</p>
</form>