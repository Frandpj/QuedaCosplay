@extends('layouts.app')

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

<!-- stays -->
@section('main-content')
<article id="stay" class="panel">
	<header>
		<h2>Editar usuario</h2>
	</header>
	<form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
		@csrf
    @method('PUT')
		<div>
			<div class="row">
        <div class="col-12 col-12-medium">
					<input type="file" name="image" placeholder="Imagen" value="{{ $user->image }}"/>
					{!! $errors->first('image', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
				<div class="col-12 col-12-medium">
					<input type="text" name="username" placeholder="Usuario" value="{{ $user->username }}"/>
					{!! $errors->first('username', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
        <div class="col-12">
					<input type="text" name="name" placeholder="Nombre" value="{{ $user->name }}"></input>
					{!! $errors->first('name', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
        <div class="col-12 col-12-medium">
					<input type="text" name="surname" placeholder="Apellidos" value="{{ $user->surname }}"/>
					{!! $errors->first('surname', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
				<div class="col-12">
					<input type="email" id="email" placeholder="Email" name="email" value="{{ $user->email }}">
					{!! $errors->first('email', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
        <div class="col-6">
					<input type="password" id="password" placeholder="Contraseña" name="password">
					{!! $errors->first('password', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
        <div class="col-6">
					<input type="password" id="passwordConfirmation" placeholder="Confirmar contraseña" name="passwordConfirmation">
					{!! $errors->first('passwordConfirmation', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
				<div class="col-12">
					<select name="province_id" id=province_id>
						@foreach($provinces as $province)
              @if ($user->province_id == $province->id)
  							<option selected value="{{ $province->id }}">{{ $province->province }}</option>
  						@else
  							<option value="{{ $province->id }}">{{ $province->province }}</option>
  						@endif
						@endforeach
          </select>
          {!! $errors->first('province_id', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
        <div class="col-12">
					<select name="town_id" id="town_id">
            @foreach($towns as $town)
              @if ($user->town_id == $town->id)
                <option selected value="{{ $town->id }}">{{ $town->town }}</option>
              @else
                <option value="{{ $town->id }}">{{ $town->town }}</option>
              @endif
            @endforeach
          </select>
          {!! $errors->first('town_id', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
				</div>
				<div class="col-12">
					<button type="submit"><i class="fa fa-save"></i> Guardar</button>
				</div>
			</div>
		</div>
	</form>
</article>

<script type="text/javascript">
$(document).ready(function() {
  $('#province_id').on('change', function() {
    var provinceID = $(this).val();
    if(provinceID) {
    $.ajax({
      url: '/users/getTowns/'+encodeURI(provinceID),
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('#town_id').empty();
        $.each(data, function(key, value) {
          $('#town_id').append('<option value="'+ value['id'] +'">'+ value['town'] +'</option>');
        });
      }
    });
    }else{
    $('select[name="town_id"]').empty();
      }
     });
  });
</script>
@endsection
