#!/usr/bin/perl
##############################################################################
# Cliff's Form Mailer Version 1.0                                            # 
# Copyright 1998 Shaven Ferret Productions                                   #
# Created 6/4/98                                                             #
# Available at http://www.shavenferret.com/scripts                           #
##############################################################################
# COPYRIGHT NOTICE                                                           #
# Copyright 1998 Shaven Ferret Productions All Rights Reserved.              #
#                                                                            #
# This script can be used\modified free of charge as long as you don't       #
# change this header thing, or the part that gives me credit for writing     #
# script in the e-mail.  If you really need to remove this part, go to       #
# http://www.shavenferret.com/scripts/register.shtml .  By using this script #
# you agree to indemnifyme from any liability that might arise from its use. #
# In simple English, if this script somehow makes your computer run amuck    #
# and kill the pope, it's not my fault.                                      #
#                                                                            #
# Redistributing\selling the code for this program without prior written     #
# consent is expressly forbidden.                                            #
##############################################################################

# Enter the location of sendmail.  
$mailprogram = "/usr/sbin/sendmail -t";

# Enter the fields that are required.  They should each be in quotes and
# separated by a comma.  If no fields are required, change the next line
# to @required = ();
@required = ('name','email','body');

# Enter your e-mail address.  Be sure to put a \ in front of the @.
# (user@domain.com becomes user\@domain.com)
$youremail = "webmaster\@aretemm.net";

##############################################################################
# Congratulations!  You've finished defining the variables.  If you want to, #
# you can continue screwing with the script, but it isn't necessary.         #
##############################################################################

# Put the posted data into variables

read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
@pairs = split(/&/, $buffer);
foreach $pair (@pairs) {
        ($name, $value) = split(/=/, $pair);
        $value =~ tr/+/ /;
        $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
        $FORM{$name} = $value;
}

# Check for all required fields

