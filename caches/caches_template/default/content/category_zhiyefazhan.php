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
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4b4ce46338cc15e3b3f33574dbf7e3a0&action=lists&catid=50&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'50','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'1',));}?>
                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="page-development-header">
						<div class="box">
							<h4><?php echo $r['txt1'];?></h4>
							<h3><?php echo $r['txt2'];?></h3>
							<h3><?php echo $r['txt3'];?></h3>
						</div>
					</div>
					<div class="page-development-box">
						<div class="img">
							<img src="<?php echo $r['thumb'];?>" alt="">
						</div>
						<div class="info">
							<?php echo $r['content'];?>
						</div>
					</div>
					<?php $n++;}unset($n); ?>
                	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					<div class="page-development-title">
						About Us
					</div>
					<div class="page-development-about clearfix">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=9efebfcb5910a951981c14a730afa5e1&action=lists&catid=51&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'51','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'4',));}?>
                		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="item">
							<div class="img">
								<img src="<?php echo $r['thumb'];?>" alt="">
							</div>
							<div class="title">
								<?php echo $r['title'];?>
							</div>
							<div class="info">
								<?php echo $r['content'];?>
							</div>
						</div>
						<?php $n++;}unset($n); ?>
                		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				

					</div>

					<div class="page-development-ftitle">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=800513eae3aaa8c3689a28f9ec442890&action=lists&catid=52&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'52','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'1',));}?>
                		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<h3><?php echo $r['title'];?></h3>
						<p><?php echo $r['description'];?></p>
						<?php $n++;}unset($n); ?>
                		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
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