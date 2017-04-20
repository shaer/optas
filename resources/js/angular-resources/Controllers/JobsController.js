app.controller('JobsController', ['$scope','$http', '$mdDialog',
    function($scope, $http, $mdDialog) {
        
    $http.get("/jobs").then(function(response) {
        $scope.jobs = response.data.data.jobs;
    });
    
    
    $scope.showTabDialog = function(ev) {
        $mdDialog.show({
            controller: DialogController,
            templateUrl: '/app/jobs/add_form.html',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose:true
        }).then(function(data) {
            console.log(data);
            alert("Here!")
        });
    };
    
    
    
     function DialogController($scope, $mdDialog) {
        $scope.hide = function() {
            $mdDialog.hide();
        };
    
        $scope.cancel = function() {
            $mdDialog.cancel();
        };
    
        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };
     }

}]);

