app.directive('responseMessages', [

    function() {
        return {
            restrict: 'EA',
            scope: {
                messages: "=messages",
                info: "@info"
            },
            template: " {{ data }}",
            link: function(scope, iElement, iAttrs) {
                var message = scope.messages || scope.info;
                if (typeof message === 'string') {
                    var icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
                    iElement.html('<div class="alert alert-success"> ' + icon + ' ' + message + '</div>');
                } else {
                    var data = '<div class="alert alert-danger"> ';
                    message.forEach(function(post) {
                        var icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
                        data = data + '<div > ' + icon + ' ' + post + '</div>';
                    });
                    data += '</div>'
                    iElement.html(data);
                }

            },
            controller: function($scope) {

                (function(selector, delay) {
                    window.setTimeout(function() {
                        $(selector).hide(100);
                    }, delay);
                })('response-messages', '5000');
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
.directive('displayWidget', ['$compile',function ($compile) {
    return {
        scope :{
            code : "=code"
        },
        restrict: 'EA',
        link: function (scope, element, iAttrs) {
            $compile(element.html(scope.code).contents())(scope);
        }
    };
}])