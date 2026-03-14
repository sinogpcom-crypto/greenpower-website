<?php if(!isset($CATEGORYS)) { $CATEGORYS = getcache('category_content_'.$siteid,'commons'); } ?>


<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4391fa8c76964673debe7d12051c8a7c&action=lists&catid=57&moreinfo=1&siteid=%24siteid&order=listorder+is+null%2Clistorder+desc%2Cinputtime+desc%2Cid+desc&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'lists')) {global $data; $data = $content_tag->lists(array('catid'=>'57','moreinfo'=>'1','siteid'=>$siteid,'order'=>'listorder is null,listorder desc,inputtime desc,id desc','limit'=>'1',));}?>
<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
<?php $web_site = $r?>
<?php $n++;}unset($n); ?>
<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
<div class="header-wrapper transition05 header-fix">
        <div class="wrap">
            <div class="header-top clearfix">
                <div class="logo transition05">
                    <a href="/"><img class="thumbPc transition05" src="/statics/web/images/logo.png" alt=""><img
                            class="thumbMobile" src="/statics/web/images/logo.png" alt=""></a>
                </div>
                <div class="sm-menu " id="smMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="top_label">
                    <div class="top-right">
                        <div class="navigation ">
                            <ul id="navList" class="list transition05">
                                <li <?php if(!$catid) { ?> class="active" <?php } ?>><span class="top"><a href="/">Home</a></span></li>
                                <?php $n=1;if(is_array($CATEGORYS)) foreach($CATEGORYS AS $v) { ?>
                                <?php if($v[ismenu]==1 and $v[parentid]==0 and in_array($v[catid],array(3,4,5,6))) { ?>
                                <?php 
                                    if ($v[child] == 1) { 
                                        $child_arrary=explode(',',$v[arrchildid]);
                                        if($CATEGORYS[$child_arrary[1]][ismenu]==1) {
                                            $v[url]=$CATEGORYS[$child_arrary[1]][url]; 
                                           
                                         }  
                                    } 
                                ?>
                                <?php if($v[catid]!=3) { ?>
                                <li <?php if($top_parentid==$v[catid]) { ?> class="active" <?php } ?>>
                                    <span class="top"><a href="javascript:;"><?php echo $v['catname'];?><i class="fa iconfont icon-angledown"></i></a></span>
                                    <ol class="sub-item second-item">
                                        <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ef5bad1b46dc1f5bc62023069171d826&action=category&where=ismenu%3D1&catid=%24v%5Bcatid%5D&siteid=%24siteid&order=listorder%2Ccatid\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {global $data; $data = $content_tag->category(array('where'=>'ismenu=1','catid'=>$v[catid],'siteid'=>$siteid,'order'=>'listorder,catid','limit'=>'20',));}?>
                                        <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                                             <?php 
                                                if(!in_array($r[catid],array(45,59))){
                                                    if ($r[child] == 1 ) { 
                                                        $child_arrary=explode(',',$r[arrchildid]);
                                                        if($CATEGORYS[$child_arrary[1]][ismenu]==1) {  
                                                        $r[url]=$CATEGORYS[$child_arrary[1]][url];
                                                         }  
                                                    } 
                                                }
                                            ?>
                                        <li>
                                            <span class="top"><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></span>
                                        </li>
                                        <?php $n++;}unset($n); ?>
                                        <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                                        
                                    </ol>
                                
                                </li>
                                <?php } else { ?>
                                <li <?php if($top_parentid==$v[catid]) { ?> class="active" <?php } ?>>
                                    <span class="top"><a href="<?php echo $v['url'];?>"><?php echo $v['catname'];?></a></span>
                                </li>
                                <?php } ?>

                                <?php } ?>
                                <?php $n++;}unset($n); ?>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="seach_btn i_ico transition05"></div>
                    <div class="lang_btn">
                        <span>ENG<i class="fa iconfont icon-angledown"></i></span>
                        <div class="list">
                            <div class="item">
                                <a href="http://www.sinogp.net/">中文</a>
                            </div>
                            <div class="item">
                                <a href="/">ENG</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="search_box">
                <div class="wrap">
                    <div class="search_close"></div>
                    <div class="inp_button">
                        <button class="btn">Search</button>
                    </div>
                    <div class="input_box">
                        <input type="text" class="inp_box fl" id="sousuo" placeholder="Enter Keywords" name="">
                    </div>
                </div>
            </div>
            <script type="text/javascript">
            $('.btn').click(function () {
                $sousuo = $('#sousuo').val();
                if ($sousuo) {
                   
                    window.location.href = "/?m=search&c=index&a=init&typeid=0&siteid=1&q="+$sousuo;
                }else{
                    alert('Please enter keywords')
                }
                
            })
            

            </script>

        </div>
    </div>
    <div class="header-wrapper transition05 header-wrapper2">
        <div class="wrap fix">
            <div class="header-top clearfix">
                <div class="logo transition05">
                    <a href="/"><img class="thumbPc transition05" src="/statics/web/images/logo.png" alt=""><img
                            class="thumbMobile" src="/statics/web/images/logo.png" alt=""></a>
                </div>
                <div class="sm-menu " id="smMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="top_label">
                    <div class="top_nav clearfix">
                        <?php $n=1;if(is_array($CATEGORYS)) foreach($CATEGORYS AS $v) { ?>
                        <?php if($v[ismenu]==1 and $v[parentid]==0 and in_array($v[catid],array(7,8,47,10))) { ?>
                        <?php 
                            if ($v[child] == 1) { 
                                $child_arrary=explode(',',$v[arrchildid]);
                                if($CATEGORYS[$child_arrary[1]][ismenu]==1) {
                                    if($CATEGORYS[$child_arrary[1]][child]==1){
                                        $child_arrary2=explode(',',$CATEGORYS[$child_arrary[1]][arrchildid]);
                                        if($CATEGORYS[$child_arrary2[1]][ismenu]==1) {
                                            $v[url]=$CATEGORYS[$child_arrary2[1]][url];

                                        }else{
                                            $v[url]=$CATEGORYS[$child_arrary[1]][url];
                                        }

                                    }else{
                                        $v[url]=$CATEGORYS[$child_arrary[1]][url];
                                    }  
                                   
                                 }  
                            } 
                        ?>
                        <a href="<?php echo $v['url'];?>"><?php echo $v['catname'];?></a>
                        <?php } ?>
                        <?php $n++;}unset($n); ?>
                    </div>
                    <div class="seach_btn i_ico transition05"></div>
                    <div class="lang_btn">
                        <span>ENG<i class="fa iconfont icon-angledown"></i></span>
                        <div class="list">
                            <div class="item">
                                <a href="http://www.sinogp.net/">中文</a>
                            </div>
                            <div class="item">
                                <a href="/">ENG</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom clearfix">
                <div class="top-right">
                    <div class="navigation ">
                        <ul id="navList" class="list transition05">
                            <li <?php if(!$catid) { ?> class="active" <?php } ?>><span class="top"><a href="/">Home</a></span></li>
                            <?php $n=1;if(is_array($CATEGORYS)) foreach($CATEGORYS AS $v) { ?>
                            <?php if($v[ismenu]==1 and $v[parentid]==0 and in_array($v[catid],array(3,4,5,6))) { ?>
                            <?php 
                                if ($v[child] == 1) { 
                                    $child_arrary=explode(',',$v[arrchildid]);
                                    if($CATEGORYS[$child_arrary[1]][ismenu]==1) {
                                        $v[url]=$CATEGORYS[$child_arrary[1]][url]; 
                                       
                                     }  
                                } 
                            ?>
                            <?php if($v[catid]!=3) { ?>
                            <li <?php if($top_parentid==$v[catid]) { ?> class="active" <?php } ?>>
                                <span class="top"><a href="javascript:;"><?php echo $v['catname'];?><i class="fa iconfont icon-angledown"></i></a></span>
                                <ol class="sub-item second-item">
                                    <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ef5bad1b46dc1f5bc62023069171d826&action=category&where=ismenu%3D1&catid=%24v%5Bcatid%5D&siteid=%24siteid&order=listorder%2Ccatid\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {global $data; $data = $content_tag->category(array('where'=>'ismenu=1','catid'=>$v[catid],'siteid'=>$siteid,'order'=>'listorder,catid','limit'=>'20',));}?>
                                    <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                                         <?php 
                                            if(!in_array($r[catid],array(45,59))){
                                                if ($r[child] == 1 ) { 
                                                    $child_arrary=explode(',',$r[arrchildid]);
                                                    if($CATEGORYS[$child_arrary[1]][ismenu]==1) {  
                                                    $r[url]=$CATEGORYS[$child_arrary[1]][url];
                                                     }  
                                                } 
                                            }
                                        ?>
                                    <li>
                                        <span class="top"><a href="<?php echo $r['url'];?>"><?php echo $r['catname'];?></a></span>
                                    </li>
                                    <?php $n++;}unset($n); ?>
                                    <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                                    
                                </ol>
                            
                            </li>
                            <?php } else { ?>
                            <li <?php if($top_parentid==$v[catid]) { ?> class="active" <?php } ?>>
                                <span class="top"><a href="<?php echo $v['url'];?>"><?php echo $v['catname'];?></a></span>
                            </li>
                            <?php } ?>

                            <?php } ?>
                            <?php $n++;}unset($n); ?>
                            
                            
                            
                        </ul>
                    </div>
                </div>
                <div class="header-notice">
                    <div class="notice-box">
                        <div class="notice-container">
                            <div class="swiper-wrapper">
                                <?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=ec786b3d89b06cebfb53b595cd6bd7ee&action=position&posid=1&order=listorder+is+null%2Clistorder+desc%2Cid+desc\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = bc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {global $data; $data = $content_tag->position(array('posid'=>'1','order'=>'listorder is null,listorder desc,id desc','limit'=>'20',));}?>
                            <?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
                                <div class="swiper-slide">
                                    <div class="item">
                                        <a href="<?php echo $r['url'];?>">
                                            <div class="title"><?php echo $r['title'];?></div><div class="date"><?php echo date('Y-m-d', $r['inputtime']);?></div>
                                        </a>
                                    </div>
                                </div>
                                <?php $n++;}unset($n); ?>
                            <?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
            
            
           <!--  <div class="search_box">
                <div class="wrap">
                    <div class="search_close"></div>
                    <div class="inp_button">
                        <button class="btn">搜索</button>
                    </div>
                    <div class="input_box">
                        <input type="text" class="inp_box fl" placeholder="请输入关键词" name="">
                    </div>
                </div>
            </div> -->

        </div>
    </div>