#!/usr/bin/perl 
#===============================================================================
#
#         FILE:  check_strings.pl
#
#        USAGE:  ./check_strings.pl 
#
#  DESCRIPTION:  
#
#      OPTIONS:  ---
# REQUIREMENTS:  ---
#         BUGS:  ---
#        NOTES:  ---
#       AUTHOR:   (), <>
#      COMPANY:  
#      VERSION:  1.0
#      CREATED:  01/04/10 14:27:13 CEST
#     REVISION:  ---
#===============================================================================

use strict;
use warnings;
use JSON;
use v5.10;
use utf8;
use File::Slurp::Unicode;
use Data::Dumper;
use Regexp::Common 'RE_ALL';

my $strings = from_json(read_file('msg.json'));

sub quot {
	my $retval = shift;
	$retval =~ s/"/\\"/;
	return $retval;
}
foreach my $file( `find admin -name \\\*.php -o -name \\\*.js` ) {
	chomp $file;
	my $text = read_file( $file, encoding => 'utf8'  );
    #my $bal_re =  RE_balanced(-parens=>'()');
    while( my($key, $value) = each( %$strings ) ) {
		$value = quot $value;
        $text =~ s/\$\.message\( \s* ['"] $key ['"] \s* \)/_("$value")/gx;
        $text =~ s/\$\.message\( \s* ['"] $key ['"] \s* , \s* (.*?)\)/sprintf(_("$value"), $1)/gx;
    }
    #$text =~ s/\bt\( \s* ['"] (.*?) ['"] \s* , \s* (.*?)\)/"sprintf(_(\"".quot($1)."\"), $2)"/egx;
    #$text =~ s/\bt($bal_re)/_$1/gx;
    #$text =~ s/_\("(.*?)€PLATFORM_NAME€(.*?)"\)/sprintf(_("$1%s$2"), NAME)/gx;
    write_file( $file, { encoding => 'utf8' }, $text );
}
