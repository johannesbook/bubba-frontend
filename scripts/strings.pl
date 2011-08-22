#!/usr/bin/perl
#===============================================================================
#
#         FILE:  strings.pl
#
#        USAGE:  ./strings.pl
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

my $tstring=`php -r "define('NAME','NAMN');require_once(\\\"admin/views/default/i18n/default/bubba_lang.php\\\");echo json_encode(\\\$lang);"`;

my $strings = from_json($tstring);
my $ts = ();
my $nf = ();


foreach my $file( `find admin/views/default/ -name \\\*.php` ) {
	chomp $file;
	my @lines = read_file( $file );
	my @used_strings = grep { !/\$/ } map { /\bt\("(.*?)"\)/g } grep { !/^\s*(\/\/|\#)/ && /\bt\("[^"]*?"\)/ } @lines;
	foreach my $str ( @used_strings ) {
		#print "String: [$str]\n";
		$ts->{$str}++;
	}

	@used_strings = grep { !/\$/ } map { /\bt\('(.*?)'\)/g } grep { !/^\s*(\/\/|\#)/ && /\bt\('[^']*?'\)/ } @lines;
	foreach my $str ( @used_strings ) {
		#print "String: [$str]\n";
		$ts->{$str}++;
	}

}

foreach my $str( sort keys %$ts ) {
	if( ! exists $strings->{$str} ) {
		$nf->{$str}++;
		$strings->{$str}="[NEW]$str";
		#print "$str\n";
	}
}

#print "<?php\n";
#foreach my $k( keys %$strings){
#	print "\$lang[\"$k\"]=\"".$strings->{$k}."\";\n";
#}

foreach my $k ( keys %$nf ){
	print "\$lang[\"$k\"]=\"$k\";\n";
}

#say join "\n", keys %$nf;
