<?php include("include/html_hdr.inc"); ?>

<title>phpCDs :: Online Music Inventory</title></head>

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
								<th align=left bgcolor="#666666" class="display2">phpCDs :: Help :: About</th>
								<td align=right bgcolor="#666666" class="cart1">Using the Site | <a href="about.php" class="cart3">About the Site</a> | <a href="contact.php" class="cart3">Contact</a></td>
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
				     				<th valign=top class="display" width=150>Browsing<br>Tips and Tricks</th>
								<td valign=top class="display">
									<ul type=disc>
										<li>Selecting Artist or Album in the bottom frame will return the full resultset of that category. You can select from choices presented for more detailed information.
										<li>Selecting one of the options from pulldown in the bottom frame will return all relevant results. These pulldowns are dynamically generated from values in the database.
										<li>You can search the database by ALL, ID, Artist, Album, Genre or Label which will return a list of all relevant items. See Advanced Site Features on how and when to use wildcards.
								</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display" width=150>Basic Site<br>Features</th>
								<td valign=top class="display">
									<ul type=disc>
										<li>When you search by category, then the value will link to google.com and other category values will link back to the phpCDs website to aid in finding relevant results.
										<li>Example: 
											<ul>
												<li>Search for Metallica by Artist, then Metallica will link to google.com which will appear in the top frame allowing you to continue browsing the CD collection.
												<li>Search for Master of Puppets by Album, then by clicking Metallica you will get all albums by that band.
											</ul>
								</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display" width=150>Advanced Site<br>Features</th>
								<td valign=top class="display">
									<ul type=disc>
										<li>The Search window requires explicit use of Wildcards. Use % when you're not sure of the exact phrase.
										<li>Images: the images are named according to the record number, i.e. icon123.jpg
										<li>Shopping Cart and Checkout
											<ul>
												<li>When browsing you can select items for the shopping cart. When you are ready you can proceed to the Checkout section where you'll provide your contact information. 
												<li>This page uses a basic form handler written in PERL to send an email to site administrator and an autoreply to the sender.
											</ul>
								</td>
							</tr>
							<tr>
								<td colspan=2 height=1 width="100%"><hr size="1" color="#666666" NOSHADE></td>
							</tr>
							<tr>
								<th valign=top class="display" width=150>Database<br>Adminstration</th>
								<td valign=top class="display">
									<ul type=disc>
										<li>This part of the site is password protected and uses the .htaccess feature of Apache.
										<li>Inserting records
											<ul>
												<li>All data comes from the Album information on Amazon.com.
												<li>The record numbers are incremented using the automatic feature of MySQL.
												<li>When the record is initially inserted, a default cover image is used. See below for adding images.
											</ul>
										<li>Updating, Deleting records
											<ul>
												<li>The search form on the main update page returns its results in an editable format.
												<li>You can use the update page to upload images to the /phpCDs/covers sub-directory automatically.
											</ul>		
								</td>
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
<p><br>

<?php include("include/html_end.inc"); ?>
