<!DOCTYPE html>
<html lang="es">

@section('head')
@include('layouts.partials.head')
@show

<body class="is-preload">

  <!-- Wrapper-->
  <div id="wrapper">
    @yield('nav')
    <!-- Main -->
    <div id="main">
      @yield('main-content')
    </div>
    @include('layouts.partials.footer')
  </div>
  @section('scripts')
  @include('layouts.partials.scripts')
  @show

</body>
</html>
