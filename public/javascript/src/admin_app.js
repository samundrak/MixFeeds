app.config(['$stateProvider', '$urlRouterProvider', '$httpProvider',
    function($stateProvider, $urlRouterProvider, $httpProvider) {
        $stateProvider
            .state('adminUsers', {
                url: '/admin/users',
                templateUrl: '/views/admin/partials/users',
                controller: 'AdminusersController'
            })
            .state('adminSubscription', {
                url: '/admin/subscriptions',
                templateUrl: '/views/admin/partials/subscriptions',
                controller: function($scope, $state) {
                    $state.go('adminSubscription.view');
                }
            })
            .state('adminSubscription.view', {
                url: '/view',
                templateUrl: '/views/admin/partials/subscriptions_view',
                controller: 'AdminSubscriptionCtrl'
            })
            .state('adminSubscription.create', {
                url: '/create',
                templateUrl: '/views/admin/partials/create_subscription',
                controller: 'AdminSubscriptionCreateCtrl'

            })
            .state('adminWidgets', {
                url: '/admin/widgets',
                templateUrl: '/views/admin/partials/widgets',
            })
    }
])
    .controller('AdminusersController', ['$scope', '$http', 'notify',
        function($scope, $http, notify) {
            $scope.actionLists = [{
                title: 'Remove Admin',
                id: '5'
            }, {
                title: 'Make Admin',
                id: '4'
            }, {
                title: 'Delete User',
                id: '3'
            }, {
                title: 'Block User',
                id: '2'
            }, {
                title: 'Verify User',
                id: '1'
            }, {
                title: 'Unverify User',
                id: '0'
            }];
            $scope.users = [];

            $scope.totalAdmin = function(users) {
                return _.where(users, {
                    is_admin: '1'
                }).length;
            }
            $scope.fetchUsers = function() {
                $http.get('/api/admin/users', {})
                    .then(function(report) {
                        $scope.users = report.data;
                        console.log($scope.users);
                    })
                    .catch(function(error) {

                    });
            }
            $scope.fetchUsers();
            $scope.getCodes = function(code) {
                switch (code) {
                    case '1':
                        return 'Verified';
                        break;
                    case '2':
                        return 'Blocked';
                        break;
                    case '3':
                        return 'Deleted';
                        break;
                    default:
                        return 'Unverified';
                        break;
                }
            }
            $scope.startAction = function(user, index) {
                // if(!confirm('Are you sure you want to proceed')) return false;
                $http.post('/api/admin/action', {
                    action: user.action.title,
                    id: user.id
                }).then(function(report) {

                    if (user.action.id === '4') {
                        $scope.users[index].is_admin = '1'
                    } else if (user.action.id === '5') {
                        $scope.users[index].is_admin = '0'
                    } else {
                        $scope.users[index].is_verified = user.action.id
                    }
                    return notify(report.data.message);
                })
                    .catch(function(error) {
                        return console.log(error);
                    });
            }
        }
    ])
    .controller('AdminSubscriptionCtrl', ['$scope', '$http', 'notify',
        function($scope, $http, notify) {
            $scope.action = [{
                title: 'Activate',
                id: '1'
            }, {
                title: 'Deactivate',
                id: '0'
            }];
            $scope.plans = [];
            $scope.loadAllSubscriptions = function() {
                $http.get('/api/admin/subscriptions')
                    .then(function(report) {
                        if (!report.data.success) {
                            return notify(report.data.message);
                        }

                        $scope.plans = report.data.data.plans;
                        $scope.stats = report.data.data.stats;
                    })
                    .catch(function(error) {
                        alert(error);
                    })
            }

            $scope.loadAllSubscriptions();

            $scope.startAction = function(item, index) {
                if (!item || index < 0) return;


                $http.post('/api/admin/subscriptions/action', {
                    id: item.plan_id,
                    action: item.action.id
                })
                    .then(function(report) {
                        $scope.plans[index].active = item.action.id;
                        return notify(report.data.message);
                    }).catch(function(err) {
                        return alert('error');
                    })
            }
        }
    ])
    .controller('AdminSubscriptionCreateCtrl', ['$scope', '$http', 'notify',
        function($scope, $http, notify) {
            $scope.create = {
                points: ['']
            };
            $scope.points = [1];
            $scope.addPoints = function() {
                $scope.create.points.push('');
            }
            $scope.removePoints = function(index) {
                $scope.create.points.splice(index, 1);
            }

            $scope.createWidget = function() {
                console.log($scope.create);
                $http.post('/api/admin/subscriptions/add', $scope.create)
                    .then(function(report) {
                        if (report.data.success) {
                            $scope.create = {
                                points: ['']
                            }
                        } else {

                        }
                        return notify(report.data.message);
                    })
                    .catch(function(error) {
                        alert(error);
                    });
            }

        }
    ])