@extends('layouts.app')
<!-- stays -->

@section('nav')
<!-- Nav -->
  <nav id="nav">
    <a href="{{ route ('home.index') }}" class="invisible"><i class="fas fa-home"></i> <span>Home</span></a>
    <a href="{{ route ('stays.index') }}" class="active"><i class="fas fa-bezier-curve"></i> <span>Quedadas</span></a>
    <a href="{{ route ('calendars.index') }}"><i class="fas fa-calendar-alt"></i> <span>Calendario</span></a>
    <a href="{{ route ('users.index') }}"><i class="fas fa-user-circle"></i> <span>Perfil</span></a>
    <a href="/logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
  </nav>
@endsection

@section('main-content')

<article id="stays" class="panel">
  <header>
    <div class="row">
      <div class="col-sm-8">
        <h2>Quedadas</h2>
      </div>
      <div class="col-sm-4">
        <a href="{{ route('stays.create') }}" class="btn btn-xs btn-outline-dark"><i class="fas fa-plus-circle"></i> Agregar quedada</a>
      </div>
    </div>
  </header>
  <section>
    <div class="row justify-content-between">
      @foreach($stays as $stay)
      <div class="row align-items-start">
        <div class="col">
          <div class="card" style="width: 22rem;">
          <div class="card-body">
              <h5 class="card-title">{{ $stay->title }}</h5>
              <p class="card-text m-0" style="font-size:17px;">{{ $stay->description }}</p>
              <p class="card-text m-0" style="font-size:17px;">Provincia: {{ $stay->province->province }}</p>
              <p class="card-text m-0" style="font-size:17px;">Fecha y hora: {{ $stay->datetime }}</p>
              <a href="{{ route('stays.show', $stay->id)}}" class="btn btn-xs btn-outline-dark"><i class="fas fa-eye"></i> Ver quedada</a>
              @if($stay->user_id == Auth::user()->id)
              <a href="{{ route('stays.edit', $stay->id) }}" class="btn btn-xs btn-outline-dark"><i class="fas fa-pen"></i> Editar</a>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="row justify-content-between" style="margin-top:10px;">
				{{ $stays->onEachSide(1)->links() }}
    </div>
  </section>
</article>

@endsection
