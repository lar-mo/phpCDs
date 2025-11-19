<?php

/////////////////////////////////////////////////////////////
//
// apache401.php -- replacement for Apache Server Error 401
//                  *requires a modification to httpd.conf*
//
// written by Larry Moiola (September 22, 2002)
//
/////////////////////////////////////////////////////////////

include "./include/html_hdr.inc";

print "<title>Add Image</title></head>";

include "./include/body.inc";
include "./include/zarkobar.inc";

print "
<p>
<table bgcolor=\"#666666\" cellspacing=\"0\" cellpadding=\"1\" border=0 width=300>
	<tr>
		<td>
			<table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
				<tr bgcolor=\"#666666\">
					<td>
						<table width=\"100%\" cellpadding=\"1\" cellspacing=\"1\">
							<tr>
								<td bgcolor=\"#666666\" colspan=2 class=\"display2\"><b>Unauthorized Access</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor=\"#DDDDDD\">
					<td align=center align=\"center\" class=display>
						<table border=0>
							<tr>
								<td bgcolor=\"#DDDDDD\" class=display height=100 align=center valign=middle><img src=\"../images/401.jpg\"></td>
								<td bgcolor=\"#DDDDDD\" class=display height=100 align=center valign=middle>You are free to browse but you must be authorized to add to the database.</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
";

include "./include/html_end.inc";

?>