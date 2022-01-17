@section('title', 'Cobrança | Gestão de Clientes')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clientes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cadastro de Clientes</li>
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
            <li class="nav-item">
                <a href="{{route('clients.index')}}" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-arrow-alt-circle-left"></i>Voltar</a>
            </li>
        </ul>
        </div>
    </div>
</section>

<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">Cadastro</h5>
    <p class="mb-25">Preencha os Dados para cadastrar uma nova franquia</p>
    <div class="row">
    @include('includes.alerts')
        <div class="col-sm">
        <form method="POST" enctype="multipart/form-data" action="{{ route('client.update', $client->id) }}">
        @csrf
                    @method('PUT')
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="firstName">Unidade</label>
                        <input class="form-control" id="name" name="name" value="{{ $client->name }}"   type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Supervisor</label>
                        <input class="form-control" id="supervisor" name="supervisor" value="{{ $client->supervisor }}" type="text">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="lastName">Status</label>
                        <select class="form-control custom-select d-block w-100" id="status_id" name="status_id">
                            <option value="">Selecione...</option>
                            @foreach($statuses as $status)
                            <option value="{{$status->id}}"
                                    @if( isset($client) && $client->status_id == $status->id )
                                        selected
                                    @endif
                                    >{{$status->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Tipo de Venda</label>
                        <select class="form-control custom-select d-block w-100" id="sale_id" name="sale_id">
                            <option value="">Selecione...</option>
                            @foreach($typeSales as $type)
                            <option value="{{$status->id}}"
                                    @if( isset($client) && $client->sale_id == $type->id )
                                        selected
                                    @endif
                                    >{{$type->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Razão Social</label>
                        <input class="form-control" id="razao_social" name="razao_social" value="{{ $client->razao_social }}" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">CNPJ</label>
                        <input class="form-control" id="cnpj" name="cnpj" value="{{ $client->cnpj }}" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Iscrição Estadual</label>
                        <input class="form-control" id="insc" name="insc" value="{{ $client->insc }}" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">CRO</label>
                        <input class="form-control" id="cro" name="cro" value="{{ $client->cro }}" type="text">
                    </div>
                    <div class="col-md-5 form-group">
                        <label for="lastName">Responsável CRO</label>
                        <input class="form-control" id="responsavel_tecnico" name="responsavel_tecnico" value="{{ $client->responsavel_tecnico }}" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">CRO do Responsavel</label>
                        <input class="form-control" id="responsavel_tecnico_cro" name="responsavel_tecnico_cro" value="{{ $client->responsavel_tecnico_cro }}" type="text">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="lastName">Cadeiras Ativas</label>
                        <input class="form-control" id="cadeiras_ativas" name="cadeiras_ativas" value="{{ $client->cadeiras_ativas }}" type="text">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="lastName">Cadeiras Capacidade</label>
                        <input class="form-control" id="cadeiras_capacidade" name="cadeiras_capacidade" value="{{ $client->cadeiras_capacidade }}" type="text">
                    </div>
                </div>
                <hr>
                <h6 class="form-group">Endereço do Cliente</h6>
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label for="lastName">CEP</label>
                        <input class="form-control" id="cep" name="cep" placeholder="" value="{{ $client->cep }}" type="text">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="lastName">Endereço</label>
                        <input class="form-control" id="address" name="address" value="{{ $client->address }}" placeholder="" value="" type="text">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="lastName">Numero</label>
                        <input class="form-control" id="number" name="number" placeholder="" value="{{ $client->number }}" type="text">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="lastName">Complemento</label>
                        <input class="form-control" id="complement" name="complement"  value="{{ $client->complement }}" type="text">
                    </div> 
                    <div class="col-md-3 form-group">
                        <label for="Bairro">Bairro</label>
                        <input class="form-control" id="bairro" name="bairro" placeholder="" value="{{ $client->bairro }}" type="text">
                    </div>                                    
                    <div class="col-md-2 form-group">
                        <label for="Pais">País</label>
                        <input class="form-control" id="country" name="country" placeholder="Brasil" value="Brasil" type="text">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="Cidade">Cidade</label>
                        <input class="form-control" id="city" name="city" value="{{ $client->city }}" type="text">
                    </div>
                    <div class="col-md-1 form-group">
                        <label for="Estado">Estado</label>
                        <input class="form-control" id="state" name="state" placeholder="" value="{{ $client->state }}" type="text">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="Populacao">População</label>
                        <input class="form-control" id="populacao" name="populacao"  value="{{ $client->populacao }}" type="text">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="lastName">Região</label>
                        <input class="form-control" id="regiao" name="regiao"  value="{{ $client->regiao }}" type="text">
                    </div>
                    <div class="col-md-10 form-group">
                        <label for="lastName">Googgle Maps</label>
                        <input class="form-control" id="google_maps" name="google_maps"  value="{{ $client->google_maps }}" type="text">
                    </div>
                </div>
                <hr>
                <h6 class="form-group">Formas de Contato</h6>
                <div class="row">
                    <div class="col-md-2 form-group">
                        <label for="lastName">Telefone 01</label>
                        <input class="form-control" id="phone01" name="phone01"  value="{{ $client->phone01 }}" type="text">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="lastName">Telefone 02</label>
                        <input class="form-control" id="phone02" name="phone02" value="{{ $client->phone02 }}" type="text">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="lastName">Whatsapp</label>
                        <input class="form-control" id="whatsapp" name="whatsapp"  value="{{ $client->whatsapp }}" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Site</label>
                        <input class="form-control" id="site" name="site" value="{{ $client->site }}" type="text">
                    </div>
                    <div class="col-md-6 form-group">
                    <label for="username">Email Site</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input class="form-control" id="email_site" name="email_site" value="{{ $client->email_site }}" type="text">
                    </div>
                    </div>
                    <div class="col-md-6 form-group">
                    <label for="username">Email Principal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input class="form-control" id="email" name="email" value="{{ $client->email }}" type="text">
                    </div>
                </div>
                    </div>
                <hr>
                <h6 class="form-group">Informações Complementares ( Datas )</h6>
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="lastName">Data Inicial</label>
                        <input class="form-control" id="date_initial" name="date_initial" value="{{ $client->date_initial }}" type="date">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Data Final</label>
                        <input class="form-control" id="date_end" name="date_end" value="{{ $client->date_end }}" type="date">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Data Inauguração</label>
                        <input class="form-control" id="date_open" name="date_open" value="{{ $client->date_open }}" type="date">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Motivo do Encerramento</label>
                        <select class="form-control custom-select d-block w-100" id="termination_id" name="termination_id">
                            <option value="">Selecione...</option>
                            @foreach($typeSales as $type)
                            <option value="{{$status->id}}"
                                    @if( isset($client) && $client->termination_id == $type->id )
                                        selected
                                    @endif
                                    >{{$type->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <button class="btn btn-primary" type="submit">Cadastrar Cliente</button>
            </form>
        </div>
    </div>
                        </section>
@stop

@section('scripts')
@parent
    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>

    <!-- Daterangepicker JavaScript -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('dist/js/daterangepicker-data.js') }}"></script>

    <script type="text/javascript" >

$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#adress").val("");
        $("#bairro").val("");
        $("#city").val("");
        $("#state").val("");
        $("#country").val("");
        $("#ibge").val("");
    }
    
    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#address").val("...");
                $("#bairro").val("...");
                $("#city").val("...");
                $("#state").val("...");
                $("#country").val("...");
                $("#ibge").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#address").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#city").val(dados.localidade);
                        $("#state").val(dados.uf);
                        $("#country").val(dados.pais);
                        $("#ibge").val(dados.ibge);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

</script>
@endsection