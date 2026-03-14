<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<form method="post" action="?m=job&c=job&a=setting">
<table width="100%" cellpadding="0" cellspacing="1" class="table_form"> 
 
	<tr>
		<th width="20%"><?php echo L('yp_or_not')?>：</th>
		<td>
			<input type='radio' name='setting[yp_or_not]' value='1' <?php if($yp_or_not == 1) {?>checked<?php }?>> <?php echo L('yes')?>&nbsp;&nbsp;&nbsp;&nbsp;
	  		<input type='radio' name='setting[yp_or_not]' value='0' <?php if($yp_or_not == 0) {?>checked<?php }?>> <?php echo L('no')?>
		</td>
	</tr>
	<tr>
		<th><?php echo L('ypcode_or_not')?>：</th>
		<td>
			<input type='radio' name='setting[ypcode_or_not]' value='1' <?php if($ypcode_or_not == 1) {?>checked<?php }?>> <?php echo L('yes')?>&nbsp;&nbsp;&nbsp;&nbsp;
	  		<input type='radio' name='setting[ypcode_or_not]' value='0' <?php if($ypcode_or_not == 0) {?>checked<?php }?>> <?php echo L('no')?>
		</td>
	</tr>
	 
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class="button">&nbsp;</td>
	</tr>
</table>
</form>
</body>
</html>
 