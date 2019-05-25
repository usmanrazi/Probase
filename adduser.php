<?php
	session_start();
		
		if($_SESSION['userid'] == ""  ){
			header('Location: login.php');
		}else if($_SESSION['userlevel'] != 'Admin' ){
			header('Location: index.php');
		}
		
 ?>
<html>
<head>

<link href="css/main.css" type="text/css" rel="stylesheet" media="all" />
<script src="js/jquery.min.js"></script>
<script src="js/notify.min.js"></script>

</head>

	<body class="body_2">
		
		<div id="main_section">
			<form name="add_user" id="add_user" action="">
				
				<label> User Name:</label><input type="text" name="username" id="username" password="username" placeholder="User Name"><br>
				<label> Password:</label><input type="password" name="password" id="password" password="password" placeholder="Password"><br>
				<label> Email:</label><input type="text" name="email" id="email" password="email" placeholder="Email"><br>
			
			</form>
			<button type="button" value="" class="submit_user" onClick="submit();">Submit</button>
		</div>
	</body>


<script type="text/javascript">
	var ajaxurl = 'include/function.php';
	function submit(){
		
		if($("#username").val() == ""){
			$.notify("Please enter the User name", "error");		
			return false;			
		}
		if($("#password").val() == ""){
			$.notify("Please enter the Password", "error");		
			return false;			
		}
		if($("#email").val() == ""){
			$.notify("Please enter the Email", "error");		
			return false;			
		}else{
			var pattern = /[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/;
			var valid = pattern.test( $("#email").val() );

			if(!valid) {
				$.notify("Please enter valid email address", "error");		
				return false;	
			}

		}
		
		
		var post_data = $("#add_user").serialize();
		
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'add_user',
				post_data: post_data,
			},
			beforeSend:function(){								
			},
			complete: function (o, s) {
				
			},
			success:function(data){
				//alert(data);
				var obj = $.parseJSON( data );
				//alert(obj.status)
				if(obj.status == 'inserted'){
					$.notify("User Added. Redirecting...", "success");
					setInterval( function() { window.location.href = "user.php"; }, 2000 );
					
				}else if(obj.status == 'error'){
					$.notify("Error occured. Please try again later.", "error");
				}
				else if(obj.status == 'exist'){
					$.notify("User name already exist.", "error");
				}
			},
			error:function(){
				$.notify("Error occured. Please try again later.", "error");
			}
		});
	}
</script>
</html>