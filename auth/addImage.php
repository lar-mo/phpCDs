<?php

// addImage.php -- interface for uploading Album cover images
// written by Larry Moiola (August 30, 2002)

include "../include/html_hdr.inc";

print "<title>Add Image</title></head>";

include "../include/body.inc";

include "../include/zarkobar2.inc";

$coverid = $_GET['theid'];

$browser = $_SERVER['HTTP_USER_AGENT'];
if (stristr($browser,"Mozilla/4.7")){ 
	$text_size = 15;
} 
else { 
	$text_size = 30;
} 

print "
<p>
<table bgcolor=\"#666666\" cellspacing=0 cellpadding=1 border=0 width=300>
        <tr>
                <td>
                        <table bgcolor=\"#DDDDDD\" border=0 width=\"100%\" cellpadding=0 cellspacing=0>
                                <tr bgcolor=\"#666666\">
                                        <td>
                                                <table width=\"100%\" cellpadding=1 cellspacing=1>
                                                        <tr>
                                                                <td bgcolor=\"#666666\" class=\"display2\"><b>Add Image</b> for ID #$coverid</td>
                                                        </tr>
                                                </table>
                                        </td>
                                </tr>
                                <tr bgcolor=\"#DDDDDD\">
                                        <td align=center align=center class=display>
                                                <table border=0 height=100 bgcolor=\"#DDDDDD\">
                                                        <tr>
                                                        	<th class=display align=left height=100>
								<form method=POST action=../doUpload.php enctype=multipart/form-data>
								<p>File to upload:<br>
							 	<input type=hidden name=coverid value=$coverid>
								<input type=file name=img1 size=$text_size>
								<p>
								<input type=submit name=submit value=Upload class=display>
								</form>
								</th>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
";

include "../include/html_end.inc";

?>