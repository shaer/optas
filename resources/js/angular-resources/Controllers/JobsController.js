app.controller('JobsController', ['$scope', '$http', '$mdDialog', '$templateCache',
    function($scope, $http, $mdDialog, $templateCache) {

        $http.get("/jobs").then(function(response) {
            $scope.jobs = response.data.data.jobs;
        });

        $scope.loadJobDetails = function(id) {
            $http.get("/jobs/" + id).then(function(response) {
                $scope.manageJobDialog(null, response.data);
            });
        }

        $scope.manageJobDialog = function(ev, job) {
            $scope.editDialog = $mdDialog;
            var is_new = false;

            if (job === undefined) {
                is_new = true;
                job = $scope.createEmptyJobObject();
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
                        $scope.jobs.push(job);
                    }
                    else {
                        $scope.jobs[job.id] = job;
                    }
                }
            });
        };

        $scope.createEmptyJobObject = function() {
            var job = {
                "scheduler": {
                    "everyday": {
                        "exists": "F"
                    },
                    "weekly": {
                        "exists": "F",
                        "should_run": "T",
                        "list": []
                    },
                    "spmd": {
                        "exists": "F",
                        "should_run": "T",
                        "list": []
                    },
                    "months": {
                        "exists": "F",
                        "should_run": "T",
                        "list": []
                    },
                    "days": {
                        "exists": "F",
                        "should_run": "T",
                        "list": []
                    }
                },
                "actions": []
            };

            return job;
        }

        function EditDialogController($scope, $mdDialog, local) {
            $scope.job = local[1];
            $scope.specificDaysFormat = buildLocaleProvider("DD-MMM");

            //convert array of strings to array of numbers
            $scope.job.scheduler.spmd.list = $scope.job.scheduler.spmd.list.map(Number);

            function buildLocaleProvider(formatString) {
                return {
                    formatDate: function(date) {
                        if (date) return moment(date).format(formatString);
                        else return null;
                    },
                    parseDate: function(dateString) {
                        if (dateString) {
                            var m = moment(dateString, formatString, true);
                            return m.isValid() ? m.toDate() : new Date(NaN);
                        }
                        else return null;
                    }
                };
            }

            $scope.addNewDate = function() {
                $scope.job.scheduler.days.list.push("");
            }

            $scope.removeDate = function(index) {
                $scope.job.scheduler.days.list.splice(index, 1);
            }

            $scope.hide = function() {
                $mdDialog.hide();
            };

            $scope.cancel = function() {
                $mdDialog.cancel();
            };

            $scope.answer = function(answer) {
                $mdDialog.hide(answer);
            };

            $scope.range = function(min, max, step) {
                step = step || 1;
                var input = [];
                for (var i = min; i <= max; i += step) {
                    input.push(i);
                }
                return input;
            };

            $scope.addDay = function(day, job) {
                var elementIndex = $scope.job.scheduler.spmd.list.indexOf(day);
                if (elementIndex == -1) {
                    $scope.job.scheduler.spmd.list.push(day);
                }
                else {
                    $scope.job.scheduler.spmd.list.splice(elementIndex, 1);
                }
            }

            $scope.showActionsPopup = function(action) {
                var showParentDialog = local[0];
                var action_type_id;
                var is_update;

                if (action !== undefined) {
                    action_type_id = action.action_type_id;
                    is_update = true;
                }
                else {
                    is_update = false;
                    action = {};
                    action_type_id = $scope.new_action_type;
                }

                var templateMapping = [
                    "",
                    "/app/jobs/actions/database.html"
                ]

                $mdDialog.show({
                    controllerAs: 'addAction',
                    controller: function($mdDialog) {
                        this.action = action;

                        this.save = function() {
                            $mdDialog.hide();
                            this.appendAction();
                            showParentDialog(null, $scope.job);
                        }
                        this.cancel = function() {
                            $mdDialog.hide();
                            showParentDialog(null, $scope.job);
                        }

                        this.appendAction = function() {
                            if ($scope.job.actions === undefined) {
                                $scope.job.actions = [];
                            }

                            if (!is_update) {
                                $scope.job.actions.push({
                                    triggerable: this.triggerable,
                                    name: this.action.name,
                                    action_type_id: action_type_id
                                });
                            }
                        }
                    },
                    templateUrl: templateMapping[action_type_id]
                })
            }
        }
    }
]);