foreach $check(@required) {
        unless ($FORM{$check}) {
                print "Content-type: text/html\n\n";
print "<html>
<head><title>phpCDs :: Online Music Inventory</title>
 
<STYLE>
body {
        scrollbar-3dlight-color:#666666;
        scrollbar-arrow-color:#00000;
        scrollbar-darkshadow-color:#000000;
        scrollbar-face-color:#999999;
        scrollbar-highlight-color:#666666;
        scrollbar-track-color:#666666;
        scrollbar-shadow-color:#333333;
        background-color:#FFFFFF;
}

a:link {color: #000000}
a:visited {color: #000000}
a:hover {color: #000000}
a:active {color: #000000}
.zarko {color: #000000; font-family:tahoma; font-size:8pt}

</STYLE></head>\n";
print "<BODY bgcolor=\"#FFFFFF\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0><center>";
print "<table width=\"100%\" bgcolor=\"#DDDDDD\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
<th align=\"left\" valign=\"middle\" class=\"zarko\">&nbsp;&nbsp;&nbsp;phpCDs :: Online Music Inventory</th>
<th align=\"right\" valign=\"middle\" class=\"zarko\"><a href=\"/phpCDs/cart.php\"  class=\"zarko\">View Cart</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/phpCDs/insert.php\" class=\"zarko\">Update Page</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/phpCDs/welcome2.php\" class=\"zarko\">Help :: About</a>&nbsp;&nbsp;&nbsp;</th>
</tr>
</table>";

                print "<h1>Missing Information</h1>\n";
                print "I'm sorry, but it would appear that you've forgotten to\n";
                print "fill out the <kbd><b>$check</b></kbd> field.  Please click\n";
                print "back and try again.\n";
		print "<p><input type=button name=back value=\"Back to Form\" onClick=\"javascript:history.go(-1);\">";
                print "</body></html>\n";
                exit;
        }
}

# Check the senders email

if ($FORM{'email'}) {
        unless ($FORM{'email'} =~ /\w+@\w+.\w+/) {
                print "Content-type: text/html\n\n";
   
                print "<html><title>phpCDs :: Online Music Inventory</title>
 
<STYLE>
body {
        scrollbar-3dlight-color:#666666;
        scrollbar-arrow-color:#00000;
        scrollbar-darkshadow-color:#000000;
        scrollbar-face-color:#999999;
        scrollbar-highlight-color:#666666;
        scrollbar-track-color:#666666;
        scrollbar-shadow-color:#333333;
        background-color:#FFFFFF;
}

a:link {color: #000000}
a:visited {color: #000000}
a:hover {color: #000000}
a:active {color: #000000}
.zarko {color: #000000; font-family:tahoma; font-size:8pt}
</STYLE></head>\n";
print "<BODY bgcolor=\"#FFFFFF\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0><center>";
print "<table width=\"100%\" bgcolor=\"#DDDDDD\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
<th align=\"left\" valign=\"middle\" class=\"zarko\">&nbsp;&nbsp;&nbsp;phpCDs :: Online Music Inventory</th>
<th align=\"right\" valign=\"middle\" class=\"zarko\"><a href=\"/phpCDs/cart.php\"  class=\"zarko\">View Cart</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/phpCDs/insert.php\" class=\"zarko\">Update Page</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/phpCDs/welcome2.php\" class=\"zarko\">Help :: About</a>&nbsp;&nbsp;&nbsp;</th>
</tr>
</table>";
		print "<h1>Bad E-mail</h1>The e-mail address that you've\n";
                print "entered, <kbd><b>$FORM{'email'}</b></kbd>, is invalid.  Please click back and\n";
                print "try again.\n";
		print "<p><input type=button name=back value=\"Back to Form\" onClick=\"javascript:history.go(-1);\">";
		print "</body></html>\n";
                exit;
        }
}

open (MAIL,"|$mailprogram");
print MAIL "To: $youremail\n";
print MAIL "From: $FORM{'email'}\n";
print MAIL "Subject: $FORM{'subject'}\n";
print MAIL "Hello.  The following information has been submitted:\n\n";
foreach $pair (@pairs) {
        ($name, $value) = split(/=/, $pair);
        $value =~ tr/+/ /;
        $value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
        unless ($name eq "response" || $name eq "email" || $name eq "subject") { 
                print MAIL "$name: $value\n";
        }
}
close MAIL;

if ($FORM{'response'} && $FORM{'email'}) {
        open (RESPONSE, $FORM{'response'});
        @response = <RESPONSE>;
        close(RESPONSE);
        open (MAIL,"|$mailprogram");
        print MAIL "To: $FORM{'email'}\n";
        print MAIL "From: $youremail\n";
        print MAIL "Subject: $FORM{'subject'} -- Autoresponse\n";
        foreach $line (@response) {
                print MAIL "$line";
        }
        close MAIL;
}

print "Content-type: text/html\n\n";
print "<html>
<head><title>phpCDs :: Online Music Inventory</title>
 
<STYLE>
body { 
        scrollbar-3dlight-color:#666666;
        scrollbar-arrow-color:#00000;
        scrollbar-darkshadow-color:#000000;
        scrollbar-face-color:#999999;
        scrollbar-highlight-color:#666666;
        scrollbar-track-color:#666666; 
        scrollbar-shadow-color:#333333;
	background-color:#FFFFFF;
}

a:link {color: #000000} 
a:visited {color: #000000} 
a:hover {color: #000000} 
a:active {color: #000000} 
.zarko {color: #000000; font-family:tahoma; font-size:8pt}

</STYLE></head>\n";
print "<BODY bgcolor=\"#FFFFFF\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0><center>";
print "<table width=\"100%\" bgcolor=\"#DDDDDD\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
<tr>
<th align=\"left\" valign=\"middle\" class=\"zarko\">&nbsp;&nbsp;&nbsp;phpCDs :: Online Music Inventory</th>
<th align=\"right\" valign=\"middle\" class=\"zarko\"><a href=\"/phpCDs/cart.php\"  class=\"zarko\">View Cart</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/phpCDs/insert.php\" class=\"zarko\">Update Page</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/phpCDs/welcome2.php\" class=\"zarko\">Help :: About</a>&nbsp;&nbsp;&nbsp;</th>
</tr>
</table>";
print "<h1>Thank you!</h1>Thanks for your submission! \n";
if ($FORM{'response'} && $FORM{'email'}) {
        print "You should receive an autoresponse shortly.<p>\n";
}
print "</body></html>";



