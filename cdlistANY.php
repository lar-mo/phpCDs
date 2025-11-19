<?php

/////////////////////////////////////////////////////////////////////
//
// cdlistANY.php -- main script for displaying the query results
//                  Used by the pulldown menus and text links in the 
//                  results.  Requires two variables:
//                  $query and [$artist|$album|$genre|$record label]
//
// written by Larry Moiola (September 22, 2002)
//
/////////////////////////////////////////////////////////////////////

include "include/html_hdr.inc";

print "<title>phpCDs :: Online Music Inventory</title></head>";

include "include/body.inc";

include "include/zarkobar.inc";

include "include/db_access.inc";

$query = $_GET['query'] ?? '';
$artist = $_GET['artist'] ?? '';
$album = $_GET['album'] ?? '';
$genre = $_GET['genre'] ?? '';
$release_date = $_GET['release_date'] ?? '';
$number_of_discs = $_GET['number_of_discs'] ?? '';
$record_label = $_GET['record_label'] ?? '';

$query2 = stripslashes($query);
$artist2 = stripslashes($artist);
$album2 = stripslashes($album);
$genre2 = stripslashes($genre);
$release_date2 = stripslashes($release_date);
$number_of_discs2 = stripslashes($number_of_discs);
$record_label2 = stripslashes($record_label);

         if (strlen($album2) > 35 ) {
             $album3 = substr($album2, 0, 35).'...';
         } else {
             $album3 = $album2;
         }

if($query == "1") {
$sqlquery = "SELECT * FROM $table WHERE artist = '$artist' ORDER BY album";
} elseif ($query == "2") {
$sqlquery = "SELECT * FROM $table WHERE album = '$album' ORDER BY artist";
} elseif ($query == "3") {
$sqlquery = "SELECT * FROM $table WHERE genre = '$genre' ORDER BY artist";
} elseif ($query == "4") {
$sqlquery = "SELECT * FROM $table WHERE record_label = '$record_label' ORDER BY artist";
} else {
$sqlquery = "SELECT * FROM $table ORDER BY id DESC";
}

$con = mysqli_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database" . mysqli_errno($con));
$database = mysqli_select_db($con, "$DBName") or die("Unable to select database $DBName" . mysqli_errno($con));
$result = mysqli_query($con, $sqlquery);
$rowcount = mysqli_num_rows($result);

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
						</table>
					</td>
				</tr>";

} else {

	print "
<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <td class=\"display2\">";

if ($query == "1") {
	print "<b>Results of</b>&nbsp;&nbsp;<kbd>$artist2</kbd>";
} elseif ($query == "2") {
	print "<b>Results of</b>&nbsp;&nbsp;<kbd>$album3</kbd>";
} elseif ($query == "3") {
	print "<b>Results of</b>&nbsp;&nbsp;<kbd>$genre2</kbd>";
} elseif ($query == "4") {
	print "<b>Results of</b>&nbsp;&nbsp;<kbd>$record_label2</kbd>";
} else {
	print "<b>Display</b>&nbsp;&nbsp;<kbd>ALL</kbd>";
}

	print "							</td>
								<td align=right valign=middle class=\"display2\"><b>Number of results:</b>&nbsp;$rowcount</kbd></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td bgcolor=\"#DDDDDD\">
						<table bgcolor=\"#DDDDDD\" border=0>
	";

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
                print "                                 <tr>
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
