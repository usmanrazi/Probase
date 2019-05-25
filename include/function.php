<?php
require ("../config.php");

if($_POST['action'] == "login_users"){
	$name = $_POST['username'];
	$password = $_POST['password'];
	$data = array();
	$query = "SELECT * FROM users WHERE username = '$name' AND password = '$password'";
	$result = mysql_query($query);
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		
		$id = $row['userid'];
		$level = $row['userlevel'];
		$username = $row['username'];
		session_start();
		$_SESSION['userid'] = $id;
		$_SESSION['userlevel'] = $level;
		$_SESSION['username'] = $username;
		
		$data['userid'] = $id;
		$data['level'] = $level;
		if($level=="Admin") {
			$data['status'] = "admin";
		}
		else {
			$data['status'] = "user";
		}
	}
	if(empty($data)){
		$data['status'] = "error";
	}
	
	echo json_encode($data);
}

if($_POST['action'] == "form_data"){
	
	$probaseform 		= array();
	parse_str($_POST['probaseform'], $probaseform);
	
	$test_location 		= $_POST['test_location'];
	$client 			= $probaseform['client']; //Outputs 'meeting'
	$job_name 			= $probaseform['job_name']; 
	$address 			= $probaseform['address']; 
	$job_no 			= $probaseform['job_no'];
	$month 				= $probaseform['month']; 
	$days 				= $probaseform['days']; 
	$year 				= $probaseform['year'];
	$date 				= $month."-".$days."-".$year;
	$tested_by 			= $probaseform['tested_by']; 
	$message 			= $probaseform['message'];
	$insertion_id		= $probaseform['insertion_id'];
	$update_timeinterval = $probaseform['update_timeinterval'];
	$location_changed_form = $probaseform['location_changed'];
	$location_changed	= $_POST['location_changed'];
	$calibration		= $_POST['calibration'];
	
	$updation = 1;
	
	if($insertion_id == ""){
		$query_id_max = "SELECT MAX(`id`) as id FROM probasform";
		$result_id_max = mysql_query($query_id_max);
		$insertion_id = "";
		while ($row = mysql_fetch_array($result_id_max, MYSQL_ASSOC)) {
			$insertion_id = $row['id'];
			if($insertion_id == ""){
				$insertion_id = 1;
			}else{
				$insertion_id = $insertion_id + 1;
			}
		}
		$updation = "";
	}else if($location_changed == 1){
		$updation = "";
	}else if($location_changed_form == 1){
		$updation = "";
	}
	
	$query_locid_max = "SELECT MAX(`locationid`) as locationid FROM probasform WHERE id = '$insertion_id'";
	$result_locid_max = mysql_query($query_locid_max);
	$locationid	= "";
	while ($row = mysql_fetch_array($result_locid_max, MYSQL_ASSOC)) {
		$locationid = $row['locationid'];
		if($locationid == ""){
			$locationid = 1;
		}else{
			$locationid = $locationid + 1;
		}
	}
		
	$blownumber 		= array();
	$blownumber 		= $_POST['blownumber'];
	
	$count_array = count($blownumber);
	$valueno = 0;
	$no_of_blows = '';
	for($i=0; $i < $count_array; $i++){
		
		$no_of_blows .= $blownumber[$valueno];
		if($valueno != $count_array){
			$no_of_blows .= ",";
		}
		$valueno++;
	}
	//echo $no_of_blows;
	
	$underailedform_start = array();
	$underailedform_start = $_POST['underainedform_start'];
	$filter = array_filter($underailedform_start);
	$count_array_underained = count($underailedform_start);
	$underained_start = '';
	$valueno_underained = 0;
	if(!empty($filter)){
		for($i=0; $i < $count_array_underained; $i++){
			$underained_start .= $underailedform_start[$valueno_underained];
			if($valueno_underained != $count_array_underained){
				$underained_start .= ",";
			} 
			$valueno_underained++;
		}
	}
	
	$underailedform_end = array();
	$underailedform_end = $_POST['underainedform_end'];
	$filter_end = array_filter($underailedform_end);

	$count_array_underained_end = count($underailedform_end);
	$valueno_underained_end = 0;
	$underained_end = '';
	if(!empty($filter_end)){
		for($i=0; $i < $count_array_underained_end; $i++){
			$underained_end .= $underailedform_end[$valueno_underained_end];
			if($valueno_underained_end != $count_array_underained_end){
				$underained_end .= ",";
			} 
			$valueno_underained_end++;
		}
	}
	
	session_start();
	$userid = $_SESSION['userid'];
	//echo $underained_end;
	//,'borelognote','suggestionone','suggestiontwo','suggestionthree'
	$data 		= array();
	$query 		= NULL;
	if ( $updation != "" ) {
		
		$query = "UPDATE probasform SET
					`testlocation` 			= '$test_location',
					`client` 				= '$client' ,
					`jobname` 				= '$job_name',
					`address` 				= '$address',
					`date` 					= '$date',
					`testedby` 				= '$tested_by',
					`projectnote` 			= '$message',
					`noofblows` 			= '$no_of_blows',
					`undrainedfrom` 		= '$underained_start',
					`undrainedto` 			= '$underained_end',
					`calibration`			= '$calibration'
					
					WHERE `locationid` = $update_timeinterval AND `id` = '$insertion_id'
				";
	} else {
		
		$query = "INSERT INTO probasform 
				(`id`,`userid`,`locationid`,`testlocation`,`client`,`jobname`,
				`address`,`jobno`,`date`,`testedby`,
				`projectnote`,`noofblows`,`undrainedfrom`,
				`undrainedto`,`calibration`)
				
				VALUES
				
				('$insertion_id','$userid','$locationid','$test_location','$client','$job_name',
				'$address','$job_no','$date','$tested_by',
				'$message','$no_of_blows','$underained_start',
				'$underained_end','$calibration')
				";
	}
	
	if(mysql_query($query)){
		if ( $updation != "" ) {
			$data['updation_id'] 	= $insertion_id;
			$data["status"] 		= "updated";
		} else {
			$data['inserted_id'] 	= $insertion_id;
			$data['locationid'] 	= $locationid;
			$data["status"] 		= "inserted";
		}
	}else{
		$data["status"] = "error";
	}
	
	if ( $updation == "" ) {
	
		$borlog_textarea = array();
		$image_data = array();
		
		$borlog_textarea = json_decode($_POST['borlog_textarea']);
		$image_data = "";
		if($_POST['image_data'] != ""){
			$image_data = json_decode($_POST['image_data']);
		}
		
		$inserted_data = array();
		if($borlog_textarea != ""){
			foreach($borlog_textarea as $borlog_value){
				$bortext_meter_no = $borlog_value->meter_no;
				$bortext_value = $borlog_value->value;

				if($image_data != ""){
					foreach($image_data as $image_values){
						$image_meterno = $image_values->meter_no;
						if($image_meterno == $bortext_meter_no){
							$image_value_equal = $image_values->image_name;
						}
					}
				}
				

				$query_borlog = "INSERT INTO borlog 
						(`formid`,`jobno`,`locationid`,`borlogmeterno`,`imagename`,`borlognote`)
						
						VALUES
						
						('$insertion_id','$job_no','$locationid','$bortext_meter_no','$image_value_equal','$bortext_value')
						";
				
				if(mysql_query($query_borlog)){
					$data["status-borlog"] = "inserted";
				}else{
					$data["status-borlog"] = "error";
				}
				
			}
		}
	}else{
		$borlog_textarea = array();
		$image_data = array();
		
		$borlog_textarea = json_decode($_POST['borlog_textarea']);
		$image_data = "";
		if($_POST['image_data'] != ""){
			$image_data = json_decode($_POST['image_data']);
		}
		foreach($borlog_textarea as $borlog_value){
			$bortext_meter_no = $borlog_value->meter_no;
			$bortext_value = $borlog_value->value;
			
			$image_value_equal = "";
			if($image_data != ""){
				foreach($image_data as $image_values){
					$image_meterno = $image_values->meter_no;
					if($image_meterno == $bortext_meter_no){
						$image_value_equal = $image_values->image_name;
					}
				}
			}
			
			$i = 0;
			$new_borlog = array();
			$query_newborlog = "SELECT `borlogmeterno` FROM borlog WHERE `jobno` = $job_no AND `locationid` = $update_timeinterval";
			$result_newborlog = mysql_query($query_newborlog);
			while ($row_new = mysql_fetch_array($result_newborlog, MYSQL_ASSOC)) {
				$new_borlog[$i] = $row_new['borlogmeterno'];
				$i++;
			}
			
			if(in_array($bortext_meter_no, $new_borlog)){
				$query_borlog = "UPDATE borlog SET 
					`borlognote` 	= '$bortext_value'";
					
				if($image_value_equal != ""){
					$query_borlog .= ", `imagename` 	=  '$image_value_equal'";
				}
				$query_borlog .= "WHERE `jobno` = $job_no AND `borlogmeterno` = $bortext_meter_no AND `locationid` = $update_timeinterval";
					
				if(mysql_query($query_borlog)){
					$data["status-borlog"] = "updated";
				}else{
					$data["status-type"] = "updated";
					$data["status-borlog"] = "error";
				}
			}else{
				$query_borlog = "INSERT INTO borlog 
						(`formid`,`jobno`,`locationid`,`borlogmeterno`,`borlognote`";
						if($image_value_equal != ""){
							$query_borlog .= ",`imagename`)"; 
						}else{
							$query_borlog .= ") ";
						}
						
				$query_borlog .= "VALUES
						
						('$insertion_id','$job_no','$update_timeinterval','$bortext_meter_no','$bortext_value'";
				if($image_value_equal != ""){
					$query_borlog .= ",$image_value_equal)"; 
				}else{
					$query_borlog .= ")";
				}
				
				if(mysql_query($query_borlog)){
					$data["status-borlog"] = "inserted";
				}else{
					$data["status-type"] = "inserted";
					$data["status-borlog"] = "error";
				}
			
			}
		}
	}
	echo json_encode($data);
}

if($_POST['action'] == 'get_jobno'){
	$data = array();
	$query = "SELECT MAX(`jobno`) FROM probasform";
	$result = mysql_query($query);
	
		while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
			
			$job_no = $row[0];
			$data['job_no'] = $job_no;
			$data['job_value'] = "max";
			
			//print_r($row);
		}
		if(empty($data['job_no'])){
			$data['job_no'] = 1;
			$data['job_value'] = "first";
		}
		
	echo json_encode($data);
}

if($_POST['action'] == 'search_result'){
	session_start();
	$userid = $_SESSION['userid'];
	$data = array();
	$search_text = strtolower($_POST['search_text']);
	if(is_numeric($search_text)){
		$query = "SELECT * FROM probasform WHERE `userid` = '$userid' AND `jobno` = '$search_text'"; 
		$result = mysql_query($query);
		$i =0 ;
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$form_id = $row['id'];
			$address = $row['address'];
			$date = $row['date'];
			$locationid = $row['locationid'];
			
			$data[$i]['form_id'] = $form_id;
			$data[$i]['address'] = $address;
			$data[$i]['date'] = $date;
			$data[$i]['locationid'] = $locationid;
			$data[$i]['found'] = "found";
			$data[$i]['job_no'] = "job no";
			$i++;
			//print_r($row);
		}
		if(empty($data)){
			$data['found'] = "not found";
			$data['job_no'] = "job no";
		}
		
	}else{
		$query = "SELECT * FROM probasform WHERE `userid` = '$userid' AND (`address` LIKE '%$search_text%' OR `client` LIKE '%$search_text%' OR `testedby` LIKE '%$search_text%' OR `jobname` LIKE '%$search_text%' )"; 
		$result = mysql_query($query);
		$i = 0;
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$form_id = $row['id'];
			$address = $row['address'];
			$date = $row['date'];
			$locationid = $row['locationid'];
			
			$data[$i]['form_id'] = $form_id;
			$data[$i]['address'] = $address;
			$data[$i]['date'] = $date;
			$data[$i]['locationid'] = $locationid;
			$data[$i]['found'] = "found";
			$i++;
			//print_r($row);
		}
		if(empty($data)){
			$data['found'] = "not found";
		}
		
	}
	echo json_encode($data);
}

