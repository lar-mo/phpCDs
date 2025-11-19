#!/usr/bin/perl
# 
# redirect.pl
#
read(STDIN, $query_string, $ENV{'CONTENT_LENGTH'});
# Parse name-value pairs and de-webbify.
@key_value_pairs = split(/&/, $query_string);
foreach $key_value (@key_value_pairs) {
 ($key, $value) = split (/=/, $key_value);
 $key =~ tr/+/ /;
 $value =~ tr/+/ /;
 $value =~ s/%([\dA-Fa-f][\dA-Fa-f])/pack ("C", hex($1))/eg;
 if (defined($array{$key})) {
 $array{$key} = join("|", $array{$key}, $value);
 } else {
 $array{$key} = $value;
 }
} 
if ($array{'url'} eq "") {
 print "Status: 204 Do Nothing\n\n";
 exit(0);
}
elsif ($array{'url'} !~ /^http/) {
 $prefix = "http://" . $ENV{'SERVER_NAME'};
 if ($ENV{'SERVER_PORT'} ne "80") {
 $prefix .= ":" . $ENV{'SERVER_PORT'};
 }
 if ($array{'url'} !~ /^\//) {
 $prefix .= "/";
 }
 $array{'url'} = $prefix . $array{'url'};
}
print <<EOF;
Content-type: text/html
Location: $array{'url'}

EOF
