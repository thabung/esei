<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Play your favorite songs</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.js"></script>
        <script type="text/javascript" src="/lib/taggedInfiniteScroll.js"></script>
        <link type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css"></link>
        <link type="text/css" rel="stylesheet" href="/css/app/main.css"></link>
    </head>
    <body ng-app="SongApp" ng-cloak>
        

        <div class="container">
            <div ng-controller="SongsPlayListController">
                <div> 
                    <input class="" placeholder="Song name" type="text" ng-model="song_name"><p ng-bind="song_name">{{song_name}}</p>
                    <button ng-click="search()">Search</button>
                </div>
                <div tagged-infinite-scroll="" tagged-infinite-scroll-disabled="!enabled || paginating" tagged-infinite-scroll-distance="distance">

                    <ul class="items" ng-class="{ paginating: paginating }">
                        <li ng-repeat="item in items" ng-style="item.styles">
                            <div class="song_name">{{ item.name}}</div>
                            <div><audio controls> <source ng-src="{{trustSrc(item.url)}}" type="audio/mpeg"></audio></div>
                            <div>{{ item.name}}</div>
                            <div>{{ item.url}}</div>
                            
                        </li>
                    </ul>
                    <div ng-click="getMore()">Click more..... </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var demo = angular.module('SongApp', ['tagged.directives.infiniteScroll'])
                    .controller('SongsPlayListController', SongsPlayListController);



            function SongsPlayListController($scope, $http,$sce) {

                $scope.items = [];
                $scope.distance = 0;
                $scope.paginating = false;
                $scope.enabled = true;
                $scope.setVariables = function (keyword)
                {
                    $scope.limit = 4;
                    $scope.offset = 0;
                    $scope.word = keyword;
                };


                $scope.getMore = function () {
                    if (true === $scope.paginating) {
                        return;
                    }
                    $scope.paginating = true;
                    url = "http://local.esei/search?word="+$scope.word+"&limit=" + $scope.limit + "&offset=" + $scope.offset;
                    $scope.offset = $scope.offset + $scope.limit;
                    httpObj = $http.get(url);
                    httpObj.success(function (data) {

                        var items = data;
                        for (var i = 0; i < items.length; i++) {
                            $scope.items.push({
                                id: items[i].id,
                                name: items[i].name,
                                title: items[i].title,
                                url:items[i].url,
                                styles: {
                                    background: 'hsl(' + (i * 107) % 360 + ', 70%, 85%)'
                                }
                            });


                        }
                        //this.after = "t3_" + items[items.length - 1].id;
                        if (0 == data.length) {
                            $scope.paginating = true;
                        } else {
                            $scope.paginating = false;

                        }

                    });


                    //ends here///
                };



                $scope.search = function () {
                    $scope.paginating = false;
                    $scope.items = [];

                    $scope.setVariables($scope.song_name);
                    $scope.getMore();
                }
                
                
                 $scope.trustSrc = function(src) {
                    return $sce.trustAsResourceUrl(src);
                  }
            }
        </script>
    </body>
</html>
