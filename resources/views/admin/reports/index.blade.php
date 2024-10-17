@extends('layouts.app')

@section('content')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
<div class="dashboard-container">
    <div class="container">
        <h1 class="text-center mb-5">Gestion des signalements</h1>

        <div class="table-container">
            <!-- Signalements de tatouages -->
            <h3 class="text-center">Signalements de tatouages</h3>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID Tatouage</th>
                        <th>Nom Tatouage</th>
                        <th>Propriétaire</th>
                        <th>Utilisateur qui a signalé</th>
                        <th>Motif</th>
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
            <!-- Signalements d'utilisateurs -->
            <h3 class="text-center">Signalements d'utilisateurs</h3>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID Utilisateur</th>
                        <th>Nom de l'utilisateur</th>
                        <th>Signalé par</th>
                        <th>Motif</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userReports as $report)
                        <tr>
                            <td>{{ $report->reportedUser->id }}</td>
                            <td>{{ $report->reportedUser->name }}</td>
                            <td>{{ $report->reportingUser ? $report->reportingUser->name : 'Utilisateur non trouvé' }}</td>
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
