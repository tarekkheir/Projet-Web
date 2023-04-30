@extends('modele.main')

@section('contents')
@if($errors->any())
@foreach($errors->all() as $e)
<br>{{$e}}<br>
@endforeach
@endif
@if(Session::has('message'))
<span>{{Session::get('message')}}</span>
@endif
<div class="form-container">
    <form method="post" class="form">
        @method('put')
        <h1>New MDP {{auth()->user()->login}}</h1>
        <div class="form-group">
            <label class="form-label">Old MDP</label> 
            <input class="form-field" type="password" name="old_mdp">
        </div>
        <div class="form-group">
            <label class="form-label">New MDP</label> 
            <input class="form-field" type="password" name="new_mdp">
        </div>
        <div class="form-group">
            <label class="form-label">New MDP Confirmation</label>
            <input class="form-field" type="password" name="new_mdp_confirmation">
        </div>
        <button type="submit" class="btn btn-primary btn-ghost">Envoyer</button>
        @csrf
    </form>
</div>
@endsection