@extends('layouts.app')
<!-- stays -->
@section('main-content')

@section('nav')
<!-- Nav -->
  <nav id="nav">
    <a href="{{ route ('home.index') }}" class="invisible"><i class="fas fa-home"></i> <span>Home</span></a>
    <a href="{{ route ('stays.index') }}"><i class="fas fa-bezier-curve"></i> <span>Quedadas</span></a>
    <a href="{{ route ('calendars.index') }}"><i class="fas fa-calendar-alt"></i> <span>Calendario</span></a>
    <a href="{{ route ('users.index') }}" class="active"><i class="fas fa-user-circle"></i> <span>Perfil</span></a>
    <a href="/logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
  </nav>
@endsection

<article id="users" class="panel">
  <header>
    <div class="row">
      <div class="col-sm-12 p-0">
        <h2>Mi cuenta</h2>
        <a class="btn btn-xs btn-outline-dark pull-right m-1" href="{{ route('users.userStay', $user->id) }}"><i class="fas fa-bezier-curve"></i> Ir a mis quedadas</a>
      </div>
    </div>
  </header>
  <section>
    <div class="row border border-dark">
      <div class="col-12">
        <h3><i class="fa fa-user"></i> Datos del usuario</h3>
      </div>

      <div class="col-12">
        @if(isset($user->image))
        <img src="{{asset('images/').'/images'.$user->image}}" class="img-responsive" alt="avatar">
        @else
        No tienes foto de perfil
        @endif
      </div>

      <div class="col-6">
        <p style="font-size:20px; margin-bottom:10px;"><b>Usuario: </b>{{ $user->username }}</p>
        <p style="font-size:20px; margin-bottom:10px;"><b>Nombre: </b>{{ $user->name }}</p>
        <p style="font-size:20px; margin-bottom:10px;"><b>Apellidos: </b>{{ $user->surname }}</p>
      </div>

      <div class="col-6">
        <p style="font-size:20px; margin-bottom:10px;"><b>Email: </b>{{ $user->email }}</p>
        <p style="font-size:20px; margin-bottom:10px;"><b>Provincia: </b>{{ $user->province->province }}</p>
        <p style="font-size:20px; margin-bottom:10px;"><b>Población: </b>{{ $user->town->town }}</p>
      </div>

      <div class="col-12 p-0">
        <a class="btn btn-xs btn-outline-dark pull-right m-1" href="{{ route('users.edit', $user->id) }}"><i class="fas fa-pen"></i> Editar</a>
      </div>
    </div>
  </section>
</article>

@endsection
