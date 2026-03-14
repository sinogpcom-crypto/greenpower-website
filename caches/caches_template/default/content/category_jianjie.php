<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>

	
	<!-- Page Content -->
	<main class="page-content">

		<div class="about-info productbg1">
			<div class="page_wrap clearfix">
				 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7f1bab9aee8fa59b5f0de5a9eb4529fd&action=lists&catid=27&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'27','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'1',));}?>
             	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<div class="about-info-fl">
					<div class="title">
						<?php echo $r['title'];?>
					</div>
					<div class="liner"></div>
					<div class="single-page">
						<?php echo format_textarea($r[description]);?> 
					</div>
					<div class="about-info-label">
						<span><?php echo $r['txt1'];?></span>
						<span><?php echo $r['txt2'];?></span>
						<span><?php echo $r['txt3'];?></span>
					</div>
				</div>
				<div class="about-info-fr">
					<div class="img-box">
						<img src="<?php echo $r['thumb'];?>" alt="">
					</div>
				</div>
				<?php $n++;}unset($n); ?>
            	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				
			</div>
		</div>
		
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=40d46c65838092e83114e344dc2cdaa4&action=lists&catid=28&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=1&return=fanwei\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $fanwei; $fanwei = $content_tag->lists(array('catid'=>'28','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'1',));}?>
		<?php $i=1?>
		<?php $n=1;if(is_array($fanwei)) foreach($fanwei AS $r) { ?>
		<?php if($i==1) { ?>
		<?php $fanwei = $r?>
		<?php } ?>
		<?php $i++?>
		<?php $n++;}unset($n); ?>
		
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<div class="about-business">
			<div class="about-business-bg" style="background-image: url(<?php echo $fanwei['thumb'];?>);"></div>
			<div class="about-business-box">
				<div class="page_wrap">
					 
	             	
					<div class="about-business-info">
						<h3><?php echo $fanwei['title'];?></h3>
						<div class="single-page">
							<?php echo format_textarea($fanwei[description]);?> 
						</div>
					</div>
	            	
					<div class="about-business-list">
						 <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0c90baf77b742ca16293db0081303064&action=lists&catid=28&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'28','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
						 <?php $i=1?>
		             	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
		             	<?php if($i>1) { ?>
		             	<?php if($i%2==0) { ?>
						<div class="item">
							<div class="item-box">
								<div class="img">
									<img src="<?php echo $r['thumb'];?>" alt="">
								</div>
								<div class="info"><?php echo format_textarea($r[description]);?>  </div>
							</div>
						</div>
						<?php } else { ?>
						<div class="item">
							<div class="item-box">
								<div class="info"><?php echo format_textarea($r[description]);?>  </div>
								<div class="img">
									<img src="<?php echo $r['thumb'];?>" alt="">
								</div>
							</div>
						</div>
						<?php } ?>
						<?php } ?>
						<?php $i++?>
						<?php $n++;}unset($n); ?>
	            		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>


				</div>
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