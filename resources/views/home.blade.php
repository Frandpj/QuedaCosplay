@extends('layouts.app')

@section('nav')
<!-- Nav -->
  <nav id="nav">
    <a href="{{ route ('home.index') }}" class="active"><i class="fas fa-home"></i> <span>Home</span></a>
    <a href="{{ route ('stays.index') }}"><i class="fas fa-bezier-curve"></i> <span>Quedadas</span></a>
    <a href="{{ route ('calendars.index') }}"><i class="fas fa-calendar-alt"></i> <span>Calendario</span></a>
    <a href="{{ route ('users.index') }}"><i class="fas fa-user-circle"></i> <span>Perfil</span></a>
    <a href="/logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
  </nav>
@endsection

@section('main-content')

<!-- HOME -->
<article id="home" class="panel intro">
  <header>
    <h1>QuedaCosplay</h1>
    <p>Programación de quedadas personalizadas</p>
  </header>
  <a href="{{ route ('stays.index') }}" class="jumplink pic">
    <span class="arrow icon fa-chevron-right"><span>Quedadas</span></span>
    <img src="images/me.jpg" alt="" />
  </a>
</article>

@endsection
