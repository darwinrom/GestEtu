<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("css/materialize.css") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <title>Profil</title>
</head>
<body>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="{{route("Home")}}" class="brand-logo">GesEtu</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
            <li><a href="{{route('deconnecter')}}">Deconnecter</a></li>

        </ul>

        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="container">
    @foreach($data as $value)
    <div class="row">
        <div class="col s12 m12">
            <div class="card col s12 m12">
                <div class="card-image col s12 m6">

                    <img src="{{asset('images/'.$value->photo)}}">
                    <span class="card-title"></span>
                    {{--<a class="btn-floating halfway-fab waves-effect waves-light red"></a>--}}
                </div>
                <div class="card-content col s12 m6">
                    <p><strong>Nom  et Prenom:</strong> {{$value->nom }}   {{$value->prenom }}<br>
                        <strong> Email :</strong> {{$value->email }} <br>
                        <strong>Pseudo :</strong> {{$value->pseudo }}<br>
                        <strong>Filiere :</strong> {{$value->code_fil }}  <br></p>
                    <a href="{{route('modifierProfil')}}" class="btn-small btn-flat green" style="margin-top: 50px;text-align: center;margin-bottom: 50px;">Modifier</a>
                </div>
            </div>
        </div>

    </div>
        @endforeach
</div>



<footer  class="page-footer orange">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Company Bio</h5>
                <p class="grey-text text-lighten-4">Ce site vous permet de gerer vos notes</p>


            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Settings</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                </ul>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">Connect</h5>
                <ul>
                    <li><a class="white-text" href="#!">Link 1</a></li>
                    <li><a class="white-text" href="#!">Link 2</a></li>
                    <li><a class="white-text" href="#!">Link 3</a></li>
                    <li><a class="white-text" href="#!">Link 4</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
    </div>
</footer>
</body>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script >
    $(document).ready(function(){
        $('.modal').modal();
    });

    $(document).ready(function(){
        $('select').formSelect();
    });

</script>
<script src="{{ asset("jquery.min.js") }}"></script>
<script src="{{ asset("js/materialize.js") }}"></script>
<script src="{{ asset("js/init.js") }}"></script>
</html>

