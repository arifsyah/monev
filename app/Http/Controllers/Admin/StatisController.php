<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisController extends Controller
{
    //
    public function lppd2020(){
    	
    	return view('admin.statis.lppd2020');
    }
}
