<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tiket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('user.dashboard');
    }
}
