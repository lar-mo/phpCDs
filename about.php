<?php

/////////////////////////////////////////////////////////////
//
// about.php -- complete list of files used in this program 
//              with short description of its function.
//
// written by Larry Moiola (September 22, 2002)
//
/////////////////////////////////////////////////////////////

include("include/html_hdr.inc");

print "<title>phpCDs :: Online Music Inventory</title></head>";

include("include/body.inc");
include("include/zarkobar.inc"); 

?>

<p>
<table bgcolor="#666666" cellspacing="0" cellpadding="1" border=0 width=640>
	<tr>
		<td>
			<table bgcolor="#DDDDDD" border=0 width="100%" cellpadding="0" cellspacing="0">
				<tr bgcolor="#666666">
					<td>
						<table width="100%" cellpadding="1" cellspacing="1">
							<tr>
								<th align=left class="display2">phpCDs :: Help :: About</th>
								<td align=right class="cart1"><a href="using.php" class="cart3">Using the Site</a> | About the Site | <a href="contact.php" class="cart3">Contact</a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="#DDDDDD">
					<td align=center align="center" class=display>
						<table border=0>
							<tr>
								<td><img src="images/1pix.gif" width=1 height="100%"></td>
							</tr>
							<tr>
								<th valign=top class="display">.htaccess</th>
								<td class="display">File that enables the Apache File protection</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">.htpasswd</th>
								<td class="display">Small text file that has the name:password values for .htaccess</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">about.php</th>
								<td class="display">This is it, you're reading it now. Stuff regarding nuts'n'bolts of this project.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">addImage.php</th>
								<td class="display">Page served as a small popup to add & update album cover thumbnails.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">body.inc</th>
								<td class="display">Text file that inserts body with some parameters like marginheight and a center tag.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">cart.php</th>
								<td class="display">Script to create, update & delete the basket items in shopping cart environment.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">cdform.cgi</th>
								<td class="display">Perl script used in checkout.php & contact.php to send email to webmaster and autoresponse to submitter.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">cdlistANY.php</th>
								<td class="display">Script to display database records.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">cdlistColumn.php</th>
								<td class="display">Script to list the contents of the category selected. Same resultset as the pulldown menus.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">cdlistSearch.php</th>
								<td class="display">Script to handle more refined search of database by category.<br>Requires explicit use of wildcards (%).</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">checkout.php</th>
								<td class="display">Script to transfer the information from shopping cart into a form.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">contact.php</th>
								<td class="display">Additional contact information and such.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">db.php</th>
								<td class="display">Script to set session cookie for the shopping cart environment.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">db_access.inc</th>
								<td class="display">Snippet of code for the basic database connection.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">display.inc</th>
								<td class="display">Main php-include for the table used to show the results.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">doUpload.php</th>
								<td class="display">Script behind addImage.php page to upload album cover images.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">editCDs.php</th>
								<td class="display">Script to update & delete database records.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">editSearch.php</th>
								<td class="display">Script to display records in a form for updating and deleting database records.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">html_hdr.inc</th>
								<td class="display">Snippet of HTML & CSS that defines the text and link appearance.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">index.php</th>
								<td class="display">Page that defines frames for application UI.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">insert.php</th>
								<td class="display">Script to insert database records and search for records to be updated or deleted.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">response2.txt</th>
								<td class="display">Small file containing text specific to the Shopping Cart form used by cdform.cgi in the autoresponse.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">response3.txt</th>
								<td class="display">Small file containing text specific to the Contact form used by cdform.cgi in the autoresponse.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">topframeCD.php</th>
								<td class="display">Script that displays bottom frame. Includes the pulldowns and search window.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">using.php</th>
								<td class="display">Page that provides instructions to help aid where to find data and the cover images. Also how to get the best results from the Search page.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">welcome.php</th>
								<td class="display">Page that has the large B&W photo of the guy looking through the CDs.<br><font size="1">Main Photo Credit: http://www.lbfl.li/patent/</font></td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">welcome2.php</th>
								<td class="display">Page that indexes the three help pages: using.php, about.php, contact.php</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">zarkobar.inc</th>
								<td class="display">Snippet of code for the grey bar at the top of the page.</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"></td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display">zarkobar2.inc</th>
								<td class="display">Modified version of zarkobar.inc designed for the image upload popup.</td>
							</tr>
							<tr>
								<td><img src="images/1pix.gif" width=1 height="100%"></td>
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
