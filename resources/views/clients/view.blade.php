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
                <a href="#" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-arrow-alt-circle-left"></i>Voltar</a>
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
                                    @foreach($typeSales as $type)
                                    <option value="{{$type->id}}"
                                            @if( isset($client) && $client->sale_id == $type->id )
                                                selected
                                            @endif
                                            >{{$type->name}}</option> 
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
                <!-- Title -->
                <div class="hk-pg-header mb-10">
					<div>
						<h4 class="hk-pg-title"><span class="pg-title-icon"><i class="ion ion-md-bookmarks"></i></span>Invoice</h4>
                    </div>
					<div class="d-flex">
                        <a href="#" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="printer"></i></span></a>
                        <a href="#" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="download"></i></span></a>
                        <button class="btn btn-primary btn-sm">Create New</button>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            <div class="invoice-from-wrap">
                                <div class="row">
                                    <div class="col-md-7 mb-20">
                                        @if ($client->image != null)
                                            <div class="col-xl-1s">
                                                <img class="img-thumbnail shadow" src="{{ url('storage/'.$client->image) }}" alt="{{ $client->image }}" style="max-width: 200px;" data-holder-rendered="true">
                                            </div>
                                                @else
                                            <div class="col-xl-1s">
                                                <img class="img-thumbnail shadow" src="{{ url('assets/images/default_img.png') }}" alt="Sem Imagem" style="max-width: 200px;" data-holder-rendered="true">
                                            </div>
                                        @endif
                                        <br>
                                        <h6 class="mb-5">{{ $client->razao_social }} - {{ $client->state }}</h6>
                                        <address>
                                        <strong>Endereço :</strong> {{ $client->address }}, {{ $client->number }} - {{ $client->complement }}<strong> CEP :</strong> {{ $client->cep }}<br>
                                        <strong>Região :</strong> {{ $client->regiao }}<br>
                                        <strong>Telefone :</strong> {{ $client->phone01 }} - {{ $client->phone02 }}<br>
                                        <strong>CNPJ :</strong> {{ $client->cnpj }} <strong>Inscrição Estadual :</strong> {{ $client->insc }}<br>
                                        <strong>{{ $client->country }} - {{ $client->city }} - {{ $client->state }}</strong>
                                    </address>
                                    </div>
                                    <div class="col-md-5 mb-20">
                                        <br>
                                        <h4 class="mb-35 font-weight-600">{{ $client->id }} - {{ $client->name }} - {{ $client->state }}</h4>
                                        <br>
                                        <span class="d-block">Status do Cliente : <span class="text-dark">@if($client->status_id)
                                    <span class="badge badge-{{$client->status->color}}">{{$client->status->name}}</span>
                                    @endif</span></span>
                                    <span class="d-block">Tipo de Venda : <span class="text-dark">@if($client->sale_id){{$client->sales->name}}
                                    @endif</span></span>
                                        <span class="d-block">CRO : <span class="pl-10 text-dark">{{ $client->cro }}</span></span>
                                        <span class="d-block">Cadeiras / Capacidade #<span class="pl-10 text-dark">{{ $client->cadeiras_ativas }} de {{ $client->cadeiras_capacidade }}</span></span>
                                        <span class="d-block">Supervisor : <span class="pl-10 text-dark">{{ $client->supervisor }}</span></span>
                                        
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <div class="invoice-to-wrap pb-20">
                                <div class="row">
                                    <div class="col-md-7 mb-30">
                                        <span class="d-block text-uppercase mb-5 font-13">Site</span>
                                        <h6 class="mb-5">{{ $client->site }}</h6>
                                        <address>
												<span class="d-block">Email : {{ $client->email }}</span>
												<span class="d-block">Email Site: {{ $client->email_site }}</span>
												<span class="d-block">Whatsapp : {{ $client->whatsapp }}</span>
												<span class="d-block">Data Inicial de Contrato : {{$client->date_initial->format('d/m/Y')}}</span>
											</address>
                                    </div>
                                    <div class="col-md-5 mb-30">
                                        <br>
                                        <span class="d-block text-uppercase mb-5 font-13">Responsável Técnico</span>
                                        <span class="d-block">{{ $client->responsavel_tecnico }}</span>
                                        <span class="d-block">{{ $client->responsavel_tecnico_cro }}</span>
                                        <span class="d-block text-uppercase mt-20 mb-5 font-13">Cadastrado por : <span class="pl-10 text-dark"> @if($client->user_id)
                                                {{$client->user->name}} @endif</span></span>
                                        <span class="d-block text-dark font-18 font-weight-600">Média Faturamento : $22,010</span>
                                    </div>
                                </div>
                            </div>
                            <h5>Sócios</h5>
                            <hr>
                            <div class="invoice-details">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-border mb-0">
                                            <thead>
                                                <tr><th class="w-5">id</th>
                                                    <th class="w-30">Nome</th>
                                                    <th >CPF</th>
                                                    <th>Email</th>
                                                    <th>Telefone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if($partners = $client->partnersClient)
                                                @foreach($partners as $partner)
                                                <tr>
                                                @if($partner->partner_id)
                                                    <td>{{$partner->partner->id}}</td>
                                                    <td>{{$partner->partner->name}}</td>
                                                    <td>{{$partner->partner->cpf}}</td>
                                                    <td>{{$partner->partner->email}}</td>
                                                    <td>{{$partner->partner->phone}}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <ul class="invoice-terms-wrap font-14 list-ul">
                                <li>A buyer must settle his or her account within 30 days of the date listed on the invoice.</li>
                                <li>The conditions under which a seller will complete a sale. Typically, these terms specify the period allowed to a buyer to pay off the amount due.</li>
                            </ul>
                        </section>
                    </div>
                </div>
                <!-- /Row -->
</section>

@stop

@section('scripts')
@parent
    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>
@endsection