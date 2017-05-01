app.controller('JobsController', ['$scope', '$http', '$mdDialog', 'JobService',
    function($scope, $http, $mdDialog, JobService) {

        JobService.getAll().then(function(response) {
            $scope.jobs = response.data.data.jobs;
        });

        $scope.loadJobDetails = function(id) {
            JobService.get(id).then(function(response) {
                $scope.manageJobDialog(null, response.data);
            });
        }

        $scope.manageJobDialog = function(ev, job, tabToShow) {
            tabToShow = tabToShow === undefined ? 0 : tabToShow;
            $scope.editDialog = $mdDialog;
            if (job === undefined) {
                job = JobService.createNew();
                job.is_new = true;
            }

            $mdDialog.show({
                controller: EditDialogController,
                templateUrl: '/app/jobs/add_form.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: false,
                locals: {
                    local: [$scope.manageJobDialog, job, JobService, tabToShow]
                },
            }).then(function(data) {
                if (data[0]) {
                    var newJob = data[1];
                    if (data[2]) {
                        $scope.jobs[newJob.id] = newJob;
                    }
                    else {
                        $scope.jobs[job.id] = job;
                    }
                }
            });
        };

        $scope.deleteJob = function(id) {
            JobService.delete(id).then(function(response) {
                delete $scope.jobs[id];
            });
        }
    }
]);
