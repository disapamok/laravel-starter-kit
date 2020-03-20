<?php

namespace App\Http\Controllers\ViewsControllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard(){
        return view('index');
    }

    public function showCustomers(){

    }

}