if($_POST['action'] == "saved_result"){
	session_start();
	$userid = $_SESSION['userid'];
	$data = array();
	
	$query = "SELECT * FROM probasform WHERE `userid` = '$userid' AND `export` = '0'"; 
	$result = mysql_query($query);
	$i = 0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	
		$form_id = $row['id'];
		$address = $row['address'];
		$date = $row['date'];
		$locationid = $row['locationid'];
		
		$data[$i]['form_id'] = $form_id;
		$data[$i]['address'] = $address;
		$data[$i]['date'] = $date;
		$data[$i]['locationid'] = $locationid;
		$data[$i]['status'] = "ok";
		$i++;
		//print_r($row);
	}
	if(empty($data)){
		$data['status'] = "error";
	}
	echo json_encode($data);
}

if($_POST['action'] == "form_detail"){
	session_start();
	$userid = $_SESSION['userid'];
	
	$form_id = $_POST['form_id'];
	$locationid = $_POST['locationid'];
	
	$data = array();
	$query = "SELECT * FROM probasform WHERE `id` = '$form_id' AND `userid` = '$userid' AND `locationid` = '$locationid'"; 
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	
		$data['form_id'] = $row['id'];
		$data['testlocation'] = $row['testlocation'];
		$data['locationid'] = $row['locationid'];
		$data['client'] = $row['client'];
		$data['jobname'] = $row['jobname'];
		$data['address'] = $row['address'];
		$data['jobno'] = $row['jobno'];
		$data['date'] = $row['date'];
		$data['testedby'] = $row['testedby'];
		$data['projectnote'] = $row['projectnote'];
		$data['noofblows'] = $row['noofblows'];
		$data['calibration'] = $row['calibration'];
		
		if($row['undrainedfrom'] != "0"){
			$data['undrainedfrom'] = $row['undrainedfrom'];
		}else{
			$data['undrainedfrom'] = "";
		}
		if($row['undrainedto'] != "0"){
			$data['undrainedto'] = $row['undrainedto'];
		}else{
			$data['undrainedto'] = "";
		}
		
		$data['status'] = "ok";
		
	
	}
	if(empty($data)){
		$data['status'] = "error";
	}
	
	$query_borlog = "SELECT * FROM borlog WHERE `formid` = '$form_id' AND `locationid` = '$locationid' ORDER BY `borlogmeterno` ASC";
	$result_borlog = mysql_query($query_borlog);
	$data['borlog'] = array();
	$borlog_data = array();
	$i = 0;
	while ($row_borlog = mysql_fetch_array($result_borlog, MYSQL_ASSOC)) {
		
		$borlog_data['borlogid'] = $row_borlog['borlogid'];
		$borlog_data['formid'] = $row_borlog['formid'];
		$borlog_data['jobno'] = $row_borlog['jobno'];
		$borlog_data['locationid'] = $row_borlog['locationid'];
		$borlog_data['borlogmeterno'] = $row_borlog['borlogmeterno'];
		$borlog_data['imagename'] = $row_borlog['imagename'];
		$borlog_data['borlognote'] = $row_borlog['borlognote'];
		
		$data['borlog'][$i] = $borlog_data;
		$i++;
	}
	if(empty($borlog_data)){
		$data['status_borlog'] = "no record found";
	}
	echo json_encode($data);
}

