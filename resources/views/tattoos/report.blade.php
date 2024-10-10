@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Signaler le tatouage : {{ $portfolio->title }}</h1>

    <form action="{{ route('tattoo.report.store', $portfolio->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="reason">Motif du signalement</label>
            <textarea id="reason" name="reason" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
</div>
@endsection
