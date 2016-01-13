app.filter('arr2str', function() {
    return function(input, link) {
        var links = JSON.parse(input);
        var str = '';
        links.forEach(function(post) {
            str += '<a href="' + post + '" target="_blank"> ' + post + ' </a>,'
        });
        if (link) return str;

        return links.toString();
    };
})

.service('notify', ['$rootScope', '$timeout',
    function($rootScope, $timeout) {
        return function(params, cb) {
            delete $rootScope.notification;
            $rootScope.notification = params;
            $timeout(function() {
                if ($rootScope.notification) delete $rootScope.notification;
                $rootScope.$apply();
                if(cb) cb();
            }, 7000);
        }
    }
])

.service('api', ['$http', '$q', 'notify',
    function($http, $q, notify) {

        return {
            call: function(method, api) {
                var defer = $q.defer();

                function g2login(cb) {
                    window.location.href = '/logout';
                }
                $http({
                    url: api,
                    method: method
                }).then(function(report) {
                    if (report.data.success) {
                        return defer.resolve(report.data);
                    } else {
                        return notify(report.data.message);
                    }
                }, function(error) {
                    return notify($global.error.network);
                });
                defer.promise.catch(g2login);
                return defer.promise;
            }
        };
    }
])
.service('profile', ['$http', '$q', 'notify',
    function($http, $q, notify) {

        return {
            call: function() {
                var defer = $q.defer();

                function g2login(cb) {
                    // window.location.href = '/logout';
                }
                $http({
                    method: 'GET',
                    url: '/api/user/details'
                }).then(function(report) {
                    if (report.data.success) {
                        var profile = report.data.data;
                        profile.subscribe = JSON.parse(profile.subscribe);
                        profile.subscribe.rules = JSON.parse(profile.subscribe.rules);
                        profile.subscribe.rules.settings = JSON.parse(profile.subscribe.rules.settings);
                        profile.subscribe.rules.points = JSON.parse(profile.subscribe.rules.points);
                        return defer.resolve(profile);
                    } else {
                        return notify($global.error.network, g2login);
                    }
                }, function(error) {
                    return notify($global.error.network, g2login);
                });
                defer.promise.catch(g2login);
                return defer.promise;
            }
        };
    }
])