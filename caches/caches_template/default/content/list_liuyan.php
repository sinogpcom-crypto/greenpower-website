<?php include template("content","header"); ?>

<body>

	<!--header-wrapper-->

	<?php include template("content","part_nav"); ?>
	<!--/header-wrapper-->


	
	<?php include template("content","page_banner"); ?>
	
	<?php include template("content","page_nav"); ?>
	          
	
	
<!-- Page Content -->
	<main class="page-content">

		<div class="message-page productbg1">
            
            <div class="page_wrap ">
				<div class="message-box">
					<div class="message-title">
						<h3>Online message</h3>
						<span>Comments or suggestions can be submitted to us</span>
					</div>
					<div class="contact_form">
						<form id="myform">
							<div class="clearfix ">
								<div class="contactPage_dome">
									<input type="text" name="" class="contactPage_input" placeholder="Name" id="name">
									<font>*</font>
								</div>
								<div class="contactPage_dome">
									<input type="text" name="" class="contactPage_input" placeholder="Company name" id="company">
									<font>*</font>
								</div>							
								<div class="contactPage_dome">
									<input type="text" name="" class="contactPage_input" placeholder="Email address" id="email">
									<font>*</font>
								</div>
								<div class="contactPage_dome">
									<input type="text" name="" class="contactPage_input" placeholder="Mobile/Phone" id="phone">
									<font>*</font>
								</div>
							</div>
							<div class="clearfix">
								<div class="contactPage_dome_textarea">
									<textarea class="contactPage_textarea" placeholder="Please describe your specific inquiry, questions and suggestions, and we will have relevant professionals to get in touch with you." id="content"></textarea>
								</div>
							</div>
							<div class="contactPage_form_sub">
								<input type="submit" class="contact_an" name="" value ="Submit">
							</div>
						</form>
					</div>
				</div>
            </div>
			
			

		</div>

		
	</main>
	<!-- //Page Content -->

		
		
	<script>
		$('#myform').submit(function(){
			var name = $('#name');
			var company = $('#company');
			var email = $('#email');
			var phone = $('#phone');
			var content = $('#content');

			if(name.val()==''){
				alert('Please enter your name');
				name.focus();
				return false;
			}
			if(company.val()==''){
				alert('Please enter your company name');
				company.focus();
				return false;
			}
			if(phone.val()==''){
				alert('Please enter your mobile/phone number');
				phone.focus();
				return false;
			}
			if(email.val()==''){
				alert('Please enter your email address');
				email.focus();
				return false;
			}
			if(!check_email(email.val())){
				alert('The email address entered is incorrect');
				email.focus();
				return false;
			}
			if(content.val()==''){
				alert('Please enter your message');
				content.focus();
				return false;
			}

			
	        $.ajax({
	          url: "/index.php?m=formguide&c=index&a=show&formid=18&siteid=1&action=js&type=ajax",
	          dataType: "json",
	          type: "post",
	           data:{'info[tname]':name.val(),
	                'info[qita]':company.val(),
	                'info[phone]':phone.val(),
	                'info[email]':email.val(),
	                'info[content]':content.val(),
	                'dosubmit':1,},
	          success: function(data) {
	            if (data) {
	              alert("Submit completed");
	              name.val('');
	              company.val('');
	              phone.val('');
	              email.val('');
	              content.val('');
	              // $("button[type=reset]").trigger("click");
	            }
	          },
	          error:function () {
	           console.log(XMLHttpRequest.readyState + XMLHttpRequest.status + XMLHttpRequest.responseText);  
	          }
	        });
			return false;
		});
		
		//邮箱格式验证
		// function check_email(str){
		// 	var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
		// 	if(!myreg.test(str)){
		// 		return false;
		// 	}else{
		// 		return true;
		// 	}
		// }
	</script>
	

	<!-- 底部 -->
	
	<?php include template("content","footer"); ?>
	
	<!-- 底部 end-->


	<?php include template("content","script"); ?>

</body>

</html>