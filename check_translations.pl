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
use File::Slurp;
use Data::Dumper;

use v5.10;

open PHP, '>missing_de_php.list';
open PHP_HELP, '>missing_de_help_php.list';
open JSON, '>missing_de_json.list';

my $en = from_json(`php -r "define('NAME', 'b3');require_once(\\\"admin/views/default/i18n/en/bubba_lang.php\\\");echo json_encode(\\\$lang);"`);
my $de = from_json(`php -r "define('NAME', 'b3');require_once(\\\"admin/views/default/i18n/de/bubba_lang.php\\\");echo json_encode(\\\$lang);"`);

while(my($k,$v) = each(%$en)) {
	if(not defined $de->{$k}) {
		say PHP "\$lang['$k'] = '$v'";
	}
}

say PHP "# non-key-converted strings";
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
	if( ! exists $en->{$str} ) {
		$nf->{$str}++;
	}
}

while (my($k,$v) = each %$nf ) {
	say PHP "\$lang['$k'] = '$k'";
}

$en = from_json(`php -r "define('NAME', 'b3');require_once(\\\"admin/views/default/i18n/en/help_lang.php\\\");echo json_encode(\\\$lang);"`);
$de = from_json(`php -r "define('NAME', 'b3');require_once(\\\"admin/views/default/i18n/de/help_lang.php\\\");echo json_encode(\\\$lang);"`);
$ts = ();
$nf = ();

while(my($k,$v) = each(%$en)) {
	if(not defined $de->{$k}) {
		say PHP_HELP "\$lang['$k'] = '$v'";
	}
}

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
	if( ! exists $en->{$str} && $str =~ /help/) {
		$nf->{$str}++;
	}
}

while (my($k,$v) = each %$nf ) {
	say PHP_HELP "\$lang['$k'] = '$k'";
}

$en = read_file('en.js');
$en = from_json($en);

$de = read_file('de.js');
$de = from_json($de);

my $json = {};
while(my($k,$v) = each(%$en)) {
	if(not defined $de->{$k}) {
		$json->{$k} = $v;
	}
}

say JSON to_json($json, {pretty => 1});
