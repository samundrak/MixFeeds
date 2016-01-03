<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class me extends Controller
{
    public function show(){
        $name = array(1,2,3);
        return 'hello world';
    }

    public function contact(){
    	return "I am from conat"
    }
}