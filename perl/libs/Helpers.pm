package Helpers;

use strict;
use warnings;
use Exporter qw(import);
our @EXPORT_OK = qw(readFile);

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

1;