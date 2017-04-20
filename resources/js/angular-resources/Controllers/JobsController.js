app.controller('JobsController', ['$scope','$http', 
    function($scope, $http) {
        
    $http.get("/jobs").then(function(response) {
        $scope.jobs = response.data.data.jobs;
    });
    
    
    
    
    
    
    

}]);