if($_POST['action'] == "searhnext_location"){

	session_start();
	$userid = $_SESSION['userid'];
	
	$locationid = $_POST['locationid'];
	$form_id = $_POST['form_id'];
	
	$data = array();
	$query = "SELECT * FROM probasform WHERE `id` = '$form_id' AND `userid` = '$userid' AND `locationid` = '$locationid'"; 
	$result = mysql_query($query);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	
		$data['form_id'] = $row['id'];
		$data['locationid'] = $row['locationid'];
		$data['noofblows'] = $row['noofblows'];
		
		if($row['undrainedfrom'] != "0"){
			$data['undrainedfrom'] = $row['undrainedfrom'];
		}else{
			$data['undrainedfrom'] = "";
		}
		if($row['undrainedto'] != "0"){
			$data['undrainedto'] = $row['undrainedto'];
		}else{
			$data['undrainedto'] = "";
		}
		
	
		$data['status'] = "ok";

	}
	if(empty($data)){
		$data['status'] = "error";
	}
	
	$query_borlog = "SELECT * FROM borlog WHERE `formid` = '$form_id' AND `locationid` = '$locationid' ORDER BY `borlogmeterno` ASC ";
	$result_borlog = mysql_query($query_borlog);
	$data['borlog'] = array();
	$borlog_data = array();
	$i = 0;
	while ($row_borlog = mysql_fetch_array($result_borlog, MYSQL_ASSOC)) {
		
		$borlog_data['borlogid'] = $row_borlog['borlogid'];
		$borlog_data['formid'] = $row_borlog['formid'];
		$borlog_data['jobno'] = $row_borlog['jobno'];
		$borlog_data['locationid'] = $row_borlog['locationid'];
		$borlog_data['borlogmeterno'] = $row_borlog['borlogmeterno'];
		$borlog_data['imagename'] = $row_borlog['imagename'];
		$borlog_data['borlognote'] = $row_borlog['borlognote'];
		
		$data['borlog'][$i] = $borlog_data;
		$i++;
	}
	if(empty($borlog_data)){
		$data['status_borlog'] = "no record found";
	}
	
	echo json_encode($data);

}

