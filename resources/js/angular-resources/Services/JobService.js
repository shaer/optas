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
