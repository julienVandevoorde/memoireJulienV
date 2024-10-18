@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
<br><br>
<div class="report-container">
    <h1>Report {{ $user->name }}</h1>

    <!-- Report Form -->
    <form action="{{ route('report.user.submit', $user->id) }}" method="POST" class="report-form">
        @csrf

        <!-- Hidden field for reported user ID -->
        <input type="hidden" name="reported_user_id" value="{{ $user->id }}">

        <div class="form-group">
            <label for="reason">Reason for reporting</label>
            <textarea name="reason" id="reason" rows="4" class="form-control" required></textarea>
            @if($errors->has('reason'))
                <span class="text-danger">{{ $errors->first('reason') }}</span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Submit Report</button>
        </div>
    </form>
</div>
@endsection
