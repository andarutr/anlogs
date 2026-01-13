<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardService 
{
    public function totalDaily($actionFilter, $startDate, $endDate)
    {
        $data = DB::select("
            SELECT 
                DATE(created_at) as date, 
                COUNT(*) as total_activities
            FROM activities 
            WHERE DATE(created_at) BETWEEN ? AND ?
            " . ($actionFilter ? "AND action = ? " : "") . "
            GROUP BY DATE(created_at)
            ORDER BY date DESC
        ", $actionFilter ? [$startDate, $endDate, $actionFilter] : [$startDate, $endDate]);

        return $data;
    }

    public function topUser($limit, $actionFilter, $startDate, $endDate)
    {
        $data = DB::select("
            SELECT 
                u.name, 
                u.email, 
                a.user_id, 
                COUNT(*) as total_activities
            FROM activities a
            INNER JOIN users u ON a.user_id = u.id
            WHERE DATE(a.created_at) BETWEEN ? AND ?
            " . ($actionFilter ? "AND a.action = ? " : "") . "
            GROUP BY a.user_id, u.name, u.email
            ORDER BY total_activities DESC
            LIMIT $limit
        ", $actionFilter ? [$startDate, $endDate, $actionFilter] : [$startDate, $endDate]);

        return $data;
    }

    public function totalAction($actionFilter, $startDate, $endDate)
    {
        $data = DB::select("
            SELECT 
                action, 
                COUNT(*) as total_activities
            FROM activities 
            WHERE DATE(created_at) BETWEEN ? AND ?
            " . ($actionFilter ? "AND action = ? " : "") . "
            GROUP BY action
            ORDER BY action
        ", $actionFilter ? [$startDate, $endDate, $actionFilter] : [$startDate, $endDate]);

        return $data;
    }
}