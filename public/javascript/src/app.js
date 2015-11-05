var $global = {
    error: {
        network: ["Error on network connection"]
    }
}

function getHomePartialsTemplate(path) {
    return "/views/home/partials/" + path;
}
var app = angular.module('static', ['ui.router', 'angular-loading-bar', 'ngAnimate', 'ngMessages', 'ngSanitize'])

.controller('dashboardCtrl', ['$scope', '$stateParams', '$http', 'notify',
    function($scope, $stateParams, $http, notify) {
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
                            notify(report.data.message);
                            $scope.dashboard.profile.alert.type = 'success';

                        } else {
                            report.data.message = JSON.parse(report.data.message);
                            var msg = [];
                            for (var key in report.data.message) {
                                report.data.message[key].forEach(function(post) {
                                    msg.push(post);
                                });
                            }
                            notify(msg);
                            $scope.dashboard.profile.alert.type = 'danger';

                        }
                        return angular.element("#alerts").slideDown(500);
                    }, function(err) {
                        $scope.dashboard.profile.alert = {};
                        notify($global.error.network);
                        angular.element("#alerts").slideDown(500);
                        return $scope.dashboard.profile.alert.type = 'danger';
                    });
                }

                break;
        }
    }
])

.controller('widgetsCtrl', ['$scope', '$http', '$rootScope', 'notify',
    function($scope, $http, $rootScope, notify) {
        $scope.deleteWidget = function(item) {
            if (!confirm("Are you sure you want to delete this widget")) return;
            $scope.response_message = undefined;
            if (item < 0) return;
            if (!$scope.widgets.data[item]) return;
            return $http.delete('/api/widgets/delete/' + $scope.widgets.data[item].id).then(function(report) {
                if (report.data.success) {
                    notify(report.data.message);
                    $scope.widgets.data.splice(item, 1);
                } else {
                    notify([report.data.message]);
                }
            }, function(error) {
                notify($global.error.network);
            });
        }


        $scope.getCode = function(id, preview) {
            $scope.preview = preview || false;
            if (!id) return;

            $http.get('/api/widgets/get/' + id).then(function(report) {
                if (report.data.success) {
                    var res = report.data.data;
                    var size = JSON.parse(JSON.parse(res.settings).size);

                    var w = size.responsive ? 'auto' : size.width;
                    var h = size.responsive ? 'auto' : size.height;

                    var code = '<iframe style="border:0px;" src="' + window.location.origin + '/widget/' + res.token + '" width="' + w + '" height="' + h + '" ></iframe>';
                    $scope.code = code;
                    $("#codeView").modal();
                    $("#me").html(code);
                } else {
                    notify([report.data.message]);
                }
            }, function(error) {
                notify($global.error.network);
            });
        }

        function loadWidgets(data) {
            var path = '/api/widgets/get';
            if (data) path = '/api/widgets/get?dest=' + data.desc;
            $http.get(path).then(function(report) {
                if (report.data.success) {
                    $scope.widgets = report.data;
                } else {
                    notify(report.data.message);
                }
            }, function(error) {
                notify($global.error.network);
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
    .controller('widgetsCreateEditCtrl', ['$scope', '$http', '$stateParams', '$state', 'notify',
        function($scope, $http, $stateParams, $state, notify) {
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
                        // if ($state.current.name === 'widgets.create') {
                        report.data.message = JSON.parse(report.data.message);
                        for (var key in report.data.message) {
                            report.data.message[key].forEach(function(post) {
                                msg.push(post);
                            });
                        }

                        // } else {
                        // msg = [report.data.message];
                        // }

                        return notify(msg);
                    }
                    return notify(report.data.message);
                }, function(error) {
                    notify($global.error.network);
                });
            }

            if ($state.current.name === 'widgets.edit') {
                $scope.id = $stateParams.id;

                if (isNaN($scope.id) || !$scope.id) {
                    notify(["Invalid id format, You will be redirected to home"]);
                    window.setTimeout(function() {
                        $state.go('widgets');
                    }, 1000);

                }


                function getSingleWidget() {
                    $http.get('/api/widgets/get/' + $scope.id).then(function(report) {

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
                            notify(report.data.message);
                        }
                    }, function(error) {
                        notify($global.error.network);
                    })
                }
                getSingleWidget();

            }
        }
    ])

.controller('subscriptionsCtrl', ['$scope', '$http', 'notify',
    function($scope, $http, notify) {
        $scope.subscribe = {
            alert: {}
        }
        $scope.plans = {};
        var getSubscriptionsPlans = function() {
            $http.get('/api/subscribe/plans').then(function(report) {
                    $scope.plans = report.data;
                    if (!report.data.success)
                        notify([report.data.message]);
                },
                function(error) {
                    notify($global.error.network);
                });

        }

        var getSubscriptionsDetails = function(data) {
            var path = '/api/subscribe/details';
            if (data) path = path + '?dest=' + data.desc;
            $http.get(path).then(function(report) {
                $scope.subscription = report.data;
                if (!report.data.success)
                    return notify(report.data.message);
            }, function(error) {
                notify($global.error.network);
            });
        }

        $scope.$on('paginationClicked', function(type, data) {
            getSubscriptionsDetails({
                desc: data.clicked
            });
        });
        getSubscriptionsDetails();
        getSubscriptionsPlans();
        $scope.subscribe = function(plan) {
            if (!plan) return true;
            var data = {
                plan: plan
            }
            $http.post('/api/subscribe/create', data).then(function(report) {
                if (report.data.success) {
                    notify(report.data.message);
                    $scope.amount -= report.data.data.amount;
                    getSubscriptionsDetails();
                } else {
                    notify([report.data.message]);
                }
            }, function(error) {
                notify($global.error.network);
            });
        }
    }
])

.controller('settingsCtrl', ['$scope', '$http', 'notify',
    function($scope, $http, notify) {

        $scope.changePassword = function() {
            var data = {
                oldPassword: $scope.oldPassword,
                newPassword: $scope.newPassword,
                confirmPassword: $scope.confirmPassword
            }

            $http.post('/api/user/password/edit', data).then(function(report) {
                if (report.data.success) {
                    notify(report.data.message);
                    window.location.href = "/logout";
                } else {
                    notify(report.data.message);
                }
            }, function(error) {
                notify($global.error.network);
            });
        }
        $scope.changeEmail = function() {
            var data = {
                oldEmail: $scope.oldEmail,
                newEmail: $scope.newEmail,
                password: $scope.password
            }
            $http.post('/api/user/email/edit', data).then(function(report) {
                if (report.data.success) {
                    $scope.oldEmail = $scope.newEmail;
                    $scope.newEmail = '';
                    $scope.password = '';
                    notify(report.data.message);
                } else {
                    notify(report.data.message);
                }
            }, function(error) {
                notify($global.error.network);
            });
        }
    }
])
    .controller('authCtrl', ['$scope', '$http', 'notify',
        function($scope, $http, notify) {

            $scope.register = function() {
                var data = {
                    firstname: $scope.firstname,
                    lastname: $scope.lastname,
                    email: $scope.email,
                    password: $scope.password,
                    password_confirmation: $scope.password_confirmation
                }

                $http.post('/auth/register', data).then(function(report) {
                    if (report.data.success) {
                        window.location.href = report.data.data.path;
                    } else {
                        notify(report.data.message)
                    }
                }, function(error) {
                    notify($global.error.network);
                });
            }
            $scope.login = function() {
                var data = {
                    email: $scope.email,
                    password: $scope.password
                }

                $http.post('/auth/login', data).then(function(report) {
                    if (report.data.success) {
                        window.location.href = report.data.data.path;
                    } else {
                        notify(report.data.message);
                    }
                }, function(error) {
                    ntoify($global.error.network);
                })
            }
        }
    ]);