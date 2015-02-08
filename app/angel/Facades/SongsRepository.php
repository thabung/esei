<?php
namespace Angel\Facades;
use Illuminate\Support\Facades\Facade;
/**
 * Description of SongsRepositories
 *
 * @author thabung
 */
class SongsRepository  extends Facade{
     
    protected static function getFacadeAccessor() { return 'songs_repository'; }

}
