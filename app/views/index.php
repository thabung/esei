<!DOCTYPE html>
<html lang="en" ng-app="SongsPlayer">
    <head>
        <title>Play your favorite songs</title>
        <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.js"></script>-->

        <script src="/js/lib/bower_components/angular/angular.min.js"></script>
        <script src="/js/lib/bower_components/angular-sanitize/angular-sanitize.min.js"></script>

        <script type="text/javascript" src="/js/lib/taggedInfiniteScroll.js"></script>
        <link type="text/css" rel="stylesheet" href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css"></link>
        <link type="text/css" rel="stylesheet" href="/css/app/main.css"></link>
        <link type="text/css" rel="stylesheet" href="/css/app/main.css"></link>

        <script src="/js/lib/bower_components/videogular/videogular.js"></script>
        <script src="/js/lib/bower_components/videogular-controls/vg-controls.js"></script>
        <script src="/js/lib/bower_components/videogular-overlay-play/vg-overlay-play.js"></script>
        <script src="/js/lib/bower_components/videogular-poster/vg-poster.js"></script>
        <script src="/js/lib/bower_components/videogular-buffering/vg-buffering.js"></script>
        <script src="/js/app/music-player.js"></script>

    </head>
    <body  ng-cloak>


        <div class="container">


            <div ng-controller="SongsPlayerCtrl">
                <div>
                    <div> 
                        <input class="" placeholder="Song name" type="text" ng-model="song_name"><p ng-bind="song_name">{{song_name}}</p>
                        <a href='javascript:void(0);' ng-click="search()">Search</a>
                    </div>
                    <div tagged-infinite-scroll="" tagged-infinite-scroll-disabled="!enabled || paginating" tagged-infinite-scroll-distance="distance">

                        <ul class="items" ng-class="{ paginating: paginating }">
                            <li ng-repeat="(key, item) in items" ng-style="item.styles">
                                <div class="song_name">{{ item.name}}</div>
                                
                                <a href="javascript:void(0);"  ng-click="playSong(key)">Play</a>
                                <div>{{ item.name}}</div>
                                <div>{{ item.url}}</div>

                            </li>
                        </ul>
                        <a href="javascript:void(0);" ng-click="getData()">Click more..... </a>
                    </div>
                </div>




                <div style="height:50px" >
                    <videogular vg-theme="config.theme" vg-player-ready="onPlayerReady($API)">
                        <vg-media vg-src="config.sources"
                                  vg-tracks="config.tracks">
                        </vg-media>
                        <prevButton></prevButton>
                        <nextButton></nextButton>
                        <a href="javascript:void(0);" ng-click="playPreNextSong(0)">prev</a>

                        <a href="javascript:void(0);" ng-click="playPreNextSong(1)">next</a>
                        <vg-controls>

                            <vg-play-pause-button></vg-play-pause-button>



                            <vg-time-display>{{ currentTime | date:'mm:ss' }}</vg-time-display>
                            <vg-scrub-bar>
                                <vg-scrub-bar-current-time></vg-scrub-bar-current-time>
                            </vg-scrub-bar>
                            <vg-time-display>{{ timeLeft | date:'mm:ss' }}</vg-time-display>
                            <vg-volume>
                                <vg-mute-button></vg-mute-button>
                                <vg-volume-bar></vg-volume-bar>
                            </vg-volume>


                        </vg-controls>


                        <vg-overlay-play></vg-overlay-play>
                        <vg-poster vg-url='config.plugins.poster'></vg-poster>
                    </videogular>
                </div>








            </div>

        </div>


    </body>
</html>
