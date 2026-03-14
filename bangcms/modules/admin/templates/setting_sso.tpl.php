<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});				
		$("#phpsso_api_url").formValidator({onshow:"<?php echo L('setting_phpsso_type')?>",onfocus:"<?php echo L('setting_phpsso_type')?>",tipcss:{width:'300px'},empty:false}).inputValidator({onerror:"<?php echo L('setting_phpsso_type')?>"}).regexValidator({regexp:"http:\/\/(.+)[^/]$",onerror:"<?php echo L('setting_phpsso_type')?>"});
		$("#phpsso_appid").formValidator({onshow:"<?php echo L('input').L('setting_phpsso_appid')?>",onfocus:"<?php echo L('input').L('setting_phpsso_appid')?>"}).regexValidator({regexp:"^\\d{1,8}$",onerror:"<?php echo L('setting_phpsso_appid').L('must_be_number')?>"});
		$("#phpsso_version").formValidator({onshow:"<?php echo L('input').L('setting_phpsso_version')?>",onfocus:"<?php echo L('input').L('setting_phpsso_version')?>"}).regexValidator({regexp:"^\\d{1,8}$",onerror:"<?php echo L('setting_phpsso_version').L('must_be_number')?>"});
		$("#phpsso_auth_key").formValidator({onshow:"<?php echo L('input').L('setting_phpsso_auth_key')?>",onfocus:"<?php echo L('input').L('setting_phpsso_auth_key')?>"}).regexValidator({regexp:"^\\w{32}$",onerror:"<?php echo L('setting_phpsso_auth_key').L('must_be_32_w')?>"});
	})
//-->
</script>
<form action="?m=admin&c=setting&a=save" method="post" id="myform">
	<input type="hidden" name="setting_flag" value="<?php echo ROUTE_A?>" />
	<div class="pad-10">
	<div class="col-tab">
	<ul class="tabBut cu-li">
		<li id="tab_setting_1" class="on"><?php echo L('setting_sso_cfg')?></li>
	</ul>
	<div id="div_setting_3" class="contentList pad-10">
		<table width="100%"  class="table_form">
		  <tr>
		    <th width="120"><?php echo L('setting_phpsso')?></th>
		    <td class="y-bg">
		    <input name="setconfig[phpsso]" value="1" type="radio"  <?php echo ($phpsso=='1') ? ' checked' : ''?>> <?php echo L('setting_yes')?>&nbsp;&nbsp;&nbsp;&nbsp;
			 <input name="setconfig[phpsso]" value="0" type="radio"  <?php echo ($phpsso=='0') ? ' checked' : ''?>> <?php echo L('setting_no')?></td>
		  </tr> 
		  <tr>
		    <th><?php echo L('setting_phpsso_appid')?></th>
		    <td class="y-bg"><input type="text" class="input-text" name="setconfig[phpsso_appid]" id="phpsso_appid" size="30" value="<?php echo $phpsso_appid ?>"/></td>
		  </tr> 
		  <tr>
		    <th><?php echo L('setting_phpsso_phpsso_api_url')?></th>
		    <td class="y-bg"><input type="text" class="input-text" name="setconfig[phpsso_api_url]" id="phpsso_api_url" size="50" value="<?php echo $phpsso_api_url ?>"/></td>
		  </tr>  
		   <tr>
		    <th><?php echo L('setting_phpsso_auth_key')?></th>
		    <td class="y-bg"><input type="text" class="input-text" name="setconfig[phpsso_auth_key]" id="phpsso_auth_key" size="50" value="<?php echo $phpsso_auth_key ?>"/></td>
		  </tr>
		   <tr>
		    <th><?php echo L('setting_phpsso_version')?></th>
		    <td class="y-bg"><input type="text" class="input-text" name="setconfig[phpsso_version]" id="phpsso_version" size="2" value="<?php echo $phpsso_version ?>"/></td>
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