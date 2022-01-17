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
    
</section>

@include('includes.alerts')

<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">Lista dos Clientes Cadastrados</h5>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Cargo</th>
                                <th>Telefone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($contacts = $client->contactsClient)
                            @foreach($contacts as $contact)
                            <tr>
                                <td>{{$contact->name}}</td>
                                <td>{{$contact->phone01}}</td>
                                <td>@if($contact->cargo_id)
                                {{$client->cargo->name}}</span>
                                    @endif</td>
                                <td><a href="{{route('client.edit', $contact->id)}}" class="btn btn-warning btn-icon-style-4 btn-sm"><i class="far fa-edit"></i></a>
                                <a href="{{route('client.show', $contact->id)}}" class="btn btn-danger btn-icon-style-4 btn-sm"><i class="far fa-trash-alt"></i></a>
                                  
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