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

        $scope.manageJobDialog = function(ev, job) {

            console.log(job);
            $scope.editDialog = $mdDialog;
            var is_new = false;

            if (job === undefined) {
                is_new = true;
                job = JobService.createNew();
            }

            $mdDialog.show({
                controller: EditDialogController,
                templateUrl: '/app/jobs/add_form.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: false,
                locals: {
                    local: [$scope.manageJobDialog, job]
                },
            }).then(function(save) {
                if (save) {
                    if (is_new) {
                        JobService.store(job).then(function(response) {
                            $scope.jobs[response.data.data.id] = response.data.data;
                        });
                    }
                    else {
                        JobService.store(job).then(function(response) {
                            $scope.jobs[job.id] = job;
                        });
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
