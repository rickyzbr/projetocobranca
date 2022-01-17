@section('title', 'Cobrança | Gestão de Cobrança')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item"><a href="{{route('releasesuser.index')}}">Minhas Cobranças</a></li>
        <li class="breadcrumb-item active" aria-current="page">Agendamentos</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="row">
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <div class="row">
            <div class="calendarapp-wrap">
                <div class="col-sm ">
                    <div id="calendar"></div>
                </div>
            </div>
        </section>                   
    </div>
@stop

@section('scripts')
@parent
    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>

    <!-- Fullcalendar JavaScript -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendors/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendors/fullcalendar/dist/locale-all.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />


    
    <script>
$(document).ready(function () {
   
var SITEURL = "{{ url('/') }}";
  
$.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
var calendar = $('#calendar').fullCalendar({
                    themeSystem: 'bootstrap4',
	                editable: true,
                    selectable: false,
                    selectHelper: false,
                    eventColor: '#378006',
                    eventLimit: true,
                    events: SITEURL + "/fullcalender",
                    displayEventTime: true,
                    locale: 'pt-br',
                    
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay,listMonth'
                    },
                    
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }
                    },
                    

                    
                    eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
  
                        $.ajax({
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                title: event.title,
                                start: start,
                                end: end,
                                id: event.id,
                                type: 'update'
                            },
                            type: "POST",
                            success: function (response) {
                                displayMessage("Novo agendamento feito com sucesso!");
                            },
                            eventClick: function(event) {
                                if (event.url) {
                                    window.open(event.url, "_parent");
                                    return false;
                                }
                            }

                        });
                        
                    
  }
 
                });
 
});
 
function displayMessage(message) {
    toastr.success(message, 'Feito');    
} 
  
</script>

@endsection