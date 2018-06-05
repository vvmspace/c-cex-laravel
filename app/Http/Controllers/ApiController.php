<?php

namespace App\Http\Controllers;

use App\Cto;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function sinCto(){
        $cto = new Cto();
        return ['to' => $cto->to()];
    }
}
