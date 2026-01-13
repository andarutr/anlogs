<?php

namespace App\Traits;

use App\Services\ActivityService;

trait TrackActivity
{
    public function trackUserActivity($action, $ip_address, $page)
    {
        $activityService = app(ActivityService::class);
        $activityService->create($action, $ip_address, $page);
    }
}