<?php
if (isset($_POST['resource']) AND isset($_POST['beta']))
{
	$ResourceID = filter_input (INPUT_POST, 'resource', FILTER_SANITIZE_NUMBER_INT);
	$Beta = filter_input (INPUT_POST, 'beta', FILTER_SANITIZE_STRING);
	$BetaBoolean = $Beta != 'zzz';
	$Where = '';
	if ($BetaBoolean == 1)
	{
		$Where = "WHERE
			ResourceID = $ResourceID
			AND Beta = 0";
	}
	else
	{
		$Where = "WHERE
			ResourceID = $ResourceID";
	}
	
	$currTable = "None";

	$config = parse_ini_file('../private/software-updates.ini');
	$mysqli = new mysqli($config['servername'],$config['username'],$config['password'],$config['database']);
    
	//Output any connection error
	if ($mysqli->connect_error) 
	{
			die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
			
	$theSQL = "
		SELECT Name, Version, CreateDate, Active, Note, ID, Beta
		FROM 
			Version ".$Where." 
		ORDER BY CreateDate DESC
	";
	$results = $mysqli->query($theSQL);
	print "<div class=\"rTablePV\">";
	$n="odd";
	$nRecCount = 0;
	while($row = $results->fetch_assoc()) 
	{
		if (($nRecCount > 0) || ($row["Beta"] == 1))
		{			
			$Name     = $row["Name"];
			$Notes    = nl2br($row["Note"]);    
			$Created  = $row["CreateDate"];    
			$Version  = $row["Version"];    
			$VersID   = $row["ID"];  
			$Active = $row["Active"];
		
			if ($n=="odd")
			{
				print "<div class=\"rTableRowPVO rTableRowPV\">";
				$n="even";
			}
			else
			{				
				print "<div class=\"rTableRowPVE rTableRowPV\">";
				$n="odd";
			}
			print "<div class=\"rTableCell1PV\">$Name</div>";
			print "<div class=\"rTableCell2PV\">$Notes</div>";
			print "<div class=\"rTableCell3PV\">$Created</div>";
			print "<div class=\"rTableCell4PV\">$Version</div>";

			$Folder= (int) ($VersID / 100);
			$target_file = "uploads/".$Folder."/".$VersID."/".$Name;
		
			if ($Active == 1)
			{
				print "<div class=\"rTableCell5PV\"><img src=\"Download3.png\"width=\"50\"height=\"58\"onclick=\"IncVal('".$VersID."');window.open('".$target_file."');\"style=\"cursor: pointer\"vertical-align: top;\"/></div>";
			}
			else
			{
				print "<div class=\"rTableCell5PV\"><img src=\"Warning-WF.png\"width=\"50\"height=\"58\"style=\"vertical-align: top;\"/></div>";
			}
			print "</div>";
		};
		$nRecCount = $nRecCount + 1;
	}
	if ($nRecCount < 2)
	{
		print "<div class=\"rEmptyRow\">No Previous Versions Available</div>";		
	}
	print "</div>";
}
?>
