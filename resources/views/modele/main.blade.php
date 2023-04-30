<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Projet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="{{ asset('app.css') }}"> -->
</head>

<body>
    <!-- page content -->
    @guest
    <p>vous n'êtes pas connecté</p>
    <div>
        <a href="{{route('login')}}">Se connecter</a><br>
        <a href="{{route('register')}}">S'enregistrer</a><br>
        <a href="{{route('home')}}">Home page</a><br>
    </div>
    @endguest
    @auth
    <p>Vous êtes connecté</p>
    <div class="navbar">
        <a href="{{route('logout')}}">Se deconnecter</a>
    </div>
    @endauth
    @yield('contents')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>