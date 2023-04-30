@extends('modele.main')

@section('contents')
<div class="commandes">
    @if($errors->any())
    @foreach($errors->all() as $e)
    <br>{{$e}}<br>
    @endforeach
    @endif
    @if(Session::has('message'))
    <span>{{Session::get('message')}}</span>
    @endif
    <h1>User Page</h1>
    <div class="navigation">
        <ul class="navigation-liste">
            <li class="navigation-liste-item">
                <a href="{{route('user.updateName')}}">MAJ Nom/Prénom</a>
            </li>
            <li class="navigation-liste-item">
                <a href="{{route('user.updatePassword')}}">MAJ Password</a>
            </li>
        </ul>
    </div>
</div>
@endsection