<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('isAdmin', 1)->count();
        $users = User::where('isAdmin', 0)->count();
        $video = Video::count();
        return view('dashboardPage.index', [
            'page' => 'Dashboard',
            'video' => $video,
            'user' => $user,
            'users' => $users,
        ]);
    }
}
