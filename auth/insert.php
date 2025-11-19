<?php
// this is the INSERT.PHP script for http://www.aretefilms.com/phpCDs/

//include "../include/db_auth.inc";

if ($_REQUEST['submitBtn'] == "Enter Record"){
  // The submit button was clicked!
  // Get the input for Artist, Album and Genre then store it in the database.

include "../include/db_access.inc";

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
$therecord_label = urldecode($record_label);

  $connection = mysql_connect($DBhost,$DBuser,$DBpass);
  if ($connection == false){
    echo mysql_errno().": ".mysql_error()."<BR>";
    exit;
  }   

  $query = "insert into $table values ('$id', '$artist', '$album', '$genre', '$release_date', '$number_of_discs', '$record_label')";
  $result = mysql_db_query($DBName, $query);
  if ($result){
    	include "../include/html_hdr.inc";
	print "<title>phpCDs :: Online Music Inventory</title></head>";
	include "../include/body.inc";
	include "../include/zarkobar.inc";
    echo "<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0 width=400>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <th class=\"display2\" bgcolor=\"#666666\" width=\"100\" align=left>Success!</th>
								<td class=\"display2\" bgcolor=\"#666666\" width=\"300\" align=right>You have added the album to the database.</td>
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

//--></SCRIPT>

</head>";

include("../include/body.inc");
include("../include/zarkobar.inc");

print "
<p>
<table bgcolor=\"#666666\" cellspacing=\"0\" cellpadding=\"1\" border=0 width=640>
	<tr>
		<td>
			<table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr bgcolor=\"#666666\">
					<td>
						<table width=\"100%\" cellpadding=\"1\" cellspacing=\"1\">
							<tr>
								<th bgcolor=\"#666666\" align=center class=\"display2\">Update Page</th>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor=\"#DDDDDD\">
					<td align=center align=\"center\" class=display>
						<table border=0 width=\"100%\">
			        			<tr>
								<td>
									<table border=0 width=\"100%\">
										<tr>
        			        						<th align=left class=display>&#183;</th>
                									<td align=left class=display>Artist and Album Name: 50 char max.</td>
                									<td align=right class=display>Record Label: 35 char max.</td>
			                						<th align=right class=display>&#183;</th>
        									</tr>
        									<tr>
                									<th align=left class=display>&#183;</th>
                									<td align=left class=display>Use Capital Letters where appropriate</td>
                									<td align=right class=display>Enter Date in this format: MMM DD, YYYY</td>
                									<th align=right class=display>&#183;</th>
        									</tr>
        									<tr>
                									<th align=left class=display>&#183;</th>
                									<td align=left class=display>Send comments to <a href=\"mailto:&#112;&#111;&#115;&#116;&#109;&#097;&#115;&#116;&#101;&#114;&#064;&#097;&#114;&#101;&#116;&#101;&#109;&#109;&#046;&#110;&#101;&#116;\" class=text>&#112;&#111;&#115;&#116;&#109;&#097;&#115;&#116;&#101;&#114;&#064;&#097;&#114;&#101;&#116;&#101;&#109;&#109;&#046;&#110;&#101;&#116;</a></td>
                									<td align=right class=display># of Discs refers to Compilations and Album Sets</td>
                									<th align=right class=display>&#183;</th>
										</tr>
									</table>
								</td>
        						</tr>
        						<tr>
								<td height=1 width=\"100%\"><hr size=1 color=\"#666666\" NOSHADE></td>

							</tr>
    							<tr>
								<th bgcolor=\"#DDDDDC\" class=display>Add to the Database</th>
							</tr>
							<tr>
								<td>
									<table border=0 width=\"100%\">
			    						<form name=\"insertForm\" action=\"insert.php\">
    									<input type=\"hidden\" name=\"id\"></input> 
    										<tr>
											<th class=display width=175>Enter the Artist's Name</th>
        										<td><input type=\"text\" name=\"artist\" maxlength=\"50\" tabindex=\"1\"></td>
        										<th class=display width=125>Record Label</th>
        										<td><input type=\"text\" name=\"record_label\" maxlength=\"50\" tabindex=\"5\"></td>
										</tr>
    										<tr>
											<th class=display>Enter the Album Name</th>
        										<td><input type=\"text\" name=\"album\" maxlength=\"60\" tabindex=\"2\"></td>
        										<th class=display>Release Date</th>
        										<td><input type=\"text\" name=\"release_date\" maxlength=\"35\" tabindex=\"6\"></td>
										</tr>
    										<tr>
											<th class=display>Enter the Genre</th>
        										<td>
    												<select name=\"genre\" tabindex=\"3\">
    									  				<option value=\"\"></option>
    									  				<option value=\"Acid Jazz\">Acid Jazz</option>
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
    									  				<option value=\"Hip Hop\">Hip Hop</option>
    									  				<option value=\"Jazz\">Jazz</option>
    									  				<option value=\"Latin\">Latin</option>
    									  				<option value=\"Metal\">Metal</option>
    									  				<option value=\"New Age\">New Age</option>
    									  				<option value=\"Pop\">Pop</option>
    									  				<option value=\"Punk\">Punk</option>
    									  				<option value=\"R&B/Soul\">R&B/Soul</option>
    									  				<option value=\"Reggae\">Reggae</option>
    									  				<option value=\"Rock\">Rock</option>
    									  				<option value=\"Soundtrack\">Soundtrack</option>
    									  				<option value=\"Trip Hop\">Trip Hop</option>
    									  				<option value=\"Vocal\">Vocal</option>
    									  				<option value=\"Other\">Other</option>
    									 			</select>
    											</td>
        										<th class=display># of Discs</th>
        										<td><input type=\"text\" name=\"number_of_discs\" maxlength=\"2\" tabindex=\"7\"></td>
										</tr>
    										<tr>
											<td><img src=\"../images/1pix.gif\" width=1 height=\"10\"></td>
        										<td align=left colspan=3><input type=\"reset\" name=\"Reset\" value=\"Reset\" class=display>&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"submitBtn\" value=\"Enter Record\" onFocus=\"validate(this.form.artist,'Artist'); validate(this.form.album,'Album'); validate(this.form.genre,'Genre'); validate(this.form.release_date,'Release Date'); validate(this.form.number_of_discs,'Number of Discs'); validate(this.form.record_label,'Record Label');\" class=display></td>
										</tr>
										<tr>
											<td colspan=4><img src=\"../images/1pix.gif\" width=1 height=\"1\"></td>
										</tr>
									</form>
									</table>
								</td>
							</tr>
        						<tr>
								<td height=1 width=\"100%\"><hr size=1 color=\"#666666\" NOSHADE></td>
							</tr>
    							<tr>
								<th bgcolor=\"#DDDDDD\" class=display>Edit the Database</th>
							</tr> 
							<tr>

								<td>
									<table border=0>      
									<form name=\"search\" action=\"editSearch.php\">
										<tr>
											<th class=display width=\"175\"><b>Locate an Entry</b></th>
											<td><input type=\"text\" name=\"query\" MAXLENGTH=\"60\"></td>
										</tr>
										<tr>
											<th class=display><b>Search by</b></th>
											<td><select name=\"searchType\">
												<option value=\"ALL\">ALL
												<option value=\"id\">ID
												<option value=\"artist\">Artist
												<option value=\"album\">Album
												<option value=\"genre\">Genre
												<option value=\"record_label\">Label
											</select>
											</td>
										</tr>
										<tr>
											<th class=display>Limit Result Set to</th>
        										<td><select name=\"resultSet\">
        							  				<option value=\"5\">5
        							  				<option value=\"10\">10
        							  				<option value=\"15\">15
        							  				<option value=\"25\">25
        							  				<option value=\"50\">50
        							  				<option value=\"75\">75
       								  				<option value=\"100\">100
        							 			</select>
											</td>
										</tr>
			    							<tr>
											<td><img src=\"../images/1pix.gif\" width=1 height=\"1\"></td>
											<td><input type=\"reset\" value=\"Reset\" class=display>&nbsp;&nbsp;&nbsp;<input type=\"submit\" value=\"Search\" class=display></td>
										</tr>
										<tr>
											<td colspan=2><img src=\"../images/1pix.gif\" width=1 height=\"10\"></td>
										</tr>
										</form>
        								</table>
								</td>
							</tr>
						</table>
        				</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<p><br>";

}

include "../include/html_end.inc";

?>