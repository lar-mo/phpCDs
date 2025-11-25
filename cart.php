<?php

/////////////////////////////////////////////////////////////////////////////////////
//
// cart.php -- adapted from "Building A Persistent Shopping Cart With PHP and MySQL"
//             By: Mitchell Harper
//             Published: 18th May 2002
//             http://www.devarticles.com/content.php?articleId=132
//
/////////////////////////////////////////////////////////////////////////////////////

	include("include/db.php");

	switch($_GET["action"] ?? 'default')
	{
		case "add_item":
		{
			AddItem($_GET["id"], $_GET["qty"]);
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

	function AddItem($itemId, $qty)
	{
		// Will check whether or not this item
		// already exists in the cart table.
		// If it does, the UpdateItem function
		// will be called instead

		global $dbServer, $dbUser, $dbPass, $dbName;

		// Get a connection to the database
		$con = mysqli_connect($dbServer,$dbUser,$dbPass) or die("Unable to connect to database" . mysqli_errno($con));
		$database = mysqli_select_db($con, "$dbName") or die("Unable to select database $DBName" . mysqli_errno($con));

		$cartId = GetCartId();

		// Check if this item already exists in the users cart table
		$sqlquery = "select count(*) from cart where cookieId = '$cartId' and itemId = $itemId";
		$result = mysqli_query($con, $sqlquery);
		$row = mysqli_fetch_row($result);
		$count = $row[0];

		if($count == 0)
		{
			// This item doesn't exist in the users cart,
			// we will add it with an insert query

			$insertQuery = "insert into cart(cookieId, itemId, qty) values('$cartId', $itemId, $qty)";
			$insertResult = mysqli_query($con, $insertQuery);
		}
		else
		{
			// This item already exists in the users cart,
			// we will update it instead
			return false;
			// UpdateItem($itemId, $qty);
		}
	}

	function RemoveItem($itemId)
	{
		// Uses an SQL delete statement to remove an item from
		// the users cart

                global $dbServer, $dbUser, $dbPass, $dbName;

                // Get a connection to the database
                $con = mysqli_connect($dbServer,$dbUser,$dbPass) or die("Unable to connect to database" . mysqli_errno($con));
                $database = mysqli_select_db($con, "$dbName") or die("Unable to select database $DBName" . mysqli_errno($con));

		mysqli_query($con, "delete from cart where cookieId = '" . GetCartId() . "' and itemId = $itemId");
	}

	function ShowCart()
	{
		// Gets each item from the cart table and display them in
		// a tabulated format, as well as a final total for the cart

                global $dbServer, $dbUser, $dbPass, $dbName;

                // Get a connection to the database
                $con = mysqli_connect($dbServer,$dbUser,$dbPass) or die("Unable to connect to database" . mysqli_errno($con));
                $database = mysqli_select_db($con, "$dbName") or die("Unable to select database $DBName" . mysqli_errno($con));

		$totalCost = 0;
		$cartId = GetCartId();
		$query = "select * from cart inner join cds on cart.itemId = cds.id where cart.cookieId = '$cartId' order by cart.cartId asc";
		$result = mysqli_query($con, $query);
		$rowcount = mysqli_num_rows($result);
		?>
		<?php include "include/html_hdr.inc"; ?>

		<SCRIPT LANGUAGE="JavaScript">
		<!--
		function validate() {
			if(document.frmCart.id){
				return true;
			} else {
				alert('Your cart is empty!');
				return false;
			}
		}

  		//--></SCRIPT>

		</head>
		<?php include("include/body.inc"); ?>
		<?php include "include/zarkobar.inc"; ?>
		<form name="frmCart" method="POST" action="checkout.php" onSubmit="return validate();">
		<p>
	<table bgcolor="#666666" cellspacing="0" cellpadding="1" border=0 width=640>
		<tr>
			<td>
				<table bgcolor="#DDDDDD" border=0 width="100%" cellpadding="0" cellspacing="0">
					<tr bgcolor="#666666">
						<td>
							<table width="100%" cellpadding="1" cellspacing="1">
								<tr>
									<th bgcolor="#666666" class="display2">View Cart</th></tr>
								</tr>
							</table>
						</td>
					</tr>
					<tr bgcolor="#DDDDDD">
						<td align=center align="center" class=display>
							<table border=0 width="100%">
								<tr>
									<td class="display" bgcolor="#DDDDDD">&nbsp;<b>ID#</b></td>
									<td class="display" bgcolor="#DDDDDD"><b>Artist</b></td>
									<td class="display" bgcolor="#DDDDDD"><b>Album</b></td>
									<td class="display" bgcolor="#DDDDDD"><b>Remove?</b></td>
								</tr>
								<tr>
									<td width="100%" colspan="4" bgcolor="#DDDDDD"><hr size="1" color="#666666" NOSHADE></td>
								</tr>
			<?php

			$row = mysqli_fetch_all($result,MYSQLI_ASSOC);
			if (count($row) == 0) {
                echo "<tr><td height=\"25\" class=\"zarko\" colspan=4 align=\"center\">The cart is empty.</td></tr>";
			}
			for($i=0;$i<$rowcount;$i++)
			{
			?>
			<tr>
	<td height="25"><input type=hidden name=id value="<?php echo $row[$i]['id']; ?>"><a href="cdlistSearch.php?searchType=id&query=<?php echo $row[$i]['id']; ?>" class="cart2"><?php echo $row[$i]['id']; ?></a></td>
	<td height="25" class="zarko"><input type=hidden name=artist value="<?php echo $row[$i]['artist']; ?>"><?php echo $row[$i]['artist']; ?></td>
	<td height="25" class="zarko"><input type=hidden name=album value="<?php echo $row[$i]['album']; ?>"><?php echo $row[$i]['album']; ?></td>
	<td height="25"><a href="cart.php?action=remove_item&id=<?php echo $row[$i]['id']; ?>" class="cart2">Remove</a></td>
								</tr>

			<?php
			}
			?>
	<tr>
	<td width="100%" bgcolor="#DDDDDD" colspan="4">
		<hr size="1" color="#666666" NOSHADE>
	</td>
	</tr>
	<tr>
	<td colspan="2" bgcolor="#DDDDDD" align=left>
		<input type="button" name="go_back" value="&lt;&lt; Keep Browsing" onClick="javascript:history.go(-1);" class=display>
	</td>
	<td colspan="2" bgcolor="#DDDDDD" align=right>
		<input type="submit" name="checkout" value="Checkout &gt;&gt;" class=display>
	</td>
	</tr>
							</table>
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
