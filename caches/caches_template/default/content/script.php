<script type="text/javascript" src="/statics/web/js/swiper.min.js"></script>
<script type="text/javascript" src="/statics/web/js/SuperSlide.2.1.3.js"></script>

<script type="text/javascript" src="/statics/web/js/common.js"></script>
<?php if($id) { ?>
<script language="JavaScript" src="<?php echo APP_PATH;?>api.php?op=count&id=<?php echo $id;?>&modelid=<?php echo $modelid;?>"></script> 
<?php } ?>