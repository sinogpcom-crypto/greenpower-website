<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<div class="pad_10" style="padding-top:10px;">
<form action="?m=job&c=job&a=yp_more&menuid=<?php echo $_GET['menuid']?>&id=<?php echo $ypid?>" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
	
	<tr>
		<th width="100"><?php echo L('name')?>hehe：</th>
		<td><?php echo $name;?></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo L('sex')?>：</th>
		<td><?php echo $sex;?></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo L('age')?>：</th>
		<td><?php echo $age;?> 岁</td>
	</tr>
	
	<tr>
		<th width="100"><?php echo L('xueli')?>：</th>
		<td><?php echo $xueli;?></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo L('jianli')?>：</th>
		<td><?php echo $jianli;?></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo L('remark')?>：</th>
		<td>
			<textarea style="height: 100px; width: 300px;" id="remark" cols="20" rows="2" name="yp[remark]"><?php echo $remark?></textarea>
		</td>
	</tr>
	<tr>
		<th><?php echo L('passed')?>：</th>
		<td>
			<input name="yp[passed]" type="radio" value="1" <?php if($passed==1){echo "checked";}?>>&nbsp;<?php echo L('yes')?>&nbsp;&nbsp;
			<input name="yp[passed]" type="radio" value="0" <?php if($passed==0){echo "checked";}?>>&nbsp;<?php echo L('no')?>
		</td>
	</tr>

	<tr>
		<th></th>
		<td><input type="hidden" name="forward" value="?m=job&c=job&a=yp_more&menuid=<?php echo $_GET['menuid']?>&id=<?php echo $ypid?>"> <input
		type="submit" name="dosubmit" id="dosubmit" class="dialog"
		value=" <?php echo L('submit')?> "></td>
	</tr>

</table>
</form>
</div>
</body>
</html> 

<script type="text/javascript">
<!--
$(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});
	$("#remark").formValidator({
		onshow:"<?php echo L("input").L('remark')?>",
		onfocus:"<?php echo L("input").L('remark')?>",
		oncorrect:"<?php echo L('correct')?>"
	});
	 
})
//-->
</script>