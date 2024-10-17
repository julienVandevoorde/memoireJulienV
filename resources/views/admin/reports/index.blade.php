@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<div class="dashboard-container">
    <div class="container">
        <h1 class="text-center mb-5">Report Management</h1>

        <div class="table-container">
            <!-- Tattoo Reports -->
            <h3 class="text-center">Tattoo Reports</h3>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Tattoo ID</th>
                        <th>Tattoo Name</th>
                        <th>Owner</th>
                        <th>Reported by</th>
                        <th>Reason</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tattooReports as $report)
                        <tr>
                            <td>{{ $report->portfolio->id }}</td>
                            <td>{{ $report->portfolio->title }}</td>
                            <td>{{ $report->portfolio->user->name }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->reason }}</td>
                            <td>{{ $report->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <!-- User Reports -->
            <h3 class="text-center">User Reports</h3>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Reported by</th>
                        <th>Reason</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userReports as $report)
                        <tr>
                            <td>{{ $report->reportedUser->id }}</td>
                            <td>{{ $report->reportedUser->name }}</td>
                            <td>{{ $report->reportingUser ? $report->reportingUser->name : 'User not found' }}</td>
                            <td>{{ $report->reason }}</td>
                            <td>{{ $report->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
