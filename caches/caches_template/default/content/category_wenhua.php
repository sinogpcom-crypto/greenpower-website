<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>

	
	<!-- Page Content -->
	<main class="page-content">

		<div class="about-culture productbg1">
			<div class="about-title">
				<?php echo $CATEGORYS['29']['catname'];?>
			</div>

			<div class="culture-list">
				<div class="page_wrap clearfix">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=997dfeca4ef32c9e9066d25994cba470&action=lists&catid=29&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'29','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
             		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					
					<div class="item">
						<div class="img">
							<img src="<?php echo $r['thumb'];?>" alt="">
						</div>
						<div class="title"><?php echo $r['title'];?></div>
						<div class="synopsis">
							<p style="text-align: center;"><?php echo format_textarea($r[description]);?></p>							
						</div>
					</div>
					<?php $n++;}unset($n); ?>
            		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				
				</div>
			</div>
			
		</div>
		
		<div class="about-brand">
			<div class="about-title">
				<?php echo $CATEGORYS['30']['catname'];?>
			</div>
			<div class="brand-list">
				<div class="page_wrap clearfix">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=22b612acd7645a27152e3915d606eff1&action=lists&catid=30&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'30','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
             		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="item">
						<div class="item-img">
							<img src="<?php echo $r['thumb'];?>" alt="">
						</div>
						<div class="item-info">
							<?php echo format_textarea($r[description]);?>
						</div>
					</div>
					<?php $n++;}unset($n); ?>
            		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>


				</div>
			</div>
		</div>

		<div class="about-corporate">
			<div class="about-title">
				<?php echo $CATEGORYS['31']['catname'];?>
			</div>
			<div class="corporate-list">
				<div class="page_wrap clearfix">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ad87624bd7f2437efed185cbedde4f00&action=lists&catid=31&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'31','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
             		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="item">
						<div class="item-icon">
							<img src="/statics/web/images/ic/ic_20.png" alt="">
						</div>
						<div class="item-info">
							<?php echo format_textarea($r[description]);?>
						</div>
					</div>
					<?php $n++;}unset($n); ?>
            		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

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