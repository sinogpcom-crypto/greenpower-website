<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	
	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>
	          
	
	
	<!-- Page Content -->
	<main class="page-content">

		<div class="about-leader productbg1">
			<div class="page_wrap clearfix">
				 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3c724318e8dc102b06459c9e9b2f90fd&action=lists&catid=%24catid&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>$catid,'moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'1',));}?>
             	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<div class="leader-info-fl">
					<div class="img-box">
						<img src="<?php echo $r['thumb'];?>" alt="">
					</div>
					<div class="name">
						<h3><?php echo $r['title'];?></h3>
						<span><?php echo $r['zhiwei'];?></span>
					</div>
				</div>

				<div class="leader-info-fr">
					
					<div class="single-page">
						<?php echo $r['content'];?>
					</div>
					
				</div>
				<?php $n++;}unset($n); ?>
            	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				
				
			</div>
		</div>
		

	</main>
	<!-- //Page Content -->

	

	<!-- 底部 -->
	
	<?php include template("content","footer"); ?>
	
	<!-- 底部 end-->


	<?php include template("content","script"); ?>

</body>

</html>