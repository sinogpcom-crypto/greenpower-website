<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');?>
<script type="text/javascript">
<!--
	$(function(){
		$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'200',height:'50'}, function(){this.close();$(obj).focus();})}});		
		$("#js_path").formValidator({onshow:"<?php echo L('setting_input').L('setting_js_path')?>",onfocus:"<?php echo L('setting_js_path').L('setting_end_with_x')?>"}).inputValidator({onerror:"<?php echo L('setting_js_path').L('setting_input_error')?>"}).regexValidator({regexp:"(.+)\/$",onerror:"<?php echo L('setting_js_path').L('setting_end_with_x')?>"});
		$("#css_path").formValidator({onshow:"<?php echo L('setting_input').L('setting_css_path')?>",onfocus:"<?php echo L('setting_css_path').L('setting_end_with_x')?>"}).inputValidator({onerror:"<?php echo L('setting_css_path').L('setting_input_error')?>"}).regexValidator({regexp:"(.+)\/$",onerror:"<?php echo L('setting_css_path').L('setting_end_with_x')?>"});
		$("#img_path").formValidator({onshow:"<?php echo L('setting_input').L('setting_img_path')?>",onfocus:"<?php echo L('setting_img_path').L('setting_end_with_x')?>"}).inputValidator({onerror:"<?php echo L('setting_img_path').L('setting_input_error')?>"}).regexValidator({regexp:"(.+)\/$",onerror:"<?php echo L('setting_img_path').L('setting_end_with_x')?>"});
		$("#upload_url").formValidator({onshow:"<?php echo L('setting_input').L('setting_upload_url')?>",onfocus:"<?php echo L('setting_upload_url').L('setting_end_with_x')?>"}).inputValidator({onerror:"<?php echo L('setting_upload_url').L('setting_input_error')?>"}).regexValidator({regexp:"(.+)\/$",onerror:"<?php echo L('setting_upload_url').L('setting_end_with_x')?>"});
	})
//-->
</script>
<form action="?m=admin&c=setting&a=save" method="post" id="myform">
	<input type="hidden" name="setting_flag" value="<?php echo ROUTE_A?>" />
	<div class="pad-10">
		<div class="col-tab">
			<ul class="tabBut cu-li">
			            <li id="tab_setting_1" class="on"><?php echo L('setting_basic_cfg')?></li>
			</ul>
			<div id="div_setting_1" class="contentList pad-10">
				<table width="100%"  class="table_form">
				  <tr>
				    <th width="120"><?php echo L('setting_admin_email')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setting[admin_email]" id="admin_email" size="30" value="<?php echo $admin_email?>"/></td>
				  </tr>
				  <tr>
				    <th width="120"><?php echo L('setting_category_ajax')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setting[category_ajax]" id="category_ajax" size="5" value="<?php echo $category_ajax?>"/>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo L('setting_category_ajax_desc')?></td>
				  </tr>
				  <tr>
				    <th width="120"><?php echo L('setting_gzip')?></th>
				    <td class="y-bg">
				    <input name="setconfig[gzip]" value="1"  type="radio"  <?php echo ($gzip=='1') ? ' checked' : ''?>> <?php echo L('setting_yes')?>&nbsp;&nbsp;&nbsp;&nbsp;
					<input name="setconfig[gzip]" value="0" type="radio"  <?php echo ($gzip=='0') ? ' checked' : ''?>> <?php echo L('setting_no')?></td>
				  </tr> 
				  <tr>
				    <th width="120"><?php echo L('setting_attachment_stat')?></th>
				    <td class="y-bg">
				    <input name="setconfig[attachment_stat]" value="1"  type="radio"  <?php echo ($attachment_stat=='1') ? ' checked' : ''?>> <?php echo L('setting_yes')?>&nbsp;&nbsp;&nbsp;&nbsp;
					<input  name="setconfig[attachment_stat]" value="0" type="radio"  <?php echo ($attachment_stat=='0') ? ' checked' : ''?>> <?php echo L('setting_no')?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo L('setting_attachment_stat_desc')?></td>
				  </tr> 	
				  <tr>
				    <th width="120"><?php echo L('setting_js_path')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setconfig[js_path]" id="js_path" size="50" value="<?php echo JS_PATH?>" /></td>
				  </tr>
				  <tr>
				    <th width="120"><?php echo L('setting_css_path')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setconfig[css_path]" id="css_path" size="50" value="<?php echo CSS_PATH?>"/></td>
				  </tr> 
				  <tr>
				    <th width="120"><?php echo L('setting_img_path')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setconfig[img_path]" id="img_path" size="50" value="<?php echo IMG_PATH?>" /></td>
				  </tr>
				  <tr>
				    <th width="120"><?php echo L('setting_upload_url')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setconfig[upload_url]" id="upload_url" size="50" value="<?php echo $upload_url?>" /></td>
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