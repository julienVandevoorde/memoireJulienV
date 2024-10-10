@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Signaler {{ $user->name }}</h1>

    <!-- Formulaire de signalement -->
    <form action="{{ route('report.user.submit', $user->id) }}" method="POST">
        @csrf

        <!-- Champ caché pour l'ID de l'utilisateur signalé -->
        <input type="hidden" name="reported_user_id" value="{{ $user->id }}">

        <div class="form-group">
            <label for="reason">Raison du signalement</label>
            <textarea name="reason" id="reason" rows="4" class="form-control" required></textarea>
            @if($errors->has('reason'))
                <span class="text-danger">{{ $errors->first('reason') }}</span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Envoyer le signalement</button>
        </div>
    </form>
</div>
@endsection
