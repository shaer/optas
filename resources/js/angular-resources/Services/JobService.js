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
                alert("delete " + id);
            },
            save: function(object) {
                console.log(object);
                alert("save " + object.id);
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
