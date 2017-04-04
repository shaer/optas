#!/usr/bin/perl
use strict;
use warnings;
use Data::Dumper;
use DBI;
use PHP::Serialization qw(unserialize);
use FindBin;
use lib "$FindBin::Bin/../libs";
use Helpers;

my $filename = $ARGV[0];

my $filepath = $FindBin::Bin . '/../../storage/tmp/' . $filename;
my $data = unserialize(Helpers::readFile $filepath);
unlink $filepath;


my $server_type = defined $data->{connection}->[0] ? $data->{connection}->[0] : '';
my $database    = defined $data->{connection}->[1] ? $data->{connection}->[1] : '';
my $server      = defined $data->{connection}->[2] ? $data->{connection}->[2] : '';
my $username    = defined $data->{connection}->[3] ? $data->{connection}->[3] : '';
my $password    = defined $data->{connection}->[4] ? $data->{connection}->[4] : '';

my $dbh = DBI->connect("dbi:$server_type:$database",$username, $password) 
    or print "Cannot connect to $database using the provided username and password";
    
my $sth = $dbh->prepare($data->{query}->[0]);
my $output = $sth->execute();


if($output ne '0E0') {
    if(defined $sth->{NUM_OF_FIELDS}){
        my @records;
        my $has_records = 0;
        while (my @data = $sth->fetchrow_array())
        {
            push @records, [@data];
            $has_records = 1;
        }
        if($has_records == 0) {
            print "No Records Found";
        } else {
            print Dumper(@records);
        } 
    } else {
        print "Success!, Total processed records: $output";
    }
} else {
    print "Query executed successfully no records matched";
}