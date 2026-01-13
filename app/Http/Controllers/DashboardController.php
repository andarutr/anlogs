<?php

namespace App\Http\Controllers;

use App\Services\ActivityService;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use App\Traits\TrackActivity;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use TrackActivity;

    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index(Request $request)
    {
        // Track Activity
        $this->trackUserActivity($action = 'visit', $ip_address = request()->ip(), $page = 'dashboard');
        
        $startDate = $request->input('start_date', now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        $actionFilter = $request->input('action_filter');

        $dailyTotals = $this->dashboardService->totalDaily($actionFilter, $startDate, $endDate);

        $topUsers = $this->dashboardService->topUser($limit = 5, $actionFilter, $startDate, $endDate);

        $actionTotals = $this->dashboardService->totalAction($actionFilter, $startDate, $endDate);

        return view('pages.dashboard', [
            'dailyTotals' => $dailyTotals,
            'topUsers' => $topUsers,
            'actionTotals' => $actionTotals,
            'filters' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'action_filter' => $actionFilter
            ]
        ]);
    }
}
