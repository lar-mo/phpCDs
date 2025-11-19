<?php 
$error_msg = $_GET['msg'] ?? 'An error occurred. Please try again.';
?>
<?php include("include/html_hdr.inc"); ?>
<title>phpCDs :: Error</title></head>
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
                                <th colspan=3 bgcolor="#666666" class="display2">Error</th>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr bgcolor="#DDDDDD">
                    <td align=center class=display>
                        <table border=0 cellpadding=20>
                            <tr>
                                <td align=center>
                                    <p class="display" style="color: #CC0000;">Error: <?php echo htmlspecialchars($error_msg); ?></p>
                                    <p><a href="javascript:history.back()" class="display">Go Back</a> | <a href="index.php" class="display" target="_top">Return to Home</a></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php include("include/html_end.inc"); ?>
