function EditDialogController($scope, $mdDialog, local) {
    $scope.job = local[1];
    var JobService = local[2];
    $scope.activeTab = local[3];
    $scope.formErrors = [];
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
        $mdDialog.hide(false);
    };

    $scope.cancel = function() {
        $mdDialog.hide(false);
    };

    $scope.validateForm = function(isValidForm) {
        var invalidDays = $scope.job.scheduler.days.exists == 'T' && $scope.job.scheduler.days.list.length == 0;
        var invalidSpmd = $scope.job.scheduler.spmd.exists == 'T' && $scope.job.scheduler.spmd.list.length == 0;

        $scope.showDaysError = invalidDays;
        $scope.showSpmdError = invalidSpmd;

        return isValidForm && !invalidDays && !invalidSpmd;
    }

    $scope.save = function(isValidForm) {

        if (!$scope.validateForm(isValidForm)) {
            $scope.showFieldErrors = true;
            return;
        }

        var output;
        $scope.formErrors = [];
        if ($scope.job.is_new !== undefined && $scope.job.is_new == true) {
            JobService.store($scope.job).then(function(response) {
                $scope.preCloseActions(response);
            });
        }
        else {
            JobService.update($scope.job).then(function(response) {
                $scope.preCloseActions(response);
            });
        }
    };

    $scope.preCloseActions = function(response) {
        var output = response.data.data;
        if (response.data.status == 200) {
            $mdDialog.hide([true, output, true]);
        }
        else {
            $scope.activeTab = output[0];
            $scope.formErrors = output[2];

            if ($scope.activeTab == 1) {
                $scope.job.actions[output[1]].hasError = true;
            }
        }
    }

    $scope.range = function(min, max, step) {
        step = step || 1;
        var input = [];
        for (var i = min; i <= max; i += step) {
            input.push(i);
        }
        return input;
    };

    $scope.addDay = function(day) {
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
                this.showFieldErrors = false;

                this.save = function(isValidForm) {
                    if (!isValidForm) {
                        this.showFieldErrors = true;
                        return;
                    }

                    $mdDialog.hide();
                    this.appendAction();
                    showParentDialog(null, $scope.job, 1);
                }
                this.cancel = function() {
                    $mdDialog.hide();
                    showParentDialog(null, $scope.job, 1);
                }

                this.appendAction = function() {
                    if (!is_update) {
                        $scope.job.actions.push({
                            triggerable: this.action.triggerable,
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
