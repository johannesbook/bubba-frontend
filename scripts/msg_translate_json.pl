#!/usr/bin/perl -CS
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
use Locale::PO;
use List::Compare;
use Encode;

my $lang = 'es';

my $english = from_json(read_file("msg.json"));
my $foreign = from_json(read_file("msg_$lang.json"));
my %strings = map {if(exists $english->{$_}) {  $english->{$_} => $foreign->{$_} } else { 0 => 0 } } keys %$foreign;

my $href = Locale::PO->load_file_ashash("po/json/$lang.po");
Locale::PO->save_file_fromhash("po/json/$lang-old.po",$href);

while( my($key, $value) = each( %strings ) ) {
	if(exists $href->{Locale::PO->quote($key)}) {
		 $href->{Locale::PO->quote($key)}->msgstr(encode_utf8($value));
	}
}
Locale::PO->save_file_fromhash("po/json/$lang-new.po",$href);
