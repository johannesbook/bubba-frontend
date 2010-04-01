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
use Perl6::Say;
use File::Slurp;
use Data::Dumper;

my $strings = from_json(`php -r "require_once(\\\"admin/views/default/i18n/default/bubba_lang.php\\\");echo json_encode(\\\$lang);"`);
my $ts = ();
my $nf = ();

foreach my $file( `find admin/views/default/ -name \\\*.php` ) {
	chomp $file;
	my @lines = read_file( $file );
	my @used_strings = grep { !/\$/ } map { /\bt\("(.*?)"\)/g } grep { !/^\s*(\/\/|\#)/ && /\bt\("[^"]*?"\)/ } @lines;
	foreach my $str ( @used_strings ) {
		$ts->{$str}++;
	}

	@used_strings = grep { !/\$/ } map { /\bt\('(.*?)'\)/g } grep { !/^\s*(\/\/|\#)/ && /\bt\('[^']*?'\)/ } @lines;
	foreach my $str ( @used_strings ) {
		$ts->{$str}++;
	}

}
foreach my $str( keys %$ts ) {
	if( ! exists $strings->{$str} ) {
		$nf->{$str}++;
	}
}
say join "\n", keys %$nf;

