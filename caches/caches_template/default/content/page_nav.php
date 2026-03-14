<div class="category">
		<div class="page_wrap">
			<div class="category_head">
				<span><?php echo $CATEGORYS[$catid]['catname'];?></span>
				<i class="fa iconfont icon-angledown transition03"></i>
			</div>
			<div class="page_nav clearfix">
				<?php if($CAT[parentid]==16) { ?>
					<?php $parentid_nav=5?>
				<?php } else { ?>
					<?php $parentid_nav=$CAT[parentid]?>
				<?php } ?>
				
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=577b485ddd6f1b2ec2dbd9ea4f7bf059&action=category&where=ismenu%3D1&catid=%24parentid_nav&siteid=%24siteid&order=listorder%2Ccatid\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {global $data; $data = $content_tag->category(array('where'=>'ismenu=1','catid'=>$parentid_nav,'siteid'=>$siteid,'order'=>'listorder,catid','limit'=>'20',));}?>
                <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                <?php 
                    if ($r[child] == 1 and $r[catid]!=3) { 
                        $child_arrary=explode(',',$r[arrchildid]);
                        if($CATEGORYS[$child_arrary[1]][ismenu]==1) {
                            if($CATEGORYS[$child_arrary[1]][child]==1){
                                $child_arrary2=explode(',',$CATEGORYS[$child_arrary[1]][arrchildid]);
                                if($CATEGORYS[$child_arrary2[1]][ismenu]==1) {
                                    $r[url]=$CATEGORYS[$child_arrary2[1]][url];

                                }

                            }else{
                                $r[url]=$CATEGORYS[$child_arrary[1]][url];
                            }  
                           
                         }  
                    } 
                ?>
				<a <?php if($catid ==$r[catid] || $CAT[parentid]==$r[catid]) { ?>class="active"<?php } ?> href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a>
				<?php $n++;}unset($n); ?>
                <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
	</div>