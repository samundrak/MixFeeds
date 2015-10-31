function getHomePartialsTemplate(path) {
    return "/views/home/partials/" + path;
}
var app = angular.module('static', ['ui.router', 'angular-loading-bar', 'ngAnimate', 'ngMessages', 'ngSanitize'])

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
                if (report.data.success) {
                    $scope.widgets = report.data;
                } else {
                    $scope.response_message = report.data.message;
                }
            }, function(error) {
                $scope.response_message = "Error on network connection";
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
    .controller('widgetsCreateEditCtrl', ['$scope', '$http', '$stateParams', '$state',
        function($scope, $http, $stateParams, $state) {
            $scope.widget = {
                alert: {},
                settings: {
                    display: {}
                }
            };
            $scope.widget.pagesCounter = [0];
            $scope.addFacebookPages = function() {
                $scope.widget.pagesCounter.push('http://www.facebook.com/');
            }
            $scope.removeFacebookPages = function(index) {
                $scope.widget.pagesCounter.splice(index, 1);
            }
            $scope.createWidget = function() {
                $scope.widget.alert = {};
                var data = {};
                data.widget_name = $scope.widget.widget_name || null;
                data.pages = $scope.widget.pages || null;
                data.display = $scope.widget.settings.display || null;
                data.size = $scope.widget.settings.size || null;
                // if(!data.size.hasOwnProperty('responsive')){
                //     if(!parseInt(data.size.width) || !parseInt(data.size.height)){
                //         $scope.widget.alert.message = ["Widget size and height must be in number format"];
                //         return alert($scope.widget.alert.message[0]);
                //     }
                // }
                data.show_friends_face = $scope.widget.settings.show_friends_face || null;
                data.show_small_header = $scope.widget.settings.show_small_header || null;
                data.hide_cover_photo = $scope.widget.settings.hide_cover_photo || null;
                data.domain = $scope.widget.settings.domain;
                data.state = $state.current.name
                if ($state.current.name === 'widgets.edit') {
                    data.widget_id = $stateParams.id;
                }
                 
                $http.post('/api/widgets/create', data).then(function(report) {
                    console.log(report);
                    if (!report.data.success) {
                        var msg = [];
                        if ($state.current.name === 'widgets.create') {
                            report.data.message = JSON.parse(report.data.message);
                            for (var key in report.data.message) {
                                report.data.message[key].forEach(function(post) {
                                    msg.push(post);
                                });
                            }

                        }else{
                            msg =  [report.data.message];
                        }

                        return $scope.widget.alert.message = msg;
                    }
                    return $scope.widget.alert.message = report.data.message;
                }, function(error) {
                    $scope.widget.alert.message = ['Error on network connection'];
                });
            }

            if ($state.current.name === 'widgets.edit') {
                $scope.id = $stateParams.id;

                if (isNaN($scope.id) || !$scope.id) {
                    $scope.widget.alert.message = ["Invalid id format, You will be redirected to home"];
                    window.setTimeout(function() {
                        $state.go('widgets');
                    }, 1000);

                }


                function getSingleWidget() {
                    $http.get('/api/widgets/get/' + $scope.id).then(function(report) {
                        console.log(report.data);
                        if (report.data.success) {
                            $scope.widget.alert.message = 'done';
                            $scope.widget = report.data.data;
                            $scope.widget.pages = JSON.parse($scope.widget.pages);
                            $scope.widget.pagesCounter = $scope.widget.pages;
                            $scope.widget.settings = JSON.parse($scope.widget.settings);
                            $scope.widget.settings.display = JSON.parse($scope.widget.settings.display);
                            $scope.widget.settings.size = JSON.parse($scope.widget.settings.size);
                            $scope.widget.settings.domain = $scope.widget.domain;
                        } else {
                            $scope.widget.alert.message = [report.data.message];
                        }
                    }, function(error) {
                        $scope.widget.alert.message = ["Error on network connection"];
                    })
                }
                getSingleWidget();

            }
        }
    ])