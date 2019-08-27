
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('pageTitle')</title>
    <link rel="icon" href="{{asset('storage/img/title.png')}}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/icon.css')}}">


    <!--Import Google Icon Font-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous">


</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light shadow-lg bg-light sticky-top">
    <div class="container-fluid">

    <a class="navbar-brand" href="{{route('candidates.index')}}">
      <img src="{{url('../storage/app/public/img/logo.png')}}" style="width: 145px;" alt="">

    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto" style="font-size: 20px;">

        @auth
            @if(Auth::user()->role_id==1)

            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Candidates
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('candidates.index')}}"><i class="fas fa-users"></i> List of all Candidates</a>
                <a class="dropdown-item" href="{{route('candidates.create')}}"><i class="fas fa-briefcase-medical"></i> Create a Candidate</a>

            </div>
            </li>

            <li class="nav-item dropdown mr-4">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Users
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('users.index')}}"><i class="fas fa-users"></i> List of all Users</a>
                <a class="dropdown-item" href="{{route('users.create')}}"><i class="fas fa-user-plus"></i> Create a User</a>
            </div>
            </li>

            @endif
        @endauth

        <li class="nav-item">

          <a class="nav-link" href="{{ route('logout') }}" data-toggle="tooltip" data-placement="bottom"
            title="Logout" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
              <i class="material-icons">logout</i>
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>

        </li>
      </ul>
    </div>
  </div>
</nav>
