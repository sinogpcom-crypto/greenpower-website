<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');?>
<form action="?m=admin&c=setting&a=save" method="post" id="myform">
	<input type="hidden" name="setting_flag" value="<?php echo ROUTE_A?>" />
	<div class="pad-10">
		<div class="col-tab">
		<ul class="tabBut cu-li">
		            <li id="tab_setting_1" class="on"><?php echo L('setting_connect')?></li>
		</ul>
		<div id="div_setting_5" class="contentList pad-10">
			<table width="100%"  class="table_form">
			
			
			  <tr>
			    <th width="120"><?php echo L('setting_snda_enable')?></th>
			    <td class="y-bg">
				 APP key <input type="text" class="input-text" name="setconfig[snda_akey]" id="snda_akey" size="20" value="<?php echo $snda_akey ?>"/>
				 APP secret key <input type="text" class="input-text" name="setconfig[snda_skey]" id="snda_skey" size="40" value="<?php echo $snda_skey ?>"/> <a href="http://code.snda.com/index/oauth" target="_blank"><?php echo L('click_register')?></a>
			    </td>
			  </tr>
			
			  <tr>
			    <th><?php echo L('setting_connect_sina')?></th>
			    <td class="y-bg">
				App key <input type="text" class="input-text" name="setconfig[sina_akey]" id="sina_akey" size="20" value="<?php echo $sina_akey ?>"/>
				App secret key <input type="text" class="input-text" name="setconfig[sina_skey]" id="sina_skey" size="40" value="<?php echo $sina_skey ?>"/> <a href="http://open.t.sina.com.cn/wiki/index.php/<?php echo L('connect_micro')?>" target="_blank"><?php echo L('click_register')?></a>
				</td>
			  </tr>
			
			  <tr>
			    <th><?php echo L('setting_connect_qq')?></th>
			    <td class="y-bg">
				App key <input type="text" class="input-text" name="setconfig[qq_akey]" id="qq_akey" size="20" value="<?php echo $qq_akey ?>"/>
				App secret key <input type="text" class="input-text" name="setconfig[qq_skey]" id="qq_skey" size="40" value="<?php echo $qq_skey ?>"/> <a href="http://open.t.qq.com/" target="_blank"><?php echo L('click_register')?></a>
				</td>
			  </tr> 
			  <tr>
			    <th><?php echo L('setting_connect_qqnew')?></th>
			    <td class="y-bg">
				App I D  &nbsp;<input type="text" class="input-text" name="setconfig[qq_appid]" id="qq_appid" size="20" value="<?php echo $qq_appid;?>"/>
				App key <input type="text" class="input-text" name="setconfig[qq_appkey]" id="qq_appkey" size="40" value="<?php echo $qq_appkey;?>"/> 
				<?php echo L('setting_connect_qqcallback')?> <input type="text" class="input-text" name="setconfig[qq_callback]" id="qq_callback" size="40" value="<?php echo $qq_callback;?>"/>
				<a href="http://connect.qq.com" target="_blank"><?php echo L('click_register')?></a>
				</td>
			  </tr> 
		
		  </table>
		</div>
		
		<div class="bk15"></div>
		<input name="dosubmit" type="submit" value="<?php echo L('submit')?>" class="button">
		</div>
	</div>
</form>
</body>
</html>