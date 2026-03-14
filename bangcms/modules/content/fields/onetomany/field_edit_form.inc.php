<?php defined('IN_BANGCMS') or exit('No permission resources.');?>
<table cellpadding="2" cellspacing="1" width="98%">
	<tr> 
      <td style="width:120px;">选择关联的模型字段：</td>
      <td>
	  <select name="setting[relation_model]" onchange="javascript:get_model_field(this.value);">
		  <option value="0">请选择模型</option>
		  <?php
		  	if (isset($model_cache)) {
		  		foreach ( $model_cache as $mv) {
		  			if ($modelid!=$mv['modelid']) {
		  				$selected = $mv['modelid']==$setting['relation_model'] ?  'selected': '';
		  				echo '<option value="'.$mv['modelid'].'" '.$selected.'>'.$mv['name'].'</option>';
		  			}
		  		}
		  	}
		  ?>
	  </select>
	  <select name="setting[relation_field]" id="model-field-select">
	  	 <?php
	  		foreach ( $select_fields as $mfv) {
	  			$selected = $mfv['field']==$setting['relation_field'] ?  'selected': '';
	  			echo '<option value="'.$mfv['field'].'" '.$selected.'>'.$mfv['name'].'</option>';
	  		}
		  ?>
	  </select>
    </td>
    </tr>
</table>
<script type="text/javascript">
	function get_model_field(modelid){
		var url = "?m=content&c=sitemodel_field&a=get_model_field&modelid="+modelid+'&pc_hash=<?php echo $_SESSION['pc_hash'];?>';
		$.ajax({
			type:"GET",
			url:url,
			success: function(data){
				var modelFieldSelect = $("#model-field-select");
				console.log( data );
				if ( data ) {
					modelFieldSelect.children().eq(0).after(data);
				} else {
					alert('请先为该模型添加数字类型的主表字段');
					modelFieldSelect.html('<option value="0">请选择模型字段</option>');
				}
			}
		});
	}
</script>