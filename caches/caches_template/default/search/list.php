<?php include template("content","header"); ?>

<body>

  <!--header-wrapper-->

  <?php include template("content","part_nav"); ?>
  <!--/header-wrapper-->


  
<div class="page_ban" >
    <div class="img-box" style="background-image: url(<?php echo $CATEGORYS['56']['image'];?>);">
      <img src="<?php echo $CATEGORYS['56']['image'];?>" alt="">
    </div>
    <div class="img-info">
      <div class="page_wrap">

        <div class="info_title">
          <span><?php echo $CATEGORYS['56']['catname_en'];?></span>
          <h3><?php echo $CATEGORYS['56']['catname'];?></h3>
        </div>
        <div class="mbx">
          <a href="/">Home</a><i class="fa iconfont icon-angleright"></i><a href="javascript:;">Search</a>
        </div>
      </div>
      
    </div>
  </div>
  
  
<!-- Page Content -->
  <main class="page-content">

    <div class="seach_page">
      <div class="page_wrap">
        <div class="seach_page_box">
          <ul>
            <?php $n=1; if(is_array($datas)) foreach($datas AS $i => $r) { ?>
            <li>
              <a href="<?php echo $r['url'];?>">
                <div class="tit">
                  <h3><?php echo $r['title'];?></h3><span><?php echo date('Y-m-d', $r['inputtime']);?></span>
                </div>
              </a>
            </li>
            <?php $n++;}unset($n); ?>
            <?php if(empty($datas)) { ?>No results found<?php } ?>
   
          </ul>
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