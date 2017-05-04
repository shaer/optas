app.filter('namespaceFormat', function($sce) {
    return function(input) {
        var colorPalette = ['#0000FF', '#FF0000', '#008000', '#FF00FF', '#000000'];
        var namespace = input.split(".");
        var output = Array();
        for (var item in namespace) {
            output[item] = "<span style='color:" + colorPalette[item] + "'>" + namespace[item] + "</span>";
        }

        return $sce.trustAsHtml(output.join("."));
    };
});
