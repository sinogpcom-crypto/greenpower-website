	function number($field, $value, $fieldinfo) {
		extract($fieldinfo);
		$setting = string2array($setting);
		$size = $setting['size'];		
		if(!$value) $value = $defaultvalue;
		$is_readonly = '';
		if($_GET['relation_field']==$field){
			$is_readonly = 'readonly="readonly" style="background:#EEEEEE;"';
		}
		return "<input type='text' $is_readonly name='info[$field]' id='$field' value='$value' class='input-text' size='$size' {$formattribute} {$css}>";
	}
