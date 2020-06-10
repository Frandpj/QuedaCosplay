@extends('layouts.app')

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

<!-- stays -->
@section('main-content')
<article id="stay" class="panel">
	<header>
		<h2>Crear quedada</h2>
	</header>
	<form action="{{ route('stays.store') }}" method="post">
		@csrf
		<div>
			<div class="row">
				<div class="col-12 col-12-medium">
					<input type="text" name="title" placeholder="Título" value="{{ old('title') }}"/>
					{!! $errors->first('title', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
        <div class="col-12">
					<textarea name="description" placeholder="Descripción" rows="6">{{ old('description') }}</textarea>
					{!! $errors->first('description', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
				<div class="col-12">
					<input type="text" id="datetime" class="datetimepicker-input" name="datetime" placeholder="Fecha y hora" value="{{ old('datetime') }}"/>
					{!! $errors->first('datetime', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
				<div class="col-12">
					<input type="text" name="whatsappurl" placeholder="URL Whatsapp" value="{{ old('whatsappurl') }}"></textarea>
					{!! $errors->first('whatsappurl', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
				<div class="col-12">
					<select name="province_id">
						@foreach($provinces as $province)
              <option value="{{ $province->id }}">{{ $province->province }}</option>
							{!! $errors->first('province_id', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
						@endforeach
          </select>
				</div>
        <div class="col-12">
          <div style="height:500px;" id="map"></div>
          <input type="text" class="invisible" id="location" name="location" placeholder="Localización">
					{!! $errors->first('location', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
				<div class="col-12">
					<button type="submit"><i class="fa fa-save"></i> Guardar</button>
				</div>
			</div>
		</div>
	</form>
</article>

    <script>


        //MAPA
        function initMap() {

          navigator.geolocation.getCurrentPosition(function(position) {
            // Get the positioning coordinates.
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            var default_position = {lat: lat, lng: lng};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: default_position
            });
            marker = new google.maps.Marker({
                position: default_position,
                map: map
            });

            //con esto obtengo las coordenadas y coloco el marker
            map.addListener('click', function(event) {
                var coordenadas = event.latLng;
                var lat = coordenadas.lat();
                var lng = coordenadas.lng();
                placeMarker(event.latLng);
            });
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

            // Do something magical...
          }, function() {
            alert('Oops! A ocurrido algo.');
          });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrqDSpMIeAAGU9P8K1M0KkS9MgUfZ1hpM&callback=initMap">
    </script>

		<!--DATEPICKER PARA EL NOMBRE datetime-->
	  <script type="text/javascript">
	      $(function () {
	          $('#datetime').datetimepicker({
	              format: "yyyy-mm-dd hh:ii:ss",
	              autoclose: true,
	          });
	      });
	  </script>
@endsection
