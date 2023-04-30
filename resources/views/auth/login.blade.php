@extends('modele.main')

@section('contents')
@if($errors->any())
@foreach($errors->all() as $e)
<br>{{$e}}<br>
@endforeach
@endif
<div class="form-container">
    <form method="post" class="form">
        <h1>Login</h1>
        <div class="form-group">
            <label class="from-label">Login</label>
            <input class="form-field" type="text" name="login" value="{{old('login')}}">
        </div>
        <div class="form-group">
            <label class="form-label">MDP</label>
            <input class="form-field" type="password" name="mdp">
        </div>
        <button class="btn btn-primary btn-ghost" type="submit">Login</button>
        @csrf
    </form>
</div>
@endsection