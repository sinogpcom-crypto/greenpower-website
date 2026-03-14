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
					<a href="/">Home</a><i class="fa iconfont icon-angleright"></i><a href="<?php echo $CATEGORYS[$top_parentid]['url'];?>"><?php echo $CATEGORYS[$top_parentid]['catname'];?></a>
					
				</div>
			</div>
			
		</div>
	</div>
	
	<!-- Page Content -->
	<main class="page-content">

		<div class="product-list">
			<div class="page_wrap clearfix">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c655878d06d49fd4213e2423aaaaad55&action=category&where=ismenu%3D1&catid=3&siteid=%24siteid&order=listorder%2Ccatid\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {global $data; $data = $content_tag->category(array('where'=>'ismenu=1','catid'=>'3','siteid'=>$siteid,'order'=>'listorder,catid','limit'=>'20',));}?>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <?php 
               
                if ($r[child] == 1 ) { 
                    $child_arrary=explode(',',$r[arrchildid]);
                    
                    $r[url]=$CATEGORYS[$child_arrary[1]][url];
                   
                } 
                
            ?>
				<div class="item">
					<!-- <a href="<?php echo $r['url'];?>"> -->
						<div class="item-img">
							<img src="<?php echo $r['image'];?>" alt="">
						</div>
						<div class="item-box">
							<div class="title">
								<?php echo $r['catname'];?>
							</div>
							<div class="info">
								<ul>
									<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=164e40b6031af9f783b3dad6bc7a072b&action=category&where=ismenu%3D1&catid=%24r%5Bcatid%5D&siteid=%24siteid&order=listorder%2Ccatid&return=data2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {global $data2; $data2 = $content_tag->category(array('where'=>'ismenu=1','catid'=>$r[catid],'siteid'=>$siteid,'order'=>'listorder,catid','limit'=>'20',));}?>
                					<?php $n=1;if(is_array($data2)) foreach($data2 AS $r2) { ?>
									<li><a href="<?php echo $r2['url'];?>"><?php echo $r2['catname'];?></a></li>
									<?php $n++;}unset($n); ?>
                					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
								</ul>
							</div>
						</div>
					<!-- </a> -->
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