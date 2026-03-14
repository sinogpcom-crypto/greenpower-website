<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->

	


	<!-- banner -->
	<div class="i_banner">

		<div class="ibanner_box">
			<div class="swiper-wrapper">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=dee1d110e6ed8cb4ec7f5271049a8fb3&action=lists&catid=39&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'39','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <?php if($r[video]) { ?>
				<div class="swiper-slide">
					
					<div class="iteam">

						<div class="video_box">
							<div class="img">
								<div class="img-i imgY">
									<img src="<?php echo $r['thumb'];?>" alt="">
								</div>
								<div class="img-i imgN" style="background-image: url(<?php echo $r['thumb'];?>)"></div>
							</div>

							<video class="video" id="video1" preload="auto" poster="<?php echo $r['thumb'];?>">
								<source src="<?php echo $r['video'];?>" type="video/mp4;">
							</video>
						</div>

						
						<div class="i_banner_box">
							<div class="wrap">
								<h4 class="cover_title01 transition1 delay02"><?php echo $r['title2'];?></h4>
								<h3 class="cover_title02 transition1 delay04"><?php echo $r['description'];?></h3>
								<div class="video_btn transition1 delay06">
									<span class="video_btns" data-index="1">
										PLAY
									</span>
								</div>

							</div>
						</div>
						<div class="baner_liner"></div>
					</div>

				</div>
				<?php } else { ?>
				<div class="swiper-slide">
					<div class="iteam">
						<div class="img">
							<div class="img-i imgY">
								<img src="<?php echo $r['thumb'];?>" alt="">
							</div>
							<div class="img-i imgN" style="background-image: url(<?php echo $r['thumb'];?>)"></div>
						</div>
						<div class="i_banner_box">
							<div class="wrap">
								<h4 class="cover_title01 transition1 delay02"><?php echo $r['title2'];?></h4>
								<h3 class="cover_title02 transition1 delay04"><?php echo $r['description'];?></h3>
							</div>
						</div>
						<div class="baner_liner"></div>
					</div>

				</div>
				<?php } ?>
				<?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

				


			</div>
			
		</div>

		<div class="ibanner_list">
			<div class="wrap">
				<div class="list_box">

					
					<div class="item"></div>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=dee1d110e6ed8cb4ec7f5271049a8fb3&action=lists&catid=39&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'39','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
					<?php $i=1?>
                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="item <?php if($i==1) { ?>active<?php } ?>">
						<div class="item-bg">
							<img src="<?php echo $r['bg'];?>" alt="">
						</div>
						<div class="box">
							<div class="title">
								<h3><?php echo $r['title'];?></h3>
								<!-- <span><?php echo $r['title_en'];?></span> -->
							</div>
							<div class="num"><?php echo str_pad($i,2,"0",STR_PAD_LEFT)?> -</div>
							<div class="icon"><img src="<?php echo $r['ico'];?>" alt=""></div>
						</div>
					</div>
					<?php $i++?>
					<?php $n++;}unset($n); ?>
               		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>

		
				</div>

			</div>
			
		</div>
		

	</div>
	<!-- banner end-->

	
	
	<!-- Page Content -->
	<main class="sitepage-content">
		<div class="index_business">
			<div class="wrap">
				<div class="business_top clearfix">
					<div class="business_header">
						<div class="index_title">
							<!-- <h4><?php echo $CATEGORYS['40']['catname_en'];?></h4> -->
							<h3><?php echo $CATEGORYS['40']['catname'];?></h3><!-- 我们的业务 -->
							<a href="<?php echo $CATEGORYS['58']['url'];?>" class="more">
								SEE MORE
							</a>
						</div>
					</div>
					<div class="business_info">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=73957db3a399588d5c94626347e59401&action=lists&catid=40&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'40','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
						
	                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<div class="item" style="background-image: url(<?php echo $r['thumb'];?>);">
							<div class="box">
								<div class="item-title"><?php echo $r['title'];?></div>
								<div class="liner"></div>
								<div class="item-ftitle"><?php echo $r['title2'];?></div>
								<div class="item-desc">
									<?php echo $r['description'];?>
								</div>
								<div class="item-icon">
									<img src="/statics/web/images/ic/ic_4.png" alt="">
								</div>
							</div>
						</div>
					
						<?php $n++;}unset($n); ?>
	               		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					
						
					</div>
				</div>
				<div class="business_bottom clearfix">

					<div class="business_bottom_box">

						<div class="swiper-wrapper">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=73957db3a399588d5c94626347e59401&action=lists&catid=40&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'40','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
							<?php $i=1?>
		                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<div class="item">			
								<div class="box <?php if($i==1) { ?>active<?php } ?>">
									<div class="img-box"><img src="<?php echo $r['bg'];?>" alt=""></div>
									<div class="item-box">
										<div class="img">
											<img src="<?php echo $r['thumb2'];?>" alt="">
										</div>
										<h3><?php echo $r['title'];?></h3>
										<!-- <span><?php echo $r['title_en'];?></span> -->
										<div class="icon"></div>
									</div>
								</div>
							</div>
							<?php $i++?>
							<?php $n++;}unset($n); ?>
	               			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						
						
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="index_strengths">
			<div class="wrap">
				<div class="index_title white">
					<!-- <h4><?php echo $CATEGORYS['41']['catname_en'];?></h4> -->
					<h3><?php echo $CATEGORYS['41']['catname'];?></h3><!-- 我们的优势 -->
				</div>
				<div class="liner"></div>
				<div class="strengths_info">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0869887cda49f20650199063b97ec770&action=lists&catid=41&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'41','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="box">
						<h4><?php echo $r['title'];?></h4>
						<div class="synopsis">
							<?php echo $r['description'];?>
						</div>
					</div>
					<?php $n++;}unset($n); ?>
           			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					
				</div>
			</div>
			<div class="strengths_list clearfix">
				<div class="wrap">
					<div class="strengths_list_box">
						<div class="swiper-wrapper">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=0869887cda49f20650199063b97ec770&action=lists&catid=41&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'41','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'20',));}?>
							<?php $i=1?>
		                	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<div class="item">
								<div class="item-box <?php if($i==1) { ?>active<?php } ?>">
									<div class="img">
										<img src="<?php echo $r['thumb'];?>" alt="">
									</div>
									<div class="icon"></div>
									<div class="title">
										<?php echo $r['title'];?>
									</div>
								</div>
							</div>
							<?php $i++?>
							<?php $n++;}unset($n); ?>
	               			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="index_about">
			<div class="wrap clearfix">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=19d1fa5c61b14b2c40ebbf9052ca3ee3&action=lists&catid=42&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'42','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'1',));}?>
            	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<div class="about_fl" style="background-image: url(<?php echo $r['thumb'];?>);">
					
					<div class="index_title white">
						<h3><?php echo $r['title'];?></h3>
						<div class="liner"></div>
						<div class="synopsis">
							<?php echo $r['content'];?>
						</div>
						
						<a href="<?php echo $CATEGORYS['20']['url'];?>" class="more">
							SEE MORE
						</a>
					</div>

				</div>

				<div class="about_fr">
					<img src="<?php echo $r['thumb2'];?>" alt="">
				</div>
				<?php $n++;}unset($n); ?>
	             <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>

		<div class="index_cooperative">
			<div class="wrap">
				<div class="index_title">
					<!-- <h4><?php echo $CATEGORYS['43']['catname_en'];?></h4> -->
					<h3><?php echo $CATEGORYS['43']['catname'];?></h3><!-- 合作伙伴 -->
					<a href="" class="more">
						SEE MORE
					</a>
				</div>
				<div class="cooperative_list clearfix">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d33ce0a9e3ffacf94eb3228753911e80&action=lists&catid=43&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=100\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'43','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'100',));}?>
            	<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<div class="item">
						<a href="<?php if($r[islink]==1) { ?><?php echo $r['url'];?><?php } else { ?>javascript:;<?php } ?>"  <?php if($r[islink]==1) { ?>target="_blank"<?php } ?> rel="noopener noreferrer">
							<div class="img">
								<img src="<?php echo $r['thumb'];?>" alt="<?php echo $r['title'];?>">
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