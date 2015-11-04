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
        return function(params) {
            delete $rootScope.notification;
            $rootScope.notification = params;
            $timeout(function() {
                if ($rootScope.notification) delete $rootScope.notification;
                $rootScope.$apply();
            }, 2000);
        }
    }
])