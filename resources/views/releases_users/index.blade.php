@section('title', 'Cobrança | Minhas Cobranças')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item active" aria-current="page">Minhas Cobranças</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h5 class="hk-pg-title"><span class="fas fa-users"></span> Gerenciamento de Cobranças</h5>
</div>

@include('includes.alerts')

<section class="hk-sec-wrapper">
    <h6 class="hk-sec-title">Lista de Clientes a serem cobrados</h6>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Franquia</th>    
                                <th><span class="far fa-calendar-alt"></span></th>                             
                                <th>CNPJ</th>
                                <th>Valor</th>
                                <th>Ultima Cobrança</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            @foreach($clients as $client)
                                @if($client->releaseswithuser->count() > 0)
                                <tr>
                                    <td>{{$client->name}}</td>
                                    <td>
                                        @if($client->charges->count() > 0) 
                                        <a href="{{route('schedules.index')}}" class="btn btn-success btn-icon-style-4 btn-sm"><i class="far fa-calendar-check"></i></a> 
                                        @else 
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#newSchedule_{{ $client->id }}"><i class="far fa-calendar-plus"></i> </button>
                                        @endif
                                    </td>
                                    <td>{{$client->cnpj}}</td>
                                    <td>R$ {{number_format($client->releaseswithuser->sum('amount'), 2, ',','.')}}</td>
                                    <td></td>
                                    <td>
                                    <a href="{{route('releasesuser.list', $client->id)}}" class="btn btn-primary btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endif
                                @include('modals.new_schedule')
                            @endforeach                        
                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>
    </div>
</section>
@if (isset($dataForm))
    {!! $releases->appends($dataForm)->links("pagination::bootstrap-4") !!}
@else
    {!! $releases->links("pagination::bootstrap-4") !!}   
@endif
@stop

@section('scripts')
@parent
    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>
@endsection