if($_POST['action'] == "get_borlognote"){
	$data = array();
	$query = "SELECT borlognote FROM borlog"; 
	$result = mysql_query($query);
	$i = 0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$data[$i] = $row['borlognote'];
		$i++;
	}
	if(empty($data)){
		$data['status'] = "error";
	}
	echo json_encode($data);
}

if($_POST['action'] == "get_allclient"){
	$data = array();
	$query = "SELECT client FROM probasform"; 
	$result = mysql_query($query);
	$i = 0;
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		//$data[$i] = $row['client'];
		if(!in_array($row['client'], $data)){
			$data[$i] = $row['client'];
			$i++;
		}
		
	}
	if(empty($data)){
		$data['status'] = "error";
	}
	echo json_encode($data);
}

if($_POST['action'] == "form_export_data"){
	$form_data 	= array();
	parse_str($_POST['probaseform'], $form_data);
	$insertion_id  =  $form_data['insertion_id'];
	$job_no  =  $form_data['job_no'];
	
	session_start();
	$userid = $_SESSION['userid'];
	$data = array();
	
	$query = "SELECT `noofblows`, `locationid` FROM probasform WHERE `id` = '$insertion_id' AND `userid` = '$userid' AND `jobno` = '$job_no'"; 
	$result = mysql_query($query);
	$i = 0;
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

		$data[$i]['locationid'] = $row['locationid'];
		$data[$i]['noofblows'] = $row['noofblows'];	
		$data[$i]['status'] = "ok";
		$i++;
	}
	if(empty($data)){
		$data['status'] = "error";
	}
	echo json_encode($data);
}


