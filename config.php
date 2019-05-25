<?php
//defines
define ( "HOST" , "localhost" );
define ( "USER" , "user" );
define ( "PASSWORD" , "" );
define ( "DB" , "probase" );

//connection
$con = mysql_connect ( HOST , USER , PASSWORD );
// if connection not successfull
if ( !$con ) {
	
    die('Could not connect: ' . mysql_error());
	
}else{
	//select database
	mysql_select_db ( DB );
}
?>