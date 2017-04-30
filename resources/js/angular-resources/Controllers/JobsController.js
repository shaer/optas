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
                    JobService.save(job);
                    if (is_new) {
                        $scope.jobs.push(job);
                    }
                    else {
                        $scope.jobs[job.id] = job;
                    }
                }
            });
        };

        $scope.deleteJob = function(id) {
            JobService.delete(id).then(function(response) {
                $scope.jobs.splice(id, 1)
            });
        }
    }
]);
