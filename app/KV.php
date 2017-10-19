<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class KV extends Model
{
    static function get($key){
        $result = Redis::get($key);
        if($result){
            return $result;
        }
    }
    static function set($key, $value){
        Redis::set($key, $value);
    }
}