if($_POST['action'] == "pdf_data"){

	require ("../mpdf57/mpdf.php");
	
	session_start();
	$userid = $_SESSION['userid'];
	
	$probaseform 		= array();
	parse_str($_POST['probaseform'], $probaseform);
	$graph_html = json_decode($_POST['graph_html']);
	
	$job_no 			= $probaseform['job_no'];
	$insertion_id		= $probaseform['insertion_id'];
	
	
	$query = "SELECT * FROM probasform WHERE `id` = '$insertion_id' AND `userid` = '$userid' AND `jobno` = '$job_no'"; 
	$result = mysql_query($query);
	$i = 0;
	$f = 0;
	$files = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

		$client = $row['client'];
		$job_name = $row['jobname'];
		$address = $row['address'];
		$projectnote = $row['projectnote'];
		$date = $row['date'];
		$tested_by = $row['testedby'];
		$test_location = $row['testlocation'];
		$test_location_array = explode(" ", $test_location);
		$location_no = $test_location_array[2];
		
		$noofblows = $row['noofblows'];
		$blownumber = explode(",",$noofblows);
		$count_array = count($blownumber);
		
		$undrainedfrom = $row['undrainedfrom'];
		$underailedform_start = explode(",",$undrainedfrom);
		$count_array_underained = count($underailedform_start);
		
		$undrainedto = $row['undrainedto'];
		$underailedform_end = explode(",",$undrainedto);
		$count_array_underained_end = count($underailedform_end);
		
		$calibration = $row['calibration'];
	

	//$graph_html 		= $_POST['graph_html'];
	
		$data_image = "";
		$query_image = "SELECT * FROM borlog WHERE `formid` = '$insertion_id' AND `jobno` = $job_no AND `locationid` = $location_no ORDER BY `borlogmeterno` ASC";
		$result_image = mysql_query($query_image);
		$num_rows = mysql_num_rows($result_image);
		$i = 0;
		$k = 0;
		$display_image = array();
		$borlog_textarea = array();
		while ($row = mysql_fetch_array($result_image, MYSQL_ASSOC)){
			$i++;
			$imagename = $row['imagename'];
			$borlogmeterno = $row['borlogmeterno'];
			$borlognote = $row['borlognote'];
			$borlog_textarea[$k]['borlogmeterno'] = $borlogmeterno;
			$borlog_textarea[$k]['borlognote'] = $borlognote;
			$borlog_textarea[$k]['imagename'] = $imagename;
			
			if($imagename != ""){
				$display_image[$i] = $imagename;
				//$image_name_explode = explode("-", $imagename);
				//$image_name =  $image_name_explode[2];
				$data_image .= $imagename;
				if($i != $num_rows){
					$data_image .= ", ";
				}
			}
			
			$k++;
		}
		if(empty($data_image)){
			$data_image = "";
		}
		
		
		
		//echo $data_image;
		// This must be defined before including mpdf.php file
		// Change these if necessary to the name of font files you can access from JPGraph
		define("_TTF_FONT_NORMAL", 'arial.ttf');
		define("_TTF_FONT_BOLD", 'arialbd.ttf');
		
		
		$mpdf = new mPDF('', array(250,350));
	
		ob_start();
		$html = "<table cellspacing='0' cellpadding='0'  style='border-spacing: 0; border-collapse:collapse; font-family:Arial, Helvetica, sans-serif; border:2px solid #000;' width='80%' align='center'>
					<tr style='border:2px solid #000;'>
						<td style='padding:15px 0;' colspan='2' valign='top' align='center'>
							<img src='../images/logo.jpg' alt='' />
						</td>
					</tr>
					
					<tr style='border:2px solid #000;vertical-align: top;'>
						<td width='70%'>
							<table cellspacing='0' cellpadding='0'  style='border-spacing: 0; border-collapse:collapse;  padding:5px 0 0 10px;'>
						   
								<tr>
									<td style='font-size:18px; padding:5px 0;' >CLIENT:</td>
									<td style='padding:5px 0; font-size:21px;' >$client</td>
								</tr>
								
								<tr>
									<td style='padding:5px 0; font-size:18px;' >Job Name:</td>
									<td style='padding:5px 0; font-size:21px;' >$job_name</td>
								</tr>
								
								 <tr>
									<td style='padding:5px 0; font-size:18px;' >Address</td>
									<td style='padding:5px 0; font-size:21px;' >$address</td>
								</tr>
								
								 <tr>
									<td style='padding:5px 0;font-size:18px;' >Note</td>
									<td style='font-size:21px; padding:5px 0;' >$projectnote</td>
								</tr>

							</table>
						</td>
						<td>
							<table cellspacing='0' cellpadding='0' style='border-spacing: 0; border-collapse:collapse;'  >
								<tr style='vertical-align: top;'>
									<td>
										<table cellspacing='0' cellpadding='0' style='border-spacing: 0; border-collapse:collapse; border-right:2px solid #000; border-left:1px solid #000;'>
											<tr>
												<td style='padding:0px 20px 5px 5px; font-size:18px;'>Job No:</td>
											</tr>
											<tr>
												<td style='padding:5px 20px 5px 5px; font-size:18px;' >Date:</td>
											</tr>
											<tr>
												<td style='padding:5px 19px 12px 5px; font-size:18px;' >Tested By:</td>
											</tr>
										</table>
									</td>
									<td>
										<table cellspacing='0' cellpadding='0' style='border-spacing: 0; border-collapse:collapse;' >
											<tr>
												<td style='padding:5px 0; font-size:21px;' >$job_no</td>
											</tr>
											<tr>
												<td style='padding:5px 0; font-size:21px;' >$date</td>
											</tr>
											<tr>
												<td style='padding:3px 0; font-size:21px;' >$tested_by</td>
											</tr>
										</table>  
									</td>
								</tr>
							</table>
							<table cellspacing='0' cellpadding='0'  style='border-spacing: 0; border-collapse:collapse; border-top:2px solid #000; width:100%'>
								<tr style='vertical-align: top;'>
									<td width='100%' style='border-left:1px solid #000; padding:5px 19px 20px 10px; font-size:25px; text-transform:uppercase;'>Test </td>
									<td style='font-size:25px;'>$location_no</td>
								</tr>
							</table>
						</td>
					</tr>
			</table>";
			
			$html .= "<table cellspacing='0' cellpadding='0' style='border-spacing: 0; border-collapse:collapse; font-family:Arial, Helvetica, sans-serif; margin:0 auto; padding:0;' width='80%' align='center'>
						<tr style='border-right: 3px solid #000; border-left: 4px solid #000; border-bottom: 3px solid #000; '>";
							
			$html .=		"<td style='vertical-align: top;' width='6%' >
								<table style='width:100%;border-right: 1px solid;border-spacing: 0px;'>
									<tr style='font-size:14px;'>
										<td style='padding:0 5px 0 5px; border-bottom:1px solid #000;'>Depth<br /><br />(m)</td>
										<td style='border-left:1px solid #000; border-bottom:1px solid #000; padding-left:5px; padding-bottom: 12px;'><br />No<br />of<br />Blows</td>
									</tr> ";
				$depth = 0.5;
				$index = 0;
				for($i=0; $i<9; $i++){
					
						$blow_first = $blownumber[$index];
						$blow_second = $blownumber[$index+1];
						$blow_third = $blownumber[$index+2];
						$blow_forth = $blownumber[$index+3];
						$blow_fifth = $blownumber[$index+4];
						
						
							$html   .=    	"<tr style=''>
													<td style='font-size:18px; border-bottom:1px solid #000; text-align:right;'>$depth</td>
													<td style='padding: 0;'>
														<table cellpadding='0' cellspacing='0' width='100%' style='border-spacing: 0; border: 0; border-collapse: collapse; border-left: 1px solid;'>
															<tr>
																<td style='font-size:18px; border-bottom:1px solid #000; width:57px; border-left:1px solid #000; text-align:center; height:15.5px; margin-bottom:1px;'>$blow_first</td>
															</tr>
															<tr>
																<td style='font-size:18px; border-bottom:1px solid #000; border-top:1px solid #000; width:57px; border-left:1px solid #000; text-align:center; height:15.5px; margin-bottom:1px;'>$blow_second</td>	
															</tr>
															<tr>
																<td style='font-size:18px; border-bottom:1px solid #000; border-top:1px solid #000; width:57px; border-left:1px solid #000; text-align:center; height:15.5px; margin-bottom:1px;'>$blow_third</td>
															</tr>
															<tr>
																<td style='font-size:18px; border-bottom:1px solid #000; border-top:1px solid #000; width:57px; border-left:1px solid #000; text-align:center; height:15.5px; margin-bottom:1px;'>$blow_forth</td>
															</tr>
															<tr>
																<td style='font-size:18px; border-bottom:1px solid #000; border-top:1px solid #000; width:57px; border-left:1px solid #000; text-align:center; height:15.5px; margin-bottom:1px;'>$blow_fifth</td>
															</tr>
															
														</table>
													</td>
												</tr>";
					
					$depth = $depth + 0.5;
					$index = $index + 5;				
				}
									
				$html .=	"</table>   
							</td>";
							
						foreach($graph_html as $graph){
							if($location_no == $graph->locationid){
								$graph_html_dispaly = $graph->graph;
							}
						}	
				$html .=	"<td style='border-right:1px solid #000; vertical-align: top;' width='7%'>
								$graph_html_dispaly
							</td>";
							
				$html .=    "<td style='border-right:1px solid #000; border-top:none !important; vertical-align: top;' width='90%'>
								<table cellspacing='0' cellpadding='0' style='border-spacing: 0; border: 0;border-collapse:collapse; border-top:none !important; '>
									<tr>
										<td>
											<table cellspacing='0' cellpadding='0' style='border-spacing: 0; border: 0;border-collapse:collapse; '>
												<tr>
													<td style='font-size:27px; height:33px;'>
														SOIL DESCIPTION
													</td>
													<td style='width:63px;'></td>
													<td style='border-left:1px solid #000;height:33px;' align='right'></td>
												</tr>
											</table>
										</td>
										
									</tr>";
				if($borlog_textarea != ""){
					$loop = count($borlog_textarea);
					$counter = 1;
					for($i=0; $i<$loop; $i++){
						
						$borlogmeterno = $borlog_textarea[$i]['borlogmeterno'];
						$borlognote = $borlog_textarea[$i]['borlognote'];
						$imagename = $borlog_textarea[$i]['imagename'];
						$bor = $borlogmeterno - $counter;
						for($j=0; $j<$bor; $j++){
							$html .=    "<tr>
												<td style='border-top:1px solid #000; width:665px; text-align:center; height:15.8px;'>
													
												</td> 
											</tr>";
						}
						$html .=    "<tr>
											<td style='font-size:21px;border-top:1px solid #000; width:665px; text-shadow:none; text-align:left; height:15.62px;'>
												$borlognote $imagename
											</td>
										</tr>";
						$counter = $borlogmeterno + 1;
					}
				}           
				$html .=    "<tr>
										<td>
											<table style='border-top:1px solid #000;'  width='100%' cellspacing='0'>
												<tr>
													<td style=' width:100%; padding:5px 0 0 0; font-size:18px; '>
														
													</td>
													
												</tr>
											</table>
										</td>
									</tr>
										
								</table>
							</td>

							<td style='vertical-align: top;'>
								<table style='width:105%;border-right: 1px solid;border-spacing: 0px;'>
									<tr style='font-size:14px;'>
										<td style='padding:0 5px 0 5px; border-bottom:1px solid #000;'>Depth<br /><br />(m)</td>
										<td style='border-left:1px solid #000; border-bottom:1px solid #000; padding-left:5px;'><br />UNDRAINED SHEAR <br />(kPa)</td>
									</tr>";
				
				$depth = 0.5;
				$index = 0;
				
				for($i=0; $i<9; $i++){
					

						$under_first = $underailedform_start[$index];
						$under_second = $underailedform_start[$index+1];
						$under_third = $underailedform_start[$index+2];
						$under_forth = $underailedform_start[$index+3];
						$under_fifth = $underailedform_start[$index+4];
						
						
						$under_first_end = $underailedform_end[$index];
						$under_second_end = $underailedform_end[$index+1];
						$under_third_end = $underailedform_end[$index+2];
						$under_forth_end = $underailedform_end[$index+3];
						$under_fifth_end = $underailedform_end[$index+4];
						
						
					
							$underained_first = ($under_first * $calibration).'/'.($under_first_end * $calibration);
							if($underained_first == '0/0')
							{
								$underained_first = '';
							}
						
							$underained_second = ($under_second * $calibration).'/'.($under_second_end * $calibration);
							if($underained_second == '0/0')
							{
								$underained_second = '';
							}
						
							$underained_third = ($under_third * $calibration).'/'.($under_third_end * $calibration);
							if($underained_third == '0/0')
							{
								$underained_third = '';
							}
					
							$underained_forth = ($under_forth * $calibration).'/'.($under_forth_end * $calibration);
							if($underained_forth == '0/0')
							{
								$underained_forth = '';
							}
					
							$underained_fifth = ($under_fifth * $calibration).'/'.($under_fifth_end  * $calibration);
							if($underained_fifth == '0/0')
							{
								$underained_fifth = '';
							}
						
						
						$html .=   "<tr style=''>
										<td style='font-size:18px; border-bottom:1px solid #000; text-align:right;'>$depth</td>
										<td style='padding: 0;'>
											<table cellpadding='0' cellspacing='0' width='100%' style='border-spacing: 0; border: 0; border-collapse: collapse; border-left: 1px solid;'>
												<tr>
													<td style='font-size:18px; border-bottom:1px solid #000; width:88px; border-left:1px solid #000; text-align:center; height:15.62px;'>$underained_first</td>
												</tr>
												<tr>
													<td style='font-size:18px;border-bottom:1px solid #000; border-top:1px solid #000; width:88px; border-left:1px solid #000; text-align:center; height:15.62px;'>$underained_second</td>
													
												</tr>
												<tr>
													<td style='font-size:18px; text-align:center; border-bottom:1px solid #000; border-top:1px solid #000; width:88px; border-left:1px solid #000; height:15.62px;'>$underained_third</td>
												</tr>
												<tr>
													<td style='font-size:18px; border-bottom:1px solid #000; border-top:1px solid #000; width:88px; border-left:1px solid #000; text-align:center; height:15.62px;'>$underained_forth</td>
												</tr>
												<tr>
													<td style='font-size:18px; text-align:center; border-top:1px solid #000; width:88px; border-bottom:1px solid #000;  border-left:1px solid #000; height:15.62px;'>$underained_fifth</td>
												</tr>
												
											</table>
										</td>
									</tr>";
					
					$index = $index + 5;
					$depth = $depth + 0.5;
						
				}
				
					$html .=    "</table>
							</td>
						</tr>
					 </table>";
				/*  echo $html;
				die;  */ 
		$file = "sample".time().".pdf";
		$mpdf->WriteHTML($html);
		if($display_image != ""){
			$mpdf->AddPage();
			$html_image = "<table style=''>";
			
			foreach($display_image as $dis_img){
				
				$html_image .= "<tr>
									<td >
										<img src='../uploads/$dis_img' alt='' />
									</td>
								</tr>
								<tr>
									<td>
										$dis_img
									</td>
								</tr>";
			}
			$html_image .= "</table>";
			$mpdf->WriteHTML($html_image);
		}
		$mpdf->debug = true;
		$mpdf->Output($file, 'F');

		//$content = ob_get_contents();
		$files[$f]['filename'] = $file;
		
		sleep(3);
		
		$update_export = "UPDATE probasform SET `export` = '1' WHERE `userid` = $userid AND `id` = '$insertion_id' AND `jobno` = $job_no AND `locationid` = $location_no ";
		if(mysql_query($update_export)){
			$files[$f]['status'] = 'export';
		}else{
			$files[$f]['status'] = 'error';
		}
		//ob_end_clean();
		//echo $content;
		//exit;
		$f++;
	}
	$user_email_query = "SELECT `email` FROM users WHERE `userid` = $userid";
	$email_query_result = mysql_query($user_email_query);
	while ($row = mysql_fetch_array($email_query_result, MYSQL_ASSOC)){
		$email = $row['email']; 
	}
	$to = $email;
	// subject
	$subject = 'Probase Form Pdf';
	$message = "Below is the link of pdfs. Click on the link to view the pdf" . "\r\n";
	foreach($files as $file_name){
		$filename = $file_name['filename'];
		$link = "http://sigmasqr.com/probase/include/".$filename;
		$message .= $link . "\r\n";
	}
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/plain; charset=utf-8\n' . "\r\n";
	
	$headers .= 'To: '.$email . "\r\n";
	$headers .= 'From: Probase <no-reply@probase.com>' . "\r\n";

	mail($to, $subject, $message, $headers);
	echo json_encode($files);
}


