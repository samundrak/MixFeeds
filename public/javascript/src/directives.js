app.directive('responseMessages', [

        function() {
            return {
                restrict: 'EA',
                scope: {
                    messages: "=messages"
                },
                template: " {{ data }}",
                link: function(scope, iElement, iAttrs) {
                    if (typeof scope.messages === 'string') {
                        var icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
                        iElement.html('<div class="alert alert-success"> ' + icon + ' ' + scope.messages + '</div>');
                    } else {
                        var data = '';
                        scope.messages.forEach(function(post) {
                            var icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>';
                            data = data + '<div class="alert alert-danger"> ' + icon + ' ' + post + '</div>';
                        });
                        iElement.html(data);
                    }

                },
                controller: function($scope) {}
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