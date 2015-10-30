function getHomePartialsTemplate(path) {
    return "/views/home/partials/" + path;
}
var app = angular.module('static', ['ui.router', 'angular-loading-bar', 'ngAnimate'])

.controller('dashboardCtrl', ['$scope', '$stateParams', '$http',
    function($scope, $stateParams, $http) {
        $scope.loadingIcon = false;

        $scope.dashboard = {};
        switch ($stateParams.page) {
            case 'profile':
                (function() {

                    $http.get('/api/user/details').then(function(report) {
                        console.log(report);
                        if (report.data.success) {
                            $scope.dashboard.profile = report.data.data;
                        } else {
                            window.location.href = '/#/login';
                        }
                    }, function(error) {
                        window.location.href = '/#/login';
                    });
                })();
                $scope.updateProfile = function() {
                    $scope.dashboard.profile.alert = {};
                    angular.element("#alerts").slideUp(500)
                    $scope.dashboard.profile._token = $token;
                    $scope.dashboard.profile.alert.message = undefined;
                    $http.post('/api/user/update', $scope.dashboard.profile).then(function(report) {
                        if (report.data.success) {
                            console.log(report);
                            $scope.dashboard.profile.alert.message = report.data.message;
                            $scope.dashboard.profile.alert.type = 'success';

                        } else {
                            report.data.message = JSON.parse(report.data.message);
                            var msg = [];
                            for (var key in report.data.message) {
                                report.data.message[key].forEach(function(post) {
                                    msg.push(post);
                                });
                            }
                            $scope.dashboard.profile.alert.message = msg;
                            $scope.dashboard.profile.alert.type = 'danger';

                        }
                        return angular.element("#alerts").slideDown(500);
                    }, function(err) {
                        $scope.dashboard.profile.alert = {};
                        $scope.dashboard.profile.alert.message = 'Error on internet connection';
                        angular.element("#alerts").slideDown(500);
                        return $scope.dashboard.profile.alert.type = 'danger';
                    });
                }

                break;
        }
    }
])

.controller('widgetsCtrl', ['$scope', '$http', '$rootScope',
    function($scope, $http, $rootScope) {
            $scope.deleteWidget = function(item) {
                if (!confirm("Are you sure you want to delete this widget")) return;
                $scope.response_message = undefined;
                if (item < 0) return;
                if (!$scope.widgets.data[item]) return;
                return $http.delete('/api/widgets/delete/' + $scope.widgets.data[item].id).then(function(report) {
                    if (report.data.success) {
                        $scope.response_message = report.data.message;
                        $scope.widgets.data.splice(item, 1);
                    } else {
                        $scope.response_message = [report.data.message];
                    }
                }, function(error) {
                    $scope.response_message = [constant.error];
                });
            }

            function loadWidgets(data) {
                var path = '/api/widgets/get';
                if (data) path = '/api/widgets/get?dest=' + data.desc;
                $http.get(path).then(function(report) {
                    $scope.widgets = report.data;
                }, function(error) {

                });
            }
            loadWidgets();
            $rootScope.$on('paginationClicked', function(type, data) {
                loadWidgets({
                    desc: data.clicked
                });
            });

    }
])
.controller('widgetsCreateCtrl', ['$scope', function ($scope) {
}])