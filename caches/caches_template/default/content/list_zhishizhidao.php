<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	
	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>
	          
	
	
	<!-- Page Content -->
	<main class="page-content">

		<div class="knowledge-page productbg1">
            
            <div class="page_wrap ">
				<div class="knowledge_list">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d48958de499754e1ed80f08c9950ce67&action=lists&catid=%24catid&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>$catid,'moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="item">
						<a href="<?php echo $r['url'];?>">
							<div class="item-img">
								<img src="<?php echo $r['thumb'];?>" alt="">
							</div>
							<div class="item-info">
								<div class="title"><?php echo $r['title'];?></div>
								<div class="synopsis">
									<?php echo $r['description'];?>
								</div>
								<span class="more">MORE</span>
							</div>
						</a>
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