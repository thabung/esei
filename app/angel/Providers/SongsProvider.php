<?php
namespace Angel\Providers;
use Illuminate\Support\ServiceProvider;
/**
 * Description of SongProvider
 *
 * @author thabung
 */
class SongsProvider extends ServiceProvider {

    public function register() {
        $this->app->bind('songs_repository', function($app)
        {
            return new \Angel\Repositories\SongsRepository();
        });
       
    }

}
