<?php
//echo "got here 1";
if (isset($_POST['versid']))
{
	//echo "got here 2";
	$VersID = filter_input (INPUT_POST, 'versid', FILTER_SANITIZE_NUMBER_INT);
	$config = parse_ini_file('../private/software-updates.ini');
	$mysqli = new mysqli($config['servername'],$config['adminusername'],$config['adminpassword'],$config['database']);
		
	//Output any connection error
	//echo "got here 3";
	if ($mysqli->connect_error) 
	{		
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
		
	//echo "got here 4";
	$sql = "UPDATE Version
		SET DownloadCount = DownloadCount + 1
		WHERE id = ".$VersID;
	
	//echo "got here 5";
	if ($mysqli->query($sql) === TRUE)
	{	
		//print("yes");
	}
}
//echo "got here 6";
?>
