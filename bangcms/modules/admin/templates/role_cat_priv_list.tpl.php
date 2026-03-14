<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');
?>
<script type="text/javascript">
//全选函数
   function setAll() {

       var loves = document.getElementsByClassName("loves");

       console.log(loves.length)
       for (var i = 0; i < loves.length; i++) {
           loves[i].checked = true;
       }
   }

   //全不选函数
   function setNo() {
      var loves = document.getElementsByClassName("loves");
      //console.log(loves.length)
       for (var i = 0; i < loves.length; i++) {
           loves[i].checked = false;
       }
   }
</script>
<form action="?m=admin&c=role&a=setting_cat_priv&roleid=<?php echo $roleid?>&siteid=<?php echo $siteid?>&op=2" method="post">
<div class="table-list" id="load_priv">
<table width="100%" class="table-list">
			  <thead>
				<tr>
				  <th width="80"><span onClick="javascript:setAll();"><?php echo L('select_all');?></span>/<span onClick="javascript:setNo();"><?php echo L('cancel');?></th><th align="left"><?php echo L('title_varchar')?></th><th width="25"><?php echo L('view')?></th><th width="25"><?php echo L('add')?></th><th width="25"><?php echo L('edit')?></th><th width="25"><?php echo L('delete')?></th><th width="25"><?php echo L('sort')?></th><th width="25"><?php echo L('push')?></th><th width="25"><?php echo L('move')?></th>
			  </tr>
			    </thead>
				 <tbody>
				<?php echo $categorys?>
			 </tbody>
			</table>
<div class="btn">
<input type="submit" value="<?php echo L('submit')?>" class="button">
</div>
</div>
</form>
<script type="text/javascript">
<!--
function select_all(name, obj) {
	if (obj.checked) {
		$("input[type='checkbox'][name='priv["+name+"][]']").attr('checked', 'checked');
	} else {
		$("input[type='checkbox'][name='priv["+name+"][]']").removeAttr('checked');
	}
}
//-->
</script>
</body>
</html>
