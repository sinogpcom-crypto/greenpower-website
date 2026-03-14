<?php
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
?>
<script type="text/javascript"> 
<!--
$(function(){
	$.formValidator.initConfig({autotip:true,formid:"myform",onerror:function(msg){}});
	$("#product").formValidator({onshow:"<?php echo L('input','','admin').L('product')?>",onfocus:"<?php echo L('product').L('no_empty')?>"}).inputValidator({min:1,max:999,onerror:"<?php echo L('product').L('no_empty')?>"});
	})
//-->
</script> 
<div class="pad-lr-10"> 
<form action="?m=products_map&c=products_map&a=add" method="post" name="myform" id="myform">
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
		<th></th>
		<td><input
		type="submit" name="dosubmit" id="dosubmit" class="button"
		value=" <?php echo L('submit')?> "></td>
	</tr>

</table>
</form>
</div>
</body>
</html>
