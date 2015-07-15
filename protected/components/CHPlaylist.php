<?php
/**
 * Created by PhpStorm.
 * User: zainulabdeen
 * Date: 28/06/15
 * Time: 12:42 AM
 */

class CHPlaylist {

    public $youtubelistInstance = null;

    protected $params;
    protected $id;

    public function __construct($type,$id,$Params=null){

        $this->youtubelistInstance = new Youtubelist($type);
        $this->setId($id);
        if(isset($Params)){
            $this->setParams($Params);
        }
    }

    public function getInstance(){
        if (!isset($this->youtubelistInstance)){
            $this->youtubelistInstance = new Youtubelist('playlist');
        }
        return $this->youtubelistInstance;
    }

    protected function setId($id){
        $this->youtubelistInstance->set_playlist($id);
    }

    protected function setParams($params){
        foreach($params as $key => $value){
            $method = 'set_'.$key;
            if (method_exists($this->youtubelistInstance, $method)){
                call_user_func(array($this->youtubelistInstance,$method),$value);
            } else {
                throw new Exception('Method '. $method . 'does not exists in class Youtubelist' );
            }
        }
    }


} 