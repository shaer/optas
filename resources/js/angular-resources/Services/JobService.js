app.factory('JobService', ['$http',
    function($http) {
        return {
            getAll: function() {
                return $http.get("/jobs");
            },
            get: function(id) {
                return $http.get("/jobs/" + id);
            },
            delete: function(id) {
                return $http.delete("/jobs/" + id);
            },
            store: function(object) {
                return $http.post("/jobs/", object);
            },
            update: function(object) {
                for (var index in object.scheduler.days.list) {
                    var date = object.scheduler.days.list[index];
                    object.scheduler.days.list[index] = moment(date).format('YYYY-MM-DD')
                }
                return $http.patch("/jobs/" + object.id, object);
            },
            createNew: function() {
                return {
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

            }
        }
    }
]);
