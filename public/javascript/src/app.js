function getHomePartialsTemplate(path) {
    return "/views/home/partials/" + path;
}
var app = angular.module('static', ['ui.router', 'angular-loading-bar', 'ngAnimate'])
    .config(['$stateProvider', '$urlRouterProvider', '$httpProvider',
        function($stateProvider, $urlRouterProvider, $httpProvider) {
            $urlRouterProvider.otherwise("/");

            $stateProvider.state("home", {
                url: "/",
                templateUrl: getHomePartialsTemplate('home')
            })
                .state('contact', {
                    url: '/contact',
                    templateUrl: getHomePartialsTemplate('contact'),
                    controller: function($scope) {
                        $scope.name = 'Samundra';
                        $scope.email = 'samundrak@yahoo.com';
                        $scope.address = 'Kathmandu';
                        $scope.contactMe = function() {
                            var pass = true;

                            if (!pass) return alert('Some fields are empty');

                            alert('Welcome ' + $scope.name + '\n' + 'Your email ' + $scope.email + '\n' + 'You From' + $scope.address);
                        }
                    }
                })
                .state('about', {
                    url: '/about',
                    templateUrl: getHomePartialsTemplate('about'),

                })
                .state('content', {
                    url: '/content',
                    templateUrl: getHomePartialsTemplate('content'),
                    controller: function($scope) {
                        $scope.contents = [];
                        $scope.addContent = function() {
                            $scope.contents.push($scope.content);
                            $scope.content = '';
                        }
                    }

                })
                .state('register', {
                    url: '/register',
                    templateUrl: getHomePartialsTemplate('register')
                })
                .state('login', {
                    url: '/login',
                    templateUrl: getHomePartialsTemplate('login')
                })
                .state('account', {
                    url: '/account',
                    templateUrl: '/views/dashboard/partials/account',
                    controller: 'dashboardCtrl'
                })
                .state('account.transaction', {
                    url: '/transaction',
                    templateUrl: '/views/dashboard/partials/transaction',
                    controller: 'dashboardCtrl'
                })
                .state('widgets',{
                    url:'/widgets',
                    templateUrl: '/views/dashboard/partials/widgets',
                    controller: 'dashboardCtrl'

                })
                .state('widgets.create',{
                    url:'/widgets/create',
                    templateUrl: '/views/dashboard/partials/create',
                    controller: 'dashboardCtrl'

                })
                .state('dashboard', {
                    url: '/:page',
                    templateUrl: function($stateParams) {
                        console.log($stateParams.page);
                        return '/views/dashboard/partials/' + $stateParams.page;
                    },
                    controller: 'dashboardCtrl'
                })

        }
    ])
    .config(['cfpLoadingBarProvider',
        function(cfpLoadingBarProvider) {
            cfpLoadingBarProvider.includeSpinner = false;
            cfpLoadingBarProvider.latencyThreshold = 10;
        }
    ])
    .controller('dashboardCtrl', ['$scope', '$stateParams', '$http',
        function($scope, $stateParams, $http) {
            $scope.loadingIcon = false;

            $scope.dashboard = {};
            switch ($stateParams.page) {
                case 'profile':
                    (function() {

                        $http.get('/user/details').then(function(report) {
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
                        $http.post('/user/update', $scope.dashboard.profile).then(function(report) {
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
    .directive('responseMessages', [

        function() {
            return {
                restrict: 'EA',
                scope: {
                    messages: "=messages"
                },
                template: " {{ data }}",
                link: function(scope, iElement, iAttrs) {
                    if (typeof scope.messages === 'string') {
                        iElement.html('<div class="alert alert-success"> ' + scope.messages + '</div>');
                    } else {
                        var data = '';
                        scope.messages.forEach(function(post) {
                            data = data + '<div class="alert alert-danger"> ' + post + '</div>';
                        });
                        iElement.html(data);
                    }

                },
                controller: function($scope) {}
            };
        }
    ])