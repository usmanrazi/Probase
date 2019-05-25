<?php
	session_start();
	if (isset ($_GET['action']) && $_GET['action'] == "logout") {
		$_SESSION['userid'] = "";
		$_SESSION['userlevel'] = "";
		session_destroy();
	}
	if($_SESSION['userid'] == ""){
		header('Location: login.php');
	}
	
 ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="application/pdf; charset=utf-8">
<link href="css/main.css" type="text/css" rel="stylesheet" media="all" />

<!--whole-body-->
<body class="body_2">

	<div id="main_section">
		<div class="loader_div" id="loader"> <img style="margin-top: 28%;" src="images/35.gif"> </div>
    	<div class="left_section">
        	<a class="logo" href="#">
            	<img src="images/login_logo.png" alt="" />
            </a>
            	<button class="search" type="button" value="" id="search_button">
                	<img src="images/icon4.png" alt="" />
                </button>
              
                <input class="search_input" id="search_text" name="search_text" type="text" value="Search" onBlur="if(this.value==&quot;&quot;) this.value=&quot;Search&quot;;" onFocus="if(this.value==&quot;Search&quot;) this.value=&quot;&quot;;"/>
            <div id="inputdetails" name="inputdetails">  
				<div class="seprater">
					<img src="images/seprator.jpg" alt="" />
				</div>
				
				<a class="left" href="javascript:void(0);" id="prevlocation" >
					<img src="images/left.png" alt="" />
				</a>
				<h1 id="location">TEST LOCATION 1</h1>
				
				<a class="right" href="javascript:void(0);" id="nextlocation" >
					<img src="images/right.png" alt="" />
				</a>
				
				<div class="seprater">
					<img src="images/seprator.jpg" alt="" />
				</div>
				
				<form id="probaseform" name="probaseform">
					<input type="hidden" id="serach_next_loca" name="serach_next_loca" value="">
					<ul>
						<li>
							<input style="background:none;" class="input_1" type="text" id="client" name="client" value="Client" onBlur="if(this.value==&quot;&quot;) this.value=&quot;Client&quot;;" onFocus="if(this.value==&quot;Client&quot;) this.value=&quot;&quot;;"/>
						</li>
						<li>
							  <input style="background:none;" class="input_1" type="text" value="Job Name" id="job_name" name="job_name" onBlur="if(this.value==&quot;&quot;) this.value=&quot;Job Name&quot;;" onFocus="if(this.value==&quot;Job Name&quot;) this.value=&quot;&quot;;"/>
						</li>
						<li style="margin-left:10px;">
							<input class="input_1" type="text" value="" id="address" name="address" />
						</li>
					</ul>
					<label>Job No</label>
						<input class="input_2" type="text" value="" id="job_no" name="job_no" />
							<div class="clear-me"></div>
					<label>Date</label>
					<?php 
						$month = date("m"); 
						$day = date("d"); 
						$year = date("Y"); 
					
					?>
						<input class="input_3" type="text" value="<?php echo $month; ?>" id="month" name="month" />
						<input class="input_3" type="text" value="<?php echo $day; ?>" id="days" name="days" />
						<input class="input_3" type="text" value="<?php echo $year; ?>" id="year" name="year" />
						<input type="hidden" name="insertion_id" id="insertion_id" value="">
						<input type="hidden" name="search_result_hidden" id="search_result_hidden" value="">
						<input type="hidden" name="update_timeinterval" id="update_timeinterval" value="">
						<input type="hidden" name="new_id_borlog" id="new_id_borlog" value="">
						<input type="hidden" name="location_changed" id="location_changed" value="">
							<div class="clear-me"></div>
					<label>Tested by</label>
					<?php $username = $_SESSION['username']; ?>
						<input class="input_2" type="text" value="<?php echo $username; ?>" id="tested_by" name="tested_by" />
						<div id="client_list"> </div>
							<div class="clear-me"></div>
				
					<textarea class="input_4" name="message" id="project_note" name="project_note" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Project notes</textarea>
				
					<button type="button" value="" id="createnew">
						<img src="images/icon5.png" alt="" /> Create
					</button>
					<button type="button" value="" id="saved_form">
						<img src="images/icon6.png" alt="" /> Saved
					</button> 
					
				</form>
			</div>
			
			<div name="search_result" id="search_result" style="display:none;">
				<div class="seprater">
					<img src="images/seprator.jpg" alt="" />
				</div>
				
				<a class="left">
					<img src="images/icon6.png" alt="" />
				</a>
				<h1>Saved Projects</h1>
				<div class="seprater">
					<img src="images/seprator.jpg" alt="" />
				</div>
				
				<div class="address_section">
					<div class="address_top_section">
						<div class="address_left_potion">
						<h2>Address</h2>
						<a class="arrow" href="#">
							<img src="images/arrow.png" />
						</a>
						</div>
						
						<div class="address_right_potion">
						<h2>Date</h2>
						<a class="arrow" href="#">
							<img src="images/arrow.png" />
						</a>
						</div>
					</div>
						<div style="clear:both;"></div>
				<div id="CanScrollWithXAxis" class="contentHolder">
					<div class="address_left_potion position_by_2 " id="result_display">
						
					</div>
						
					<div class="address_right_potion position_by" id="result_date">
				
					</div>
                </div>  
				</div>
					<button type="button" value="" id="createnew">
						<img src="images/icon5.png" alt="" /> Create
					</button>
					<button type="button" value="" id="saved_form">
						<img src="images/icon6.png" alt="" /> Saved
					</button> 
			</div>
        </div>
        
        <div class="right_section">
        	<div class="top_menu">
            	<ul>
                	<li><a href="javascript:void(0);" id="export_pdf"><img src="images/icon1.png" /> Export</a></li>
                    <li><a href="javascript:void(0);" id="saved_draft"><img src="images/icon2.png" />Save Draft</a></li>
                    <li><a href="?action=logout"><img src="images/icon3.png" />Log out</a></li>
                    
                </ul>
            </div>
            
            
            <div style="padding-bottom:10px; border-bottom:2px solid #27353b; margin-top:20px;" class="top_menu">
            	<h2 class="bottom_menu width_1">
					<img src="images/icon7.png" alt="" />
					<br />
						m
                </h2>
                
                <h2 class="bottom_menu width_2">
					<img src="images/icon8.png" alt="" />
					<br />
						no. of blows
                </h2>
                
                <h2 class="bottom_menu width_3">
					<img src="images/icon9.png" alt="" />
					<br />
						undrained shear -kPa
                </h2>
                <div id="bor_cont">
					<div id="borlog_div">
						<h2 class="bottom_menu width_4" id="h2_tohide">
							<img src="images/icon10.png" alt="" id="borlong_display"/>
							<br />
							borelog
						</h2>
						
					</div>
				</div>
            </div>
            
            <div class="content_section">
				<div style="float:left; width:420px;">
					<div class="scal_left" id="scale_left_div">
						<?php 
							$a = 0;
							for($i=1; $i<=20; $i++){
								
							if(($i % 5) != 0){
						?>
							<div class="inner_line"></div>
							
						<?php }else{ 
							$a = $a + 0.5;
						?>
							
							<div class="inner_line inner_line_target">
								<p><?php echo $a; ?></p>
							</div>
						
						<?php } } ?>
							
							
					</div>
					<form name="blownumber" id="blownumber">
						<div class="scale_rating" id="scale_rating_div">
							
						</div>
						
					</form>
					<form name="underailedform" id="underailedform" method="POST">
						<input type="hidden" value="action" action="image_upload">
						<div class="undrained_section" id="undrained_section_div">
							
						</div>
					</form>  
					<div style="clear:both;"></div>
					<div style="width:330px; margin:0 0 0 70px;" class="undrained_section scale_rating create_group_button" >
						<button style=" width:120px;" type="button" value="" id="appenrow">
							<img style=" float:none;" src="images/icon5.png" />
						</button>
						<label style="margin-left:27px;">
							Calibration 
						</label>
						<input class="cali_input" name="calibration_val" id="calibration_val" type="text" value="" />
					</div>
				</div>
					<div style="float:right; width:255px;">
						<div id="borelog_container">
							
						</div>
						
					</div>
				
				</div>
				
        </div>
        
        <div class="clear-me"></div>
		<div id="graph" style="display:none;"></div>
		<div id="graph_show" style=""></div>
		<div id="output_image" style="display:none;"></div>
		<div id="dialog_confirm" style="display:none;" >Are you sure you want to delete??</div>
		
    </div>
    
