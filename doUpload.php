<?

// Adapted from PHP Image Uploader V1.1 Random Number Name
// by Zach White
// www.zachwhite.com

//user defined variables
$abpath = "/usr/local/apache/htdocs/phpCDs/covers"; //Absolute path to where images are uploaded. No trailing slash
$sizelim = "yes"; //Do you want size limit, yes or no
$size = "25000"; //What do you want size limited to be if there is one

//all image types to upload
$cert1 = "image/pjpeg"; //Jpeg type 1
$cert2 = "image/jpeg"; //Jpeg type 2
$cert3 = "image/gif"; //Gif type

$log = "";
$random1 = rand(1, 99999999);
$coverid = $_REQUEST['coverid'];
//begin upload 1

$img1 = $_FILES['img1']['tmp_name'];
$img1_name = $_FILES['img1']['name'];
$img1_size = $_FILES['img1']['size'];
$img1_type = $_FILES['img1']['type'];

//checks if file exists

if ($img1_name == "") {
	$log .= "No file selected for upload.<br>";
}

if ($img1_name != "") {

	//checks if file exists

	if (file_exists("$abpath/$img1_name")) {
		$log .= "File already existed.<br>";
	}

	//checks if file is too big

	if ($sizelim == "yes") {
		if ($img1_size > $size) {
			$log .= "File was too big.<br>";
		}
	}

	//Checks if file is an image

	if (($img1_type == $cert1) or ($img1_type == $cert2) or ($img1_type == $cert3)) {
		if ($img1_type == $cert3) {
			$img1_name = "icon" . $coverid . ".gif";
		} else {
			$img1_name = "icon" . $coverid . ".jpg";
		}
	
		@copy($img1, "$abpath/$img1_name") or $log .= "Couldn't copy image to server.<br>";
		if (file_exists("$abpath/$img1_name")) {
			$log .= "<b>The file was successfully uploaded.</b><p><dd><b>FileName</b> $img1_name<br><dd><b>FileSize</b> $img1_size<br><dd><b>FileType</b> $img1_type";
		}
	} else {
		$log .= "Image must be in .jpg format.<br>";
	}
}
?>

<?php include("include/html_hdr.inc"); ?>

<title>Add Image</title></head>

<?php include("include/body.inc"); ?>

<?php include("include/zarkobar2.inc"); ?>

<p>
<table bgcolor="#666666" cellspacing="1" cellpadding="1" border=0 width=300>
	<tr>
		<td bgcolor="#666666" class="display2" align=left><b>Add Image</b> for ID #<?php echo $coverid; ?></td>
		<td bgcolor="#666666" class="display2" align=right>&lt;&lt; <a href="javascript:history.go(-1);" class=text2>Go Back</a></td>
	</tr>
	<tr>
		<td bgcolor="#DDDDDD" align=center colspan=2>
			<table border=0>
				<tr>
					<td class=display align=left height=100>
					<?php echo $log; ?><br>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php include("include/html_end.inc"); ?>