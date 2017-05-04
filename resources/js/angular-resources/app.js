var app = angular.module('OptasJobs', [
    'ngAnimate',
    'ngRoute',
    'ngMaterial',
    'angular-loading-bar'
]);

app.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
        when('/', {
            templateUrl: '/app/jobs/list_jobs.html',
            controller: 'JobsController'
        });
    }
]);


app.config(['$qProvider', function($qProvider) {
    $qProvider.errorOnUnhandledRejections(false);
}]);

app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
}]);

app.config(function($mdThemingProvider) {
    $mdThemingProvider.theme('default')
        .primaryPalette('green')
        .accentPalette('indigo')
        .warnPalette('red');
});
