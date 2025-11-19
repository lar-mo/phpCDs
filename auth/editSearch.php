<?php

// editSearch.php -- main script for displaying of search results
// written by Larry Moiola (August 30, 2002)

include "../include/html_hdr.inc";

print "<SCRIPT LANGUAGE=\"JavaScript\">
<!--

function validate(object,text) {
      	if(object.value.length > 0)
          	return true;
    	else {
        	alert(text + ' field empty!');
        	if (navigator.appName.indexOf('Netscape') > -1) {
              		object.focus();
          	}
        	return false;
    	}

}

var ButtonClicked;
function updateButtonClicked(value) {
ButtonClicked = value;
}

function deleteConfirm() {
if (ButtonClicked == \"update\") { 
	return true; 
	} else {

		if(window.confirm('Are you sure you want to DELETE this record?') == true)
			return true;
		else {
			return false;
		}
	}
}

  //-->
</SCRIPT>";

print "<title>phpCDs :: Online Music Inventory</title></head>";

include "../include/body.inc";

include "../include/zarkobar.inc";

include "../include/db_access.inc";

$searchType = $_GET['searchType'];

if ($searchType == "record_label") {
	$searchType_uc = ucwords(strtr($searchType,"_"," "));
} elseif ($searchType == "id") {
	$searchType_uc = strtoupper($searchType);
} else {
	$searchType_uc = ucfirst($searchType);
}
$query = $_GET['query'];
$query2 = stripslashes($query);

         if (strlen($query2) > 35 ) {
             $query3 = substr($query2, 0, 35).'...';
         } else {
             $query3 = $query2;
         }

$resultSet = $_GET['resultSet'] ?? 5;
$id = $_GET['id'] ?? '';
$artist = $_GET['artist'] ?? '';
$album = $_GET['album'] ?? '';
$genre = $_GET['genre'] ?? '';
$release_date = $_GET['release_date'] ?? '';
$number_of_discs = $_GET['number_of_discs'] ?? '';
$record_label = $_GET['record_label'] ?? '';

$con = mysqli_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database" . mysqli_errno($con));
$database = mysqli_select_db($con, "$DBName") or die("Unable to select database $DBName" . mysqli_errno($con));

if(($searchType == "ALL") && !($query == "%")) {
$sqlquery = "SELECT * FROM $table WHERE id LIKE '$query' OR artist LIKE '$query' OR album LIKE '$query' OR genre LIKE '$query' OR record_label LIKE '$query' ORDER BY artist";
} elseif($searchType == "album" && $artist !== "") {
$sqlquery = "SELECT * FROM $table WHERE artist LIKE '$artist' AND $searchType LIKE '$query'";
} elseif($query == "%") {
$sqlquery = "SELECT * FROM $table WHERE id LIKE 'foobar'";
} else {
$sqlquery = "SELECT * FROM $table WHERE $searchType LIKE '$query' ORDER BY $searchType";
}

$result = mysqli_query($con, $sqlquery);
$rowcount = mysqli_num_rows($result);

