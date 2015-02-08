<?php

class SongsController extends BaseController {

    public function showAll() {
        $songList = Angel\Facades\SongsRepository::searchSong();
        return $this->getResponse($songList);
    }

    public function showOne($id) {
//        die("showOne");
        $paramList = array('id' => $id);
        $songList = Angel\Facades\SongsRepository::searchSong($paramList);
        return $this->getResponse($songList);
    }

    public function search() {
        
        $paramList = Input::all();
        $songList = Angel\Facades\SongsRepository::searchSong($paramList);
        return $this->getResponse($songList);
        
        
        
    }
    
    

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
