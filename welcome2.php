<?php include("include/html_hdr.inc"); ?>

<title>phpCDs :: Online Music Inventory</title>

<SCRIPT language="JavaScript">
function formFill(query1,query2)
{
	window.document.search.query.value = query1;
	window.document.search.searchType.selectedIndex = query2;
}

function goto_URL(object) {
  parent.out.location.href = object.options[object.selectedIndex].value;
  return true;
}

//-->
</script>

</head>

<?php include("include/body.inc"); ?>
<?php include("include/zarkobar.inc"); ?>

<p>
<table bgcolor="#666666" cellspacing="0" cellpadding="1" border=0 width=640>
	<tr>
		<td>
			<table bgcolor="#DDDDDD" border=0 width="100%" cellpadding="0" cellspacing="0">
				<tr bgcolor="#666666">
					<td>
						<table width="100%" cellpadding="1" cellspacing="1">
							<tr>
								<th align=left class=display2>phpCDs :: Help :: About</th>
								<td align=right class=display2>This application is for demonstration purpose only!</font></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="#DDDDDD">
					<td align=center align="center" class=display>
						<table border=0>
							<tr>
								<td><img src="images/1pix.gif" width=1 height=15></td>
							</tr>
							<tr>
				     				<td class=display>
									<a href="using.php" class=text><b>Using the site</b></a>
									<form name="search" action="cdlistSearch.php" target="out">
										<ul>
											<li>Adding records, Amazon, image naming convention
											<li>Search the Database by ALL categories<br>or by ID, Artist, Album, Genre & Label
											<li>Using % for denoting wildcards in your search, eg.<br>Search for <a href="#" onClick="formFill('Me%','3');" class=text>Me% by Album</a> returns Memento & Mezzanine<p>
											Search for <input type="text" name="query">
							 				by <select name="searchType">
												<option value="ALL">ALL
												<option value="id">ID
												<option value="artist">Artist
												<option value="album">Album
												<option value="genre">Genre
												<option value="record_label">Label
											    </select>
											<input type="submit" value="Look"><hr>
											Search by Genre
												<select name="genre" onChange="return goto_URL(this.form.genre)">
												<option value="javascript:self.focus();"></option>
<?php

include "include/db_access.inc";

$con = mysqli_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database" . mysqli_errno($con));
$database = mysqli_select_db($con, "$DBName") or die("Unable to select database $DBName" . mysqli_errno($con));
$sqlquery = "SELECT DISTINCT genre FROM $table ORDER BY genre";
$result = mysqli_query($con, $sqlquery);
$rowcount = mysqli_num_rows($result);

if ($rowcount < 1) {
	print "<CENTER><P>There Were No Results for Your Search</CENTER>";
} else {
$thegenreraw = mysqli_fetch_all($result,MYSQLI_ASSOC);
for($i=0;$i<$rowcount;$i++)
{

// encode so it can be passed as a GET in the URL

   $thegenreencode = urlencode($thegenreraw[$i]['genre']);

// populate the Albums dropdown

   echo "
        <option value=\"cdlistANY.php?query=3&genre=".$thegenreencode."\">".$thegenreraw[$i]['genre']."</option>";

 }
}

?>
												<option value="javascript:self.focus();"></option>
    												</select>
										</ul>
									</form>
									<a href="about.php" class=text><b>About the site</b></a>
										<ul>
											<li>Apache/MySQL, PHP, Perl, JavaScript, CSS, HTML
											<li>Dynamic pulldowns, server-side includes, string manipulation
											<li>Shopping cart system, Database administration
										</ul>
									<a href="contact.php" class=text><b>Contact</b></a>
										<ul>
											<li>Author: Larry Moiola
											<li>Email: <a href="mailto:&#112;&#111;&#115;&#116;&#109;&#097;&#115;&#116;&#101;&#114;&#064;&#097;&#114;&#101;&#116;&#101;&#109;&#109;&#046;&#110;&#101;&#116;?subject=phpCDs :: Help/Inquiry" class=text>&#112;&#111;&#115;&#116;&#109;&#097;&#115;&#116;&#101;&#114;&#064;&#097;&#114;&#101;&#116;&#101;&#109;&#109;&#046;&#110;&#101;&#116;</a>
											<li>Homepage: <a href="/" target="new" class=text>www.aretemm.net</a>
										</ul>
								</td>
							</tr>
							<tr>
								<td><img src="images/1pix.gif" width=1 height=10></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="#666666">
					<td align=center class=display2>Main Photo Credit: <b>http://www.lbfl.li/patent/</b></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<p><br>

<?php include("include/html_end.inc"); ?>
