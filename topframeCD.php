<?php include("include/html_hdr.inc"); ?>

<script language="JavaScript">
<!--
function goto_URL(object) {
  parent.out.location.href = object.options[object.selectedIndex].value;
  return true;
}
//-->
</script>
</head>

<body bgcolor="#666666" text="#FFFFFF" link="#FFFFFF" alink="#FFFFFF" vlink="#FFFFFF">
<center>

<table width="100%">
	<tr>
		<td align="center" valign="top"><img src="images/welcome_sm_left.jpg" border="0"></td>
		<td align="center" valign="top">
			<table border="0">
				<tr>
					<td align="center" valign="top" class=display2>
					<form name="sortartist">
					<nobr>Display by <a href="cdlistColumn.php?type=artist" target="out" onClick="document.sortartist.reset();document.sortalbum.reset();document.search.reset()" class="text2">Artist</a>:</nobr><br>
    					<select name="artist" onChange="return goto_URL(this.form.artist)" onFocus="document.sortalbum.reset();document.search.reset()" style="{color: #000000; font-family:tahoma; font-size:8pt;}">
    					<option value="javascript:self.focus();"></option>

<?

// SQL access and query to get a list of all artists

include "include/db_access.inc";

$con = mysqli_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database" . mysqli_errno($con));
$database = mysqli_select_db($con, "$DBName") or die("Unable to select database $DBName" . mysqli_errno($con));

$sqlquery = "SELECT DISTINCT artist FROM $table ORDER BY artist";
$result = mysqli_query($con, $sqlquery);
$rowcount = mysqli_num_rows($result);

if ($rowcount < 1) {
	print "<CENTER><P>There Were No Results for Your Search</CENTER>";
} else {

$theartistraw = mysqli_fetch_all($result,MYSQLI_ASSOC);
for($i=0;$i<$rowcount;$i++)
{

// encode so it can be passed as a GET in the URL

   $theartistencode = urlencode($theartistraw[$i]['artist']);

// limit the number of chars displayed in pulldown

         if (strlen($theartistraw[$i]['artist']) > 20 ) {
             $theartist = substr($theartistraw[$i]['artist'], 0, 20).'...';
         } else {
             $theartist = $theartistraw[$i]['artist'];
         }

// populate the Artists dropdown

   echo	"
	<option value=\"cdlistANY.php?query=1&artist=".$theartistencode."\">".$theartist."</option>";
 }
}


?>

					<option value="javascript:self.focus();"></option>
					</select>
					</form>
					</td>

					<td align="center" valign="top" class=display2>
					<form name="sortalbum">
					<nobr>Display by <a href="cdlistColumn.php?type=album" target="out" onClick="document.sortartist.reset();document.sortalbum.reset();document.search.reset()" class="text2">Album</a>:</nobr><br>
    					<select name="album" onChange="return goto_URL(this.form.album)" onFocus="document.sortartist.reset();document.search.reset()" style="{color: #000000; font-family:tahoma; font-size:8pt;}">
    					<option value="javascript:self.focus();"></option>

<?

// SQL query to get a list of all albums

$sqlquery = "SELECT DISTINCT album FROM $table ORDER BY album";
$result = mysqli_query($con, $sqlquery);
$rowcount = mysqli_num_rows($result);

if ($rowcount < 1) {
	print "<CENTER><P>There Were No Results for Your Search</CENTER>";
} else {

$thealbumraw = mysqli_fetch_all($result,MYSQLI_ASSOC);
for($i=0;$i<$rowcount;$i++)
{

// encode so it can be passed as a GET in the URL

   $thealbumencode = urlencode($thealbumraw[$i]['album']);

// limit the number of chars displayed in Albums pulldown

         if (strlen($thealbumraw[$i]['album']) > 20 ) {
             $thealbum = substr($thealbumraw[$i]['album'], 0, 20).'...';
         } else {
             $thealbum = $thealbumraw[$i]['album'];
         }

// populate the Albums dropdown

   echo "
        <option value=\"cdlistANY.php?query=2&album=".$thealbumencode."\">".$thealbum."</option>";

 }
}


?>
    					<option value="javascript:self.focus();"></option>
    					</select>
					</form>
					</td>

					<td align="right" valign="top" class=display2>
					<form name="search" action="cdlistSearch.php" target="out">
					Search<br>
<?php

$browser = $_SERVER['HTTP_USER_AGENT'];
if (stristr($browser,"Mozilla/4.7")){
	$text_size = 8;
}
else {
	$text_size = 15;
}

?>
					<input type="text" name="query" value="" SIZE=<?php echo $text_size; ?> MAXLENGTH="100" onFocus="document.sortartist.reset();document.sortalbum.reset();" style="{color: #000000; font-family:tahoma; font-size:8pt;}">
					</td>
					<td align="left" valign="top" class=display2>by:<br>
					<select name="searchType" onFocus="document.sortartist.reset();document.sortalbum.reset();" style="{color: #000000; font-family:tahoma; font-size:8pt;}">
					<option value="ALL">ALL
					<option value="id">ID
					<option value="artist">Artist
					<option value="album">Album
					<option value="genre">Genre
					<option value="record_label">Label
					</select>
					</td>
					<td align="center" valign="middle" class=display>
					<!-- font color="#666666">NONE</font><br -->
					<input type="submit" value="Look" style="{color: #000000; font-family:tahoma; font-size:8pt;}">
					</form>
					</td>
				</tr>
			</table>
		</td>
		<td align="center" valign="top"><img src="images/welcome_sm_right.jpg" border="0"></td>
	</tr>
</table>

<?php include("include/html_end.inc"); ?>
