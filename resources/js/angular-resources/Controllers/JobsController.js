app.controller('JobsController', ['$scope', '$http', '$mdDialog', '$templateCache',
    function($scope, $http, $mdDialog, $templateCache) {

        $http.get("/jobs").then(function(response) {
            $scope.jobs = response.data.data.jobs;
        });


        $scope.manageJobDialog = function(ev, job) {

            $scope.editDialog = $mdDialog;

            if (job === undefined) {
                job = {};
                job.actions = [];
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
            }).then(function(data) {
                console.log("Should save here!");
            });
        };

        function EditDialogController($scope, $mdDialog, local) {
            $scope.job = local[1];
            $scope.spmdSchedulers = [];

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
                var elementIndex = $scope.spmdSchedulers.indexOf(day);
                if (elementIndex == -1) {
                    $scope.spmdSchedulers.push(day);
                }
                else {
                    $scope.spmdSchedulers.splice(elementIndex, 1);
                }


                console.log($scope.spmdSchedulers);
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
