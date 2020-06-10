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

<article id="staysShow" class="panel">
  <header>
  </header>
  <section>
    <div class="row align-items-start">
        <div class="col-12">
          <div class="invisible" id="stay-location">{{ $stay->location }}</div>
          <div class="card" style="width: 100%;">
          <div class="card-body">
            <div class="col-sm-12">
                <div style="height:500px; width:100%;" id="map"></div>
                <input type="text" class="invisible" id="location" name="location" value="{{ $stay->location }}" placeholder="Localización">
            </div>
            <blockquote class="blockquote-reverse">
              <h2 class="card-title">{{ $stay->title }}</h5>
              <p class="card-text m-1" style="font-size:22px;">{{ $stay->description }}</p>
              <p class="card-text m-1" style="font-size:22px;">Fecha y hora: {{ $stay->datetime }}</p>
              <p class="card-text m-1" style="font-size:22px;">Provincia: {{ $stay->province->province }}</p>
              @if(isset($stay->whatsappurl))
              <a href="{{ $stay->whatsappurl }}" target="_blank"><p class="card-text m-1" style="font-size:22px;">Grupo de Whatsapp</p></a>
              @endif
                <footer class="blockquote-footer text-right small">Creador: {{ $stay->user->username }}</footer>
              </blockquote>
            </div>

          	<form action="{{ route('stays.storeComments') }}" method="post" class="m-0">
              @csrf
              <div class="col-12">
      					<textarea class="rounded" name="message" placeholder="Comenta..." rows="2"></textarea>
      					{!! $errors->first('message', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
      				</div>
              <div class="col-12">
                <input type="text" class="invisible pull-left" id="stay_id" name="stay_id" value="{{ $stay->id }}" style="font-size:1px;">
      					{!! $errors->first('stay_id', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}

                <button type="submit" class="btn btn-outline-dark pull-right"><i class="fas fa-comments"></i> Comentar</button>
      				</div>
            </form>
            <hr>
            @foreach($comments as $comment)
            <div class="col-12">
              <div class="card mb-2">
                <div class="card-header p-1">
                  <div class="row">
                    <div class="col">
                      <h5 style="font-size:20px;">{{ $comment->user->username }}</h5>
                    </div>
                    @if($comment->user_id == Auth::user()->id)
                    <div class="col">
                      <a href="#" data-toggle="modal" data-target="#show-modal-destroy-{{$comment->id}}" id="{{ $comment->id }}" class="text-danger" style="font-size:20px;">Eliminar</a>
                    </div>
                    <!-- Popup eliminar comentario -->
              				<form action="{{ route('stays.destroyComment', $comment->id) }}" method="post" class="m-0 p-0">
              					@csrf
              					@method('DELETE')
              					<div class="modal fade" id="show-modal-destroy-{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
              						<div class="modal-dialog">
              							<div class="modal-content">

              								<div class="modal-header">
              									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              								</div>

              								<div id="modal-destroy" style="width: 400px;height: 200px;margin: 0 auto;">

              									<h5 class="text-justify">¿Seguro que desea eliminar el comentario?</h5>
                                <div class="text-center">
                                  <button type="submit" class="btn btn-outline-success destroy-accept" href="#">Aceptar</button> <button href="#" data-dismiss="modal"  class="btn btn-outline-danger">Rechazar</button>
                                </div>
              								</div>
              							</div>
              						</div>
              					</div>
              				</form> <!--Fin Popup eliminar comentario -->
                      @endif
                    <div class="col">
                      <h5 style="font-size:20px;" class="pull-right mr-3">{{ $comment->created_at }}</h5>
                    </div>
                  </div>
                </div>
                <div class="card-body p-1">
                  <div class="row">
                    <div class="col-1">
                      @if(isset($comment->user->image))
                      <img src="{{asset('images/').'/images'.$comment->user->image}}" class="img-responsive rounded mr-1" alt="avatar" width="52" height="64">
                      @endif
                    </div>
                    <div class="col-11">
                      <p class="mr-3 mb-0 ml-3">{{ $comment->message }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="row justify-content-between" style="margin-top:10px;">
    				{{ $comments->onEachSide(1)->links() }}
        </div>
    </div>
  </section>
</article>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script>

function initMap() {

        var default_position = JSON.parse($('#stay-location').html());

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: default_position
        });
        marker = new google.maps.Marker({
            position: default_position,
            map: map
        });

}


    //y aquí la función que me permite colocar el marcador, los condicionales son
    //para que solo un marcador aparezca a la vez, así que si ya existe uno, lo recoloca
    //en la nueva posición

    // var marker;

    function placeMarker(location) {
        console.log(location);
        if ( marker ) {
            marker.setPosition(location);
        } else {
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
        $('#location').val('{"lat": ' + location.lat() + ', "lng": ' + location.lng() + '}');
    } //fin funcion placeMarker
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDee-OIS4qjkfIN_99vCcAi3Y9s8fD-7NM&callback=initMap">
</script>


@endsection
