<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	
	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>
	          
	
	
	<!-- Page Content -->
	<main class="page-content">

		<div class="service-page">
			<div class="page_wrap">
				<div class="service-list clearfix">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5a8a0b478789ce6ecaa4762cfb99657f&action=lists&catid=%24catid&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=5&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 5;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = xwjpages($content_total, $page, $pagesize, $urlrule);$pages2 = pages2($content_total, $page, $pagesize, $urlrule);global $data; $data = $content_tag->lists(array('catid'=>$catid,'moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="item">
						<a href="<?php echo $r['url'];?>">
							<div class="item-data">
								<div class="item-data-box">
									<div class="day"><?php echo date('d', $r['inputtime']);?></div>
									<div class="year"><?php echo date('Y.m', $r['inputtime']);?></div>
								</div>
							</div>
							<div class="item-img">
								<img src="<?php echo $r['thumb'];?>" alt="">
							</div>
							<div class="item-box">
								<div class="title">
									<?php echo $r['title'];?>
								</div>
								<div class="synopsis">
									<?php echo $r['description'];?>
								</div>
							</div>
							<div class="icon"><img src="/statics/web/images/ic/ic_10.png" alt=""></div>
						</a>
					</div>
					<?php $n++;}unset($n); ?>
                 	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				
				</div>

				
				<?php echo $pages2;?>
				

				
				
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