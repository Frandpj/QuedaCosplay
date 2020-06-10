@extends('layouts.app')
<!-- stays -->

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

@section('main-content')

<article id="userStay" class="panel">
  <header>
    <div class="row">
      <div class="col-sm-8">
        <h2>Mis quedadas</h2>
      </div>
      <!-- <div class="col-sm-4">
        <a href="{{ route('stays.create') }}" class="btn btn-xs btn-outline-dark"><i class="fas fa-plus-circle"></i> Agregar quedada</a>
      </div> -->
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
              <p class="card-text" style="font-size:17px;">{{ $stay->description }}</p>
              <p class="card-text" style="font-size:17px;">Fecha y hora: {{ $stay->datetime }}</p>
              <a href="{{ route('stays.show', $stay->id)}}" class="btn btn-xs btn-outline-dark"><i class="fas fa-eye"></i> Ver quedada</a>
              <a href="{{ route('stays.edit', $stay->id) }}" class="btn btn-xs btn-outline-dark"><i class="fas fa-pen"></i> Editar</a>
              <a href="#" data-toggle="modal" data-target="#show-modal-destroy-{{$stay->id}}" id="{{ $stay->id }}" class="btn btn-xs btn-outline-dark"><i class="fas fa-trash-alt"></i> Eliminar</a>
            </div>
          </div>
        </div>
      </div>
			<!-- Popup eliminar quedada -->
				<form action="{{ route('stays.destroy', $stay->id) }}" method="post" class="m-0 p-0">
					@csrf
					@method('DELETE')
					<div class="modal fade" id="show-modal-destroy-{{$stay->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">

								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>

								<div id="modal-destroy" style="width: 400px;height: 200px;margin: 0 auto;">

									<h5 class="text-justify">¿Seguro que desea eliminar la quedada?</h5>
                  <div class="text-center">
                    <button type="submit" class="btn btn-outline-success destroy-accept" href="#">Aceptar</button> <button href="#" data-dismiss="modal"  class="btn btn-outline-danger">Rechazar</button>
                  </div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- Fin Popup eliminar quedada -->
      @endforeach
    </div>
    <div class="row justify-content-between" style="margin-top:10px;">
				{{ $stays->onEachSide(1)->links() }}
    </div>
		</div>
  </section>
</article>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


@endsection
