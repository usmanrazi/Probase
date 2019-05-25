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
	<?php require ("./config.php"); ?>
<link href="css/main.css" type="text/css" rel="stylesheet" media="all" />
<script src="js/jquery.min.js"></script>
<script src="js/notify.min.js"></script>


</head>
	<?php 
		$query = "SELECT * FROM users";
		$result = mysql_query($query);
		$num_rows = mysql_num_rows($result);
		$no_of_pages = ceil($num_rows/5);
		$pagination = '';
		if($no_of_pages > 1){
			$pagination .= '<ul class="paginate">';
			$j=1;
			for($i = 0; $i<$no_of_pages; $i++){
				$pagination .= '<li><a href="javascript:void(0);" class="paginate_click" style="color:white;" id="'.$i.'">'.$j.'</a></li>';
				$j++;
			}
			$pagination .= '</ul>';
		}
		
	?>

	<body class="body_2">

		<div id="main_section">
			<div class="add_user"><a class="add_new_user" href="adduser.php" >Add New User</a>
			<div class="ad_fields_wrapper" id="ad_fields_wrapper">

				<div class="heading_section">
					<div class="fields_heading">User id</div>
					<div class="fields_heading">User name</div>
					<div class="fields_heading">Email</div>
					<div class="fields_heading">Action</div>
				</div>
				<div style="clear:both;"></div>
				<div class="displayuser_section" id="displayuser_section">
				</div>
			</div>
			<div style="clear:both;"></div>
			<?php echo $pagination; ?>
		</div>
	</body>
	
	<script>
		var ajaxurl = 'include/function.php';
		$(function(){
			var page_number = 0;
			get_user(page_number);
			
			$(".edit_user").live('click', function(){
				var user_id = $(this).attr('id');
				window.location.href = "edituser.php?id="+user_id;
			});
			
			$(".paginate_click").live('click', function(){
				var page_number = $(this).attr('id');
				get_user(page_number);
			});
			
			$(".delete_user").live('click', function(){
				var user_id = $(this).attr('id');
				if (confirm("Are you sure you want to delete user!") == true) {
					delete_user(user_id);
				}
			});
		
		});
		function get_user(page_number){
		
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'get_user',
					page_number: page_number,

				},
				beforeSend:function(){								
				},
				complete: function (o, s) {
					
				},
				success:function(data){
					//alert(data);
					var obj = $.parseJSON( data );
						$("#displayuser_section").html("");
					for(var i=0; i<obj.length; i++){
					
						$("#displayuser_section").append('<div class="both_button"><div class="fields_heading">'+obj[i].userid+'</div><div class="fields_heading">'+obj[i].username+'</div><div class="fields_heading">'+obj[i].email+'</div><div class="fields_heading"><a href="javascript:void(0);" class="edit_user" id="'+obj[i].userid+'">Edit</a><a style=" background:red;" href="javascript:void(0);" class="delete_user" id="'+obj[i].userid+'">Delete</a></div></div>');
					}
				
					/*if(obj.status == 'error'){
						$.notify("user name or password is not correct.", "error");
					} */
				},
				error:function(){
					$.notify("Error occured. Please try again later.", "error");
				}
			});
		
		}
		function delete_user(user_id){
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'delete_user',
					user_id: user_id,

				},
				beforeSend:function(){								
				},
				complete: function (o, s) {
					
				},
				success:function(data){
					//alert(data);
					var obj = $.parseJSON( data );
					if(obj.status == 'deleted'){
						$.notify("user deleted successfully.", "success");
						window.location.reload();
					}else if(obj.status == 'error'){
						$.notify("Error occured. Please try again later.", "error");
						window.location.reload();
					}
				},
				error:function(){
					$.notify("Error occured. Please try again later.", "error");
				}
			});
		}
	</script>
	
</html>

<?php

?>