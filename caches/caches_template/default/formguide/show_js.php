<script language="javascript" type="text/javascript" src="<?php echo JS_PATH;?>dialog.js"></script>
<link href="<?php echo CSS_PATH;?>se.css" rel="stylesheet" type="text/css" />
<script src="<?php echo JS_PATH;?>job/se.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $("select").selectCss();

    });
</script>
<script src="<?php echo JS_PATH;?>job/time.js"></script>
<link href="<?php echo CSS_PATH;?>form.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    
    
    function test(){
        var formData=$("#myform").serialize();
       
        $.ajax({ 
            async:false,
            type:'post',      
            url:'http://182.92.220.68:81/bangcms_hr/index.php?m=formguide&c=index&a=test&formid=23&siteid=1',  
            data: formData,
            dataType:'json',  
            success:function(data){  
				if(data==1){
					alert('简历已提交，请观看视频，等待面试');
                    
                    $("input[type=reset]").trigger("click");
                    
                    clearInterval(dateline);
                    var m=Math.floor(t/1000/60%60);
                    var s=Math.floor(t/1000%60);
                    var ml=Math.floor(m/10);
                    var mr=Math.floor(m%10);
                    var sl=Math.floor(s/10);
                    var sr=Math.floor(s%10);
                    $(".timer-minute-l").html(ml);
                    $(".timer-minute-r").html(mr);
                    $(".timer-second-l").html(sl);
                    $(".timer-second-r").html(sr);
                    $("html,body").animate({scrollTop:$(".zp-video").offset().top},1000);/*提交成功后滚动到video层*/
                
				}else{
					alert(data);
				}
				
            }  
        }); 


        return false;
		/*
        if(check1() && check2()){
            return true;
        }else{
            return false;
        }
		*/
    } 

    
    //将form中的值转换为键值对。
    function getFormJson(frm) {
        var o = {};
        var a = $(frm).serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });

        return o;
    }

/*
    function check1(){
        if($("input[value='网站']").is(":checked")||$("input[value='其他']").is(":checked")||$("input[value='内部推荐']").is(":checked")){
            
            if($("textarea[name='info[fromother]']").val()==""){
                alert("请指明获得职位信息的渠道！");
                return false;
            }
        }
        return true;
    }

    function check2(){

        if($("input[value='认识']").is(":checked")){
            if($("textarea[name='info[knowpeo]']").val()==""){
                alert("请指明认识正邦现职人员信息！");
                return false;
            }
        }
        return true;
    }
*/

</script>
<!--滚动 开始-->
<div class="wheel-box">
    <ul>
        <li class="wheel-list"><a href="#date">日期/职位</a></li>
        <li class="wheel-list"><a href="#person">个人信息</a></li>
        <li class="wheel-list"><a href="#work">工作经历</a></li>
        <li class="wheel-list"><a href="#edu">教育/培训</a></li>
       <?php if($fields['web']||$fields['books']||$fields['lcomp']) { ?> <li class="wheel-list"><a href="#life">生活/发展</a></li><?php } ?>
        <li class="wheel-list"><a href="#inf">职业信息</a></li>
        <li class="wheel-list"><a href="#fam">家庭成员</a></li>
        <li class="wheel-list"><a href="#self">自我阐述</a></li>
        <li class="wheel-list"><a href="#video">精彩视频</a></li>
    </ul>
</div>
<!--滚动 结束-->
<!--倒计时 开始-->
<div class="timer">
    <p>请在30分钟内完成填表</p>
    <div class="timer-box">
        <div class="timer-second-r fr">0</div>
        <div class="timer-second-l fr">0</div>
        <div class="timer-colon fr">:</div>
        <div class="timer-minute-r fr">0</div>
        <div class="timer-minute-l fr">3</div>
    </div>
