@section('title', 'Cobrança | Gestão de Clientes')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clientes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gestão de Clientes</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h4 class="hk-pg-title"><span class="fas fa-users"></span> Gerenciamento de Clientes</h4>
</div>


<section class="hk-sec-wrapper">
    <div class="row mb-10">
        <div class="col-sm">
        <ul class="nav nav-pills nav-light bg-light pa-15 float-right " role="tablist">
            <li class="nav-item pr-10">
                <a href="{{route('client.create')}}" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-user-circle"></i>Novo</a>
            </li>
            <li class="nav-item pr-10">
            <a class="nav-link link-icon-top bg-light border border-light-20" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
			<i class="fas fa-search"></i>Busca</a>
            </li>
            <li class="nav-item">
                <a href="{{route('clients.index')}}" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-arrow-alt-circle-left"></i>Voltar</a>
            </li>
        </ul>
        </div>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
        <h5 class="hk-sec-title pr-10"><span class="fas fa-search"></span> Sistema de Busca de Clientes</h5>
            <div class="row">
                <div class="col-sm">
                <form method="POST" enctype="multipart/form-data" action="{{ route('client.search') }}">

                        @csrf
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="firstName">Unidade/Responsável</label>
                                <input class="form-control" name="name" value="{{ old('name') }}" type="text">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lastName">Cnpj/Insc. Estadual</label>
                                <input class="form-control" name="dados" value="{{ old('dados') }}" type="text">
                            </div>
                            <div class="col-md-3 mb-10">
                                <label for="country">Tipo de Venda</label>
                                <select class="form-control custom-select d-block w-100" id="sale_id" name="sale_id">
                                    <option value="">Selecione...</option>
                                    
                                </select>
                            </div>
                            <div class="col-md-3">
                            <label for="country">Status</label>
                                            <div class="input-group">
                                            <select class="form-control custom-select d-block w-100"  id="status_id" name="status_id">
                                    <option value="">Selecione...</option>
                                    
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
    <h5 class="hk-sec-title">Lista dos Sócios Cadastrados</h5>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($partners = $client->partnersClient)
                            @foreach($partners as $partner)
                                <tr>
                                    <td>{{$partner->partner->name}}</td>
                                    <td>{{$partner->partner->cpf}}</td>
                                    <td>{{$partner->partner->email}}</td>
                                    <td>{{$partner->partner->phone}}</td>
                                    <td><a href="{{route('client.edit', $partner->id)}}" class="btn btn-warning btn-icon-style-4 btn-sm"><i class="far fa-edit"></i></a>
                                    <a href="{{route('client.show', $partner->id)}}" class="btn btn-danger btn-icon-style-4 btn-sm"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>                        
                    </table>                    
                </div>
            </div>           
        </div>
    </div>
</section>
@stop

@section('scripts')
@parent
    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>
@endsection