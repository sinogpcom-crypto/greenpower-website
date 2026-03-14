<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	
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
					<a href="/">Home</a>
					<i class="fa iconfont icon-angleright"></i>
					<a href="<?php echo $CATEGORYS[$top_parentid]['url'];?>"><?php echo $CATEGORYS[$top_parentid]['catname'];?></a>
					<i class="fa iconfont icon-angleright"></i>
					<a href="<?php echo $CATEGORYS[$catid]['url'];?>"><?php echo $CATEGORYS[$parentid]['catname'];?></a>
					<i class="fa iconfont icon-angleright"></i>
					<a href="<?php echo $CATEGORYS[$catid]['url'];?>"><?php echo $CATEGORYS[$catid]['catname'];?></a>
					
				</div>
			</div>
			
		</div>
	</div>

	<!--productMenu-->
    <div class="product_menu">
         <div id="pMenu">
         	<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=83e139e411d2da1c5a36818e833da129&action=category&where=ismenu%3D1&catid=%24CAT%5Bparentid%5D&siteid=%24siteid&order=listorder%2Ccatid&return=datas\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {global $datas; $datas = $content_tag->category(array('where'=>'ismenu=1','catid'=>$CAT[parentid],'siteid'=>$siteid,'order'=>'listorder,catid','limit'=>'20',));}?>
            <?php $n=1;if(is_array($datas)) foreach($datas AS $r) { ?>
            <a href="<?php echo $r['url'];?>" <?php if($catid ==$r[catid] ) { ?>class="active"<?php } ?>><?php echo $r['catname'];?></a>
            <?php $n++;}unset($n); ?>
            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			

			 <span id="arrow"><img src="/statics/web/images/down.png"> </span>
         </div>
		<script>
			window.onload=function(){
				var originH=$("#pMenu").height();
			    if(originH > 140){
					$("#pMenu").css({'height':'140px','overflow':'hidden'});
					$('#arrow').css('display','block');
				}
				$('#arrow').click(function () {
                      if($("#pMenu").height()==140){
						  $("#pMenu").css({'height':'auto','overflow':'auto'});
						  $('#arrow').html(`<img src="/statics/web/images/up.png">`)
					  }
                      else{
						  $("#pMenu").css({'height':'140px','overflow':'hidden'});
						  $('#arrow').html(`<img src="/statics/web/images/down.png">`)
					  }
				})


			}

		</script>
    </div>
	
	<!-- Page Content -->
	<main class="page-content">

		<div class="product-list-list">
			<div class="page_wrap clearfix">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b98f2bf133c6976d0abb9c9d53a0aef3&action=lists&catid=%24catid&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=8&page=%24page\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {$pagesize = 8;$page = intval($page) ? intval($page) : 1;if($page<=0){$page=1;}$offset = ($page - 1) * $pagesize;$content_total = $content_tag->count(array('catid'=>$catid,'moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));$pages = xwjpages($content_total, $page, $pagesize, $urlrule);$pages2 = pages2($content_total, $page, $pagesize, $urlrule);global $data; $data = $content_tag->lists(array('catid'=>$catid,'moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>$offset.",".$pagesize,'action'=>'lists',));}?>
                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<div class="item">
					<a href="<?php echo $r['url'];?>">
						<div class="item-img">
							<img src="<?php echo $r['thumb'];?>" alt="">
						</div>
						<div class="item-box">

							<div class="title"><?php echo $r['title'];?></div>
							<div class="label"><?php echo $r['xh'];?></div>

						</div>
					</a>
				</div>
				<?php $n++;}unset($n); ?>
                 	<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

				
			</div>
			<?php echo $pages2;?>
		</div>

	</main>
	<!-- //Page Content -->

	

	<!-- 底部 -->
	
	<?php include template("content","footer"); ?>
	
	<!-- 底部 end-->


	<?php include template("content","script"); ?>

</body>

</html>