if ($query == "") {
	print "<center>
<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0 width=400>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <th bgcolor=\"#666666\" class=\"display2\">Error</th>
                                                        </tr>
                                                </table>
                                        </td>
                                </tr>
                                <tr bgcolor=\"#DDDDDD\">
                                        <td align=center align=center class=display>
                                                <table border=0 width=\"100%\" height=100>
                                                        <tr>
                                                        	<td class=error align=center><b>You didn't</b>&nbsp;&nbsp;<kbd>type</kbd>&nbsp;&nbsp;<b>anything in the search window.</b><br><a href=\"javascript:history.go(-1);\" class=\"cart2\">Go Back</a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>";

include "../include/html_end.inc";

	return false;
} else {
if ($rowcount < 1) {
	print "<center>
<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0 width=400>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <td class=\"display2\"><b>Results of</b>&nbsp;&nbsp;<kbd>$query2</kbd>&nbsp;&nbsp;<b>by</b>&nbsp;&nbsp;<kbd>$searchType_uc</kbd></td>
                                                        </tr>
                                                </table>
                                        </td>
                                </tr>
                                <tr bgcolor=\"#DDDDDD\">
                                        <td align=center align=center class=display>
                                                <table border=0 width=\"100%\" height=100>
                                        		<tr>
                                                                <td><img src=\"../images/1pix.gif\" height=5></td>
							</tr>
							<tr>
								<td align=center class=display><P>There Were No Results for Your Search</P><p></td>
							</tr>
							<tr>
								<td align=center class=zarko><p>Didn't find what you were looking for?&nbsp;&nbsp;<a href=\"javascript:history.go(-1);\" class=\"cart2\">Go Back</a>&nbsp;&nbsp;Try using the percent sign <b>%</b></td>
							</tr>
							<tr>
								<td align=center class=zarko><p>eg. al% = anything that begins with \"al\" like \"Alice In Chains\" <BR> %al = anything that ends with \"al\" like \"Orbital\"</CENTER></p></td>
							</tr>
						</table>
					</td>
				</tr>

			</table>
		</td>
	</tr>						
</table>";

include "../include/html_end.inc";

} else {

	print "<center>
<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0 width=640>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <td class=\"display2\" bgcolor=\"#666666\"><b>Results of</b>&nbsp;&nbsp;<kbd>$query3</kbd>&nbsp;&nbsp;<b>by</b>&nbsp;&nbsp;<kbd>$searchType_uc</kbd></td>
								<td align=right valign=middle class=\"display2\" bgcolor=\"#666666\"><b>Number of results:</b>&nbsp;$rowcount</kbd></td>
                                                        </tr>
                                                </table>
                                        </td>
                                </tr>
                                <tr bgcolor=\"#DDDDDD\">
                                        <td align=center align=center class=display>
                                                <table border=0 width=\"100%\">";
}

/*
	while (($number > $i) && ($i < $resultSet)) {
	$theid = mysql_result($result,$i,"id");
	$theartistraw = mysql_result($result,$i,"artist");
	$thealbumraw = mysql_result($result,$i,"album");
	$thegenreraw = mysql_result($result,$i,"genre");
	$therelease_dateraw = mysql_result($result,$i,"release_date");
	$thenumber_of_discsraw = mysql_result($result,$i,"number_of_discs");
	$therecord_labelraw = mysql_result($result,$i,"record_label");

	$theartist = urlencode($theartistraw);
	$thealbum = urlencode($thealbumraw);
	$thegenre = urlencode($thegenreraw);
	$thegenre2 = urldecode($thegenreraw);
	$therelease_date = urlencode($therelease_dateraw);
	$thenumber_of_discs = urlencode($thenumber_of_discsraw);
	$therecord_label = urlencode($therecord_labelraw);

*/

$thesearchtype = mysqli_fetch_all($result,MYSQLI_ASSOC);
for($i=0;$i<$rowcount;$i++)
{

// the parsed result

   $theid = $thesearchtype[$i]['id'];
   $theartistraw = $thesearchtype[$i]['artist'];
   $thealbumraw = $thesearchtype[$i]['album'];
   $thegenreraw = $thesearchtype[$i]['genre'];
   $therelease_dateraw = $thesearchtype[$i]['release_date'];
   $thenumber_of_discsraw = $thesearchtype[$i]['number_of_discs'];
   $therecord_labelraw = $thesearchtype[$i]['record_label'];

// encode so it can be passed as a GET in the URL

   $theartist = urlencode($theartistraw);
   $thealbum = urlencode($thealbumraw);
   $thegenre = urlencode($thegenreraw);
   $thegenre2 = urldecode($thegenreraw);
   $therelease_date = urlencode($therelease_dateraw);
   $thenumber_of_discs = urlencode($thenumber_of_discsraw);
   $therecord_label = urlencode($therecord_labelraw);


							print "<tr>
								<td bgcolor=\"#DDDDDD\" align=\"center\" valign=middle width=\"120\">";

	$isImage = @fopen("../covers/icon$theid.jpg", "r"); 
	if (!$isImage) { 
		print "<a href=\"#\" onClick=\"window.open('addImage.php?theid=$theid','addImage','width=400,height=200')\"><img src=\"../covers/no_art.jpg\" width=\"90\" height=\"90\" alt=$theid border=0></a>";
	} else {  
		print "<a href=\"#\" onClick=\"window.open('addImage.php?theid=$theid','addImage','width=400,height=200')\"><img src=\"../covers/icon$theid.jpg\" width=\"90\" height=\"90\" alt=$theid border=0></a>";
	} 

	print "							</td>
								<td bgcolor=\"#DDDDDD\" align=\"left\" valign=middle>
									<table border=0 width=\"100%\">
									<form name=\"update\" action=\"editCDs.php\" onSubmit=\"return deleteConfirm()\">
										<tr>
											<th class=display>ID #:</th>
											<td><input type=text name=id value=$theid onfocus=\"this.blur()\"></td>
											<th class=display width=\"90\">Record Label:</th>
											<td><input type=text name=\"record_label\" value=\"$therecord_labelraw\" tabindex=4></td>
										</tr>
										<tr>
											<th class=display>Artist:</th>
											<td><input type=text name=artist value=\"$theartistraw\" tabindex=1></td>
											<th class=display>Release Date:</th>
											<td><input type=text name=\"release_date\" value=\"$therelease_dateraw\" tabindex=5></td>
										</tr>
										<tr>
											<th class=display>Album:</th>
											<td><input type=text name=album value=\"$thealbumraw\" tabindex=2></td>
											<th class=display># of Discs:</th>
											<td><input type=text name=\"number_of_discs\" value=\"$thenumber_of_discsraw\" tabindex=6></td>
										</tr>
										<tr>
											<th class=display>Genre:</th>
											<td><select name=\"genre\" tabindex=3>
    												<option value=\"$thegenreraw\">$thegenre2</option>
    				    								<option value=\"Acid+Jazz\">Acid Jazz</option>
    	    											<option value=\"Alternative\">Alternative</option>
    	    											<option value=\"Blues\">Blues</option>
    	    											<option value=\"Classical\">Classical</option>
    	    											<option value=\"Country\">Country</option>
    	    											<option value=\"Dance\">Dance</option>
    	    											<option value=\"Electronica\">Electronica</option>
    	    											<option value=\"Emo\">Emo</option>
    	    											<option value=\"Folk\">Folk</option>
    	    											<option value=\"Funk\">Funk</option>
    	    											<option value=\"Gospel\">Gospel</option>
    	    											<option value=\"Hip+Hop\">Hip Hop</option>
    	    											<option value=\"Jazz\">Jazz</option>
    	    											<option value=\"Latin\">Latin</option>
    	    											<option value=\"Metal\">Metal</option>
    	    											<option value=\"New+Age\">New Age</option>
    	    											<option value=\"Pop\">Pop</option>
    	    											<option value=\"Punk\">Punk</option>
    	    											<option value=\"R%26B%2FSoul\">R&B/Soul</option>
    	    											<option value=\"Reggae\">Reggae</option>
    	    											<option value=\"Rock\">Rock</option>
    	    											<option value=\"Soundtrack\">Soundtrack</option>
    	    											<option value=\"Trip+Hop\">Trip Hop</option>
    	    											<option value=\"Vocal\">Vocal</option>
    	    											<option value=\"Other\">Other</option>
    	    										</select>
											</td>
											<td>&nbsp;</td>
											<td><input type=submit name=change value=update onClick=\"updateButtonClicked(this.value);\" onMouseDown=\"validate(this.form.artist,'Artist'); validate(this.form.album,'Album'); validate(this.form.genre,'Genre');\" class=display>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=submit name=change value=delete onClick=\"updateButtonClicked(this.value)\" class=display></td>
										</tr>
	    								</form>
									</table>
								</td>
							</tr>";

$rowcountfixed = $rowcount - 1;
	if ($i < $resultSet) {
		if ($i !== $rowcountfixed) {
		print "<tr><td colspan=2 height=1 width=\"100%\"><hr size=\"1\" color=\"#666666\" NOSHADE></td></tr>";
		} else {
		print "";
		}
	} else {
		print "";
	}

     }

if ($rowcount > 0) {
print "						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td bgcolor=\"#666666\">
			<table width=\"100%\" border=0 cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#666666\">
				<tr>
					<td align=center class=\"cart1\">Note: Showing <b>$i</b> of <b>$rowcount</b> results</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table>
	<tr>
	  <td class=zarko>Didn't find what you were looking for?&nbsp;&nbsp;&lt;&lt;&nbsp;<a href=\"javascript:history.go(-1);\" class=\"cart2\">Go back</a>&nbsp;&gt;&gt;&nbsp;&nbsp;You may need to refine your search.</td>
	</tr>
</table>";

} else {
return false;
 }
}
?>
<p><br>

<?php include("../include/html_end.inc"); ?>
