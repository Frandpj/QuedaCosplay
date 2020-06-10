@extends('layouts.app')
<!-- stays -->

@section('nav')
<!-- Nav -->
  <nav id="nav">
    <a href="{{ route ('home.index') }}" class="invisible"><i class="fas fa-home"></i> <span>Home</span></a>
    <a href="{{ route ('stays.index') }}"><i class="fas fa-bezier-curve"></i> <span>Quedadas</span></a>
    <a href="{{ route ('calendars.index') }}"><i class="fas fa-calendar-alt" class="active"></i> <span>Calendario</span></a>
    <a href="{{ route ('users.index') }}"><i class="fas fa-user-circle"></i> <span>Perfil</span></a>
    <a href="/logout"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
  </nav>
@endsection

@section('main-content')
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

<article id="calendars" class="panel">
  <header>
    <div class="row">
      <div class="col-sm-8">
        <h2>Calendario</h2>
      </div>
    </div>
  </header>
  <section>
    <div id="calendar"></div>
  </section>
</article>

<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/locale/es.js'></script>


</script>

<script type="text/javascript">
  $('#calendar').fullCalendar({
    themeSystem: 'bootstrap4',
    header: {
      locale: 'es',
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listMonth'
    },
    weekNumbers: true,
    eventLimit: true,
    events : [
        @foreach($stays as $stay)
        {
            id: '{{ $stay->id }}',
            title : '{{ $stay->province->province}}',
            start : '{{$stay->datetime}}',
            url: "{{route('stays.show', $stay->id)}}",
        },
        @endforeach
    ],
    eventColor: '#cb8e89',
    eventTextColor: '#000000',
    eventClick: function(event) {
        if (event.url) {
            window.open(event.url);
            return false;
        }
    }
  });
</script>

@endsection
