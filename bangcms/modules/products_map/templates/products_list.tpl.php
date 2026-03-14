<?php
defined('IN_ADMIN') or exit('No permission resources.');
$show_dialog = 1;
include $this->admin_tpl('header','admin');
?>
<div class="pad-lr-10">
<form name="searchform" action="?m=products_map&c=products_map" method="post" >
<table width="100%" cellspacing="0" class="search-form">
	<input type="hidden" name="siteid" value="<?php echo $siteid?>">
    <tbody>
		<tr>
		<td><div class="explain-col">    
		<?php echo L('product')?>:  <input type="text" value="" class="input-text" name="search[product]">  
		<?php echo L('company')?>:  <input type="text" value="" class="input-text" name="search[company]">  
		<?php echo L('inserttime')?>:  <?php echo form::date('search[start_time]','','')?> <?php echo L('to')?>   
		<?php echo form::date('search[end_time]','','')?>    <input type="submit" value="<?php echo L('search')?>" class="button" name="dosubmit">
		</div>
		</td>
		</tr>
    </tbody>
</table>
</form>
<form name="myform" action="?m=products_map&c=products_map&a=delete" method="post" onsubmit="checkuid();return false;">
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th width="10%" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
			<th width="10%"><?php echo L('product')?></th>
			<th width="20%" align="center"><?php echo L('company')?></th>
			<th width="18%" align="center"><?php echo L('address')?></th>
			<th width="5%" align="center"><?php echo L('tel')?></th>
			<th width="5%" align="center"><?php echo L('fax')?></th>
			<th width="10%"><?php echo L('main_products')?></th>
			<th width='7%' align="center"><?php echo L('inserttime')?></th>
			<th width='15%' align="center"><?php echo '操作'?></th>
		</tr>
	</thead>
<tbody>
<?php
if(is_array($infos)){
	foreach($infos as $info){
		?>
	<tr>
		<td align="center" width="10"><input type="checkbox"
			name="id[]" value="<?php echo $info['id']?>"></td>
		<td  width="10%"><?php echo $info['product']?></td>
		<td  widht="20%"><?php echo $info['company'];?></td>
		<td align="center" width="18%"><?php echo $info['address'];?></td>
		<td align="center" width="5%"><?php echo $info['tel'];?></td>
		<td align="center" width="5%"><?php echo $info['fax'];?></td>
		<td  width="10%"><?php echo $info['main_products']?></td>
		<td align="center" width="7%"><?php echo date('Y-m-d',$info['inserttime']);?></td>
		<td align="center" width="15%"> 
		<a href='?m=products_map&c=image_map&pid=<?php echo $info['id']?>'><?php echo L('infos')?></a>
		|<a href="###" onclick="update(<?php echo $info['id']?>, '<?php echo new_addslashes(new_html_special_chars($info['product']))?>')"
			title="<?php echo L('update')?>"><?php echo L('update_product')?></a>
		|<a href='?m=products_map&c=products_map&a=delete&id=<?php echo $info['id']?>'
			onClick="return confirm('<?php echo L('product_delete')?>')"><?php echo L('delete')?></a>
		</td>
	</tr>
	<?php
	}
}
?>



</tbody>
</table>
<div class="btn"><a href="#"
	onClick="javascript:$('input[type=checkbox]').attr('checked', true)"><?php echo L('selected_all')?></a>/<a
	href="#"
	onClick="javascript:$('input[type=checkbox]').attr('checked', false)"><?php echo L('cancel')?></a>
<input name="submit" type="submit" class="button"
	value="<?php echo L('remove_all_selected')?>"
	onClick="return confirm('<?php echo L('product_delete')?>')">&nbsp;&nbsp;</div>
<div id="pages"><?php echo $pages?></div>
</div>
</form>
</div>
<script type="text/javascript">
function update(id, product) {
	window.top.art.dialog({id:'update'}).close();
	window.top.art.dialog({title:'<?php echo L('update')?> '+product+' ',id:'update',iframe:'?m=products_map&c=products_map&a=update&id='+id,width:'550',height:'350'}, function(){var d = window.top.art.dialog({id:'update'}).data.iframe;var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'update'}).close()});
}
function see_all(id, name) {
	window.top.art.dialog({id:'sell_all'}).close();
	window.top.art.dialog({title:'<?php echo L('details');//echo L('update')?> '+name+' ',id:'update',iframe:'?m=words&c=words&a=see_all&id='+id,width:'700',height:'450'}, function(){var d = window.top.art.dialog({id:'see_all'}).data.iframe;var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'see_all'}).close()});
}
function checkuid() {
	var ids='';
	$("input[name='id[]']:checked").each(function(i, n){
		ids += $(n).val() + ',';
	});
	if(ids=='') {
		window.top.art.dialog({content:"<?php echo L('before_select_operation')?>",lock:true,width:'200',height:'50',time:1.5},function(){});
		return false;
	} else {
		myform.submit();
	}
}
</script>
</body>
</html>
