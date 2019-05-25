<?php
//uploadfile.php


$tmpImageFolder = $_SERVER['DOCUMENT_ROOT'].'/probase/uploads';
//print_r($_FILES);
foreach($_FILES as $key=>$value){
	$name = $key;
}
$id = explode("_",$name);
$value_id = $id[1];

$actualFileName = $_FILES[$name]['name'];
$ImageName 		= str_replace(' ','-',strtolower($_FILES[$name]['name'])); //get image name
$ImageSize 		= $_FILES[$name]['size']; // get original image size
$TempSrc	 	= $_FILES[$name]['tmp_name']; // Temp name of image file stored in PHP tmp folder
$ImageType	 	= $_FILES[$name]['type']; //get file type, returns "image/png", image/jpeg, text/plain etc.

//echo $ext = strtolower(pathinfo($_FILES['ImageFile']['name'], PATHINFO_EXTENSION));
//new filename based on time
$RandomNumber 	= rand(0, 999);
$newFileName = $value_id.'-'.$RandomNumber.'-'.$ImageName;

//retrieve uploaded file path (temporary stored by php engine)
$source = $_FILES[$name]['tmp_name'];

$dest = $tmpImageFolder.'/'.$newFileName;

	$result = array();
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $_FILES[$name]["name"]);
	$extension = end($temp);
	if ((($_FILES[$name]["type"] == "image/gif")
	|| ($_FILES[$name]["type"] == "image/jpeg")
	|| ($_FILES[$name]["type"] == "image/jpg")
	|| ($_FILES[$name]["type"] == "image/pjpeg")
	|| ($_FILES[$name]["type"] == "image/x-png")
	|| ($_FILES[$name]["type"] == "image/png"))
	&& in_array($extension, $allowedExts))
	{
		if ($_FILES[$name]["error"] > 0)
		{
			$result["status"] = "error";
			$result["msg"] = $_FILES[$name]["error"];
			//echo "Error: " . $_FILES["ImageFile"]["error"] . "<br>";
		}
		else
		{
			move_uploaded_file($_FILES[$name]["tmp_name"], $dest);
			$result["status"] = "upload";
			$result["imagename"] = $newFileName;
			$result["meter_no"] = $value_id;
			
			
		}
		
	}
	else
	{
		$result["status"] = "invalid";
		$result["msg"] = "Invalid file type";
		//echo "Invalid file";
	}
	echo json_encode($result);		

?>