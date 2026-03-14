<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>

	
	<!-- Page Content -->
	<main class="page-content">

		<div class="about-interpretation productbg1">
            
            <div class="page_wrap ">
				<div class="interpretation-list">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e608009680ce0f39dee69b58ca76ec51&action=lists&catid=32&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'32','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
             		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="item">
						<div class="img">
							<img src="<?php echo $r['thumb'];?>" alt="">
						</div>
						<div class="title">
							<?php echo $r['title'];?>
						</div>
					</div>
					<?php $n++;}unset($n); ?>
            		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					

				</div>

				<div class="interpretation-info clearfix">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=431cd1deedf63acece5c7c900935f078&action=lists&catid=33&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'33','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
             		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="info-fl">
						<div class="img-box">
							<img src="<?php echo $r['thumb'];?>" alt="">
						</div>
					</div>
					<div class="info-fr">
						<div class="title"><?php echo $r['title'];?></div>
						<div class="single-page">
							<?php echo $r['content'];?>
						</div>
					</div>
					<?php $n++;}unset($n); ?>
            		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
				<div class="interpretation-box">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=89fcee3c48b85762ef9a8458b0c74293&action=lists&catid=34&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'34','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
             		<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="item">
						<div class="icon">
							<img src="<?php echo $r['thumb'];?>" alt="">
						</div>
						<div class="liner-1"></div>
						<div class="title"><?php echo $r['title'];?></div>
						<div class="synopsis">
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