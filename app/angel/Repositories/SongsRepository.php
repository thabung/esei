<?php
namespace Angel\Repositories;
/**
 * Description of Songs
 *
 * @author thabung
 */
class SongsRepository {
    use \Angel\Common\CommonDataLayerFeatures;
    
    
    /**
     * Search a song with the name $songName
     * 
     * @param type $paramList
     * @return Illuminate\Database\Eloquent\Collection | null
     */
    public function searchSong($paramList =null) 
    {
        $limit = isset($paramList['limit'])?$paramList['limit']:$this->defaultLimit;
        $offset = isset($paramList['offset'])?$paramList['offset']:$this->defaultOffset;
        if (!isset($paramList['word'])) {
            return  \Songs::take($limit)->offset($offset)->get();
        }
        
        $songsList = \Songs::whereRaw("MATCH(name,title) AGAINST(?)", array($paramList['word']))->take($limit)->offset($offset)->get();
        return $songsList;
    }

}
