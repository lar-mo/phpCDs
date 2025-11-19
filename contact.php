<?php include("include/html_hdr.inc"); ?>

<title>phpCDs :: Online Music Inventory</title></head>

<?php include("include/body.inc"); ?>
<?php include("include/zarkobar.inc"); ?>

<p>
<form name="phpCDsContact" method="POST" action="include/send_email.php"> 				

<table bgcolor="#666666" cellspacing="0" cellpadding="1" border=0 width=640>
	<tr>
		<td>
			<table bgcolor="#DDDDDD" border=0 width="100%" cellpadding="0" cellspacing="0">
				<tr bgcolor="#666666">
					<td>
						<table width="100%" cellpadding="1" cellspacing="1">
							<tr>
								<th align=left class="display2">phpCDs :: Help :: About</th>
								<td align=right class="cart1"><a href="using.php" class="cart3">Using the Site</a> | <a href="about.php" class="cart3">About the Site</a> | Contact</a></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="#DDDDDD">
					<td align=center align="center" class=display>
						<table border=0>
							<tr>
								<td colspan=2><img src="images/1pix.gif" width=1 height=10></td>
							</tr>
							<tr>
								<th class="display"><dd>Enter your Name</th>
								<td align=center><input type="text" name="name" value=""></td>
							</tr>
							<tr>
								<th class="display"><dd>Enter your Email</th>
								<td align=center><input type="text" name="email" value=""></td>
							</tr>
							<tr>
								<th class="display"><dd>Enter a Subject</th>
								<td align=center><input type="text" name="subject" value="phpCDs :: Contact"></td>
							</tr>
							<tr>
								<th class="display"><dd>Enter your Comments</th>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<th colspan=2>
								<textarea name="body" cols="42" rows="6" wrap="true"></textarea>
								<center><input type="submit" value="Send Comments" class="display"></center>
							</tr>
							<tr>
								<td><img src="images/1pix.gif" width=1 height=10></td>
							</tr>
						</table>	
					</td>
				</tr>
	
			</table>
		</td>
	</tr>
</table>

<INPUT TYPE="HIDDEN" NAME="form_type" VALUE="contact">

</form>
<p><br>

<?php include("include/html_end.inc"); ?>
