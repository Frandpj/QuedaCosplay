<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registro</title>
  <script src="{{ asset('/js/jquery.slim.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"  type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/all.css') }}"  type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}"  type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
          </div>
          <div class="card-body">
            <div class="col-md-12 register-sec">
              <h2 class="text-center">Registro</h2>
            </div>
              <form method="post" class="form-horizontal" action="{{ route('registerStore') }}" enctype="multipart/form-data">
              @csrf

              <div class="form-label-group">
                <input type="file" class="form-control" name="image"/>
                <label for="image">Imagen</label>
                {!! $errors->first('image', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
              </div>

              <hr>

              <div class="form-label-group">
                <input type="text" id="name" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required autofocus>
                <label for="name">Nombre</label>
                {!! $errors->first('name', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
              </div>

              <div class="form-label-group">
                <input type="text" id="surname" class="form-control" placeholder="Apellidos" name="surname" value="{{ old('surname') }}" required>
                <label for="surname">Apellidos</label>
                {!! $errors->first('surname', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
              </div>

              <hr>

              <div class="form-label-group">
              <div class="form-group {{ $errors->has('province_id') ? 'has-error' : ''}}">
                <label for="province_id">Provincia</label>
                <div class="col-sm-10">
                  <select class="form-control" name="province_id" id="province_id">
                    <option disabled selected>Seleccione una provincia</option>
                    @if ($provinces->count())
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->province }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
                {!! $errors->first('province_id', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
              </div>
            </div>

            <div class="form-label-group">
              <div class="form-group {{ $errors->has('town_id') ? 'has-error' : ''}}">
                <label for="town_id">Localidad</label>
                <div class="col-sm-10">
                  <select class="form-control" name="town_id" id="town_id">
                    <option disabled selected>Seleccione una población</option>
                    <!-- @if ($towns->count())
                    @foreach($towns as $town)
                    <option value="{{ $town->id }}">{{ $town->town }}</option>
                    @endforeach
                    @endif -->
                  </select>
                </div>
                {!! $errors->first('town_id', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
              </div>
            </div>

              <hr>

              <div class="form-label-group">
                <input type="text" id="username" class="form-control" placeholder="Usuario" name="username" value="{{ old('username') }}" required>
                <label for="username">Usuario</label>
                {!! $errors->first('username', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
              </div>

              <div class="form-label-group">
                <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                <label for="email">Email</label>
                {!! $errors->first('email', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
              </div>

              <hr>

              <div class="form-label-group">
                <input type="password" id="password" class="form-control" placeholder="Contraseña" name="password" value="{{ old('password') }}" required>
                <label for="password">Contraseña</label>
                {!! $errors->first('password', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
              </div>

              <div class="form-label-group">
                <input type="password" id="passwordConfirmation" class="form-control" placeholder="Confirmar contraseña" name="passwordConfirmation" required>
                <label for="passwordConfirmation">Confirmar contraseña</label>
                {!! $errors->first('passwordConfirmation', '<div class="col-sm-10 col-sm-offset-2 text-danger">:message</div>') !!}
              </div>

              <button class="btn btn-lg btn-register btn-block text-uppercase" type="submit">Registrarse</button>
              <a class="d-block text-center mt-2 small text-primary" href="{{ url('login') }}">Sign In</a>
              <hr class="my-4">
              <!--<button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>-->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


		<script>
			$(document).ready(function() {
				$('#province_id').on('change', function() {
					var provinceID = $(this).val();
					if(provinceID) {
					$.ajax({
						url: '/register/getTowns/'+encodeURI(provinceID),
						type: "GET",
						dataType: "json",
						success:function(data) {
							$('#town_id').empty();
							$.each(data, function(key, value) {
								$('#town_id').append('<option class="form-control" value="'+ value['id'] +'">'+ value['town'] +'</option>');
							});
						}
					});
					}else{
					$('select[name="town_id"]').empty();
					  }
				   });
				});
		</script>
</body>
</html>
