<?php

// cdlistColumn.php -- menu script for listing distinct values of category selected
// written by Larry Moiola (August 30, 2002)

include "include/html_hdr.inc";

print "<title>phpCDs :: Online Music Inventory</title></head>";

include "include/body.inc";

include "include/zarkobar.inc";

include "include/db_access.inc";

$type = $_GET['type'];
$type2 = ucfirst(stripslashes($type));

$con = mysqli_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database" . mysqli_errno($con));
$database = mysqli_select_db($con, "$DBName") or die("Unable to select database $DBName" . mysqli_errno($con)); 

$sqlquery = "SELECT DISTINCT $type FROM $table ORDER BY $type";
$result = mysqli_query($con, $sqlquery);
$rowcount = mysqli_num_rows($result);

if ($rowcount < 1) {
	print "<P align=\"center\">There Were No Results for Your Search</p>";
	}
	else {
print "
<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0 width=400>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <td class=\"display2\" bgcolor=\"#666666\"><b>Results of</b>&nbsp;&nbsp;<kbd>$type2</kbd></td>
								<td align=right valign=middle class=\"display2\" bgcolor=\"#666666\"><b>Number of results:</b>&nbsp;$rowcount</kbd></td>
                                                        </tr>
                                                </table>
                                        </td>
                                </tr>
                                <tr bgcolor=\"#DDDDDD\">
                                        <td align=center align=center class=display>
                                                <table border=0 width=\"100%\" height=100>
                                                        <tr>
                                                        	<td width=440 bgcolor=\"#DDDDDD\"><dl>";

$theoutput = mysqli_fetch_all($result,MYSQLI_ASSOC);
for($i=0;$i<$rowcount;$i++)
{

// encode so it can be passed as a GET in the URL

   $theoutputencode = urlencode($theoutput[$i][$type]);

// populate the Artists dropdown

        if ($type == 'artist') {
        echo "<dd><a href=\"cdlistANY.php?query=1&$type=".$theoutputencode."\" class=text>".$theoutput[$i][$type]."</a></dd>";
        } elseif ($type == 'album') {
        echo "<dd><a href=\"cdlistANY.php?query=2&$type=".$theoutputencode."\" class=text>".$theoutput[$i][$type]."</a></dd>";
        } else {
        echo "<dd><a href=\"cdlistANY.php?query=3&$type=".$theoutputencode."\" class=text>".$theoutput[$i][$type]."</a></dd>";
        }

 }
}

?>
								</dl>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<p><br>

<?php include("include/html_end.inc"); ?>
