<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>

	
	<!-- Page Content -->
	<main class="page-content">

		
		
		<div class="page-development productbg1">
            
            <div class="page_wrap ">
				<div class="page-development-first">
					<div class="page-development-box">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=27b1d23cc74ac79a1faa02dd2ea3c2c1&action=lists&catid=53&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'53','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'1',));}?>
                		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="img">
							<img src="<?php echo $r['thumb'];?>" alt="">
						</div>
						<div class="info">
							<h3><?php echo $r['title'];?></h3>
							<p>&nbsp;</p>
							<?php echo $r['content'];?>
						</div>
						<?php $n++;}unset($n); ?>
                		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					
					<div class="page-development-title">
						Vacant Job
					</div>
					
					<div class="page-position-list clearfix">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=67f517e19a5841301134836a8d7b319c&action=lists&catid=54&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=100\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'54','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'100',));}?>
						<?php $i=1?>
                		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="position-item <?php if($i==1) { ?>active<?php } ?>">
							<div class="item-header">
								<div class="title"><?php echo $r['title'];?></div>
								<div class="data"><?php echo date('Y-m-d',$r[inputtime]);?></div>
							</div>
							<div class="item-info">
								<div class="item">
									<div class="title">Positions Information：</div>
									<div class="info">
										<?php echo $r['content'];?>
									</div>
								</div>
								<div class="item">
									<div class="title">Position Statement：</div>
									<div class="info">
										<?php echo $r['content2'];?>
									</div>
								</div>
							</div>
						</div>
						<?php $i++?>
						<?php $n++;}unset($n); ?>
                		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					
					</div>
					

					<div class="page-development-title">
						Explore your opportunities
					</div>
					<div class="page-development-position clearfix">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=32d2b8b5543fcb5822f1ce256bd7734c&action=lists&catid=55&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=5&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 5;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>'55','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = xwjpages($content_total, $page, $pagesize, $urlrule);$pages2 = pages2($content_total, $page, $pagesize, $urlrule);global $data; $data = $content_tag->lists(array('catid'=>'55','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
                		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="item">
							<a href="<?php echo $r['url'];?>">
								<div class="item-title">
									<?php echo $r['title'];?>
								</div>
								<div class="item-info">
									<span>Recruiting Numbers：<?php echo $r['ren'];?> persons</span>
									<span>Pubdate：<?php echo date('Y-m-d',$r[inputtime]);?></span>
								</div>
								<div class="item-more">MORE</div>
							</a>
						</div>
						<?php $n++;}unset($n); ?>
                		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						

					</div>
					
					<?php echo $pages2;?>
					
					
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