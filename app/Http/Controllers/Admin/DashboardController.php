<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tiket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $user = User::count();
        $tm = Tiket::where('status', 'Pending')->count();
        $td = Tiket::where('status', 'Process')->count();
        $ts = Tiket::where('status', 'Closed')->count();
        return view('admin.dashboard', compact('user', 'tm', 'td', 'ts'));
    }
}
