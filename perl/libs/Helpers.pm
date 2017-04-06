package Helpers;

use strict;
use warnings;
use Exporter qw(import);
our @EXPORT_OK = qw(readFile saveCsv);

sub readFile {
    my $filename = shift;
    
    my $output;
    if (open(my $fh, '<:encoding(UTF-8)', $filename)) {
        while (my $row = <$fh>) {
            chomp $row;
            $output .= $row;
        }
        return $output
    } else {
        warn "Could not open file '$filename' $!";
    }
    
    return 0;
}

sub saveCsv {
    my $filename = shift;
    my $data     = shift;
    my $header   = shift;

    my $csv = Text::CSV->new ({binary => 1, eol => $/, escape_char => "\\"});
    open my $fh, ">:encoding(utf8)", $filename;
    $csv->print ($fh, $header) if defined $header; 
    $csv->print ($fh, $_) for @{$data};
    close $fh;
}

1;