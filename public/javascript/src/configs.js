app.config(['$stateProvider', '$urlRouterProvider', '$httpProvider',
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
                    templateUrl: getHomePartialsTemplate('register'),
                    controller : 'authCtrl'
                })
                .state('login', {
                    url: '/login',
                    templateUrl: getHomePartialsTemplate('login'),
                    controller : 'authCtrl'
                })
                .state('forget_password',{
                    url :'/forget_password',
                    templateUrl :getHomePartialsTemplate('forget_password'),
                    controller :  'forgetPasswordCtrl'
                })
                .state('reset_password',{
                    url:'/reset_password/:params',
                    templateUrl: getHomePartialsTemplate('reset_password'),
                    controller :  'resetPasswordCtrl'
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
                .state('account.subscriptions', {
                    url: '/subscriptions',
                    templateUrl: '/views/dashboard/partials/subscriptions',
                    controller: 'subscriptionsCtrl'
                })
                .state('widgets', {
                    url: '/widgets',
                    templateUrl: '/views/dashboard/partials/widgets',
                    controller: 'widgetsCtrl'

                })
                .state('widgets.create', {
                    url: '/create',
                    templateUrl: '/views/dashboard/partials/create',
                    controller: 'widgetsCreateEditCtrl'

                })
                .state('widgets.edit',{
                    url : '/edit/{id}',
                    templateUrl: '/views/dashboard/partials/create',
                    controller: 'widgetsCreateEditCtrl'
                })
                .state('settings',{
                    url : '/settings',
                    abstract:true,
                    templateUrl : '/views/dashboard/partials/settings',

                })
                .state('settings.changePassword',{
                    url: '/change_password',
                    templateUrl : '/views/dashboard/partials/change_password',
                    controller : "settingsCtrl"

                })
                .state('settings.changeEmail',{
                    url: '/change_email',
                    templateUrl : '/views/dashboard/partials/change_email',
                    controller : "settingsCtrl"


                })
                .state('settings.deleteAccount',{
                    url: '/delete_account',
                    templateUrl : '/views/dashboard/partials/delete_account',
                    controller : "settingsCtrl"
                    

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
    ]);
function configureTemplateFactory($provide) {
    // Set a suffix outside the decorator function 
    var cacheBuster = Date.now().toString();

    function templateFactoryDecorator($delegate) {
    var fromUrl = angular.bind($delegate, $delegate.fromUrl);
    $delegate.fromUrl = function (url, params) {
        if (url !== null && angular.isDefined(url)) {
            if (typeof url == 'function') {
                url = url.call(url, params);
            }
            if (angular.isString(url)) {
             url += (url.indexOf("?") === -1 ? "?" : "&");
             url += "v=" + Date.now().toString();
             }
         }

         return fromUrl(url, params);
     };

     return $delegate;
}

    $provide.decorator('$templateFactory', ['$delegate', templateFactoryDecorator]);
}

app.config(['$provide', configureTemplateFactory]);
