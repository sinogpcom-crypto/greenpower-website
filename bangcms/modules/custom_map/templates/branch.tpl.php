<?php
include $this->admin_tpl('header','admin');
?>

<div class="pad_10">
<form action="?m=custom_map&c=custom_map&a=<?php echo empty($id)?'add':'update'?>&pid=<?php echo $_GET['pid']?$_GET['pid']:$parentid;?>" method="post" name="myform" id="myform">
<table cellpadding="2" cellspacing="1" class="table_form" width="800">
	<tr>
		<th> * </th>
		<td>
		<?php echo L('name')?>：
		<input type="text" name="info[name]" id="product"
			size="30" class="input-text" value="<?php echo $name;?>"></td>
	</tr>
	
	<tr>
		<th>
			<span></span>
		</th>
		<td>
		<?php echo L('x')?>：
		<input type="text" name="info[x]"  size="30" class="input-text" value="<?php echo intval($x);?>" id="X">
		<?php echo L('y')?>：
		<input type="text" name="info[y]" size="30" class="input-text" value="<?php echo intval($y);?>" id="Y">
		</td>
	</tr>
	<tr>
		<th>
			<span></span>
		</th>
		<td>
			<div  id="map_view" class="" style="position: relative;">
				<img id="map" src="<?php echo APP_PATH?>statics/images_map/map.png" style="width:723px;"> 
				<img id="pointer" style="position: absolute; left: 448px; top: 163px;cursor: move;" src="<?php echo APP_PATH?>statics/images_map/icon.png">
			</div>
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
		<?php if(!empty($id)){?>
		<input type="hidden" name="id" value="<?php echo $id?>">
		<?php }?>
		
		<input type="submit" name="dosubmit" id="dosubmit" class="dialog"
		value=" <?php echo L('submit')?> "></td>
	</tr>
</table>
</form>
</div>

<?php if(is_numeric($x)&&is_numeric($y)){ ?>
	<script type="text/javascript">
		var initX=<?php echo $x?>;
		var initY=<?php echo $y?>;
	</script>
<?php } else{ ?>
	<script type="text/javascript">
		var initX=921;
		var initY=376;
	</script>
<?php } ?>

<script language="JavaScript" src="<?php echo APP_PATH?>statics/scripts_map/mootools-1.2.4-core.js"></script>
<script language="JavaScript" src="<?php echo APP_PATH?>statics/scripts_map/mootools-1.2.4.2-more.js"></script>
<script language="JavaScript">
	window.addEvent('load', function() {
		var mapView	=	document.id('map_view');
		var map = document.id('map');
		var mapPoz = map.getPosition(mapView);
		var inputX = document.id('X');
		var inputY = document.id('Y');
		var pointer = document.id('pointer');
		
		pointer.setStyles({
			'left': parseInt(initX/2.08),
			'top': parseInt(initY/2.08)
		});
		inputX.set('value', initX);
		inputY.set('value', initY);
		
		pointer.makeDraggable({
			container: 'map_view',
			onDrag: function() {
				var poz = this.getPosition(mapView);
				var x	=	parseInt((poz.x - mapPoz.x)*2.083);
				var y	=	parseInt((poz.y - mapPoz.y)*2.083);
				inputX.set('value', x);
				inputY.set('value', y);
			}.bind(pointer)
		});
	});
</script>
</body>
</html>

