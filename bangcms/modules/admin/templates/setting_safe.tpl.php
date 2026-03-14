<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});		
		$("#errorlog_size").formValidator({onshow:"<?php echo L('setting_errorlog_hint')?>",onfocus:"<?php echo L('setting_input').L('setting_error_log_size')?>"}).inputValidator({onerror:"<?php echo L('setting_error_log_size').L('setting_input_error')?>"}).regexValidator({regexp:"num",datatype:"enum",onerror:"<?php echo L('setting_errorlog_type')?>"});	
	})
//-->
</script>
<form action="?m=admin&c=setting&a=save" method="post" id="myform">
	<input type="hidden" name="setting_flag" value="<?php echo ROUTE_A?>" />
	<div class="pad-10">
		<div class="col-tab">
			<ul class="tabBut cu-li">
			            <li id="tab_setting_1" class="on"><?php echo L('setting_safe_cfg')?></li>
			</ul>
			<div id="div_setting_2" class="contentList pad-10">
				<table width="100%"  class="table_form">
				  <tr>
				    <th width="120"><?php echo L('setting_admin_log')?></th>
				    <td class="y-bg">
					  <input name="setconfig[admin_log]" value="1" type="radio" <?php echo ($admin_log=='1') ? ' checked' : ''?>> <?php echo L('setting_yes')?>&nbsp;&nbsp;&nbsp;&nbsp;
					  <input name="setconfig[admin_log]" value="0" type="radio" <?php echo ($admin_log=='0') ? ' checked' : ''?>> <?php echo L('setting_no')?>
				     </td>
				  </tr>
				  <tr>
				    <th width="120"><?php echo L('setting_error_log')?></th>
				    <td class="y-bg">
					  <input name="setconfig[errorlog]" value="1" type="radio" <?php echo ($errorlog=='1') ? ' checked' : ''?>> <?php echo L('setting_yes')?>&nbsp;&nbsp;&nbsp;&nbsp;
					  <input name="setconfig[errorlog]" value="0" type="radio" <?php echo ($errorlog=='0') ? ' checked' : ''?>> <?php echo L('setting_no')?>
				     </td>
				  </tr> 
				  <tr>
				    <th><?php echo L('setting_error_log_size')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setting[errorlog_size]" id="errorlog_size" size="5" value="<?php echo $errorlog_size?>"/> MB</td>
				  </tr>     
				
				  <tr>
				    <th><?php echo L('setting_maxloginfailedtimes')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setting[maxloginfailedtimes]" id="maxloginfailedtimes" size="10" value="<?php echo $maxloginfailedtimes?>"/></td>
				  </tr>
				
				  <tr>
				    <th><?php echo L('setting_minrefreshtime')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setting[minrefreshtime]" id="minrefreshtime" size="10" value="<?php echo $minrefreshtime?>"/> <?php echo L('miao')?></td>
				  </tr>
				  <tr>
				    <th><?php echo L('admin_url')?></th>
				    <td class="y-bg"><TABLE>
				    <TR>
						<TD width="270"><?php echo SITE_PROTOCOL;?><input type="text" class="input-text" name="setconfig[admin_url]" id="admin_url" size="30" value="<?php echo $admin_url?>"/> </TD>
						<TD><?php echo L('admin_url_tips')?></TD>
				    </TR>
				    </TABLE> </td>
				  </tr> 
				</table>
			</div>
			<div class="bk15"></div>
			<input name="dosubmit" type="submit" value="<?php echo L('submit')?>" class="button">
		</div>
	</div>
</form>
</body>
<script type="text/javascript">

function showsmtp(obj,hiddenid){
	hiddenid = hiddenid ? hiddenid : 'smtpcfg';
	var status = $(obj).val();
	if(status == 1) $("#"+hiddenid).show();
	else  $("#"+hiddenid).hide();
}
</script>
</html>