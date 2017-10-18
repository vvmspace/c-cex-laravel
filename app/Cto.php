<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cto extends Model
{
    protected $api;

    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