if($_POST['action'] == "add_user"){
	$form_data 	= array();
	parse_str($_POST['post_data'], $form_data);
	$username = $form_data['username'];
	$email = $form_data['email'];
	$password = $form_data['password'];
	$data = array();
	$query = "SELECT `username` FROM users WHERE `username` = '$username'";
	$result = mysql_query($query);
	$num_rows = mysql_num_rows($result);
	if($num_rows != '0'){
		$data['status'] = 'exist';
	}else{
		$query = "INSERT INTO users (`username`, `password`, `email`, `userlevel`) VALUES ('$username' , '$password', '$email', 'User')";
		if(mysql_query($query)){
			$data["status"] = "inserted";
		}else{
			$data["status"] = "error";
		}
	}
	echo json_encode($data);
}


if($_POST['action'] == "get_user"){
	$item_per_page = 5;
	$page_number = $_POST['page_number'];
	$position = ($page_number * $item_per_page);
	$query = "SELECT `userid`, `username`, `email` FROM users ORDER BY userid DESC LIMIT $position, $item_per_page";
	$result = mysql_query($query);
	$i = 0;
	$data = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$data[$i]['userid'] = $row['userid'];
		$data[$i]['username'] = $row['username'];
		$data[$i]['email'] = $row['email'];
		$data[$i]['status'] = "ok";
		$i++;
	}
	if(empty($data)){
		$data['status'] = "error";
	}
	echo json_encode($data);
}

