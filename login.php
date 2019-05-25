<?php
session_start();
//unset($_SESSION['userid']);
if(isset($_SESSION['userid']) && $_SESSION['userid'] != ""){
	header('Location: index.php');
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--whole-body-->
<body>

	<div id="login_forum">
    	<img src="images/login_logo.png" alt="" />
        <form action="" id="loginform">
			<input type="hidden" name="action" value="login_users">
        	<input type="text" value="" placeholder="Username" id="username" name="username" />
			<input type="password" value="" placeholder="Password" id="password" name="password" />
			<br /><br />
			<button type="button" value="" onClick="login();">Log In</button>
        </form>
        
        <div class="clear-me"></div>
    </div>
    
</body>
<!--/whole-body-->
<script src="js/jquery.min.js"></script>
<script src="js/notify.min.js"></script>
<link href="css/main.css" type="text/css" rel="stylesheet" media="all" />

<title>Login</title>
</head>

<script>
	var ajaxurl = 'include/function.php';
	function login(){
		if ( $('#username').val () == '' ) {
			$.notify("Kindly Enter username.", "error");
			return false;
		}
		if ( $('#password').val () == '' ) {
			$.notify("Kindly Enter Password.", "error");
			return false;
		}
		var post_data = $("#loginform").serialize();
		
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: post_data,
			beforeSend:function(){								
			},
			complete: function (o, s) {
				
			},
			success:function(data){
				//alert(data);
				var obj = $.parseJSON( data );
				//alert(obj.status)
				if(obj.status == 'user'){
					$.notify("Access granted. Redirecting...", "success");
					localStorage.clear();
					setInterval( function() { window.location.href = "index.php"; }, 2000 );
					
				}if(obj.status == 'admin'){
					$.notify("Access granted. Redirecting...", "success");
					setInterval( function() { window.location.href = "user.php"; }, 2000 );
					
				}else if(obj.status == 'error'){
					$.notify("user name or password is not correct.", "error");
				}
			},
			error:function(){
				$.notify("Error occured. Please try again later.", "error");
			}
		});
	}
</script>
 
</html>