</body>
<!--/whole-body-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/notify.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
	<script type="text/javascript" src="js/highcharts.js"></script>
	<script type="text/javascript" src="js/jquery.form.min.js"></script>
	<script type="text/javascript" src="js/ajaxfileupload.js"></script>
	<script type="text/javascript" src="js/jquery.collapsible.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	
	<script type="text/javascript" src="js/perfect-scrollbar.js"></script>
	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="js/jquery.ui.touch-punch.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

<title>Probase Form</title>
</head>
<script type="text/javascript">
	var ajaxurl = './include/function.php';
	var initial_save = true;
	var total_images = 0;
	var new_entry = 0;
	var draft = 0;
	var new_id = new Array();
	var borlog_note = new Array();
	var show = true;
	var nextloc = true;
	var all_client = new Array();
	get_borlognote();	
	
	
	$(function(){
		get_allclient();
		$("#loader").hide();
		$("#dialog_confirm").hide();
		var borlog_html = $("#bor_cont").html();
		$('#CanScrollWithXAxis').perfectScrollbar({useBothWheelAxes: true});
        
		function borlog_new(id){
		
			
			$( "#borlog_div" ).draggable({
				axis: "y",
				stop: function() {
					// Show dropped position.
					
					var offset = $(this).offset();
					//var xPos = offset.left;
					var yPos = offset.top;
					var position_head = 140;
					
					
					var po = ((Math.floor((yPos - position_head)/41)) + 1 ) ;
					//console.log(yPos);
					//var id = Math.floor(po/0.1);
					var id = po;

					var margin_top = ((id - 1) * 41.1) + 8;
				
					
					//alert(margin_top);
					$("#new_id_borlog").val(new_id);
					if($('#borelog_section_'+id).length == 0 )
					{
						if(new_id != ""){
							for(var i=0; i<=new_id.length; i++){
								//new_id[i];
								$(".wrapper-borlog").hide();
								$(".borelog_section").css("height","16px");
								$(".borelog_section").css("z-index","1");
								$(".imgfilelabel").css("margin-top","0");
								$(".borlog_textarea").css("height","16px");
								$(".borlog_textarea").css("padding","0 !important");
								$("#show_hide_anchor_"+new_id[i]).html('+');
								$("#show_hide_anchor_"+new_id[i]).attr('onclick', 'show_div_borlog('+new_id[i]+')');
							}
						}
						new_id.push(id);
						
						if(po >= 0.1){
							//$("#borelog_container").append('<div class="borelog_section" id="borelog_section_'+id+'" style=""><div class="top_line"></div><textarea name="borlog_textarea_'+id+'" id="borlog_textarea_'+id+'" style="width:89%; margin:0; font-size:17px; background:none;" class="borlog_textarea input_5" value="Bore look notes go here" onBlur="if(this.value==&quot;&quot;) this.value=&quot;Bore look notes go here&quot;;" onFocus="if(this.value==&quot;Bore look notes go here&quot;) this.value=&quot;&quot;;">Bore look notes go here</textarea><form id="image_form_'+id+'" name="image_form_'+id+'" class="image_form" action="uploadfile.php" enctype="multipart/form-data" method="POST" ><input style="display:none;" id="ImageFile_'+id+'" name="ImageFile_'+id+'" class="ImageFile" type="file" value="" /> </form><label style="cursor:pointer; margin:10px 0 0 0; float:right;" for="ImageFile_'+id+'"><img src="images/icon11.png" /></label><input name="suggestion_one_'+id+'" id="suggestion_one_'+id+'" class="suggestion_one input_5" type="text" value="suggestion one" onBlur="if(this.value==&quot;&quot;) this.value=&quot;suggestion one&quot;;" onFocus="if(this.value==&quot;suggestion one&quot;) this.value=&quot;&quot;;"/><input name="suggestion_two_'+id+'" id="suggestion_two_'+id+'" class="suggestion_two input_6" type="text" value="suggestion" onBlur="if(this.value==&quot;&quot;) this.value=&quot;suggestion&quot;;" onFocus="if(this.value==&quot;suggestion&quot;) this.value=&quot;&quot;;"/><input name="suggestion_three_'+id+'" id="suggestion_three_'+id+'" class="suggestion_three input_7" type="text" value="suggestion three" onBlur="if(this.value==&quot;&quot;) this.value=&quot;suggestion three&quot;;" onFocus="if(this.value==&quot;suggestion three&quot;) this.value=&quot;&quot;;"/></div>');
							$("#borelog_container").append('<div class="borelog_section collapsible" id="borelog_section_'+id+'" style="position: absolute; left:416px; top:'+margin_top+'; z-index:10; "><div class="top_line"></div><a style="" id="show_hide_anchor_'+id+'" href="javascript:void(0);" class="show_hide" rel="" onclick="show_hide_div('+id+')" >-</a><a style="" id="delete_'+id+'" href="javascript:void(0);" class="delete_borlog" rel="" onclick="delete_borlog('+id+')" >x</a><div class="wrapper-borlog" id="wrapper-'+id+'"><textarea name="borlog_textarea_'+id+'" id="borlog_textarea_'+id+'" style="width:89%; margin:0; font-size:17px; background:none;" class="borlog_textarea input_5" value="" placeholder="Bore look notes go here"></textarea><form id="image_form_'+id+'" name="image_form_'+id+'" class="image_form" action="uploadfile.php" enctype="multipart/form-data" method="POST" ><input style="display:none;" id="ImageFile_'+id+'" name="ImageFile_'+id+'" class="ImageFile" type="file" value="" /> </form><label class="imgfilelabel" style="" for="ImageFile_'+id+'"><img src="images/icon11.png" /></label><div class="sugg_div" id="sugg_div_'+id+'"><input name="suggestion_one_'+id+'" id="suggestion_one_'+id+'" class="suggestion_one input_5" type="text" value="" style="cursor:pointer;" /><input name="suggestion_two_'+id+'" id="suggestion_two_'+id+'" class="suggestion_two input_6" type="text" value="" style="cursor:pointer;" /><input name="suggestion_three_'+id+'" id="suggestion_three_'+id+'" class="suggestion_three input_7" type="text" value="" style="cursor:pointer;" /></div></div>');
							//$(".sugg_div").hide();
							$( "#borlog_div" ).remove();
							$("#bor_cont").html(borlog_html);
							total_images++;
							new_entry++;
						
							borlog_new();
							
						}	
					}else{
						$.notify("Already selected","error");
						$( "#borlog_div" ).remove();
						$("#bor_cont").html(borlog_html);
						borlog_new();
					}
					
				}
			});
			
		}
		borlog_new();
		var insertedid = localStorage.getItem('insertedid');
		if(insertedid == null){
			get_jobNo();
		}else{
			$("#location_changed").val('1');
			initial_save = false;
		}
		
		var calibration_val_local = localStorage.getItem('calibration_val');
		if(calibration_val_local != null){
			$("#calibration_val").val(calibration_val_local);
		}else{
			$("#calibration_val").val('1.50');
		}
		
		var client_storage = localStorage.getItem('client');
		
		var test_location = localStorage.getItem('testlocation');
		
		if(test_location != null){
			$("#location").html(test_location);
		}
		if($('#insertion_id').val() == ""){
			var inserted_id = localStorage.getItem('insertedid');
			if(inserted_id != null){
				$('#insertion_id').val(inserted_id);
			}
		}
		
		if(client_storage != null){
			$("#client").val(client_storage);
		}
		
		var job_name_storage = localStorage.getItem('job_name');
		if(job_name_storage != null){
			$("#job_name").val(job_name_storage);
		}
		
		var address_storage = localStorage.getItem('address');
		if(address_storage != null){
			$("#address").val(address_storage);
		}
		
		var job_no_storage = localStorage.getItem('job_no');
		if(job_no_storage != null){
			$("#job_no").val(job_no_storage);
		}
		
		var tested_by_storage = localStorage.getItem('tested_by');
		if(tested_by_storage != null){
			$("#tested_by").val(tested_by_storage);
		}
		
		var project_note_storage = localStorage.getItem('project_note');
		if(project_note_storage != null){
			$("#project_note").val(project_note_storage);
		}
		
		var project_note_storage = localStorage.getItem('blows');
		if(project_note_storage != null){
			var below_array = project_note_storage.split(",");
			var below_length = below_array.length;
			//alert(below_length);
			var bar_line = 2;
			for(var i = 0; i < below_length; i++){
				$("#scale_rating_div").append("<div class='scale_inner_rating' ><a href='javascript:void(0);' class='minusblow' id='"+i+"'><img src='images/minus_icon.jpg' /></a><input type='text' id='blowvalue_"+i+"' value='"+below_array[i]+"' class='blowclass' onKeyPress='return false;' /><a href='javascript:void(0);' id='"+i+"' class='plusblow'><img src='images/plus_icon.jpg' /></a></div>");
				//$("#blowvalue_"+i).val(below_array[i]);
				
				if(i > 19){
					var j = i + 1;
					if((j % 5) != 0){
						var line = "<div class='inner_line'></div>";
					}else{
						bar_line = bar_line + 0.5;
						var line = "<div class='inner_line inner_line_target'><p>"+bar_line+"</p></div>";
					}
				}
				$("#scale_left_div").append(line);
			}
			
		}else{
			for(var k = 0; k <= 19; k++){
				$("#scale_rating_div").append("<div class='scale_inner_rating' ><a href='javascript:void(0);' class='minusblow' id='"+k+"'><img src='images/minus_icon.jpg' /></a><input type='text' id='blowvalue_"+k+"' value='-' class='blowclass' onKeyPress='return false;' /><a href='javascript:void(0);' id='"+k+"' class='plusblow'><img src='images/plus_icon.jpg' /></a></div>");
			}
		}
		
		var underainedform_start_storage = localStorage.getItem('underainedform_start');
		var underainedclass_end_storage = localStorage.getItem('underainedclass_end');
		if(underainedform_start_storage != null && underainedclass_end_storage != null){
		
			var underainedform_start_array = underainedform_start_storage.split(",");
			var underainedclass_end_array = underainedclass_end_storage.split(",");
			
			var underainedform_start_length = underainedform_start_array.length;
			//alert(underainedform_start_length);
			for(var i = 0; i < underainedform_start_length; i++){
				$("#undrained_section_div").append("<input class='rating_input underainedclass_start' value='"+underainedform_start_array[i]+"' type='text' name='undrained_start_"+i+"' id='undrained_start_"+i+"' onkeypress='validate(event)' /><img src='images/slash.png' /><input class='rating_input underainedclass_end' type='text' value='"+underainedclass_end_array[i]+"' name='undrained_end_"+i+"' id='undrained_end_"+i+"' onkeypress='validate(event)' />");
			}
		}else{
			for(var k = 0; k <= 19; k++){
				$("#undrained_section_div").append("<input class='rating_input underainedclass_start' type='text' name='undrained_start_"+k+"' id='undrained_start_"+k+"' onkeypress='validate(event)' /><img src='images/slash.png' /><input class='rating_input underainedclass_end' type='text' name='undrained_end_"+k+"' id='undrained_end_"+k+"' onkeypress='validate(event)' />");
			}
		}
		
		
			var borlog_textarea = localStorage.getItem('borlog_textarea');
			var suggestion_one = localStorage.getItem('suggestion_one');
			var suggestion_two = localStorage.getItem('suggestion_two');
			var suggestion_three = localStorage.getItem('suggestion_three');
			if(borlog_textarea != null){
				$("#borlog_textarea").val(borlog_textarea);
			}
			if(suggestion_one != null){
				$("#suggestion_one").val(suggestion_one);
			}
			if(suggestion_two != null){
				$("#suggestion_two").val(suggestion_two);
			}
			if(suggestion_three != null){
				$("#suggestion_three").val(suggestion_three);
			}
			
		
		
		//local storage get value and display
		
		/* $(".borlog_textarea").live('focus',function(){
			var id = $(this).attr('id');
			$("#"+id).val("");
		}); */
		
		
		//$('#borelog_section').hide();
		$("#prevlocation").click(function(){
			valid_image_saved();
			if(initial_save){
				var value = $("#location").html();
				
				var explode_val = value.split(" ");
				var string_no = explode_val[2];
				var no = parseInt(string_no);
				
				if(no == 1){
					no = no;
					$("#loader").hide();
				}else{
					
					no = no - 1;
					if($("#serach_next_loca").val() != ""){
						var insert_id = $('#insertion_id').val();
						var recor = changelocation_result(no,insert_id,function(){});
					}
				}
				$("#location").html("TEST LOCATION "+no);
				//$("#loader").hide();
			}else{
				$("#loader").show();
				var value = $("#location").html();
				
				var explode_val = value.split(" ");
				var string_no = explode_val[2];
				var no = parseInt(string_no);
				if(no == 1){
					no = no;
					$("#loader").hide();
				}else{
					no = no - 1;
					var insert_id = $('#insertion_id').val();
					var recor = changelocation_result(no,insert_id,function(){});
				}
				$("#location").html("TEST LOCATION "+no);
				//$("#loader").hide();
			}
			//$("#loader").hide();
		});
		
		$("#nextlocation").click(function(){
			$("#loader").show();
			valid_image_saved();
			
			var job_no = $("#job_no").val();
			if(job_no != ""){
				localStorage.setItem('job_no',job_no);
			}
			
			if(!initial_save){				
				var value = $("#location").html();
				
				var explode_val = value.split(" ");
				var string_no = explode_val[2];
				var no = parseInt(string_no);
				no = no + 1;
					var insert_id = $('#insertion_id').val();
					var recor = changelocation_result(no,insert_id, function(){
						
						if(nextloc){
							initial_save = true;
							localStorage.removeItem("blows");
							localStorage.removeItem("underainedform_start");
							localStorage.removeItem("underainedclass_end");
							localStorage.removeItem("borlog_textarea");
											
							$("#location").html("TEST LOCATION "+no);
							
							localStorage.setItem('testlocation',"TEST LOCATION "+no);
							localStorage.setItem('insertedid',$('#insertion_id').val());
							window.location.reload();
						}else{
						
							nextloc = true;
							
							$("#location").html("TEST LOCATION "+no);
						}
					});
				//alert("test");
				
			}else if($("#serach_next_loca").val() != ""){
				var value = $("#location").html();
				
				var explode_val = value.split(" ");
				var string_no = explode_val[2];
				var no = parseInt(string_no);
				no = no + 1;
				$("#location").html("TEST LOCATION "+no);
				var loca_id = $("#serach_next_loca").val();
				var locationid = parseInt(loca_id) + 1;
				var insert_id = $('#insertion_id').val();
				
				var recor = changelocation_result(no,insert_id,function(){});
				
			}else{
				var value = $("#location").html();
				
				var explode_val = value.split(" ");
				var string_no = explode_val[2];
				var no = parseInt(string_no);
				no = no + 1;
				$("#location").html("TEST LOCATION "+no);
				var loca_id = $("#serach_next_loca").val();
				var locationid = parseInt(loca_id) + 1;
				var insert_id = $('#insertion_id').val();
				var recor = changelocation_result(no,insert_id,function(){});
				//$.notify("Please save first location first.","error");
				
			}
		});
		
		$("#saved_draft").live('click',function(){
			valid_image_saved();
		});
		
		$("#appenrow").click(function(){
		
			var blownumber_storage = [];
			$.each($('.blowclass'), function() {
				blownumber_storage.push($(this).val());
			});
			var displ_valu = blownumber_storage.length;
			
			var displ_valu_dec = displ_valu - 1;
			var incr_valu = displ_valu + 1;
			//incr_valu_prev = incr_valu - 2;
			var headi_value = $("#blowvalue_"+displ_valu_dec).val();
			
			if((incr_valu % 5) != 0){
				var line = "<div class='inner_line'></div>";
			}else{
				var bar_line = incr_valu/10;
				//bar_line = bar_line + 0.5;
				var line = "<div class='inner_line inner_line_target'><p>"+bar_line+"</p></div>";
			}
			
			//var headi_value = $("#blowvalue_"+incr_valu_prev).val();
			$("#scale_left_div").append(line);
			$("#scale_rating_div").append("<div class='scale_inner_rating' ><a href='javascript:void(0);' class='minusblow' id='"+displ_valu+"'><img src='images/minus_icon.jpg' /></a><input type='text' id='blowvalue_"+displ_valu+"' value='0' class='blowclass' onKeyPress='return false;' /><a href='javascript:void(0);' id='"+displ_valu+"' class='plusblow'><img src='images/plus_icon.jpg' /></a></div>");
			$("#undrained_section_div").append("<input class='rating_input underainedclass_start' type='text' name='undrained_start_"+displ_valu+"' id='undrained_start_"+displ_valu+"' onkeypress='validate(event)' /><img src='images/slash.png' /><input class='rating_input underainedclass_end' type='text' name='undrained_end_"+displ_valu+"' id='undrained_end_"+displ_valu+"' onkeypress='validate(event)' />");
			$("#blowvalue_"+displ_valu).val(headi_value);
			incr_valu = incr_valu + 1;
			displ_valu = displ_valu + 1;
			
			var underainedform_start_storage = [];
			$.each($('.underainedclass_start'), function() {
				underainedform_start_storage.push($(this).val());
			});
			//console.log(underainedform_start_storage);
			localStorage.setItem('underainedform_start',underainedform_start_storage);
			
			var underainedclass_end_storage = [];
			$.each($('.underainedclass_end'), function() {
				underainedclass_end_storage.push($(this).val());
			});
			//console.log(underainedform_start_storage);
			localStorage.setItem('underainedclass_end',underainedclass_end_storage);
			
			var blownumber_storage = [];
			$.each($('.blowclass'), function() {
				blownumber_storage.push($(this).val());
			});
			localStorage.setItem('blows',blownumber_storage);
		});
		
		$(".minusblow").live( 'click',function(){
			
			var anchor_id = $(this).attr("id");
			var value = $("#blowvalue_"+anchor_id).val();
			var no = ''; 
			if(value == '-'){
				var id_int = parseInt(anchor_id);
				if(id_int != 0){
					var prev_id = id_int - 1 ;
					var prev_value = $("#blowvalue_"+prev_id).val();
					
					if(prev_value == '-'){
						no = '-';					
					}else if(prev_value == 0){
						no = '-';	
					}else{
						var no_value = parseInt(prev_value);
						no = no_value - 1;
					}
				}else{
					no = '-';
				}
			}else if(value == 0){
				no = '-';	
			}else{
				var value_int = parseInt(value);
				no = value_int - 1;
			}
			
			if(no == '0'){
				no = 0;
			}
			
			$("#blowvalue_"+anchor_id).val(no);
			
			var blownumber_storage = [];
			$.each($('.blowclass'), function() {
				blownumber_storage.push($(this).val());
			});
			localStorage.setItem('blows',blownumber_storage);
			initial_save = false;
		});
		
		$(".plusblow").live('click',function(){
			var anchor_id = $(this).attr("id");
			
			if(anchor_id != '0'){
				var id_int = parseInt(anchor_id);
				var prev_id = id_int - 1 ;
				var prev_value = $("#blowvalue_"+prev_id).val();
				var no = '';
				if(prev_value == '-'){
					var value = $("#blowvalue_"+anchor_id).val();
					if(value == "-"){
						no = 0;
					}else{
						var no_value = parseInt(value);
						no = no_value + 1;
					}
					
				}else{
					var pre_int = parseInt(prev_value);
					var value = $("#blowvalue_"+anchor_id).val();
					var value_int = parseInt(value);
					if(value == '-'){
						no = pre_int + 1;
					}else{
						no = value_int + 1;
					}
					
				}
			}else{
				//alert(anchor_id);
				var value = $("#blowvalue_"+anchor_id).val();
				if(value == "-"){
					no = 0;
				}else{
					var value = $("#blowvalue_"+anchor_id).val();
					var no = parseInt(value);
					no = no + 1;
				}
			}
		
			$("#blowvalue_"+anchor_id).val(no);
			
			var blownumber_storage = [];
			$.each($('.blowclass'), function() {
				blownumber_storage.push($(this).val());
			});
			localStorage.setItem('blows',blownumber_storage);
			
			initial_save = false;
		});
		
		$("#createnew").live('click',function(){
			$('#probaseform').trigger("reset");
			localStorage.clear();
			window.location.reload();
			
		});

		
		$("#search_button").click(function(){
			if($("#search_text").val() == "Search"){
				$.notify("Please enter for search", "error");		
				return false;			
			}
			
			serach_result();
		});
//	suggestion_one_
		$(".borlog_textarea").live('change keyup paste',function(){
			//alert(borlog_note);
			var textarea_val = $(this).val();
			var id = $(this).attr('id');
			var id_val = id.split('_');
			var j = 0;
			var search_index = new Array();
			for(var i=0; i<borlog_note.length; i++){
				var pos = borlog_note[i].toString().search(textarea_val);
				if(pos > -1){
					if(j == 0){
						$("#sugg_div_"+id_val[2]).show();
						$("#suggestion_one_"+id_val[2]).val(borlog_note[i]);
						j++;
					}else if(j == 1){
						$("#suggestion_two_"+id_val[2]).val(borlog_note[i]);
						j++;
					}else if(j == 2){
						$("#suggestion_three_"+id_val[2]).val(borlog_note[i]);
						j++;
					}
				}
				
			}
		});
		
		
		$(".suggestion_three").live('click', function( ){
	
			var id = $(this).attr('id');
			var val = $(this).val();
			var id_val = id.split('_');
			$("#borlog_textarea_"+id_val[2]).val(val);
			$("#suggestion_one_"+id_val[2]).val('');
			$("#suggestion_two_"+id_val[2]).val('');
			$("#suggestion_three_"+id_val[2]).val('');
			$("#sugg_div_"+id_val[2]).hide();
			
		});
		$(".suggestion_two").live('click', function( ){
			
			var id = $(this).attr('id');
			var val = $(this).val();
			var id_val = id.split('_');
			$("#borlog_textarea_"+id_val[2]).val(val);
			$("#suggestion_one_"+id_val[2]).val('');
			$("#suggestion_two_"+id_val[2]).val('');
			$("#suggestion_three_"+id_val[2]).val('');
			$("#sugg_div_"+id_val[2]).hide();
			
		});
		$(".suggestion_one").live('click', function( ){
			
			var id = $(this).attr('id');
			var val = $(this).val();
			var id_val = id.split('_');
			$("#borlog_textarea_"+id_val[2]).val(val);
			$("#suggestion_one_"+id_val[2]).val('');
			$("#suggestion_two_"+id_val[2]).val('');
			$("#suggestion_three_"+id_val[2]).val('');
			$("#sugg_div_"+id_val[2]).hide();
			
		});
		
		/* $("#tested_by").live('change keyup paste',function(){
			$("#tested_by").unbind('blur');
			$("#client_list").show();
			$("#client_list").html(" ");
			var client_val = $(this).val();
			var search_index = new Array();
			for(var i=0; i<all_client.length; i++){
				var pos = all_client[i].toString().search(client_val);
				if(pos > -1){
					$("#client_list").append("<input type='text' name='client_"+i+"' id='client_"+i+"' value='"+all_client[i]+"' class='client_list_class input_2' style='cursor:pointer;' > ");
					//$("#suggestion_one_"+id_val[2]).val(all_client[i]);
					
				}
				
			}
		});
		 */
		/* $(".client_list_class").live('click', function(){
			var val = $(this).val();
			$("#tested_by").val(val);
			//$(".client_list_class").val('');
			$("#client_list").hide();
		}); */
		
		
	});
	
	function get_allclient(){
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'get_allclient',
				
			},
			beforeSend:function(){								
			},
			complete: function (o, s) {
				
			},
			success:function(data){
				var obj = $.parseJSON( data );
				all_client = obj;
				$( "#client" ).autocomplete({
					source: all_client
				});
				
			},
			error:function(){
				// failed request; give feedback to user
				$.notify("Technical Error occured. Please try again later.", "error");
				
			}
		});
	
	}
	
	function show_hide_div(id){
		
		$("#show_hide_anchor_"+id).attr('onclick', 'show_div_borlog('+id+')');
		$("#show_hide_anchor_"+id).html('+');
		$(".wrapper-borlog").hide();
		$("#borelog_section_"+id).css("height","16px");
		$("#borelog_section_"+id).css("z-index","1");
		for(var i=0; i<new_id.length; i++){
			
			if(new_id[i] != id){
				$("#show_hide_anchor_"+new_id[i]).html('+');
				$("#show_hide_anchor_"+new_id[i]).attr('onclick', 'show_div_borlog('+new_id[i]+')');
				$("#borelog_section_"+new_id[i]).css("height","16px");
				$("#borelog_section_"+new_id[i]).css("z-index","1");
			}
		}
		$("#suggestion_one_"+id).val('');
		$("#suggestion_two_"+id).val('');
		$("#suggestion_three_"+id).val('');
		$("#sugg_div_"+id).hide();
	}
	
	function show_div_borlog(id){
		
		$("#show_hide_anchor_"+id).attr('onclick', 'show_hide_div('+id+')');
		$("#show_hide_anchor_"+id).html('-');
		$(".wrapper-borlog").hide();
		$("#wrapper-"+id).show();
		$("#borelog_section_"+id).css("height","188px");
		$("#borlog_textarea_"+id).css("height","88px");
		$("#borelog_section_"+id).css("z-index","100");
		for(var i=0; i<new_id.length; i++){
			if(new_id[i] != id){
				$("#show_hide_anchor_"+new_id[i]).html('+');
				$("#show_hide_anchor_"+new_id[i]).attr('onclick', 'show_div_borlog('+new_id[i]+')');
				$("#borelog_section_"+new_id[i]).css("height","16px");
				$("#borelog_section_"+new_id[i]).css("z-index","1");
			}
		}
		$("#suggestion_one_"+id).val('');
		$("#suggestion_two_"+id).val('');
		$("#suggestion_three_"+id).val('');
		$("#sugg_div_"+id).hide();
	}
	//local storage set input value
	$('input').live('blur',function() {
		initial_save = false;
	});
	$('textarea').live('blur',function(){
		initial_save = false;
	});
	
	$( "#client" ).blur(function() {
		var client = $("#client").val();
		if(client != ""){
			localStorage.setItem('client',client);
		}
		initial_save = false;
	});
	$( "#job_name" ).blur(function() {
		var job_name = $("#job_name").val();
		if(job_name != ""){
			localStorage.setItem('job_name',job_name);
		}
	});
	$( "#address" ).blur(function() {
		var address = $("#address").val();
		if(address != ""){
			localStorage.setItem('address',address);
		}
		
	});
	
	$( "#job_no" ).blur(function() {
		var job_no = $("#job_no").val();
		if(job_no != ""){
			localStorage.setItem('job_no',job_no);
		}
	});
	
	$( "#tested_by" ).blur(function() {
		
		var tested_by = $("#tested_by").val();
		if(tested_by != ""){
			localStorage.setItem('tested_by',tested_by);
		}
	});
	
	$( "#project_note" ).blur(function() {
		var project_note = $("#project_note").val();
		if(project_note != ""){
			localStorage.setItem('project_note',project_note);
		}
	});
	
	$( ".underainedclass_start" ).live('blur',function() {
		var underainedform_start_storage = [];
		$.each($('.underainedclass_start'), function() {
			underainedform_start_storage.push($(this).val());
		});
		//console.log(underainedform_start_storage);
		localStorage.setItem('underainedform_start',underainedform_start_storage);
	});
	
	$( ".underainedclass_end" ).live('blur',function() {
		var underainedclass_end_storage = [];
		$.each($('.underainedclass_end'), function() {
			underainedclass_end_storage.push($(this).val());
		});
		//console.log(underainedform_start_storage);
		localStorage.setItem('underainedclass_end',underainedclass_end_storage);
	});
	
	$( "#calibration_val" ).live('blur',function() {
		var calibration_val = $("#calibration_val").val();
		if(calibration_val != ""){
			localStorage.setItem('calibration_val',calibration_val);
		}
	});

	//local storage set input value
	$("#export_pdf").live('click',function(){
		export_pdf();
	});
	
	$(".search_result_address").live('click',function(){
		$("#borelog_container").html("");
		var form_id = $(this).attr("id");
		var locationid = $(this).attr("name");
		$("#serach_next_loca").val(locationid);
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'form_detail',
				form_id: form_id,
				locationid: locationid,
			},
			beforeSend:function(){	
				$("#loader").show();
			},
			complete: function (o, s) {
				$("#loader").hide();
			},
			success:function(data){
				var obj = $.parseJSON( data );
				
				if(obj.status == "ok"){
					var form_id =  obj.form_id;
					var testlocation =  obj.testlocation;
					var client =  obj.client;
					var jobname =  obj.jobname;
					var address =  obj.address;
					var jobno =  obj.jobno;
					var date =  obj.date;
					var testedby =  obj.testedby;
					var projectnote =  obj.projectnote;
					var noofblows =  obj.noofblows;
					var undrainedfrom =  obj.undrainedfrom;
					var undrainedto =  obj.undrainedto;
					var borelognote =  obj.borelognote;
					var calibration =  obj.calibration;
					
					$("#inputdetails").show();
					$("#search_result").hide();
					
					$("#location").html(testlocation);
					$("#client").val(client);
					$("#job_name").val(jobname);
					$("#address").val(address);
					$("#job_no").val(jobno);
					$("#tested_by").val(testedby);
					var date_split = date.split("-");
					$("#month").val(date_split[0]);
					$("#days").val(date_split[1]);
					$("#year").val(date_split[2]);
					$("#project_note").val(projectnote);
					$('#update_timeinterval').val(obj.locationid);
					$("#calibration_val").val(calibration);
					
					blows_update(noofblows);
					
					underained_start(undrainedfrom,undrainedto,noofblows);
					
					new_id = [];
					//console.log(obj.borlog);
					for(var i = 0; i<obj.borlog.length; i++){
						var borlogid = obj.borlog[i].borlogid;
						var borlogmeterno = obj.borlog[i].borlogmeterno;
						var borlognote = obj.borlog[i].borlognote;
						var formid = obj.borlog[i].formid;
						var imagename = obj.borlog[i].imagename;
						var locationid = obj.borlog[i].locationid;
						var jobno = obj.borlog[i].jobno;
						var margin_top = ((borlogmeterno - 1) * 41.1) + 8;
						//$("#borelog_container").append('<div class="borelog_section" id="borelog_section_'+borlogmeterno+'" style="z-index:10; "><div class="top_line"></div><a style="" id="show_hide_anchor_'+borlogmeterno+'" href="javascript:void(0);" class="show_hide" rel="" onclick="show_hide_div('+borlogmeterno+')" >-</a><div class="wrapper-borlog" id="wrapper-'+borlogmeterno+'"><textarea name="borlog_textarea_'+borlogmeterno+'" id="borlog_textarea_'+borlogmeterno+'" style="width:89%; margin:0; font-size:17px; background:none;" class="borlog_textarea input_5" value="" placeholder="Bore look notes go here">'+borlognote+'</textarea><form id="image_form_'+borlogmeterno+'" name="image_form_'+borlogmeterno+'" class="image_form" action="uploadfile.php" enctype="multipart/form-data" method="POST" ><input style="display:none;" id="ImageFile_'+borlogmeterno+'" name="ImageFile_'+borlogmeterno+'" class="ImageFile" type="file" value="" /> </form><label class="imgfilelabel" style="" for="ImageFile_'+borlogmeterno+'"><img src="images/icon11.png" /></label><div class="sugg_div" id="sugg_div_'+borlogmeterno+'"><input name="suggestion_one_'+borlogmeterno+'" id="suggestion_one_'+borlogmeterno+'" class="suggestion_one input_5" type="text" value="" style="cursor:pointer;" /><input name="suggestion_two_'+borlogmeterno+'" id="suggestion_two_'+borlogmeterno+'" class="suggestion_two input_6" type="text" value="" style="cursor:pointer;" /><input name="suggestion_three_'+borlogmeterno+'" id="suggestion_three_'+borlogmeterno+'" class="suggestion_three input_7" type="text" value="" style="cursor:pointer;" /></div></div>');
						$("#borelog_container").append('<div class="borelog_section collapsible" id="borelog_section_'+borlogmeterno+'" style="position: absolute; left:416px; top:'+margin_top+'; z-index:10; "><div class="top_line"></div><a style="" id="show_hide_anchor_'+borlogmeterno+'" href="javascript:void(0);" class="show_hide" rel="" onclick="show_hide_div('+borlogmeterno+')" >-</a><a style="" id="delete_'+borlogmeterno+'" href="javascript:void(0);" class="delete_borlog" rel="" onclick="delete_borlog('+borlogmeterno+')" >x</a><div class="wrapper-borlog" id="wrapper-'+borlogmeterno+'"><textarea name="borlog_textarea_'+borlogmeterno+'" id="borlog_textarea_'+borlogmeterno+'" style="width:89%; margin:0; font-size:17px; background:none;" class="borlog_textarea input_5" value="" placeholder="Bore look notes go here">'+borlognote+'</textarea><form id="image_form_'+borlogmeterno+'" name="image_form_'+borlogmeterno+'" class="image_form" action="uploadfile.php" enctype="multipart/form-data" method="POST" ><input style="display:none;" id="ImageFile_'+borlogmeterno+'" name="ImageFile_'+borlogmeterno+'" class="ImageFile" type="file" value="" /> </form><label class="imgfilelabel" style="" for="ImageFile_'+borlogmeterno+'"><img src="images/icon11.png" /></label><div class="sugg_div" id="sugg_div_'+borlogmeterno+'"><input name="suggestion_one_'+borlogmeterno+'" id="suggestion_one_'+borlogmeterno+'" class="suggestion_one input_5" type="text" value="" style="cursor:pointer;" /><input name="suggestion_two_'+borlogmeterno+'" id="suggestion_two_'+borlogmeterno+'" class="suggestion_two input_6" type="text" value="" style="cursor:pointer;" /><input name="suggestion_three_'+borlogmeterno+'" id="suggestion_three_'+borlogmeterno+'" class="suggestion_three input_7" type="text" value="" style="cursor:pointer;" /></div></div></div>');
						
						new_id.push(borlogmeterno);
						
					}
					$( '#insertion_id').val(obj.form_id);
					$( '#search_result_hidden').val('1');
				}else{
					$.notify("Error occured. Please try again later.", "error");
				}
			},
			error:function(){
				// failed request; give feedback to user
				$.notify("Technical Error occured. Please try again later.", "error");
				
			}
		});
		
	});
	
	$("#saved_form").live('click',function(){
		initial_save = true;
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'saved_result',
			},
			beforeSend:function(){	
				$("#loader").show();
			},
			complete: function (o, s) {
				$("#loader").hide();
			},
			success:function(data){
				
				var obj = $.parseJSON( data );
				
				if(obj.status != "error"){
					
					$("#result_display").html('');
					$("#result_date").html('');
					var length = obj.length;
					$("#inputdetails").hide();
					$("#search_result").show();
					
					for(var i =0; i<length; i++){
						
						var form_id = obj[i].form_id;
						var address = obj[i].address;
						var locationid = obj[i].locationid;
						var date = obj[i].date;
						var date_parts = date.split("-");
						$("#result_display").append('<a href="javascript:void(0);" id="'+form_id+'" name="'+locationid+'" class="search_result_address"><span class="input_1 search_result_section" id="'+form_id+'" title="'+address+'">'+address.substr(0, 15)+'..</span></a>');
						$("#result_date").append('<span class="input_1 search_result_section result_date_section" >'+date_parts[0]+'/'+date_parts[1]+'</span>');
						//alert(split);
					}
				}else if(obj.status == "error"){
						$.notify("No record found", "error");
						//$("#result_display").html('');
						//$("#result_date").html('');
						$("#inputdetails").show();
						$("#search_result").hide();		
				}
				
			},
			error:function(){
				// failed request; give feedback to user
				$.notify("Technical Error occured. Please try again later.", "error");
				
			}
		});
	
	
	});
	
	function blows_update(noofblows){
		$("#scale_rating_div").html(" ");
		$("#scale_left_div").html(" ");
		var below_array = noofblows.split(",");
		var below_length = below_array.length;
		//alert(below_length);
		var bar_line = 0;
		for(var i = 0; i < below_length-1; i++){
			if(below_array[i] == "-"){
				below_array[i] = "-";
			}
			$("#scale_rating_div").append("<div class='scale_inner_rating' ><a href='javascript:void(0);' class='minusblow' id='"+i+"'><img src='images/minus_icon.jpg' /></a><input type='text' id='blowvalue_"+i+"' value='"+below_array[i]+"' class='blowclass' onKeyPress='return false;' /><a href='javascript:void(0);' id='"+i+"' class='plusblow'><img src='images/plus_icon.jpg' /></a></div>");
			//$("#blowvalue_"+i).val(below_array[i]);
			
			
				var j = i + 1;
				if((j % 5) != 0){
					var line = "<div class='inner_line'></div>";
				}else{
					bar_line = bar_line + 0.5;
					var line = "<div class='inner_line inner_line_target'><p>"+bar_line+"</p></div>";
				}
			
			$("#scale_left_div").append(line);
		}
	}
	
	function underained_start(undrainedfrom,undrainedto,noofblows){
		$("#undrained_section_div").html("");
		if(undrainedfrom != ""){
			var underainedform_start_array = undrainedfrom.split(",");
			var underainedclass_end_array = new Array();
			if(undrainedto != ""){
				underainedclass_end_array = undrainedto.split(",");
			}
			var underainedform_start_length = underainedform_start_array.length;
			
			for(var i = 0; i < underainedform_start_length-1; i++){
				if(underainedclass_end_array[i] == undefined){
					underainedclass_end_array[i] = "";
				}
				$("#undrained_section_div").append("<input class='rating_input underainedclass_start' value='"+underainedform_start_array[i]+"' type='text' name='undrained_start_"+i+"' id='undrained_start_"+i+"' onkeypress='validate(event)' /><img src='images/slash.png' /><input class='rating_input underainedclass_end' type='text' value='"+underainedclass_end_array[i]+"' name='undrained_end_"+i+"' id='undrained_end_"+i+"' onkeypress='validate(event)' />");
			}
		}else{
			var below_array = noofblows.split(",");
			var below_length = below_array.length;
			for(var k = 0; k < below_length-1; k++){
				$("#undrained_section_div").append("<input class='rating_input underainedclass_start' type='text' name='undrained_start_"+k+"' id='undrained_start_"+k+"' onkeypress='validate(event)' /><img src='images/slash.png'  /><input class='rating_input underainedclass_end' type='text' name='undrained_end_"+k+"' id='undrained_end_"+k+"' onkeypress='validate(event)' />");
			}
		}
	}
	function get_jobNo(){
	//alert("test");
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'get_jobno',
				
			},
			beforeSend:function(){								
			},
			complete: function (o, s) {
				
			},
			success:function(data){
				var obj = $.parseJSON( data );
				//alert(obj.job_no);
				if(obj.job_value == "max"){
					var value = parseInt(obj.job_no);
					var inc_valu = value +1;
					$("#job_no").val(inc_valu);
				}else if (obj.job_value == "first"){
					$("#job_no").val(obj.job_no);
				}
				
			},
			error:function(){
				// failed request; give feedback to user
				$.notify("Technical Error occured. Please try again later.", "error");
				
			}
		});
	
	}
	
	function get_borlognote(){
	//alert("test");
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'get_borlognote',
				
			},
			beforeSend:function(){								
			},
			complete: function (o, s) {
				
			},
			success:function(data){
				var obj = $.parseJSON( data );
				borlog_note = obj;
				//alert(obj[0]);
			},
			error:function(){
				// failed request; give feedback to user
				$.notify("Technical Error occured. Please try again later.", "error");
				
			}
		});
	
	}
	
	
	
	function valid_image_saved(){
				var image_data = new Array();
				//var image_name = uploadFile();
				$.each($('.image_form'), function() {
					draft++;
					if($(this).find(".ImageFile").val() != ""){
						$.notify("Please wait for a while images are being upload.","success");
						var id = $(this).find(".ImageFile").attr('id');
						$(this).ajaxSubmit({
							dataType: 'json',
							success: function(data, statusText, xhr, wrapper){
						
								if(data.status == "invalid"){
									$.notify(data.msg, "error");
									return false;
								}else if(data.status == "error"){
									$.notify(data.msg, "error");
									return false;
								}else if(data.status == "upload"){
									
									//$.notify("Image Uploaded Successfully.", "success");
									
									var object = {'meter_no':data.meter_no,'image_name':data.imagename};
									image_data.push(object);
								
									save_draft(image_data);
									
								}
								
							}
						});
						//console.log(image_data);
						$("#"+id).val("");
					}
					
				}); 
				
				if(draft == 0){
					var image_data = "";
					save_draft(image_data);
				}
	}
	
	function save_draft(image_data){
		
		var image_data_post = new Array();
		image_data_post = image_data;
		var probaseform = new Array(); 
		var test_location = $("#location").html();
		probaseform = $("#probaseform").serialize();
		
		var location_changed = 0;
		
		if(initial_save === true){
			location_changed = 1;
		}
		var search_hidden = $("#search_result_hidden").val();
		if(search_hidden == '1'){
			location_changed = 0;
		}
		
		var blownumber = [];
		$.each($('.blowclass'), function() {
			if($(this).val() == "-"){
				blownumber.push("-");
			}else{
				blownumber.push($(this).val());
			}
		});
		//alert(blownumber);
		
		var underainedform_start = [];
		$.each($('.underainedclass_start'), function() {
			underainedform_start.push($(this).val());
		});
		
		var underainedform_end = [];
		$.each($('.underainedclass_end'), function() {
			underainedform_end.push($(this).val());
		});
		
		var borlog_textarea  = new Array();
		$.each($('.borlog_textarea'), function() {
				var field_id = $(this).attr("id");
				var get_id = field_id.split("_");
	
				borlog_textarea.push({meter_no:get_id[2],value:$(this).val()});
		});
		
		var calibration = $("#calibration_val").val();
		
		var data_post = {
			action: 'form_data',
			test_location: test_location,
			probaseform: probaseform,
			blownumber: blownumber,
			underainedform_start: underainedform_start,
			underainedform_end: underainedform_end,
			borlog_textarea: JSON.stringify(borlog_textarea),
			image_data: JSON.stringify(image_data_post),
			location_changed: location_changed,
			calibration:calibration,
		};
			
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: data_post,
			beforeSend:function(){	
				//$("#loader").show();
			},
			complete: function (o, s) {
				//$("#loader").hide();
			},
			success:function(data){
				//alert(data);
				var obj = $.parseJSON( data );
				if(obj.status == "inserted"){
					$.notify("Data Inserted Successfully.", "success");
					//alert(obj.inserted_id);
					$('#insertion_id').val(obj.inserted_id);
					$('#update_timeinterval').val(obj.locationid);
					initial_save = false;
					$("#location_changed").val('');
					$.each($('.image_form'), function() {
						$(this).val("");
					});
					
					//$( "#underailedform" ).submit();
				} else if (obj.status == "updated") {
				
					//do nothing, otherwise there will be lot of notifications
				} else{
					$.notify("Error occured. Please try again later.", "error");
				}
			},
			error:function(){
				// failed request; give feedback to user
				$.notify("Technical Error occured. Please try again later.", "error");
				
			}
		});
		
	}
	
	function export_pdf(){
		initial_save = true;
		$("#loader").show();
		var probaseform = new Array(); 
		var test_location = $("#location").html();
		probaseform = $("#probaseform").serialize();
	
		var graph_array = new Array();
		forms_datato_export(function(graph_data) {
			//processing the data
			
			for(var i=0; i<graph_data.length; i++ ){
				var locationid = graph_data[i].locationid;
				
				var graph = getgraph(graph_data[i].noofblows);
				graph_array.push({'locationid':locationid,'graph':graph});
				
			}
			var data_post = {
				action: 'pdf_data',
				test_location: $("#location").html(),
				probaseform: $("#probaseform").serialize(),
				graph_html: JSON.stringify(graph_array),
			};
			//console.log(data_post);
			
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: data_post,
				beforeSend:function(){		
					$("#loader").show();				
				},
				complete: function (o, s) {
					$("#loader").hide();
				},
				success:function(data){
					initial_save = false;
					obj = $.parseJSON( data );
					for(var i=0; i<obj.length; i++){
						if(obj[i].status == "export"){
							var path = "include/"+obj[i].filename;
							window.open(path, '_blank');
						}else{
							$.notify("Technical Error occured. Please try again later.", "error");
						}
					}
				},
				error:function(){
					// failed request; give feedback to user
					$.notify("Technical Error occured. Please try again later.", "error");
					
				}
			});
			//localStorage["blowsdata_local"] = JSON.stringify(graph_array);
		});
		
	}
	function forms_datato_export(callback){
		var obj_blows;
		probaseform = $("#probaseform").serialize();
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'form_export_data',
				probaseform: probaseform,
			},
			beforeSend:function(){								
			},
			complete: function (o, s) {
				
			},
			success:function(data){
				obj_blows = $.parseJSON( data );
				callback(obj_blows);
			},
			error:function(){
				// failed request; give feedback to user
				$.notify("Technical Error occured. Please try again later.", "error");
				
			}
		});
		//return obj_blows;
	}
	
	function getgraph(blownumber){
		$("#graph").show();
		
		var blow_number = blownumber.split(',');
		var no_of_blows = blow_number.length;
		var height = no_of_blows * 44;
		//console.log(height);
			var mySeries = [];
			for (var i = 0; i < no_of_blows-1; i++) {
				if(blow_number[i] == '-'){
					//blow_number[i] = '';
					mySeries.push(0);
				}else{
					mySeries.push(parseInt(blow_number[i]));
				}
			}
			$('#graph').html("");
		var chart = $('#graph').highcharts();
		//chart.series[0].setData(mySeries);
		
		$('#graph').highcharts({
            chart: {
                type: 'line',
                inverted: true,
				height:height,
            },
            title: {
                text: 'Scale Penetrometer',
                x: -20 //center
            },
            subtitle: {
                text: '(Blows / 100mm)',
                x: -20
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'
                    },
					enabled: true
                }
            },
			plotOptions: {
				line: {
					lineWidth: 0.1,
					lineColor: '#000000',
				},            
			},
            yAxis: {
				title:false,
                opposite: true,
				series: [{
                	data: [2,4,6,8,10],
            	}],
				floor: 0,
            	ceiling: 10,
				tickInterval: 2,
				style: {
                        fontSize: '15px',
                        fontFamily: 'Verdana, sans-serif'
                    },
            },
			
            legend: {
                enabled: false
            },
            tooltip: {
               // pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>',
            },
            series: [{
                data:  mySeries, 
                dataLabels: {
                    //enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 4,
                    y: 10,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif',
                        textShadow: '0 0 3px black'
                    }
                }
            }]
        });
		
		var graph_html = $("#graph").html();
		$("#graph").hide();
		return graph_html;
	
	}
	
	function serach_result(){
		var search_text = $("#search_text").val();
		initial_save = true;
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'search_result',
				search_text: search_text,
				
			},
			beforeSend:function(){	
				$("#loader").show();
			},
			complete: function (o, s) {
				$("#loader").hide();
			},
			success:function(data){
				//alert(data);
				var obj = $.parseJSON( data );
				//console.log(obj);
				if(obj.job_no == "job no"){
					
					if(obj.found == "found"){
						$("#result_display").html('');
						$("#result_date").html('');
						var address = obj.address;
						var date = obj.date;
						var date_parts = date.split("-");
						
						var form_id = obj.form_id;
						var locationid = obj.locationid;
						$("#inputdetails").hide();
						$("#search_result").show();
						$("#result_display").append('<a href="javascript:void(0);" id="'+form_id+'" name="'+locationid+'" class="search_result_address"><span class="input_1 search_result_section" title="'+address+'">'+address.substr(0, 15)+'..</span></a>');
						$("#result_date").append('<span class="input_1 search_result_section result_date_section " >'+date_parts[0]+'/'+date_parts[1]+'</span>');
						
						
					}else if(obj.found == "not found"){
						$.notify("No record found", "error");
						$("#result_display").html('');
						$("#result_date").html('');
						$("#inputdetails").show();
						$("#search_result").hide();		
					}
				}else{
					if(obj.found != "not found"){
						$("#result_display").html('');
						$("#result_date").html('');
						var length = obj.length;
						//console.log(length);
						$("#inputdetails").hide();
						$("#search_result").show();
						for(var i =0; i<length; i++){
							var form_id = obj[i].form_id;
							var address = obj[i].address;
							var date = obj[i].date;
							var date_parts = date.split("-");
							var locationid = obj[i].locationid;
							
							$("#result_display").append('<a href="javascript:void(0);" id="'+form_id+'" name="'+locationid+'" class="search_result_address"><span class="input_1 search_result_section" id="'+form_id+'" title="'+address+'">'+address.substr(0, 15)+'..</span></a>');
							$("#result_date").append('<span class="input_1 search_result_section result_date_section" >'+date_parts[0]+'/'+date_parts[1]+'</span>');
							//alert(split);
						}
					}else{
						$.notify("No record found", "error");
						$("#result_display").html('');
						$("#result_date").html('');
						$("#inputdetails").show();
						$("#search_result").hide();	
					}
				}
			},
			error:function(){
				// failed request; give feedback to user
				$.notify("Technical Error occured. Please try again later.", "error");
				
			}
		});
	}
	
	function changelocation_result(loca_id,insert_id,callback){
		initial_save = true;
		
		$.ajax({
			type: 'POST',
			url: ajaxurl,
			data: {
				action: 'searhnext_location',
				form_id: insert_id,
				locationid: loca_id,
			},
			beforeSend:function(){	
				$("#loader").show();		
			},
			complete: function (o, s) {
				$("#loader").hide();
			},
			success:function(data){
				//alert(data);
				var obj = $.parseJSON( data );
				
				if(obj.status == "ok"){
					var form_id =  obj.form_id;
					var noofblows =  obj.noofblows;
					var undrainedfrom =  obj.undrainedfrom;
					var undrainedto =  obj.undrainedto;

					$('#update_timeinterval').val(obj.locationid);
					
					blows_update(noofblows);
					new_id = [];
					underained_start(undrainedfrom,undrainedto,noofblows);
					$("#borelog_container").html("");
					for(var i = 0; i<obj.borlog.length; i++){
						var borlogid = obj.borlog[i].borlogid;
						var borlogmeterno = obj.borlog[i].borlogmeterno;
						var borlognote = obj.borlog[i].borlognote;
						var formid = obj.borlog[i].formid;
						var imagename = obj.borlog[i].imagename;
						var locationid = obj.borlog[i].locationid;
						var jobno = obj.borlog[i].jobno;
						var margin_top = ((borlogmeterno - 1) * 41.1) + 8;
						//$("#borelog_container").append('<div class="borelog_section" id="borelog_section_'+borlogmeterno+'" style="z-index:10; "><div class="top_line"></div><a style="" id="show_hide_anchor_'+borlogmeterno+'" href="javascript:void(0);" class="show_hide" rel="" onclick="show_hide_div('+borlogmeterno+')" >-</a><div class="wrapper-borlog" id="wrapper-'+borlogmeterno+'"><textarea name="borlog_textarea_'+borlogmeterno+'" id="borlog_textarea_'+borlogmeterno+'" style="width:89%; margin:0; font-size:17px; background:none;" class="borlog_textarea input_5" value="" placeholder="Bore look notes go here">'+borlognote+'</textarea><form id="image_form_'+borlogmeterno+'" name="image_form_'+borlogmeterno+'" class="image_form" action="uploadfile.php" enctype="multipart/form-data" method="POST" ><input style="display:none;" id="ImageFile_'+borlogmeterno+'" name="ImageFile_'+borlogmeterno+'" class="ImageFile" type="file" value="" /> </form><label class="imgfilelabel" style="" for="ImageFile_'+borlogmeterno+'"><img src="images/icon11.png" /></label><div class="sugg_div" id="sugg_div_'+borlogmeterno+'"><input name="suggestion_one_'+borlogmeterno+'" id="suggestion_one_'+borlogmeterno+'" class="suggestion_one input_5" type="text" value="" style="cursor:pointer;" /><input name="suggestion_two_'+borlogmeterno+'" id="suggestion_two_'+borlogmeterno+'" class="suggestion_two input_6" type="text" value="" style="cursor:pointer;" /><input name="suggestion_three_'+borlogmeterno+'" id="suggestion_three_'+borlogmeterno+'" class="suggestion_three input_7" type="text" value="" style="cursor:pointer;" /></div></div>');
						$("#borelog_container").append('<div class="borelog_section collapsible" id="borelog_section_'+borlogmeterno+'" style="position: absolute; left:416px; top:'+margin_top+'; z-index:10; "><div class="top_line"></div><a style="" id="show_hide_anchor_'+borlogmeterno+'" href="javascript:void(0);" class="show_hide" rel="" onclick="show_hide_div('+borlogmeterno+')" >-</a><a style="" id="delete_'+borlogmeterno+'" href="javascript:void(0);" class="delete_borlog" rel="" onclick="delete_borlog('+borlogmeterno+')" >x</a><div class="wrapper-borlog" id="wrapper-'+borlogmeterno+'"><textarea name="borlog_textarea_'+borlogmeterno+'" id="borlog_textarea_'+borlogmeterno+'" style="width:89%; margin:0; font-size:17px; background:none;" class="borlog_textarea input_5" value="" placeholder="Bore look notes go here">'+borlognote+'</textarea><form id="image_form_'+borlogmeterno+'" name="image_form_'+borlogmeterno+'" class="image_form" action="uploadfile.php" enctype="multipart/form-data" method="POST" ><input style="display:none;" id="ImageFile_'+borlogmeterno+'" name="ImageFile_'+borlogmeterno+'" class="ImageFile" type="file" value="" /> </form><label class="imgfilelabel" style="" for="ImageFile_'+borlogmeterno+'"><img src="images/icon11.png" /></label><div class="sugg_div" id="sugg_div_'+borlogmeterno+'"><input name="suggestion_one_'+borlogmeterno+'" id="suggestion_one_'+borlogmeterno+'" class="suggestion_one input_5" type="text" value="" style="cursor:pointer;" /><input name="suggestion_two_'+borlogmeterno+'" id="suggestion_two_'+borlogmeterno+'" class="suggestion_two input_6" type="text" value="" style="cursor:pointer;" /><input name="suggestion_three_'+borlogmeterno+'" id="suggestion_three_'+borlogmeterno+'" class="suggestion_three input_7" type="text" value="" style="cursor:pointer;" /></div></div></div>');
						//$("#borelog_container").append('<div class="borelog_section" id="borelog_section_'+borlogmeterno+'" style="z-index:10; "><div class="top_line"></div><div class="wrapper-borlog" id="wrapper-'+borlogmeterno+'"><textarea name="borlog_textarea_'+borlogmeterno+'" id="borlog_textarea_'+borlogmeterno+'" style="width:89%; margin:0; font-size:17px; background:none;" class="borlog_textarea input_5" value="" placeholder="Bore look notes go here">'+borlognote+'</textarea><form id="image_form_'+borlogmeterno+'" name="image_form_'+borlogmeterno+'" class="image_form" action="uploadfile.php" enctype="multipart/form-data" method="POST" ><input style="display:none;" id="ImageFile_'+borlogmeterno+'" name="ImageFile_'+borlogmeterno+'" class="ImageFile" type="file" value="" /> </form><label class="imgfilelabel" style="" for="ImageFile_'+borlogmeterno+'"><img src="images/icon11.png" /></label><div class="sugg_div" id="sugg_div_'+borlogmeterno+'"><input name="suggestion_one_'+borlogmeterno+'" id="suggestion_one_'+borlogmeterno+'" class="suggestion_one input_5" type="text" value="" style="cursor:pointer;" /><input name="suggestion_two_'+borlogmeterno+'" id="suggestion_two_'+borlogmeterno+'" class="suggestion_two input_6" type="text" value="" style="cursor:pointer;" /><input name="suggestion_three_'+borlogmeterno+'" id="suggestion_three_'+borlogmeterno+'" class="suggestion_three input_7" type="text" value="" style="cursor:pointer;" /></div></div>');
						$("#show_hide_anchor_"+borlogmeterno).html('+');
						$("#show_hide_anchor_"+borlogmeterno).attr('onclick', 'show_div_borlog('+borlogmeterno+')');
						$("#borelog_section_"+borlogmeterno).css("height","16px");
						$("#borelog_section_"+borlogmeterno).css("z-index","1");
						$("#suggestion_one_"+borlogmeterno).val('');
						$("#suggestion_two_"+borlogmeterno).val('');
						$("#suggestion_three_"+borlogmeterno).val('');
						$("#sugg_div_"+borlogmeterno).hide();
						$(".wrapper-borlog").hide();
						new_id.push(borlogmeterno);
					}
					
					$( '#insertion_id').val(obj.form_id);
					$( '#search_result_hidden').val('1');
					nextloc = false;
					initial_save = false;
				}else{
					nextloc = true;
					$.notify("No record Found.", "error");
					initial_save = false;
				
				}
				callback();
			},
			error:function(){
				// failed request; give feedback to user
				$.notify("Technical Error occured. Please try again later.", "error");
				
			}
		});
	
	}
	function validate(evt) {
		var theEvent = evt || window.event;
		var key = theEvent.keyCode || theEvent.which;
		key = String.fromCharCode( key );
		var regex = /[0-9\b]|\./;
		if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}
	
	function delete_borlog(id){
		$("#dialog_confirm").show();
		$("#dialog_confirm").dialog({
			resizable: false,
			modal: true,
			title: "Delete Borlog",
			height: 220,
			width: 300,
			buttons: {
				"Yes": function () {
					$(this).dialog('close');
					$("#dialog_confirm").hide();
					deleteBorlog(id);
				},
					"No": function () {
					$(this).dialog('close');
					$("#dialog_confirm").hide();
					
				}
			}
		});
	}
	
	function deleteBorlog(meter_id){
		var insert_id = $('#insertion_id').val();
		var loca_id   = $('#update_timeinterval').val();
		if(insert_id != ""){
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action: 'delete_borlog',
					form_id: insert_id,
					locationid: loca_id,
					meter_id: meter_id,
				},
				beforeSend:function(){	
					$("#loader").show();			
				},
				complete: function (o, s) {
					$("#loader").hide();
				},
				success:function(data){
					//alert(data);
					var obj = $.parseJSON( data );
					
					if(obj.status == "deleted"){
						$.notify("Borlog note deleted successfully.", "success");
						$("#borelog_section_"+meter_id).remove();
						
						var index = new_id.indexOf(meter_id);
						if (index > -1) {
							new_id.splice(index, 1);
						}
					}else{
						$.notify("Error Occured.", "error");
					
					}
				},
				error:function(){
					// failed request; give feedback to user
					$.notify("Technical Error occured. Please try again later.", "error");
					
				}
			});
		}else{
			
			$("#borelog_section_"+meter_id).remove();
			var index = new_id.indexOf(meter_id);
			if (index > -1) {
				new_id.splice(index, 1);
			}
			
		}
	}
	
	setInterval( function() {
		if ( !initial_save ) {
			var image_data = "";
			var call = true;
			$.each($('.ImageFile'), function(){
				if($(this).val() != ""){
					call = false;
					valid_image_saved();
				}
			});
			if(call){
				save_draft(image_data); 
			}
		} }, 5000 );
		
	function sleep(milliseconds) {
		var start = new Date().getTime();
		for (var i = 0; i < 1e7; i++) {
			if ((new Date().getTime() - start) > milliseconds){
				break;
			}
		}
	}
</script>
</html>
