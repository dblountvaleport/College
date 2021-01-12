function GetDownloads(Beta)
{
    var file, xhttp, elmnt, elmntPV, sel;
    sel = document.getElementById("Instrument")
    file="downloads.php";
    elmnt = document.getElementById("instDownloads");
    elmntPV = document.getElementById("previousVersions");
    elmnt.innerHTML = "<div class=\"rContactingRow\">Contacting website, please wait...</div>";
    elmntPV.innerHTML = "";
    xhttp = new XMLHttpRequest();
            
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {elmnt.innerHTML = this.responseText;}
            if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
        }
    }      

    xhttp.open("POST", file, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var thedata = "inst="+sel.value+"&beta="+Beta+"z";
    xhttp.send(thedata);

    return;        
}

function GetPreviousVersions(ResourceID, Beta)
{
    var file, xhttp, elmntPV, sel;
    file="PrevVers.php";
    TheDivID = "PrevVers"+ResourceID;
    elmntPV = document.getElementById(TheDivID);		
    elmntPV.innerHTML = "<div class=\"rContactingRow\">Contacting website, please wait...</div>";

    if (elmntPV.style.display === "none")
    {
        elmntPV.style.display = "block";
    
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {elmntPV.innerHTML = this.responseText;}
                if (this.status == 404) {elmntPV.innerHTML = "Page not found.";}
            }
        }      

        xhttp.open("POST", file, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        var thedata = "resource="+ResourceID+"&beta="+Beta+"z";
        xhttp.send(thedata);
    }
    else
    {
        elmntPV.style.display = "none";
    }
    return;        
}

function IncVal(VersionID)
{
	var file, xhttp;
	file="DownloadCount.php"
	
	xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4) {
					//if (this.status == 200) {alert(this.responseText); alert("Error Response 200");}
					if (this.status == 404) {alert("Page not found.");}
				}
			}      

			xhttp.open("POST", file, true);
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("versid="+VersionID);
						
	return;   
}
