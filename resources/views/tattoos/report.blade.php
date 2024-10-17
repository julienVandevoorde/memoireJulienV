@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Report the Tattoo: {{ $portfolio->title }}</h1>

    <form action="{{ route('tattoo.report.store', $portfolio->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="reason">Reason for reporting</label>
            <textarea id="reason" name="reason" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
