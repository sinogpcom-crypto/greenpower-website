<?php 
defined('IN_ADMIN') or exit('No permission resources.');
$show_header = 1;
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
<table width="100%" cellspacing="0" class="table-list">
	<thead>
		<tr>
			<th width="15%" align="right"><?php echo L('selects')?></th>
			<th align="left"><?php echo L('values')?></th>
		</tr>
	</thead>
<tbody>
 <?php
if(is_array($forminfos_data)){
	foreach($forminfos_data as $key => $form){
?>   
	<tr>
		<?php  if ($fields[$key]['name']=='文件地址') { ?>
			
		<?php }else{ ?>
			<td><?php echo $fields[$key]['name']?>:</td>
		<?php	} ?>
		


		<?php if ($key =='filename') { ?>
			<td><a style="color: red;" href="<?php echo $forminfos_data['fileurl']?>" download="<?php echo $form?>"><?php echo $form?></a></td>
		<?php }elseif($key =='fileurl'){ ?>
			
		<?php	}else{?>
			<td><?php echo $form?></td>
		<?php	} ?>

		
		
		
		</tr>
<?php 
	}
}
?>
	</tbody>
</table>

</div>
</body>
</html>