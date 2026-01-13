@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h4>Dashboard Analytics</h4>
                </div>
                <div class="card-body">
                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label>Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $filters['start_date'] }}" id="start_date">
                        </div>
                        <div class="col-md-3">
                            <label>End Date</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $filters['end_date'] }}" id="end_date">
                        </div>
                        <div class="col-md-3">
                            <label>Action Filter</label>
                            <select name="action_filter" class="form-control" id="action_filter">
                                <option value="">All Actions</option>
                                <option value="login" {{ $filters['action_filter'] == 'login' ? 'selected' : '' }}>Login</option>
                                <option value="visit" {{ $filters['action_filter'] == 'visit' ? 'selected' : '' }}>Visit</option>
                                <option value="logout" {{ $filters['action_filter'] == 'logout' ? 'selected' : '' }}>Logout</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label><br>
                            <button class="btn btn-primary" onclick="applyFilters()">Apply Filters</button>
                        </div>
                    </div>

                    <!-- Daily Totals -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5>Total Activity Per Day</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Total Activities</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dailyTotals as $daily)
                                        <tr>
                                            <td>{{ $daily->date }}</td>
                                            <td>{{ $daily->total_activities }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2">No data available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Top 5 Users -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Top 5 Most Active Users</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Total Activities</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($topUsers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->total_activities }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2">No data available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Action Totals -->
                        <div class="col-md-6">
                            <h5>Total Activity Per Action</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Total Activities</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($actionTotals as $action)
                                        <tr>
                                            <td>{{ ucfirst($action->action) }}</td>
                                            <td>{{ $action->total_activities }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2">No data available</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function applyFilters() {
    const startDate = $('#start_date').val();
    const endDate = $('#end_date').val();
    const actionFilter = $('#action_filter').val();
    
    let url = `?start_date=${startDate}&end_date=${endDate}`;
    if(actionFilter) {
        url += `&action_filter=${actionFilter}`;
    }
    
    window.location.href = url;
}
</script>
@endsection