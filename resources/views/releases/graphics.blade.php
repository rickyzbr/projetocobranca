@section('title', 'Cobrança | Gestão de Cobranças')

@extends ('layouts.app')

@section('content_header')
<ul class="nav nav-tabs nav-sm nav-light mb-25" role="tablist">
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left active" data-toggle="tab" href="#tabs-1" role="tab"><i class="zmdi zmdi-apps"></i>Dashboard</a>
    </li>
    
    <li class="nav-item mb-5">
        <a class="nav-link link-icon-left"  href="#" role="tab"><i class="zmdi zmdi-trending-up"></i>Graficos de Cobrança</a>
    </li>
</ul>
@stop
<!-- end row -->

@section('content')

<div class="col-md-12">
{!! $chart->html() !!}

    {!! Charts::scripts() !!}

{!! $chart->script() !!}

    <div class="card">
        <div class="card-header card-header-action">
            <h6>Referral Stats</h6>
            <div class="d-flex align-items-center card-action-wrap">
                <a href="#" class="inline-block refresh mr-15">
                    <i class="ion ion-md-arrow-down"></i>
                </a>
                <a href="#" class="inline-block full-screen">
                    <i class="ion ion-md-expand"></i>
                </a>
            </div>
        </div>
        
    </div>
</div>

@include('includes.alerts')
@stop

@section('scripts')
@parent

<script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
<script src="{{ asset('dist/js/peity-data.js') }}"></script>
@endsection