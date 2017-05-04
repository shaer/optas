app.filter('dateToISO', function() {
    return function(input) {
        if (input === null)
            return 'Uncalculated';

        return new Date(Date.parse(input.replace('-', '/', 'g')));
    };
});
