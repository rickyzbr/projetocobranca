@section('title', 'Cobrança | Gestão de Cobranças')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clientes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gestão de Cobranças</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h4 class="hk-pg-title"><span class="fas fa-users"></span> Gerenciamento de Cobrança</h4>
</div>


<section class="hk-sec-wrapper">
    <div class="row mb-10">
        <div class="col-sm">
        <ul class="nav nav-pills nav-light bg-light pa-15 float-right " role="tablist">
            <li class="nav-item pr-10">
                <a href="{{route('release.create')}}" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-plus-square"></i>Novo</a>
            </li>
            <li class="nav-item pr-10">
                <a href="{{route('release.create')}}" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-chart-bar"></i>Análise</a>
            </li>
            <li class="nav-item pr-10">
                <a href="{{route('release.create')}}" class="nav-link link-icon-top bg-light border border-light-20"><i class="fas fa-upload"></i>Import</a>
            </li>
            <li class="nav-item pr-10">
            <a class="nav-link link-icon-top bg-light border border-light-20" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
			<i class="fas fa-search"></i>Busca</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-arrow-alt-circle-left"></i>Voltar</a>
            </li>
        </ul>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
        <h5 class="hk-sec-title pr-10"><span class="fas fa-search"></span> Sistema de Busca de Lançamentos</h5>
            <div class="row">
                <div class="col-sm">
                <form method="POST" enctype="multipart/form-data" action="{{ route('releases.search') }}">

                        @csrf
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="firstName">Franquia</label>
                                <input class="form-control" name="name" value="{{ old('name') }}" type="text">
                            </div>
                            <div class="col-md-3 mb-10">
                                <label for="country">Mês</label>
                                <select class="form-control custom-select d-block w-100" id="sale_id" name="sale_id">
                                    <option value="">Selecione...</option>
                                    @foreach($months as $month)
                                    <option value="{{$month->id}}"
                                            @if( isset($release) && $release->month_id == $month->id )
                                                selected
                                            @endif
                                            >{{$month->name}}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                            <label for="country">Status</label>
                                            <div class="input-group">
                                            <select class="form-control custom-select d-block w-100"  id="status_id" name="status_id">
                                    <option value="">Selecione...</option>
                                    @foreach($statuses as $status)
                                    <option value="{{$status->id}}"
                                            @if( isset($client) && $client->status_id == $status->id )
                                                selected
                                            @endif
                                            >{{$status->name}}</option> 
                                    @endforeach
                                </select>
                                                <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Busca</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</section>

@include('includes.alerts')

<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">Lançamentos de valores em aberto</h5>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="w-30">Franquia</th>
                                <th>Objeto</th>
                                <th>Status</th>
                                <th>Vencimento</th>
                                <th>Valor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($releases as $release)
                            <tr>
                                <td>{{$release->client->name}} <span class="badge badge-success badge-pill"></span></td>
                                <td>{{$release->type->name}} <span class="badge badge-success badge-pill"></span></td>
                                <td><span class="badge badge-{{$release->status->color}} badge-pill">{{$release->status->name}}</span></td>
                                <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                <td>{{ number_format($release->amount, 2, ',','.') }}</td>
                                <td>
                                <a href="{{route('release.show', $release->id)}}" class="btn btn-smoke btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                <a href="{{route('release.edit', $release->id)}}" class="btn btn-warning btn-icon-style-4 btn-sm"><i class="far fa-edit"></i></a>
                                <a href="{{route('release.show', $release->id)}}" class="btn btn-danger btn-icon-style-4 btn-sm"><i class="far fa-trash-alt"></i></a>
                                  
                                </td>
                            </tr>
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