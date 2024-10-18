@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
<br><br>
<div class="report-container">
    <h1>Report the Tattoo: {{ $portfolio->title }}</h1>

    <!-- Report Form -->
    <form action="{{ route('tattoo.report.store', $portfolio->id) }}" method="POST" class="report-form">
        @csrf

        <div class="form-group">
            <label for="reason">Reason for reporting</label>
            <textarea id="reason" name="reason" rows="4" class="form-control" required></textarea>
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
