'use strict';
var songsPlayerModule = angular.module('SongsPlayer',
        [
            "ngSanitize",
            "com.2fdevs.videogular",
            "com.2fdevs.videogular.plugins.controls",
            "com.2fdevs.videogular.plugins.overlayplay",
            "com.2fdevs.videogular.plugins.poster",
            "tagged.directives.infiniteScroll"
        ]);

songsPlayerModule.controller('SongsPlayerCtrl',
        ["$sce", '$http', '$scope', function ($sce, $http, $scope) {

                /* player properties starts here*/
                $scope.config = {
                    sources: [
                        {src: $sce.trustAsResourceUrl("http://a.tumblr.com/tumblr_lppf8q8GW11qa863po1.mp3"), type: "audio/mpeg"},
                    ],
                    tracks: [
                        {
                            src: "http://www.videogular.com/assets/subs/pale-blue-dot.vtt",
                            kind: "subtitles",
                            srclang: "en",
                            label: "English",
                            default: ""
                        }
                    ],
                    theme: "/js/lib/bower_components/videogular-themes-default/videogular.css",
                    plugins: {
                        poster: "http://www.videogular.com/assets/images/videogular.png"
                    }
                };


                /* player properties ends here*/

                $scope.currentSongIndex = 0;
                /**
                 * plays the current song
                 * 
                 * @param {type} songKey
                 * @returns {undefined}
                 */
                $scope.playSong = function (songKey) {
                    $scope.currentSongIndex = songKey;
                    $scope.API.stop();
                    $scope.config.sources = [{src: $sce.trustAsResourceUrl($scope.items[songKey].url), type: "audio/mpeg"}];
                    $scope.API.play();
                };


                /**
                 * plays prev/next song
                 * 
                 * @param {integer} prevNext 0=previous, 1=next
                 * @returns {undefined}
                 */
                $scope.playPreNextSong = function (prevNext) {
                    if (0 === prevNext) {
                        $scope.currentSongIndex--;
                    } else if (1 === prevNext) {
                        $scope.currentSongIndex++;
                    }
                    $scope.playSong($scope.currentSongIndex);
                };

                /**
                 * Injecting API object on ready
                 * 
                 * @param {type} API
                 * @returns {undefined}
                 */
                $scope.onPlayerReady = function (API) {
                    $scope.API = API;
                };






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


                $scope.getData = function () {

                    if (true === $scope.paginating) {
                        return;
                    }
                    $scope.paginating = true;
                    $scope.url = "http://local.esei/search?word=" + $scope.word + "&limit=" + $scope.limit + "&offset=" + $scope.offset;
                    $scope.offset = $scope.offset + $scope.limit;
                    $http.get($scope.url).success(function (data) {
                        var items = data;
                        for (var i = 0; i < items.length; i++) {
                            $scope.items.push({
                                id: items[i].id,
                                name: items[i].name,
                                title: items[i].title,
                                url: items[i].url,
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

                };
                $scope.search = function () {
                    $scope.paginating = false;
                    $scope.items = [];

                    $scope.setVariables($scope.song_name);
                    $scope.getData();
                };


                $scope.trustSrc = function (src) {
                    return $sce.trustAsResourceUrl(src);
                };






            }]
        );


songsPlayerModule.directive("prevButton",
        function () {
            return {
                restrict: "E",
                template: "<div class='prev-next-button' ng-click='playPreNextSong(0)'>prev</div>"
            }
        }
);
songsPlayerModule.directive("nextButton",
        function () {
            return {
                restrict: "E",
                template: "<div class='prev-next-button' ng-click='playPreNextSong(1)'>next</div>"
            }
        }
);
