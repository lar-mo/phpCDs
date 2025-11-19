<?php
// Determine base path based on current location
$base = (strpos($_SERVER['PHP_SELF'], '/auth/') !== false) ? '../' : '';
?>
<table width="100%" bgcolor="#DDDDDD" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<th align="left" valign="middle" class="zarko">&nbsp;&nbsp;&nbsp;phpCDs :: Online Music Inventory</th>
		<th align="right" valign="middle" class="zarko"><a href="<?php echo $base; ?>cart.php" class="zarko">View Cart</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $base; ?>auth/insert.php" class="zarko">Update Page</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $base; ?>welcome2.php" class="zarko">Help :: About</a>&nbsp;&nbsp;&nbsp;</th>
	</tr>
</table>
