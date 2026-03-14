<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	
	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>
	          
	
	
	<!-- Page Content -->
	<main class="page-content">

		<div class="contact-page productbg1">
            <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3c724318e8dc102b06459c9e9b2f90fd&action=lists&catid=%24catid&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>$catid,'moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'1',));}?>
             <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
            <div class="page_wrap ">
				<div class="contact-info">
					<?php echo $r['description'];?>
				</div>
				<div class="contact-list clearfix">
					<div class="item">
						<div class="item-title">
							Hotline
						</div>
						<div class="liner"></div>
						<div class="item-info">
							<?php echo $r['tel'];?>
						</div>
					</div>
					<div class="item">
						<div class="item-title">
							Email
						</div>
						<div class="liner"></div>
						<div class="item-info">
							<?php echo $r['mail'];?>
						</div>
					</div>
					<div class="item">
						<div class="item-title">
							Tel
						</div>
						<div class="liner"></div>
						<div class="item-info">
							<?php echo $r['xiaoshou'];?>
						</div>
					</div>
					<div class="item">
						<div class="item-title">
							Work time
						</div>
						<div class="liner"></div>
						<div class="item-info">
							<?php echo $r['shijian'];?>
						</div>
					</div>
				</div>
				

            </div>
			
				
			<div class="entity_map">
				<div id="allmap"></div>
				<div class="map-list">
					<div class="page_wrap clearfix">
						<div class="item active" data-lat="<?php echo $r['bg_lat'];?>" data-lng="<?php echo $r['bg_lng'];?>" >
							<span class="title">Office address</span><i class="iconfont icon-angleright"></i><span class="address"><?php echo $r['bg_add'];?></span>
						</div>
						<div class="item" data-lat="<?php echo $r['gc_lat'];?>" data-lng="<?php echo $r['gc_lng'];?>">
							<span class="title">Factory address</span><i class="iconfont icon-angleright"></i><span class="address"><?php echo $r['gc_add'];?></span>
						</div>
					</div>
				</div>
			</div>
			<?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

		</div>

		
	</main>
	<!-- //Page Content -->

	

<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5lonGGNmwbTBzGbqc79xp69h"></script>

<script type="text/javascript">

$(function(){

    //加载之前就把第一个信息调出来
	

	
    //获取地图
    function getmap(lng,lat){
		var map = new BMap.Map('allmap');
		var poi = new BMap.Point(lng ,lat);
		map.centerAndZoom(poi, 16);
			map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
			map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用
			
		var myIcon = new BMap.Icon("/statics/web/images/ic/ic_29.png", new BMap.Size(47,55),{imageOffset:new BMap.Size(0,0) ,imageSize: new BMap.Size(39,50)});
		var marker = new BMap.Marker(poi,{icon:myIcon});

		map.addOverlay(marker);
		
	}

	var lng = $(".map-list .item").eq(0).data("lng");
	var lat = $(".map-list .item").eq(0).data("lat");

	getmap(lng,lat);

	$(".map-list .item").click(function(){

		var lng = $(this).data("lng");
		var lat = $(this).data("lat");
		$(".map-list .item").removeClass("active");
		$(this).addClass("active");

		getmap(lng,lat);

	})
    
	

});











</script>

	

	<!-- 底部 -->
	
	<?php include template("content","footer"); ?>
	
	<!-- 底部 end-->


	<?php include template("content","script"); ?>

</body>

</html>