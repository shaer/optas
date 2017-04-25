app.controller('JobsController', ['$scope','$http', '$mdDialog', '$templateCache',
    function($scope, $http, $mdDialog, $templateCache) {
        
    $http.get("/jobs").then(function(response) {
        $scope.jobs = response.data.data.jobs;
    });
    
    
    $scope.manageJobDialog = function(ev, job) {

        $scope.editDialog = $mdDialog;
        
        if(job === undefined) {
           job = {}; 
        }
        
        $mdDialog.show({
            controller: EditDialogController,
            templateUrl: '/app/jobs/add_form.html',
            parent: angular.element(document.body),
            targetEvent: ev,
            clickOutsideToClose: false,
            locals: {local: [$scope.manageJobDialog, job]},
        }).then(function(data) {
            alert("Here!")
        });
    };
    
    
    
    function EditDialogController($scope, $mdDialog, local) {
        $scope.job = local[1];

        $scope.hide = function() {
            $mdDialog.hide();
        };
    
        $scope.cancel = function() {
            $mdDialog.cancel();
        };
    
        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };
        
        $scope.showActionsPopup = function() {
            var showParentDialog = local[0];

            var action_id = $scope.job_action;
            $scope.job_action = undefined;
            
            
            var templateMapping = [
                    "",
                    "/app/jobs/database_action.html"
                ]
            
            $mdDialog.show({
                controllerAs: 'addAction',
                controller: function($mdDialog){
                  this.save = function(action){
                    $mdDialog.hide();
                    this.appendAction(action);
                    showParentDialog(null, $scope.job);
                  }
                  this.cancel = function(){
                    $mdDialog.hide();
                    showParentDialog(null, $scope.job);
                  }
                  
                  this.appendAction = function(action) {
                      if($scope.job.actions === undefined) {
                          $scope.job.actions = [];
                      }
                      action.action_type = action_id;
                      $scope.job.actions.push(action);
                  }
                },
                templateUrl: templateMapping[action_id]
              })
        }
    }

}]);

