<?php 
	defined('IN_ADMIN') or exit('No permission resources.');
	$show_dialog = 1;
	include $this->admin_tpl('header','admin');
?>
<div class="pad_10">
<div class="table-list">
<form name="searchform" action="" method="post" >
<div class="explain-col search-form">
<?php echo L('tgtj_time')?>  <?php echo form::date('info[start_addtime]',$start_addtime)?><?php echo L('to')?>   <?php echo form::date('info[end_addtime]',$end_addtime)?> 
<?php echo L('tgtj_realname')?> <?php echo form::select($a_u,$a_user,'name="info[a_user]"',"姓名")?> &nbsp;&nbsp;
<?php echo L('tgtj_columnname')?> <input type="text" name="info[column]" value="" />
<input type="submit" value="<?php echo L('search')?>" class="button" name="dosubmit">
</div>
</form>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th width="3%"><?php echo L('tgtj_userid')?></th>
            <th width="5%"><?php echo L('tgtj_username')?></th>
			<th width="5%"><?php echo L('tgtj_realname')?></th>
            <th width="15%"><?php echo L('tgtj_column')?></th>
            <th width="9%"><?php echo L('tgtj_countysh')?></th>
            <th width="9%"><?php echo L('tgtj_countwsh')?></th>
           <th width="9%"><?php echo L('tgtj_countgsh')?></th>
            <th width="9%"><?php echo L('tgtj_countzs')?></th>
            </tr>
        </thead>
    <tbody>
	
 <?php 
if(is_array($re)){
	foreach($re as $info){
		
?>   
	<tr>
	<td width="3%" align="center"><?php echo $info['userid']?></td>
	<td width="5%" align="center"><?php echo $info['username']?></td>
	<td width="5%" align="center"><?php echo $info['realname']?></td>
	<td  width="15%" align="center"><?php echo $info['catname']?></td>
	<!-- <td width="8%" align="center"><?php echo $info['counts']?></td> -->
	<td width="8%" align="center">
	<?php 
	$username = $info['username'];
	$catid = $info['catid'];
	$number = $this->content_db->count("`status`=99 AND `username` = '$username'  AND `catid` = '$catid' $timewhere");
	echo $number;
	?>
	</td>
	<td width="8%" align="center">
	<?php 
	$username = $info['username'];
	$catid = $info['catid'];
	$number = $this->content_db->count("`status` NOT IN (99,0,-2)  AND `username` = '$username' AND `catid` = '$catid' $timewhere");
	echo $number;
	?>
	</td>
	<td width="8%" align="center">
	<?php 
	$username = $info['username'];
	$catid = $info['catid'];
	$number = $this->content_db->count("`status`= 0  AND `username` = '$username' AND `catid` = '$catid' $timewhere");
	echo $number;
	?>
	</td>
	<td width="8%" align="center"><?php 
	$username = $info['username'];
	$catid = $info['catid'];
	$number = $this->content_db->count("`username` = '$username'  AND `catid` = '$catid' $timewhere");
	echo $number;
	?>
	</td>
	</tr>
<?php 
	}
}
?>
    </tbody>
    </table>
 <div id="pages"> <?php echo $pages?></div>
</div>
</div>
</form>
</body>
</html>