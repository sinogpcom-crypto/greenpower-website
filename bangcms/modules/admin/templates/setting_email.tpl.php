<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');?>
<form action="?m=admin&c=setting&a=save" method="post" id="myform">
	<input type="hidden" name="setting_flag" value="<?php echo ROUTE_A?>" />
	<div class="pad-10">
		<div class="col-tab">
			<ul class="tabBut cu-li">
			            <li id="tab_setting_1" class="on"><?php echo L('setting_mail_cfg')?></li>
			</ul>
			<div id="div_setting_4" class="contentList pad-10">
				<table width="100%"  class="table_form">
				  <tr>
				    <th width="120"><?php echo L('mail_type')?></th>
				    <td class="y-bg">
				     <input name="setting[mail_type]" checkbox="mail_type" value="1" onclick="showsmtp(this)" type="radio" <?php echo $mail_type==1 ? ' checked' : ''?>> <?php echo L('mail_type_smtp')?>
				    <input name="setting[mail_type]" checkbox="mail_type" value="0" onclick="showsmtp(this)" type="radio" <?php echo $mail_type==0 ? ' checked' : ''?> <?php if(substr(strtolower(PHP_OS), 0, 3) == 'win') echo 'disabled'; ?>/> <?php echo L('mail_type_mail')?> 
					</td>
				  </tr>
				  <tbody id="smtpcfg" style="<?php if($mail_type == 0) echo 'display:none'?>">
				  <tr>
				    <th><?php echo L('mail_server')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setting[mail_server]" id="mail_server" size="30" value="<?php echo $mail_server?>"/></td>
				  </tr>  
				  <tr>
				    <th><?php echo L('mail_port')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setting[mail_port]" id="mail_port" size="30" value="<?php echo $mail_port?>"/></td>
				  </tr> 
				  <tr>
				    <th><?php echo L('mail_from')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="setting[mail_from]" id="mail_from" size="30" value="<?php echo $mail_from?>"/></td>
				  </tr>   
				  <tr>
				    <th><?php echo L('mail_auth')?></th>
				    <td class="y-bg">
				    <input name="setting[mail_auth]" checkbox="mail_auth" value="1" type="radio" <?php echo $mail_auth==1 ? ' checked' : ''?>> <?php echo L('mail_auth_open')?>
					<input name="setting[mail_auth]" checkbox="mail_auth" value="0" type="radio" <?php echo $mail_auth==0 ? ' checked' : ''?>> <?php echo L('mail_auth_close')?></td>
				  </tr> 
				
					  <tr>
					    <th><?php echo L('mail_user')?></th>
					    <td class="y-bg"><input type="text" class="input-text" name="setting[mail_user]" id="mail_user" size="30" value="<?php echo $mail_user?>"/></td>
					  </tr> 
					  <tr>
					    <th><?php echo L('mail_password')?></th>
					    <td class="y-bg"><input type="password" class="input-text" name="setting[mail_password]" id="mail_password" size="30" value="<?php echo $mail_password?>"/></td>
					  </tr>
				
				 </tbody>
				  <tr>
				    <th><?php echo L('mail_test')?></th>
				    <td class="y-bg"><input type="text" class="input-text" name="mail_to" id="mail_to" size="30" value=""/> <input type="button" class="button" onClick="javascript:test_mail();" value="<?php echo L('mail_test_send')?>"></td>
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
function test_mail() {
	var mail_type = $('input[checkbox=mail_type][checked]').val();
	var mail_auth = $('input[checkbox=mail_auth][checked]').val();
    $.post('?m=admin&c=setting&a=public_test_mail&mail_to='+$('#mail_to').val(),{mail_type:mail_type,mail_server:$('#mail_server').val(),mail_port:$('#mail_port').val(),mail_user:$('#mail_user').val(),mail_password:$('#mail_password').val(),mail_auth:mail_auth,mail_from:$('#mail_from').val()}, function(data){
	alert(data);
	});
}

</script>
</html>