<?php

namespace App\Http\Controllers;

use App\Traits\TrackActivity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use TrackActivity;

    public function index()
    {
        // Track Activity
        $this->trackUserActivity($action = 'visit', $ip_address = request()->ip(), $page = 'dashboard');

        return view('pages.dashboard');
    }
}
