<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header','admin');
?>
<div class="pad-lr-10">
<table width="100%" cellspacing="0" class="search-form">
    <tbody>
		<tr>
		<!--<td>
		<div class="explain-col"> 
			<?php echo L('job_num')?>：<font color="green"><?php echo $this->job_num;?></font> 个&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo L('job_num_online')?>：<font color="green"><?php echo $this->job_num_online;?></font> 个&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo L('yingpin_num')?>：<font color="green"><?php echo $this->yingpin_num;?></font> 份&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo L('yingpin_num_unpass')?>：<font color="red"><?php echo $this->yingpin_num_unpass;?></font> 份
		</div>
		</td>-->
		</tr>
    </tbody>
</table>
<form name="myform" id="myform" action="?m=job&c=job&a=yp_listorder" method="post" >
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
		<tr>
			<th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall('ypid[]');"></th>
			<th width="35" align="center"><?php echo L('listorder')?></th>
			<th align="center"><?php echo L('name')?></th>
			<th align="center"><?php echo L('sex')?></th>
			<th align="center"><?php echo L('age')?></th>
			<th align="center"><?php echo L('xueli')?></th>
			<th width="12%" align="center">金融工作年限</th>
			<th width='10%' align="center">现任公司及岗位</th>
			<th width='10%' align="center">简历</th>
			<!--<th width="8%" align="center"><?php echo L('status')?></th>-->
			<th width="12%" align="center"><?php echo L('operations_manage')?></th>
		</tr>
	</thead>
<tbody>
<?php
if(is_array($infos)){
	foreach($infos as $info){
		?>
	<tr>
		<td align="center" width="35"><input type="checkbox" name="ypid[]" value="<?php echo $info['ypid']?>"></td>
		<td align="center" width="35"><input name='listorders[<?php echo $info['ypid']?>]' type='text' size='3' value='<?php echo $info['listorder']?>' class="input-text-c"></td>
		<td align="center"><?php echo $info['name']?></td>
		<td align="center" width="12%"><?php echo $info['sex'];?></td>
		<td align="center" width="10%"><?php echo $info['age'];?> 岁</td>
		<td align="center" width="10%"><?php echo $info['xueli'];?></td>
		<td align="center" width="10%"><?php echo $info['work_years'];?></td>
		<td align="center" width="10%"><?php echo $info['now_work'];?></td>
		<td align="center" width="10%"><a  target="blank" href="/bangcms/templates/scxt/content/upload/<?php echo $info['jianli'];?>">简历</a></td>
		<!--<td width="8%" align="center">
			<?php if($info['passed']=='0'){?>
			<a href='?m=job&c=job&a=yp_check&pass=1&id=<?php echo $info['ypid']?>'
			onClick="return confirm('<?php echo L('pass_or_not')?>')">
				<font color=red><?php echo L('unpassed')?></font>
			</a>
			<?php }else{?>
			<a href='?m=job&c=job&a=yp_check&pass=0&id=<?php echo $info['ypid']?>'
			onClick="return confirm('<?php echo L('pass_or_not')?>')">
				<font color=green><?php echo L('passed')?></font>
			</a>
			<?php }?>
		</td>-->
		<td align="center" width="12%"><!--<a href="###"
			onclick="more(<?php echo $info['ypid']?>, '<?php echo new_addslashes($info['name'])?>')"
			title="<?php echo L('more')?>"><?php echo L('more')?></a> | --> 
			<a href='?m=job&c=job&a=yp_delete&ypid=<?php echo $info['ypid']?>'
			onClick="return confirm('<?php echo L('confirm', array('message' => new_addslashes($info['name'])))?>')"><?php echo L('delete')?></a> 
		</td>
	</tr>
	<?php
	}
}
?>
</tbody>
</table>
</div>
<div class="btn"> 
	<input name="dosubmit" type="submit" class="button" value="<?php echo L('listorder')?>">&nbsp;&nbsp;
	<input type="submit" class="button" name="dosubmit" onClick="document.myform.action='?m=job&c=job&a=yp_delete'" value="<?php echo L('delete')?>"/>
</div>
<div id="pages"><?php echo $pages?></div>
</form>
</div>
<script type="text/javascript">

function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'<?php echo L('edit')?> '+name+' ',id:'edit',iframe:'?m=job&c=job&a=edit&jobid='+id,width:'700',height:'450'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;
	var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}

function more(id, name) {
	window.top.art.dialog({id:'more'}).close();
	window.top.art.dialog({title:'<?php echo L('more')?> '+name+' ',id:'more',iframe:'?m=job&c=job&a=yp_more&menuid=<?php echo $_GET['menuid']?>&id='+id,width:'700',height:'310'}, function(){var d = window.top.art.dialog({id:'more'}).data.iframe;
	var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'more'}).close()});
}
</script>
</body>
</html>
