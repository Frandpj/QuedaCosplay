<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}"  type="text/css" rel="stylesheet"/>
</head>
<body>

  <section class="login-block">
    <div class="container">
      <div class="row">
        <div class="col-md-4 login-sec">
          <h2 class="text-center">Login</h2>
          @if(Session::has('mensaje_error'))
              {{ Session::get('mensaje_error') }}
          @endif
          {{ Form::open(array('url' => '/login'), ['class' => 'form-signin']) }}
              <div class="form-label-group">
                <input type="text" id="username" class="form-control" placeholder="Usuario" name="username" required autofocus>
                <label for="username">Usuario</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="password" class="form-control" name="password" placeholder="Contraseña" required>
                <label for="password">Contraseña</label>
              </div>
              <div class="form-check">
              {{ Form::label('lblRememberme', 'Recordar contraseña', ['class' => 'form-check-label']) }}
              {{ Form::checkbox('rememberme', true, ['class' => 'form-check-input']) }}
              {{ Form::submit('Login', ['class' => 'btn btn-login float-right']) }}
              </div>
          {{ Form::close() }}
          <div class="col-sm-8">
            <a class="d-block text-left mt-2 small text-primary" href="{{ url('/register') }}"><small>Regístrate</small></a>
          </div>
        </div>
        <div class="col-md-8 banner-sec">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="{{ asset('css/images/kaneki.jpg') }}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                  <div class="banner-text">
                    <h2>QuedaCosplay</h2>
                    <p>Haz tus propias quedadas personalizadas y conoce gente con esta misma afición</p>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="{{ asset('css/images/l.jpg') }}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                  <div class="banner-text">
                    <h2>QuedaCosplay</h2>
                    <p>Haz tus propias quedadas personalizadas y conoce gente con esta misma afición</p>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="{{ asset('css/images/sao.jpg') }}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                  <div class="banner-text">
                    <h2>QuedaCosplay</h2>
                    <p>Haz tus propias quedadas personalizadas y conoce gente con esta misma afición</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
  </html>
