<div class="page_ban" >
		<div class="img-box" style="background-image: url(<?php echo $CATEGORYS[$top_parentid]['image'];?>);">
			<img src="<?php echo $CATEGORYS[$top_parentid]['image'];?>" alt="">
		</div>
		<div class="img-info">
			<div class="page_wrap">

				<div class="info_title">
					<span><?php echo $CATEGORYS[$top_parentid]['catname_en'];?></span>
					<h3><?php echo $CATEGORYS[$top_parentid]['catname'];?></h3>
				</div>
				<div class="mbx">
					<!-- <a href="/">首页</a><i class="fa iconfont icon-angleright"></i><a href="">产品</a> -->
					<?php echo catpos2($catid,'<i class="fa iconfont icon-angleright"></i>');?>
				</div>
			</div>
			
		</div>
	</div>