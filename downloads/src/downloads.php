<?php
if (isset($_POST['inst']) AND isset($_POST['beta']))
{
    $InstID = filter_input (INPUT_POST, 'inst', FILTER_SANITIZE_NUMBER_INT);
    $Beta = filter_input (INPUT_POST, 'beta', FILTER_SANITIZE_STRING);
  
	$BetaBoolean = $Beta != 'z';
		
	$Where = '';
	if ($BetaBoolean == 0)
	{
		$Where = "WHERE
			a.InstsId = $InstID AND
			a.ResourceID = b.ResourceID AND
			b.LastVersID = c.ID AND   
			b.TypeID = d.ID 
			AND c.Beta = 0";
	}
	else
	{
		$Where = "WHERE
			a.InstsId = $InstID AND
			a.ResourceID = b.ResourceID AND
			b.LastVersID = c.ID AND   
			b.TypeID = d.ID";
	}
	
	$config = parse_ini_file('../private/software-updates.ini');
	$currTable = "None";
	
    $mysqli = new mysqli($config['servername'],$config['username'],$config['password'],$config['database']);
    
    //Output any connection error
    if ($mysqli->connect_error) 
    {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
        
    $theSQL = "
		SELECT b.Name, b.ResourceID as ResID, b.ProductDesc, c.ID, c.Note, c.CreateDate, c.Version, d.Description, c.Active, c.Name AS filename
		FROM 
			Link a,
			Resources b, 
			Version c,
			Type d ".
			$Where.
		" ORDER BY b.TypeID
	";

    $results = $mysqli->query($theSQL);
	$n="odd";
	
	while($row = $results->fetch_assoc()) 
    {
		$Name     = $row["Name"];
		$VersID   = $row["ID"];    
		$Notes    = nl2br($row["Note"]);    
		$Created  = $row["CreateDate"];    
		$Version  = $row["Version"];   
		$ProductDesc     = $row["ProductDesc"];
		$Type     = $row["Description"];    
		$filename = $row["filename"];    
		$ResourceID = $row["ResID"];    
		$Active = $row["Active"];
		
		if ($Type <> $currTable)
		{
			print "<h2>$Type</h2>";
		}
		print "<div class=\"rTable\">";
		$currTable = $Type;
		if ($n=="odd")
		{				
			print "<div class=\"rTableRowO rTableRow\">";
			$n="even";
		}
		else
		{				
			print "<div class=\"rTableRowE rTableRow\">";
			$n="odd";
		}
		print "<div class=\"rTableCell1\">$Name</div>";
		print "<div class=\"rTableCell2\">$ProductDesc <br><br> $Notes</div>";
		print "<div class=\"rTableCell3\">$Created</div>";
		print "<div class=\"rTableCell4\">$Version</div>";

		$Folder= (int) ($VersID / 100);
		$target_file = "uploads/".$Folder."/".$VersID."/".$filename;
			
		if ($Active == 1)
		{
			print "<div class=\"rTableCell5\"><img src=\"Download3.png\"width=\"50\"height=\"58\"onclick=\"IncVal('".$VersID."');window.open('".$target_file."');\"style=\"cursor: pointer\"vertical-align: top;\"/><img src=\"Previous3.png\"width=\"50\"height=\"58\"onclick=\"GetPreviousVersions('".$ResourceID."','".$Beta."');\"style=\"cursor: pointer\"vertical-align: top;\"/></div>";
		}
		else
		{
			print "<div class=\"rTableCell5\"><img src=\"Warning-WF.png\"width=\"50\"height=\"58\"style=\"vertical-align: top;\"/>&nbsp;<img src=\"Previous3.png\"width=\"50\"height=\"58\"onclick=\"GetPreviousVersions('".$ResourceID."');\"style=\"cursor: pointer\"vertical-align: top;\"/></div>";
		}
		print "</div>";// end row
		print "</div>";// end table
	
		print "<div id=\"PrevVers".$ResourceID."\" style=\"width:100%;display:none;\">";
		print "</div>";
		print "<div class=\"whitespace\"></div>";
    }
	/////////////////////////////////////////////
	    $theSQL = "
		SELECT b.Description, b.URL
		FROM 
			ext_links_link a,
			ext_links b
			WHERE
			a.inst_ID = $InstID AND
			a.ext_links_ID = b.ID";

    $results = $mysqli->query($theSQL);
	$n="odd";
	$FoundSomething="n";
	while($row = $results->fetch_assoc()) 
    {
		$URL_Desc = $row["Description"];
		$URL	  = $row["URL"];    
		
		if ($FoundSomething == "n") 
		{
			print "<h2>External Links</h2>";
			print "<div class=\"externallinktext\">The following links open in new tabs.</div>";
			print "<div class=\"rTable\">";
		}
		print "<div class=\"rTableRow\">";
		
		print "<div class=\"rTableCell1\">$URL_Desc<br><a href=\"$URL\" target=\"_blank\">$URL</a></div>";

		$FoundSomething = "y";
		
		print "</div>";// end row
	}
	if ($FoundSomething == "y") 
	{
		print "</div>";// end table
	}
}
?>