</div>
<!--倒计时 结束-->
<!--<?php echo APP_PATH;?>index.php?m=formguide&c=index&a=show&formid=<?php echo $formid;?>&siteid=<?php echo $this->siteid;?>-->
<form method="post" action="" <?php if($no_allowed) { ?> target="member_login"<?php } ?> name="myform" id="myform" onsubmit="return test()">
<input type="reset" name="reset" style="display: none;" />
    <div class="zp-date">
        <!--2-18-->
        <div class="zp-date-up">
            <div class="zp-date-red">
                日期/职位
            </div>
            <a name="date"></a>
            <div class="zp-arrow-down fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_03.png" alt="">
            </div>
            <div class="zp-arrow-up fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_04.png" alt="">
            </div>
        </div>
        <!--2-18-->
        <div class="zp-list-box">
            <div class="zp-list">
                <label for="">填表日期</label>
                <!--<span class="zp-year-month-date"><?php echo date('Y年m月d日')?></span>-->
                <?php echo date('Y年m月d日')?>
            </div>
			<?php if($fields['warea']) { ?>
            <div class="zp-list zp-site-height">
                <?php if($fields['warea']['minlength']>0) { ?><span class="star">*</span><?php } ?>
				<label class="zp-site-l" for="">应聘地址</label>
                <select style="left:105px;position: relative;" class="zp-date-order zp-select-site" value="0" placeholder="应聘地址" name="info[warea]" id="">
                    <?php $n=1; if(is_array($fields['warea']['box'])) foreach($fields['warea']['box'] AS $k => $v) { ?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php $n++;}unset($n); ?>
                </select>
            </div>
			<?php } ?>
			<?php if($fields['appointed']) { ?>
            <div class="zp-list zp-site-height">
				<?php if($fields['appointed']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">面试时间</label>
                <!--2-18-->
                <select class="zp-date-order zp-time-left zp-select-time zp-select-time-l" value="" placeholder="" name="info[appointed]" id="">
                    <option value="09:00">09:00</option>
                    <option value="09:30">09:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="11:30">11:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                </select>
               <!-- <select class="zp-date-order zp-time-left zp-select-time-r" value="" placeholder="" name="info[arrive]" id="">
                    <option value="09:00">09:00</option>
                    <option value="09:30">09:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="11:30">11:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                </select>-->
                <img class='zp-select-time-one' src='<?php echo IMG_PATH;?>job/zp_03.png' alt=''>
               <!-- <img class='zp-select-time-two' src='<?php echo IMG_PATH;?>job/zp_03.png' alt=''>-->
            </div>
			<?php } ?>
			<?php if($fields['ptype']||$fields['job']) { ?>
            <div class="zp-list">
				<?php if($fields['ptype']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">应聘职位</label>
                <select class="zp-date-order zp-select-position"  placeholder="职位类型" name="info[ptype]" id="">
                   <?php $n=1; if(is_array($fields['ptype']['box'])) foreach($fields['ptype']['box'] AS $k => $v) { ?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php $n++;}unset($n); ?>
                </select>
                <input class="zp-date-position zp-select-position-r" type="text" name="info[job]" placeholder="职位">
				<select style=" margin-left:230px" class="zp-date-order zp-select-level"  placeholder="职级" name="info[level]" id="">
                   <?php $n=1; if(is_array($fields['level']['box'])) foreach($fields['level']['box'] AS $k => $v) { ?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php $n++;}unset($n); ?>
                </select>
            </div>
			<?php } ?>
        </div>
    </div>
    <div class="zp-date">
        <!--2-18-->
        <div class="zp-date-up">
            <div class="zp-date-red">
                个人信息
            </div>
            <a name="person"></a>
            <div class="zp-arrow-down fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_03.png" alt="">
            </div>
            <div class="zp-arrow-up fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_04.png" alt="">
            </div>
        </div>
        <!--2-18-->
        <div class="zp-list-box zp-box-bottom">
			<?php if($fields['name']) { ?>
            <div class="zp-list">
				<?php if($fields['name']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">姓名</label>
                <input type="text" name="info[name]" placeholder="请填写真实姓名">
            </div>
			<?php } ?>
			<?php if($fields['sex']) { ?>
            <div class="zp-list">
				<?php if($fields['sex']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">性别</label>
				<?php $n=1; if(is_array($fields['sex']['box'])) foreach($fields['sex']['box'] AS $k => $v) { ?>
					<label class="zp-black" for=""><input type="radio" name="info[sex]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
            </div>
			<?php } ?>
			<?php if($fields['marry']) { ?>
            <div class="zp-list">
				<?php if($fields['marry']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">婚育状况</label>
				<?php $n=1; if(is_array($fields['marry']['box'])) foreach($fields['marry']['box'] AS $k => $v) { ?>
					<label class="zp-radio zp-black" for=""><input type="radio" name="info[marry]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
				<?php if($fields['child']) { ?>
					<?php $n=1; if(is_array($fields['child']['box'])) foreach($fields['child']['box'] AS $k => $v) { ?>
						<input type="checkbox" class="zp-radio zp-black" name="info[child]" value="<?php echo $k;?>"><?php echo $v;?>
					<?php $n++;}unset($n); ?>
				<?php } ?>
               <!-- <select  value="" placeholder="有无孩子" name="info[child]" id="">
					<?php $n=1; if(is_array($fields['child']['box'])) foreach($fields['child']['box'] AS $k => $v) { ?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php $n++;}unset($n); ?>
                </select>-->
            </div>
			<?php } ?>
			<?php if($fields['ID']) { ?>
            <div class="zp-list">
				<?php if($fields['ID']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">身份证号</label>
                <input type="text" name="info[ID]">
            </div>
			<?php } ?>
            <?php if($fields['residence']) { ?>
            <div class="zp-list">
				<?php if($fields['residence']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">户口所在地</label>
                <input type="text" name="info[residence]">
            </div>
			<?php } ?>
            <div class="zp-gray-line"></div>
            <?php if($fields['email']) { ?>
            <div class="zp-list">
				<?php if($fields['email']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">电子邮箱</label>
                <input type="text" name="info[email]">
            </div>
			<?php } ?>
            <?php if($fields['mobile']) { ?>
            <div class="zp-list">
				<?php if($fields['mobile']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">联系电话</label>
                <input type="text" name="info[mobile]">
            </div>
            <?php } ?>
            <?php if($fields['qq']) { ?>
            <div class="zp-list">
				<?php if($fields['qq']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">QQ或微信</label>
                <input type="text" name="info[qq]">
            <?php } ?>
            <?php if($fields['addrl']) { ?>
            <div class="zp-list zp-family-bottom">
				<?php if($fields['addrl']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">家庭住址</label>
				
                <script src="<?php echo JS_PATH;?>Area.js" type="text/javascript"></script>
                <script src="<?php echo JS_PATH;?>AreaData_min.js" type="text/javascript"></script>
                <script type="text/javascript">
                    $(function (){
                        $("#seachdistrict_div").css("display","none");
                        initComplexArea('seachprov', 'seachcity', 'seachdistrict', area_array, sub_array, '11', '0', '0');
                    });

                    //得到地区码
                    function getAreaID(){
                        var area = 0;
                        if($("#seachdistrict").val() != "0"){
                            area = $("#seachdistrict").val();
                        }else if ($("#seachcity").val() != "0"){
                            area = $("#seachcity").val();
                        }else{
                            area = $("#seachprov").val();
                        }
                        return area;
                    }

                    function showAreaID() {
                        //地区码
                        var areaID = getAreaID();
                        //地区名
                        var areaName = getAreaNamebyID(areaID) ;
                        alert("您选择的地区码：" + areaID + "      地区名：" + areaName);
                    }

                    //根据地区码查询地区名
                    function getAreaNamebyID(areaID){
                        var areaName = "";
                        if(areaID.length == 2){
                            areaName = area_array[areaID];
                        }else if(areaID.length == 4){
                            var index1 = areaID.substring(0, 2);
                            areaName = area_array[index1] + " " + sub_array[index1][areaID];
                        }else if(areaID.length == 6){
                            var index1 = areaID.substring(0, 2);
                            var index2 = areaID.substring(0, 4);
                            areaName = area_array[index1] + " " + sub_array[index1][index2] + " " + sub_arr[index2][areaID];
                        }
                        return areaName;
                    }
                </script>
                <input type="hidden" value="" class="zp-input-hidden" name="info[addrl]">
                <select id="seachprov" name="seachprov" onChange="changeComplexProvince(this.value, sub_array, 'seachcity', 'seachdistrict');"></select>&nbsp;&nbsp;
                <select id="seachcity" name="homecity" onChange="changeCity(this.value,'seachdistrict','seachdistrict');"></select>&nbsp;&nbsp;
                <span id="seachdistrict_div"><select id="seachdistrict" name="seachdistrict"></select></span>
                <br>
                <input class="zp-personal-site zp-site-left" type="text" name="info[addr]" placeholder="尽量具体所在地">
                <label class="zp-personal-label" for="">到公司路程所需</label>
                <select class="zp-personal-age zp-select-addrtime" value="" placeholder="" name="info[addrtime]" id="">
                    <?php $n=1; if(is_array($fields['addrtime']['box'])) foreach($fields['addrtime']['box'] AS $k => $v) { ?>
						<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php $n++;}unset($n); ?>
                </select>
            </div>
			<?php } ?>
        </div>
    </div>
    </div>
    <div class="zp-date">
        <!--2-18-->
        <div class="zp-date-up">
            <div class="zp-date-red">
                工作经历
            </div>
            <div class="zp-date-gray fl">
                填写最近的工作经历
            </div>
            <a name="work"></a>
            <div class="zp-arrow-down fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_03.png" alt="">
            </div>
            <div class="zp-arrow-up fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_04.png" alt="">
            </div>
        </div>
        <!--2-18-->
        <div class="zp-list-box zp-box-bottom">
			<?php if($fields['jobtimes1']) { ?>
            <div class="zp-list">
				<?php if($fields['jobtimes1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">在职时间</label>
				<?php echo $forminfos_data['jobtimes1']['form'];?>
				<?php echo $forminfos_data['jobtimee1']['form'];?>
                <!--<input class="zp-experience-from date" type="text" name="jobtimes1" id="jobtimes1" placeholder="">
                <input class="zp-experience-from date" type="text" name="jobtimee1" id="jobtimee1" placeholder="">-->
            </div>
			<?php } ?>
            <?php if($fields['company1']) { ?>
            <div class="zp-list">
				<?php if($fields['company1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">公司名称</label>
                <input type="text" name="info[company1]" placeholder="">
            </div>
            <?php } ?>
            <?php if($fields['compsize1']) { ?>
            <div class="zp-list">
				<?php if($fields['compsize1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">规模（人）</label>
                <input class="zp-experience-from" type="text" name="info[compsize1]" placeholder="公司规模">
                <input class="zp-experience-from" type="text" name="info[teamsize1]" placeholder="部门规模">
            </div>
            <?php } ?>
            <?php if($fields['team1']) { ?>
            <div class="zp-list">
				<?php if($fields['team1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">任职部门</label>
                <input type="text" name="info[team1]" placeholder="">
            </div>
            <?php } ?>
            <?php if($fields['job1']) { ?>
            <div class="zp-list">
				<?php if($fields['job1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">所在职位</label>
                <input type="text" name="info[job1]" placeholder="">
            </div>
            <?php } ?>
            <?php if($fields['income1']) { ?>
            <div class="zp-list">
				<?php if($fields['income1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">收入</label>
                <!----><input  class="zp-salary-left" type="text" name="info[income1]" placeholder="">
                <!----><img class="zp-experience-one" src="<?php echo IMG_PATH;?>job/zp_23.png" alt="">
                <!----><!--<input type="text" name="income1" placeholder="">-->
            </div>
           <?php } ?>
            <?php if($fields['supname1']) { ?>
            <div class="zp-list">
				<?php if($fields['supname1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">直属上级</label>
                <input class="zp-experience-from" type="text" name="info[supname1]" placeholder="姓名">
                <input class="zp-experience-from" type="text" name="info[supjob1]" placeholder="职位">
                <input class="zp-experience-from" type="text" name="info[supmobile1]" placeholder="电话">
            </div>
            <?php } ?>
            <?php if($fields['leaving1']) { ?>
            <div class="zp-list">
				<?php if($fields['leaving1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">离职原因</label>
                <input class="zp-experience-from" type="text" name="info[leaving1]" placeholder="">
            </div>
			<?php } ?>
			<?php if($fields['jobtimes2']) { ?>
            <div class="zp-gray-line"></div>
            <div class="zp-list">
				<?php if($fields['jobtimes2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">在职时间</label>
				<?php echo $forminfos_data['jobtimes2']['form'];?>
				<?php echo $forminfos_data['jobtimee2']['form'];?>
                <!--<input class="zp-experience-from" type="text" name="jobtimes2" placeholder="">
                <input class="zp-experience-from" type="text" name="jobtimee2" placeholder="">-->
            </div>
			<?php } ?>
            <?php if($fields['company2']) { ?>
            <div class="zp-list">
				<?php if($fields['company2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">公司名称</label>
                <input type="text" name="info[company2]" placeholder="">
            </div>
            <?php } ?>
            <?php if($fields['compsize2']) { ?>
            <div class="zp-list">
				<?php if($fields['compsize2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">规模（人）</label>
                <input class="zp-experience-from" type="text" name="info[compsize2]" placeholder="公司规模">
                <input class="zp-experience-from" type="text" name="info[teamsize2]" placeholder="部门规模">
            </div>
            <?php } ?>
            <?php if($fields['team2']) { ?>
            <div class="zp-list">
				<?php if($fields['team2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">任职部门</label>
                <input type="text" name="info[team2]" placeholder="">
            </div>
            <?php } ?>
            <?php if($fields['job2']) { ?>
            <div class="zp-list">
				<?php if($fields['job2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">所在职位</label>
                <input type="text" name="info[job2]" placeholder="">
            </div>
            <?php } ?>
            <?php if($fields['income2']) { ?>
            <div class="zp-list">
				<?php if($fields['income2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">收入</label>
                <!----><input  class="zp-salary-left" type="text" name="info[income2]" placeholder="">
                <!----><img class="zp-experience-one" src="<?php echo IMG_PATH;?>job/zp_23.png" alt="">
                <!----><!--<input type="text" name="income1" placeholder="">-->
                <!----><!--<input type="text" name="income2" placeholder="">-->
            </div>
           <?php } ?>
            <?php if($fields['supname2']) { ?>
            <div class="zp-list">
				<?php if($fields['supname2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">直属上级</label>
                <input class="zp-experience-from" type="text" name="info[supname2]" placeholder="姓名">
                <input class="zp-experience-from" type="text" name="info[supjob2]" placeholder="职位">
                <input class="zp-experience-from" type="text" name="info[supmobile2]" placeholder="电话">
            </div>
            <?php } ?>
            <?php if($fields['leaving2']) { ?>
            <div class="zp-list">
				<?php if($fields['leaving2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">离职原因</label>
                <input class="zp-experience-from" type="text" name="info[leaving2]" placeholder="">
            </div>
			<?php } ?>
        </div>
    </div>
    <div class="zp-date">
        <!--2-18-->
        <div class="zp-date-up">
            <div class="zp-date-red">
                教育/培训
            </div>
            <div class="zp-date-gray fl">
                毕业院校填写最高教育经历
            </div>
            <a name="edu"></a>
            <div class="zp-arrow-down fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_03.png" alt="">
            </div>
            <div class="zp-arrow-up fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_04.png" alt="">
            </div>
        </div>
        <!--2-18-->
        <div class="zp-list-box zp-box-bottom">
            <?php if($fields['school1']) { ?>
            <div class="zp-list">
				<?php if($fields['school1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
				<label for="">毕业院校</label>
                <input class="zp-education-academy" type="text" name="info[school1]" placeholder="填写学校">
            </div>
            <?php } ?>
            <?php if($fields['studyst1']) { ?>
            <div class="zp-list">
				<?php if($fields['studyst1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">就读时间</label>
				<?php echo $forminfos_data['studyst1']['form'];?>
				<?php echo $forminfos_data['studyet1']['form'];?>
                <!--<input class="zp-experience-from" type="text" name="studyst1" placeholder="">
                <input class="zp-experience-from" type="text" name="studyet1" placeholder="">-->
            </div>
            <?php } ?>
            <?php if($fields['major1']) { ?>
            <div class="zp-list">
				<?php if($fields['major1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">专业</label>
                <input type="text" name="info[major1]" placeholder="">
            </div>
            <?php } ?>
            <?php if($fields['isget1']) { ?>
            <div class="zp-list">
				<?php if($fields['isget1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">是否统招</label>
                <?php $n=1; if(is_array($fields['isget1']['box'])) foreach($fields['isget1']['box'] AS $k => $v) { ?>
					<label class="zp-black" for=""><input type="radio" name="info[isget1]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
            </div>
            <?php } ?>
            <?php if($fields['edu1']) { ?>
            <div class="zp-list">
				<?php if($fields['edu1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">学历</label>
				 <select class="zp-education-province zp-select-edu-up" value="" placeholder="" name="info[edu1]" id="">
                <?php $n=1; if(is_array($fields['edu1']['box'])) foreach($fields['edu1']['box'] AS $k => $v) { ?>
					<option value="<?php echo $k;?>"><?php echo $v;?></option>
				<?php $n++;}unset($n); ?>
				</select>
            </div>
			<?php } ?>
            
            <?php if($fields['school2']) { ?>
            <div class="zp-gray-line"></div>
            <div class="zp-list">
				<?php if($fields['school2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
				<label for="">毕业院校</label>
                <input class="zp-education-academy" type="text" name="info[school2]" placeholder="填写学校">
            </div>
            <?php } ?>
            <?php if($fields['studyst2']) { ?>
            <div class="zp-list">
				<?php if($fields['studyst2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">就读时间</label>
				<?php echo $forminfos_data['studyst2']['form'];?>
				<?php echo $forminfos_data['studyet2']['form'];?>
                <!--<input class="zp-experience-from" type="text" name="studyst2" placeholder="">
                <input class="zp-experience-from" type="text" name="studyet2" placeholder="">-->
            </div>
            <?php } ?>
            <?php if($fields['major2']) { ?>
            <div class="zp-list">
				<?php if($fields['major2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">专业</label>
                <input type="text" name="info[major2]" placeholder="">
            </div>
            <?php } ?>
            <?php if($fields['isget2']) { ?>
            <div class="zp-list">
				<?php if($fields['isget2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">是否统招</label>
                <?php $n=1; if(is_array($fields['isget2']['box'])) foreach($fields['isget2']['box'] AS $k => $v) { ?>
					<label class="zp-black" for=""><input type="radio" name="info[isget2]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
            </div>
            <?php } ?>
            <?php if($fields['edu2']) { ?>
            <div class="zp-list">
				<?php if($fields['edu2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">学历</label>
				 <select class="zp-education-province zp-select-edu-down" value="" placeholder="" name="info[edu2]" id="">
                <?php $n=1; if(is_array($fields['edu2']['box'])) foreach($fields['edu2']['box'] AS $k => $v) { ?>
					<option value="<?php echo $k;?>"><?php echo $v;?></option>
				<?php $n++;}unset($n); ?>
				</select>
            </div>
			<?php } ?>
            <!--重复学历-->
            <div class="zp-gray-line"></div>
            <?php if($fields['seclanguage']) { ?>
            <div class="zp-list">
				<?php if($fields['seclanguage']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">第二语言</label>
                <input type="text" name="info[seclanguage]" placeholder="">
            </div>
			<?php } ?>
            <?php if($fields['state']) { ?>
            <div class="zp-list">
				<?php if($fields['state']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">掌握情况</label>
                <?php $n=1; if(is_array($fields['state']['box'])) foreach($fields['state']['box'] AS $k => $v) { ?>
					<label class="zp-black" for=""><input type="radio" name="info[state]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
            </div>
			<?php } ?>
            <?php if($fields['certificate']) { ?>
            <div class="zp-list">
                <?php if($fields['certificate']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>和专业/工作相关的证书</p>
                <textarea class="zp-relative" name="info[certificate]" id="" cols="30" rows="10"></textarea>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php if($fields['web']||$fields['books']||$fields['lcomp']) { ?>
    <div class="zp-date zp-life">
        <!--2-18-->
        <div class="zp-date-up">
            <div class="zp-date-red">
                生活/发展
            </div>
            <a name="life"></a>
            <div class="zp-arrow-down fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_03.png" alt="">
            </div>
            <div class="zp-arrow-up fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_04.png" alt="">
            </div>
        </div>
        <!--2-18-->
        <div class="zp-list-box zp-box-bottom">
			<?php if($fields['web']) { ?>
            <div class="zp-list">
				<?php if($fields['web']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>经常游览的网站名称及网址</p>
                <textarea name="info[web]" id="" cols="30" rows="10"></textarea>
            </div>
			<?php } ?>
            <?php if($fields['books']) { ?>
            <div class="zp-list">
				<?php if($fields['books']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>平时常阅览的书籍</p>
                <textarea name="info[books]" id="" cols="30" rows="10"></textarea>
            </div>
            <?php } ?>
            <?php if($fields['lcomp']) { ?>
            <div class="zp-list">
				<?php if($fields['lcomp']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>您喜欢的行业内公司有哪些？请列举3家</p>
                <textarea name="info[lcomp]" id="" cols="30" rows="10"></textarea>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <div class="zp-date">
        <!--2-18-->
        <div class="zp-date-up">
            <div class="zp-date-red">
                职业信息
            </div>
            <a name="inf"></a>
            <div class="zp-arrow-down fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_03.png" alt="">
            </div>
            <div class="zp-arrow-up fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_04.png" alt="">
            </div>
        </div>
        <!--2-18-->
        <div class="zp-list-box zp-box-bottom">
            <?php if($fields['from']) { ?>
            <div class="zp-list">
				<?php if($fields['from']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>获得职位信息的渠道</p>
                <?php $n=1; if(is_array($fields['from']['box'])) foreach($fields['from']['box'] AS $k => $v) { ?>
					<label class="zp-black" for=""><input type="radio" name="info[from]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
				<textarea class="zp-how-get" name="info[fromother]" id="" cols="30" rows="10" placeholder="请指明"></textarea>
            </div>
			<?php } ?>
            <?php if($fields['understand']) { ?>
            <div class="zp-list">
				<?php if($fields['understand']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>请阐述您对正邦的理解</p>
                <textarea class="zp-how-comprehension" name="info[understand]" id="" cols="30" rows="10" placeholder="正邦是"></textarea>
            </div>
			<?php } ?>
            <?php if($fields['know']) { ?>
            <div class="zp-list">
				<?php if($fields['know']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>是否认识正邦现职人员</p>
                <?php $n=1; if(is_array($fields['know']['box'])) foreach($fields['know']['box'] AS $k => $v) { ?>
					<label class="zp-black" for=""><input type="radio" name="info[know]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
                <textarea class="zp-how-reason" name="info[knowpeo]" id="" cols="30" rows="10" placeholder="请指明"></textarea>
            </div>
            <?php } ?>
            <?php if($fields['factor1']) { ?>
            <div class="zp-list">
				<?php if($fields['factor1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>考虑入职因素排序</p>
                <select class="zp-occupation-reason zp-select-factor-l" value="" placeholder="" name="info[factor1]" id="">
                   <?php $n=1; if(is_array($fields['factor1']['box'])) foreach($fields['factor1']['box'] AS $k => $v) { ?>
					<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php $n++;}unset($n); ?>
                </select>
				<select class="zp-occupation-reason zp-select-factor-m" value="" placeholder="" name="info[factor2]" id="">
                   <?php $n=1; if(is_array($fields['factor2']['box'])) foreach($fields['factor2']['box'] AS $k => $v) { ?>
					<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php $n++;}unset($n); ?>
                </select>
				<select class="zp-occupation-reason zp-select-factor-r" value="" placeholder="" name="info[factor3]" id="">
                   <?php $n=1; if(is_array($fields['factor3']['box'])) foreach($fields['factor3']['box'] AS $k => $v) { ?>
					<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php $n++;}unset($n); ?>
                </select>
            </div>
			<?php } ?>
            <div class="zp-gray-line"></div>
            <?php if($fields['jobstatus']) { ?>
            <div class="zp-list">
				<?php if($fields['jobstatus']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">工作状态</label>
				<?php $n=1; if(is_array($fields['jobstatus']['box'])) foreach($fields['jobstatus']['box'] AS $k => $v) { ?>
					<label class="zp-black" for=""><input type="radio" name="info[jobstatus]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
            </div>
			<?php } ?>
            <?php if($fields['insurance']) { ?>
            <div class="zp-list">
				<?php if($fields['insurance']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">在京社保</label>
                <?php $n=1; if(is_array($fields['insurance']['box'])) foreach($fields['insurance']['box'] AS $k => $v) { ?>
					<label class="zp-black" for=""><input type="radio" name="info[insurance]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
            </div>
			<?php } ?>
            <?php if($fields['fund']) { ?>
            <div class="zp-list">
				<?php if($fields['fund']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">住房公积金</label>
                <?php $n=1; if(is_array($fields['fund']['box'])) foreach($fields['fund']['box'] AS $k => $v) { ?>
					<label class="zp-black" for=""><input type="radio" name="info[fund]" value="<?php echo $k;?>"><?php echo $v;?></label>
				<?php $n++;}unset($n); ?>
                <label class="zp-occupation-label" for="">每月缴纳</label>
                <input class="zp-occupation-pay" type="text" name="info[fundmonth]" placeholder="">
            </div>
            <?php } ?>
            <?php if($fields['salary1']) { ?>
            <div class="zp-list">
				<?php if($fields['salary1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">期望薪金</label>
                <!----><input class="zp-probation-salary zp-salary-left" type="text" name="info[salary1]" placeholder="填写试用期期望薪金（税前/月）">
                <!----><img class="zp-occupation-two" src="<?php echo IMG_PATH;?>job/zp_23.png" alt="">
                <!----><input class="zp-probation-salary zp-salary-left" type="text" name="info[salary2]" placeholder="填写转正期望薪金（税前/月）">
                <!----><img class="zp-occupation-three" src="<?php echo IMG_PATH;?>job/zp_23.png" alt="">
                <!----><!--<input class="zp-probation-salary" type="text" name="" placeholder="填写试用期期望薪金（税前/月）">-->
                <!----><!--<input class="zp-probation-salary" type="text" name="" placeholder="填写转正期望薪金（税前/月）">-->
            </div>
            <?php } ?>
            <?php if($fields['structure']) { ?>
            <div class="zp-list">
				<?php if($fields['structure']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">期望薪资结构</label>
                <select class="zp-occupation-reason zp-select-structure" value="" placeholder="" name="info[structure]" id="">
                    <?php $n=1; if(is_array($fields['structure']['box'])) foreach($fields['structure']['box'] AS $k => $v) { ?>
					<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php $n++;}unset($n); ?>
                </select>
            </div>
			<?php } ?>
        </div>
    </div>
    <div class="zp-date zp-family">
        <!--2-18-->
        <div class="zp-date-up">
            <div class="zp-date-red">
                家庭成员
            </div>
			<div class="zp-date-gray fl">
                请至少填写一位家庭成员信息
            </div>
            <a name="fam"></a>
            <div class="zp-arrow-down fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_03.png" alt="">
            </div>
            <div class="zp-arrow-up fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_04.png" alt="">
            </div>
        </div>
        <!--2-18-->
        <div class="zp-list-box zp-box-bottom">
           <?php if($fields['fname1']) { ?>
            <div class="zp-list">
				<?php if($fields['fname1']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">父亲</label>
                <input class="zp-family-name" type="text" name="info[fname1]" placeholder="姓名">
               <!-- <input class="zp-family-age" type="text" name="info[fage1]" placeholder="年龄">
                <input class="zp-family-phone" type="text" name="info[ftel1]" placeholder="电话">-->
                <input class="zp-family-firms" type="text" name="info[fjob1]" placeholder="工作单位">
               <!-- <input class="zp-family-position" type="text" name="info[fpost1]" placeholder="职务">-->
            </div>
			<?php } ?>
            <?php if($fields['fname2']) { ?>
            <div class="zp-list">
				<?php if($fields['fname2']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">母亲</label>
                <input class="zp-family-name" type="text" name="info[fname2]" placeholder="姓名">
                <!--<input class="zp-family-age" type="text" name="info[fage2]" placeholder="年龄">
                <input class="zp-family-phone" type="text" name="info[ftel2]" placeholder="电话">-->
                <input class="zp-family-firms" type="text" name="info[fjob2]" placeholder="工作单位">
               <!-- <input class="zp-family-position" type="text" name="info[fpost2]" placeholder="职务">-->
            </div>
            <?php } ?>
            <?php if($fields['fname3']) { ?>
            <div class="zp-list">
				<?php if($fields['fname3']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <label for="">配偶/对象</label>
                <input class="zp-family-name" type="text" name="info[fname3]" placeholder="姓名">
                <!--<input class="zp-family-age" type="text" name="info[fage3]" placeholder="年龄">
                <input class="zp-family-phone" type="text" name="info[ftel3]" placeholder="电话">-->
                <input class="zp-family-firms" type="text" name="info[fjob3]" placeholder="工作单位">
                <!--<input class="zp-family-position" type="text" name="info[fpost3]" placeholder="职务">-->
            </div>
			<?php } ?>
        </div>
    </div>
    <div class="zp-date zp-evaluation">
        <!--2-18-->
        <div class="zp-date-up">
            <div class="zp-date-red">
                自我阐述
            </div>
            <a name="self"></a>
            <div class="zp-arrow-down fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_03.png" alt="">
            </div>
            <div class="zp-arrow-up fr">
                <img src="<?php echo IMG_PATH;?>job/zhaopin_04.png" alt="">
            </div>
        </div>
        <!--2-18-->
        <div class="zp-list-box zp-box-bottom">
           <?php if($fields['advantages']) { ?>
            <div class="zp-list">
				<?php if($fields['advantages']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>专业优势</p>
                <textarea name="info[advantages]" id="" cols="30" rows="10" placeholder="<?php echo $fields['advantages']['defaultvalue'];?>"></textarea>
            </div>
			<?php } ?>
            <?php if($fields['deficiency']) { ?>
            <div class="zp-list">
				<?php if($fields['deficiency']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>专业不足</p>
                <textarea name="info[deficiency]" id="" cols="30" rows="10" placeholder="<?php echo $fields['deficiency']['defaultvalue'];?>"></textarea>
            </div>
            <?php } ?>
            <?php if($fields['industry']) { ?>
            <div class="zp-list">
				<?php if($fields['industry']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>服务客户行业</p>
                <textarea name="info[industry]" id="" cols="30" rows="10" placeholder="<?php echo $fields['industry']['defaultvalue'];?>"></textarea>
            </div>
            <?php } ?>
            <?php if($fields['customer']) { ?>
            <div class="zp-list">
				<?php if($fields['customer']['minlength']>0) { ?><span class="star">*</span><?php } ?>
                <p>主要服务客户</p>
                <textarea name="info[customer]" id="" cols="30" rows="10" placeholder="<?php echo $fields['customer']['defaultvalue'];?>"></textarea>
            </div>
			<?php } ?>
        </div>
    </div>
    <label class="zp-guarantee" for="">
        <input class="check-one" type="checkbox" name="">
        <p>我保证上述所填一切资料属实，并保证在以往的历史中无任何犯罪记录。<br>
        我授权北京正邦品牌服务集团公司或委托第三方对我提供的个人及工作履历信息进行验证核实，包括但不限于通过向权威数据源提请验证以及就个人履历部分向有关单位进行核实。若上述所填资料有不实之处，公司有权随时与我解除劳动关系，但不承担任何经济、法律责任。公司有权要求我补偿由此引起的一切损失，包括为招聘我而花费的费用。</p>
    </label>
    <input class="zp-submit" type="submit" name="dosubmit" id="dosubmit"  value=" 提交 ">
</form>
