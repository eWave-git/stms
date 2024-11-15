<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Widget;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    function index(){

        $devices = Device::with('widget')->get()->toArray();


        exit;


        return view('index');
    }
}