if($_POST['action'] == "get_user_data"){
	$user_id = $_POST['user_id'];
	$query = "SELECT * FROM users WHERE `userid` = '$user_id'";
	$result = mysql_query($query);
	$data = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$data['userid'] = $row['userid'];
		$data['username'] = $row['username'];
		$data['email'] = $row['email'];
		$data['status'] = "ok";
	}
	if(empty($data)){
		$data['status'] = "error";
	}
	echo json_encode($data);
}

if($_POST['action'] == "update_user"){
	$form_data 	= array();
	parse_str($_POST['post_data'], $form_data);
	$username = $form_data['username'];
	$email = $form_data['email'];
	$password = $form_data['password'];
	$userid = $form_data['userid'];
	
	$data = array();
	$query = "UPDATE users SET
					`username` 			= '$username',
					`email` 			= '$email'";
					
			if($password != ""){
				$query .= ", `password` 	= '$password'";
			}	
			$query .= "	WHERE `userid` = $userid";
	if(mysql_query($query)){
		$data["status"] = "updated";
	}else{
		$data["status"] = "error";
	}
	echo json_encode($data);
}

if($_POST['action'] == "delete_user"){
	$userid = $_POST['user_id']; 
	$data = array();
	$query = "DELETE FROM users WHERE `userid`='$userid'";
	if(mysql_query($query)){
		$data["status"] = "deleted";
	}else{
		$data["status"] = "error";
	}
	echo json_encode($data);
}

if($_POST['action'] == "delete_borlog"){
	$meter_no = $_POST['meter_no'];
	$form_id = $_POST['form_id'];
	$locationid = $_POST['locationid'];
	$meter_id = $_POST['meter_id'];
	$data = array();
	$sql = "DELETE FROM borlog WHERE  `formid` =  '$form_id' AND  `locationid` =  '$locationid' AND  `borlogmeterno` =  '$meter_id'";
	if(mysql_query($sql)){
		$data["status"] = "deleted";
	}else{
		$data["status"] = "error";
	}
	echo json_encode($data);
}

?>