<?php

	include("include/db.php");

	switch($_GET["action"] ?? 'default')
	{
		case "add_item":
		{
			AddItem($_GET["id"], $_GET["qty"]);
			ShowCart();
			break;
		}
		case "update_item":
		{
			UpdateItem($_GET["id"], $_GET["qty"]);
			ShowCart();
			break;
		}
		case "remove_item":
		{
			RemoveItem($_GET["id"]);
			ShowCart();
			break;
		}
		default:
		{
			ShowCart();
		}
	}


	function ShowCart()
	{
		// Gets each item from the cart table and display them in
		// a tabulated format, as well as a final total for the cart

		global $dbServer, $dbUser, $dbPass, $dbName;

		// Get a connection to the database
		$con = mysqli_connect($dbServer,$dbUser,$dbPass) or die("Unable to connect to database" . mysqli_errno($con));
		$database = mysqli_select_db($con, "$dbName") or die("Unable to select database $dbName" . mysqli_errno($con));

		$totalCost = 0;
		$cartId = GetCartId();
		$result = mysqli_query($con, "select * from cart inner join cds on cart.itemId = cds.id where cart.cookieId = '$cartId' order by cart.cartId asc");
		?>
		<?php include "include/html_hdr.inc"; ?>
		<title>phpCDs :: Online Music Inventory</title></head>
		<?php include("include/body.inc"); ?>
		<?php include "include/zarkobar.inc"; ?>

		<p>
<form name="frmCart" method="POST" action="include/send_email.php">
<table bgcolor="#666666" cellspacing="0" cellpadding="1" border=0 width=640>
	<tr>
		<td>
			<table bgcolor="#DDDDDD" border=0 width="100%" cellpadding="0" cellspacing="0">
				<tr bgcolor="#666666">
					<td>
						<table width="100%" cellpadding="1" cellspacing="1">
							<tr>
								<th colspan=3 bgcolor="#666666" class="display2">Checkout</th>
							</tr>
						</table>
					</td>
				</tr>
				<tr bgcolor="#DDDDDD">
					<td align=center align="center" class=display>
						<table border=0>
							<tr>
								<td align=center colspan="3" bgcolor="#DDDDDD">
									<table border=0 bgcolor="#DDDDDD">
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
											<td align=center><input type="text" name="subject" value="phpCDs :: CD request"></td>
										</tr>
										<tr>
											<th class="display"><dd>Enter your Address</th>
											<td><img src="images/1pix.gif" width=1 height=10></td>
										</tr>
										<tr>
											<th colspan=2><textarea name="body" cols="42" rows="6" wrap="true"></textarea>
										    	<center><input type="button" value="View Cart" class="display" onClick="self.location='cart.php'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset" class="display">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Send Request" class="display"></center>
										</tr>
										<tr>
											<td colspan=2><img src="images/1pix.gif" width=1 height=10></td>
										</tr>
									</table>
								</th>
							</tr>
						</table>

			<?php

			while($row = mysqli_fetch_array($result))
			{

			?>

				<INPUT TYPE="HIDDEN" NAME="id[]" value="<?php echo $row["id"]; ?>">
				<INPUT TYPE="HIDDEN" NAME="artist[]" value="<?php echo $row["artist"]; ?>">
				<INPUT TYPE="HIDDEN" NAME="album[]" value="<?php echo $row["album"]; ?>">

			<?php

			}

			?>

				<INPUT TYPE="HIDDEN" NAME="form_type" value="checkout">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

			</form>
			</body>
			</html>

<?php

	}

?>
