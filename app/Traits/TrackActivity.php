<?php

namespace App\Traits;

use App\Services\ActivityService;

trait TrackActivity
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function trackUserActivity($action, $ip_address, $page)
    {
        $this->activityService->create($action, $ip_address, $page);
    }
}