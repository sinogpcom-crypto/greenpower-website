<?php
include $this->admin_tpl('header','admin');
?>
<br /><br /><br />
<div class="pad_10">
<form action="?m=products_map&c=products_map&a=<?php echo empty($id)?'add':'update'?>" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
	<tr>
		<th width="100"> * <?php echo L('product')?>：</th>
		<td><input type="text" name="info[product]" id="product"
			size="30" class="input-text" value="<?php echo $product;?>"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo L('company')?>：</th>
		<td><input type="text" name="info[company]" 
			size="30" class="input-text" value="<?php echo $company;?>"></td>
	</tr>
	
	<tr>
		<th><?php echo L('address')?>：</th>
		<td><input type="text" name="info[address]" 
			size="30" class="input-text" value="<?php echo $address;?>"></td>
	</tr>

	<tr>
		<th><?php echo L('tel')?>：</th>
		<td><input type="text" name="info[tel]" 
			size="30" class="input-text" value="<?php echo $tel;?>"></td>
	</tr>
	
	<tr>
		<th><?php echo L('fax')?>：</th>
		<td><input type="text" name="info[fax]" 
			size="30" class="input-text" value="<?php echo $fax;?>"></td>
	</tr>
	<tr>
		<th width="100"><?php echo L('main_products')?>：</th>
		<td><input type="text" name="info[main_products]"
			size="30" class="input-text" value="<?php echo $main_products;?>"></td>
	</tr>
	<tr>
		<th></th>
		<td>
		<?php if(!empty($id)){?>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<?php }?>
		
		<input type="hidden" name="forward" value="?m=products_map&c=products_map&a=update"> 
		<input type="submit" name="dosubmit" id="dosubmit" class="dialog"
		value=" <?php echo L('submit')?> "></td>
	</tr>
</table>
</form>
</div>
</body>
</html>

