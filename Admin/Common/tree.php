<?php
function getTree($data, $level=0, $pid=0){
    static $limitdata = array();

    foreach($data as $value){
        if($value['pid'] == $pid){
            $value['level'] = $level;
            $limitdata[] = $value;
            getTree($data,$level+1,$value['id']);
        }
    }
    return $limitdata;
}