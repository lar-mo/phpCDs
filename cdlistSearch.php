<?php

// cdlistSearch.php -- main script for displaying of search results
// written by Larry Moiola (August 30, 2002)

include "include/html_hdr.inc";

print "<title>phpCDs :: Online Music Inventory</title></head>";

include "include/body.inc";

include "include/zarkobar.inc";

include "include/db_access.inc";

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


$con = mysqli_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database" . mysqli_errno($con));
$database = mysqli_select_db($con, "$DBName") or die("Unable to select database $DBName" . mysqli_errno($con));

if(($searchType == "ALL") && !($query == "%")) {
$sqlquery = "SELECT * FROM $table WHERE id LIKE '$query' OR artist LIKE '$query' OR album LIKE '$query' OR genre LIKE '$query' OR record_label LIKE '$query' ORDER BY artist";
} elseif($query == "%") {
$sqlquery = "SELECT * FROM $table WHERE id LIKE 'foobar'";
} elseif(($query == "ShowAll") && ($searchType == "album")) {
$sqlquery = "SELECT * FROM $table ORDER BY id DESC";
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

include "include/html_end.inc";

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
                                        <td bgcolor=\"#DDDDDD\">
						<table bgcolor=\"#DDDDDD\" border=0 width=400 height=125>
							<tr>
								<td><img src=\"images/1pix.gif\" height=5></td>
							</tr>
							<tr>
								<td align=center class=display><center><P>There Were No Results for Your Search</P><p></center></td>
							</tr>
							<tr>
								<td class=zarko><p><CENTER>Didn't find what you were looking for?&nbsp;&nbsp;Try using the percent sign <b>%</b></CENTER></td>
							</tr>
							<tr>
								<td class=zarko><CENTER>eg. al% = anything that begins with \"al\" like \"Alice In Chains\" <BR> %al = anything that ends with \"al\" like \"Orbital\"</CENTER></p></td>
							</tr>
						</table>
					</td>
				</tr>";

} else {

	print "<center>
<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <td class=\"display2\"><b>Results of</b>&nbsp;&nbsp;<kbd>$query3</kbd>&nbsp;&nbsp;<b>by</b>&nbsp;&nbsp;<kbd>$searchType_uc</kbd></td>
								<td align=right valign=middle class=\"display2\"><b>Number of results:</b>&nbsp;$rowcount</font></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td bgcolor=\"#DDDDDD\">
						<table bgcolor=\"#DDDDDD\" border=0>
	";
}

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
   $therelease_date = urlencode($therelease_dateraw);
   $thenumber_of_discs = urlencode($thenumber_of_discsraw);
   $therecord_label = urlencode($therecord_labelraw);

include "include/display.inc";

// this snippet show the dark divider between records UNLESS it is the last record in result set
// must be below the $i++; expression or line will show when before the first record in result set

// adjust $rowcount, minus 1

$rowcountfixed = $rowcount - 1;

	if ($i !== $rowcountfixed) {
		print "					<tr>
								<td colspan=2 height=1 width=\"100%\"><hr size=\"1\" color=\"#666666\" NOSHADE></td></tr>";
	} else {
		print "";
	}

 }
}

print "							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<p><br>";

include "include/html_end.inc";

?>
