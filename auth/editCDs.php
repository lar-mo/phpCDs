<?php

include "../include/db_access.inc";

$update_type = $_GET['change'];
$id = $_GET['id'];
$artist = $_GET['artist'];
$album = $_GET['album'];
$genre = $_GET['genre'];
$release_date = $_GET['release_date'];
$number_of_discs = $_GET['number_of_discs'];
$record_label = $_GET['record_label'];

$query2 = stripslashes($query);
$artist2 = stripslashes($artist);
$album2 = stripslashes($album);
$genre2 = stripslashes($genre);
$release_date2 = stripslashes($release_date);
$number_of_discs2 = stripslashes($number_of_discs);
$record_label2 = stripslashes($record_label);

$thequery = urldecode($query2);
$theartist = urldecode($artist2);
$thealbum = urldecode($album2);
$thegenre = urldecode($genre2);
$therelease_date = urldecode($release_date2);
$thenumber_of_discs = urldecode($number_of_discs);
$therecord_label = urldecode($record_label2);

  //$connection = mysql_connect($DBhost,$DBuser,$DBpass);
  $con = mysqli_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database" . mysqli_errno($con));
  $database = mysqli_select_db($con, "$DBName") or die("Unable to select database $DBName" . mysqli_errno($con));
  if ($con == false){
    echo mysql_errno().": ".mysql_error()."<BR>";
    exit;
  }
	if ($update_type == "update"){
  		$query = "update $table set artist=\"$artist\", album=\"$album\", genre=\"$genre\", release_date=\"$release_date\", number_of_discs=\"$number_of_discs\", record_label=\"$record_label\" where id=$id";
  		$result = mysqli_query($con, $query);
  		if ($result){
		include("../include/html_hdr.inc");
		print "<title>phpCDs :: Online Music Inventory</title></head>";
		include("../include/body.inc");
		include("../include/zarkobar.inc");
    		echo "<center>
<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0 width=400>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <th class=\"display2\" bgcolor=\"#666666\" width=\"200\" align=left>Success!</th>
								<td class=\"display2\" bgcolor=\"#666666\" width=\"200\" align=right>You have updated the information.</td>
                                                        </tr>
                                                </table>
                                        </td>
                                </tr>
                                <tr bgcolor=\"#DDDDDD\">
                                        <td align=center align=center class=display>
                                                <table border=0 height=100 bgcolor=\"#DDDDDD\">
                                                        <tr>
                                                        	<td bgcolor=\"#DDDDDD\" class=display>
									<ul>&nbsp;
										<li><b>Artist</b>: $theartist</li>
										<li><b>Album</b>: $thealbum</li>
										<li><b>Genre</b>: $thegenre</li>
										<li><b>Record Label</b>: $therecord_label</li>
										<li><b>Release Date</b>: $therelease_date</li>
										<li><b>Number of Discs</b>: $thenumber_of_discs</li>
										<form name=edit action=\"editSearch.php\">
										<input type=hidden name=artist value=\"$artist\">
										<input type=hidden name=query value=\"$album\">
										<input type=hidden name=searchType value=album>
										<input type=hidden name=resultSet value=5>
										<input type=submit value=\"Edit this Record\" style=\"{color: #000000; font-family:tahoma; font-size:8pt;}\">
										</form>
		        						</ul>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>";

include "../include/html_end.inc";
		}
  		else{
    			echo mysql_errno().": ".mysql_error()."<BR>";
  		}
		  mysql_close ();

	}
	else{
		$query = "delete from $table where id=$id";
  		$result = mysqli_query($con, $query);
		if ($result){
		include("../include/html_hdr.inc");
		print "<title>phpCDs :: Online Music Inventory</title></head>";
		include("../include/body.inc");
		include("../include/zarkobar.inc");
    		echo "<center>
<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0 width=400>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <th class=\"display2\" bgcolor=\"#666666\" width=\"400\">Success!</th>
                                                        </tr>
                                                </table>
                                        </td>
                                </tr>
                                <tr bgcolor=\"#DDDDDD\">
                                        <td align=center align=center class=display>
                                                <table border=0 width=\"100%\" height=100>
                                                        <tr>
                                                        	<td bgcolor=\"#DDDDDD\" height=150 valign=middle colspan=2 align=center class=\"display\">You successfully deleted the album from the database.</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>";

include "../include/html_end.inc";
		}

		else{
    			echo mysql_errno().": ".mysql_error()."<BR>";
  		}
		  mysql_close ();
	}


?>
