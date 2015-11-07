app.directive('responseMessages', [
    '$compile',
    function($compile) {
        return {
            restrict: 'EA',
            scope: {
                messages: "=messages",
                info: "@info",
                type: "@type",
                popup: "=popup"
            },
            template: " {{ data }}",
            link: function(scope, iElement, iAttrs) {
                var message = scope.messages || scope.info;
                if (typeof message === 'string') {
                    var iconR = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
                    var iconW = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';

                    data = '<div class="alert alert-' + (scope.type || 'success') + '"> ' + (scope.type ? iconW : iconR) + ' ' + message + '</div>';
                } else {
                    var data = '<div class="alert alert-danger"> ';
                    message.forEach(function(post) {
                        var icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
                        data = data + '<div > ' + icon + ' ' + post + '</div>';
                    });
                    data += '</div>'
                }

                if (scope.popup)
                    $compile(iElement.html('<div style="position:fixed;z-index:99999;top:1%;left:40%;" ng-click="hide()">' + data + '</div>').contents())(scope);
                else
                    $compile(iElement.html('<div ng-click="hide()">' + data + '</div>').contents())(scope);


            },
            controller: function($scope, $rootScope, $timeout) {
                $scope.hide = function() {
                    $("response-messages").hide(100);
                }

            }
        };
    }
])
    .directive('pagination', ['$compile', '$rootScope',

        function($compile, $rootScope) {
            return {
                restrict: 'EA',
                scope: {
                    total: "=total",
                    span: "=span",
                    last: "=last"
                },
                link: function(scope, element, attr) {
                    console.log(scope.last);
                    var html = '<nav><ul class="pagination">';
                    html += '<li ><a  ng-click="pageClick(' + scope.last + ')" href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                    var last = 0;
                    var counter = 1;
                    console.log(scope.last, scope.total)
                    for (var i = 0; i < scope.total; i += scope.span) {
                        var item = scope.last - i;
                        html += '<li><a ng-click="pageClick(' + item + ')" href="javascript:void(0);">' + counter + '</a></li>'
                        last = item;
                        counter++;
                    };
                    html += '  <li><a  ng-click="pageClick(' + last + ')" href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
                    html += '</ul></nav>';
                    element.html(html);
                    $compile(element.contents())(scope);
                },
                controller: function($scope, $rootScope) {
                    $scope.pageClick = function(item) {
                        if (!item) return;
                        $rootScope.$broadcast('paginationClicked', {
                            total: $scope.total,
                            span: $scope.span,
                            last: $scope.last,
                            clicked: item
                        });
                    }
                }
            };
        }
    ])
    .directive('displayWidget', ['$compile',
        function($compile) {
            return {
                scope: {
                    code: "=code"
                },
                restrict: 'EA',
                link: function(scope, element, iAttrs) {
                    $compile(element.html(scope.code).contents())(scope);
                }
            };
        }
    ])