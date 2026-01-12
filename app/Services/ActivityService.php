<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityService 
{
    public function create($action, $ip_address, $page)
    {
        Activity::create([
            'user_id' => Auth::user()->id,
            'action' => $action,
            'ip_address' => $ip_address,
            'page' => $page,
        ]);
    }
}