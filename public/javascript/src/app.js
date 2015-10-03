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

        }
    ])
    .config(['cfpLoadingBarProvider',
        function(cfpLoadingBarProvider) {
            cfpLoadingBarProvider.includeSpinner = false;
            cfpLoadingBarProvider.latencyThreshold = 10;
        }
    ])