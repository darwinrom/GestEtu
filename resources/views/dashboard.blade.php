<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("css/materialize.css") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <title>Dashboard</title>
</head>
<body>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="{{route("Home")}}" class="brand-logo">GesEtu</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="{{route('profil')}}">Voir Profil</a></li>
            <li><a href="{{route('deconnecter')}}">Deconnecter</a></li>

        </ul>

        <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="container table-contents striped-table">
    <table class="centered responsive-table">
        <thead>
        <tr>
            <th style="color: #574cf2">Note</th>
            <th style="color: #574cf2">Matiere</th>
            <th style="color: #574cf2">Actions</th>
        </tr>
        </thead>
        <tbody id="mtbody">
        @if (count($listComposer) == 0)
            <tr style="font-size: 16px">
                <td colspan="3" class="black-text">Aucune note disponible</td>
            </tr>
        @else
        @foreach($listComposer as $value)
        <tr>
            <td class="black-text">{{$value->note}}</td>
            <td class="black-text">{{$value->lib_mat}}</td>
            <td>
                <a class="btn-small btn-flat blue" href="?enreg={{encrypt($value->code_mat)}}">Supprimer</a>
                <a class="btn-small btn-flat red" href="/noteupdated?enreg={{encrypt($value->code_mat)}}"> Modifier</a>
            </td>
        </tr>
        @endforeach
        @endif
        </tbody>
    </table>
           <a href="{{route('ajoutNote')}}" class="btn-small btn-flat green" style="margin-top: 50px;text-align: center;margin-bottom: 50px; ">Ajouter</a>
           <a href="{{route('pdf_note')}}" class="btn-small btn-flat blue-grey" style="margin-top: 50px;text-align: center;margin-bottom: 50px; ">Télecharger</a>

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

