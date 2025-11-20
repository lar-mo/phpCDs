<?php

	print "<tr><td width=\"120\" height=\"120\" bgcolor=\"#DDDDDD\" align=\"center\" valign=\"middle\">";

// checks to see the cover image exists:
// -if image doesn't exist-> show the default cover image(no_art.jpg)
// -if image does exist -> show the album cover image (eg. icon123.jpg)

	if (file_exists(__DIR__."/../covers/icon$theid.jpg")) {
		print "<img src=\"covers/icon$theid.jpg\" width=\"90\" height=\"90\" alt=\"$theid\"><br><a href=\"cart.php?action=add_item&id=$theid&qty=1\" class=\"cart2\">Add to Cart</a>";
	} else {
		print "<img src=\"covers/no_art.jpg\" width=\"90\" height=\"90\" border=0 alt=\"$theid\"><br><a href=\"cart.php?action=add_item&id=$theid&qty=1\" class=\"cart2\">Add to Cart</a>";
	}

	print "</td><td bgcolor=\"#DDDDDD\" align=\"left\" valign=\"middle\">
	  <table border=0>
	    <tr>
	      	<th valign=top class=display>Artist:</th>
		<td valign=top class=display width=\"175\">
	";

// if query is by artist, show the DuckDuckGo link
// if query isn't by artist, show the internal link

	if ($query == "1") {
		print "$theartistraw<br><a href=\"https://duckduckgo.com/?q=$theartist\" target=\"_blank\" class=text><font size=1>Search for this Artist</font></a>";
	} else {
		print "$theartistraw<br><a href=\"cdlistANY.php?query=1&artist=$theartist\" class=text><font size=1>View All by this Artist</font></a>";
	}

	print "</td><th valign=top class=display>Genre:</th>
		<td class=display valign=top width=\"150\">
	";

// if query is by genre, show the DuckDuckGo link
// if query isn't by genre, show the internal link

	if ($query == "3") {
		print "$thegenreraw<br><a href=\"https://duckduckgo.com/?q=$thegenre\" target=\"_blank\" class=text><font size=1>Search for this Genre</font></a>";
	} else {
		print "$thegenreraw<br><a href=\"cdlistANY.php?query=3&genre=$thegenre\" class=text><font size=1>View All in this Genre</font></a>";
	}

	print "</td></tr>
	    <tr>
		<th valign=top class=display>Album:</th>
		<td valign=top class=display width=\"175\">$thealbumraw<br><a href=\"https://duckduckgo.com/?q=$theartist+$thealbum\" target=\"_blank\" class=text><font size=1>Search for this Album</font></a></td>
		<th valign=top class=display>Released:</th>
	      	<td valign=top class=display width=\"150\">$therelease_dateraw</td>
	    </tr>
	    <tr>
	      	<th valign=top class=display>Label:</th>
		<td valign=top class=display width=\"175\">
	";

// if query is by record label, show the DuckDuckGo link
// if query isn't by record label, show the internal link

	if ($query == "4") {
	    if (preg_match('(Records)', $therecord_label) === 1) {
		    print "$therecord_labelraw<br><a href=\"https://duckduckgo.com/?q=$therecord_label\" target=\"_blank\" class=text><font size=1>Search for this Record Label</font></a>";
		} else {
		    print "$therecord_labelraw<br><a href=\"https://duckduckgo.com/?q=$therecord_label+records\" target=\"_blank\" class=text><font size=1>Search for this Record Label</font></a>";
        }
	} else {
		print "$therecord_labelraw<br><a href=\"cdlistANY.php?query=4&record_label=$therecord_label\" class=text><font size=1>View All by this Record Label</font></a>";
	}

	print "</td><th valign=top class=display># of Discs:</th>
	      	<td valign=top class=display width=\"150\">$thenumber_of_discsraw</td>
	    </tr>
	  </table>
	</td></tr>
	";

?>
