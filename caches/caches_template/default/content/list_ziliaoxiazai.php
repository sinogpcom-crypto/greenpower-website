<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	
	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>
	          
	
	
	<!-- Page Content -->
	<main class="page-content">

		<div class="data-page productbg1">
            
            <div class="page_wrap ">
				<div class="data-nav">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=fe937f449e60eb572da46b5dd5a52a58&action=category&where=ismenu%3D1&catid=%24CAT%5Bparentid%5D&siteid=%24siteid&order=listorder%2Ccatid\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {global $data; $data = $content_tag->category(array('where'=>'ismenu=1','catid'=>$CAT[parentid],'siteid'=>$siteid,'order'=>'listorder,catid','limit'=>'20',));}?>
                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<a href="<?php echo $r['url'];?>" <?php if($catid ==$r[catid]) { ?>class="active"<?php } ?> ><?php echo $r['catname'];?></a>
					<?php $n++;}unset($n); ?>
                	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
				<div class="data-info">
					<div class="single-page">
						<p style="text-align: center;">
							<b><?php echo $CATEGORYS[$catid]['description'];?></b>
						</p>

					</div>
				</div>

				<div class="data_list clearfix">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=99d167cab52d05ccd166bbf23dc0f459&action=lists&catid=%24catid&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=8&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 8;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = xwjpages($content_total, $page, $pagesize, $urlrule);$pages2 = pages2($content_total, $page, $pagesize, $urlrule);global $data; $data = $content_tag->lists(array('catid'=>$catid,'moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="item">
						<!-- <a href="/index.php?m=content&c=index&a=filedown&id=<?php echo $r['id'];?>"> -->
						<a href="<?php if($r[file]) { ?><?php echo $r['file'];?><?php } else { ?>javascript:;<?php } ?>">
							<div class="item-title"><?php echo $r['title'];?></div>
							<div class="item-synopsis"><?php echo $r['filesize'];?></div>
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