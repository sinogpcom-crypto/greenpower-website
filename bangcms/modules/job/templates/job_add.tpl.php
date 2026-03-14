<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<div class="pad_10" style="padding-top:10px;">
<form action="?m=job&c=job&a=add" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="100%">
	
	<tr>
		<th width="100"><?php echo L('zhiwei')?>：</th>
		<td><input type="text" name="job[zhiwei]" id="zhiwei" size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100">发布时间：</th>
		<td><?php echo form::date('job[enddate]', $info['enddate'], 1);?></td>
	</tr> 

	<tr>
		<th width="100"><?php echo L('diqu')?>：</th>
		<td><input type="text" name="job[diqu]" id="diqu" size="30" class="input-text"></td>
	</tr>

	<tr>
		<th width="100"><?php echo L('bumen')?>：</th>
		<td><input type="text" name="job[bumen]" id="bumen" size="30" class="input-text"></td>
	</tr>

	<tr>
		<th width="100">职位详情：</th>
		<td><textarea name="job[content]" id="content"></textarea><?php echo form::editor('content');?></td>
	</tr>

<!--	<tr>
		<th width="100"><?php echo L('renshu')?>：</th>
		<td><input type="text" name="job[renshu]" id="renshu" size="30" class="input-text"></td>
	</tr>
	
-->
	

		

<!--
	<tr>
		<th width="100"><?php echo L('lianxiren')?>：</th>
		<td><input type="text" name="job[lianxiren]" id="lianxiren" size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo L('tel')?>：</th>
		<td><input type="text" name="job[tel]" id="tel" size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo L('email')?>：</th>
		<td><input type="text" name="job[email]" id="email" size="30" class="input-text"></td>
	</tr>
	
	<tr>
		<th width="100"><?php echo L('address')?>：</th>
		<td><input type="text" name="job[address]" id="address" size="30" class="input-text"></td>
	</tr>
-->
	<tr>
		<th><?php echo L('passed')?>：</th>
		<td><input name="job[passed]" type="radio" value="1" checked>&nbsp;<?php echo L('yes')?>&nbsp;&nbsp;<input
			name="job[passed]" type="radio" value="0">&nbsp;<?php echo L('no')?></td>
	</tr>

	<tr>
		<th></th>
		<td><input type="hidden" name="forward" value="?m=job&c=job&a=add"> <input
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
	$("#zhiwei").formValidator({
		onshow:"<?php echo L("input").L('zhiwei')?>",
		onfocus:"<?php echo L("input").L('zhiwei')?>",
		oncorrect:"<?php echo L('correct')?>"
	}).inputValidator({
		min:1,			
		onerror:"<?php echo L("input").L('zhiwei')?>"
	}).ajaxValidator({
		type:"get",
		url:"",data:"m=job&c=job&a=public_check_zhiwei",
		datatype:"html",
		cached:false,
		async:'true',
		success : function(data) {
			if( data == "1" )
			{
				return true;
			}
			else
			{
				return false;
			}
		},
	error: function(){alert("<?php echo L('server_busy')?>");},
	onerror : "<?php echo L('zhiwei').L('exist')?>",
	onwait : "<?php echo L('checking')?>"
	});
	
	$("#enddate").formValidator({
		onshow:"发布时间",
		onfocus:"发布时间",
		oncorrect:"<?php echo L('correct')?>"
	});
	
	$("#bumen").formValidator({
		onshow:"<?php echo L("input").L('bumen')?>",
		onfocus:"<?php echo L("input").L('bumen')?>",
		oncorrect:"<?php echo L('correct')?>"
	});
	
	$("#renshu").formValidator({
		onshow:"<?php echo L("input").L('renshu')?>",
		onfocus:"<?php echo L("input").L('renshu')?>",
		oncorrect:"<?php echo L('correct')?>"
	}).inputValidator({
		min:1,			
		onerror:"<?php echo L("input").L('renshu')?>"
	}).regexValidator({
		regexp:"^[1-9]\\d*|0$",
		onerror:"<?php echo L('renshuonerror')?>"
	});
	
	$("#diqu").formValidator({
		onshow:"<?php echo L("input").L('diqu')?>",
		onfocus:"<?php echo L("input").L('diqu')?>",
		oncorrect:"<?php echo L('correct')?>"
	}).inputValidator({
		min:1,			
		onerror:"<?php echo L("input").L('diqu')?>"
	});
	
	$("#content").formValidator({
		onshow:"<?php echo L("input").L('content')?>",
		onfocus:"<?php echo L("input").L('content')?>",
		oncorrect:"<?php echo L('correct')?>"
	}).inputValidator({
		min:1,			
		onerror:"<?php echo L('contentonerror')?>"
	});
	
	$("#lianxiren").formValidator({
		onshow:"<?php echo L("input").L('lianxiren')?>",
		onfocus:"<?php echo L("input").L('lianxiren')?>",
		oncorrect:"<?php echo L('correct')?>"
	}).inputValidator({
		min:3,			
		onerror:"<?php echo L("input").L('lianxiren')?>"
	});
	
	$("#tel").formValidator({
		onshow:"<?php echo L("input").L('tel')?>",
		onfocus:"<?php echo L("input").L('tel')?>",
		oncorrect:"<?php echo L('correct')?>"
	}).inputValidator({
		min:1,			
		onerror:"<?php echo L("input").L('tel')?>"
	}).regexValidator({
		regexp:"^(([0\\+]\\d{2,3}-)?(0\\d{2,3})-)?(\\d{7,8})(-(\\d{3,}))?$",				
		onerror:"<?php echo L("telonerror")?>"
	});
	
	$("#email").formValidator({
		onshow:"<?php echo L("input").L('email')?>",
		onfocus:"<?php echo L("input").L('email')?>",
		oncorrect:"<?php echo L('correct')?>"
	}).inputValidator({
		min:1,			
		onerror:"<?php echo L("input").L('email')?>"
	}).regexValidator({
		regexp:"^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$",				
		onerror:"<?php echo L("emailonerror")?>"
	});
	
	$("#address").formValidator({
		onshow:"<?php echo L("input").L('address')?>",
		onfocus:"<?php echo L("input").L('address')?>",
		oncorrect:"<?php echo L('correct')?>"
	}).inputValidator({
		min:8,			
		onerror:"<?php echo L("input").L('address')?>"
	});
	 
})
//-->
</script>