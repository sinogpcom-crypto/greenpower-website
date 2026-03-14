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
<form name="myform" id="myform" action="?m=job&c=job&a=listorder" method="post" >
<div class="table-list">
<table width="100%" cellspacing="0">
	<thead>
	
		<tr>
			<th width="35" align="center"><input type="checkbox" value="" id="check_box" onclick="selectall('jobid[]');"></th>
			<th width="35" align="center"><?php echo L('listorder')?></th>
			<th align="center"><?php echo L('zhiwei')?></th>
			<!--<th width="12%" align="center"><?php echo L('renshu')?></th>-->
			<th width="10%" align="center"><?php echo L('diqu')?></th>
			<th width='10%' align="center"><?php echo L('yingpin')?></th>
			<!--<th width='10%' align="center"><?php echo L('inputtime')?></th>-->
			<th width='10%' align="center">发布时间</th>
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
		<td align="center" width="35"><input type="checkbox" name="jobid[]" value="<?php echo $info['jobid']?>"></td>
		<td align="center" width="35"><input name='listorders[<?php echo $info['jobid']?>]' type='text' size='3' value='<?php echo $info['listorder']?>' class="input-text-c"></td>
		<td align="center"><a href="###" onclick="edit(<?php echo $info['jobid']?>, '<?php echo new_addslashes($info['zhiwei'])?>')" title="<?php echo L('edit')?>"><?php echo $info['zhiwei']?></a> </td>
		<!--<td align="center" width="12%"><?php echo $info['renshu'];?> 人</td>-->
		<td align="center" width="10%"><?php echo $info['diqu'];?></td>
		<td align="center" width="10%"><a href="?m=job&c=job&a=yingpin&jobid=<?php echo $info['jobid'];?>&menuid=<?php echo $_GET['menuid'];?>">查看</a></td>
		<!--<td align="center" width="10%"><?php echo date('Y-m-d H:i:s',$info['inputtime']);?></td>-->
		<td align="center" width="10%"><?php echo $info['enddate'];?></td>
		<!--<td width="8%" align="center">
			<?php if($info['passed']=='0'){?>
			<a href='?m=job&c=job&a=check&pass=1&jobid=<?php echo $info['jobid']?>'
			onClick="return confirm('<?php echo L('pass_or_not')?>')">
				<font color=red><?php echo L('unpassed')?></font>
			</a>
			<?php }else{?>
			<a href='?m=job&c=job&a=check&pass=0&jobid=<?php echo $info['jobid']?>'
			onClick="return confirm('<?php echo L('pass_or_not')?>')">
				<font color=green><?php echo L('passed')?></font>
			</a>
			<?php }?>
		</td>-->
		<td align="center" width="12%">
			<a href="###" onclick="edit(<?php echo $info['jobid']?>, '<?php echo new_addslashes($info['zhiwei'])?>')"
			title="<?php echo L('edit')?>"><?php echo L('edit')?></a> |  
			<a href='?m=job&c=job&a=delete&jobid=<?php echo $info['jobid']?>'
			onClick="return confirm('<?php echo L('confirm', array('message' => new_addslashes($info['zhiwei'])))?>')"><?php echo L('delete')?></a> 
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
	<input type="submit" class="button" name="dosubmit" onClick="document.myform.action='?m=job&c=job&a=delete'" value="<?php echo L('delete')?>"/>
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
</script>
</body>
</html>
