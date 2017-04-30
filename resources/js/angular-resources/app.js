var app = angular.module('OptasJobs', [
    'ngAnimate',
    'ngRoute',
    'ngMaterial'
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
