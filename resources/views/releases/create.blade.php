@section('title', 'Cobrança | Gestão de Cobrança')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lançamento de Cobrança</li>
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
                <a href="#" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-user-circle"></i>Novo</a>
            </li>
            <li class="nav-item">
                <a href="{{route('releases.index')}}" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-arrow-alt-circle-left"></i>Voltar</a>
            </li>
        </ul>
        </div>
    </div>
</section>


<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">Lançamento</h5>
    <p class="mb-25">Preencha os Dados para fazer um novo lançamento de Cobrança de uma Franquia</p>
    <div class="row">
    @include('includes.alerts')
        <div class="col-sm">
            <form method="POST" enctype="multipart/form-data" action="{{ route('release.store') }}">
            @csrf
                <div class="row">
                <div class="col-md-6 form-group">
                        <label for="lastName">Franquia</label>
                        <select class="form-control custom-select d-block w-100" id="client_id" name="client_id">
                            <option value="">Selecione...</option>
                            @foreach($clients as $client)
                            <option value="{{$client->id}}"
                                    @if( isset($client) && $client->client_id == $client->id )
                                        selected
                                    @endif
                                    >{{$client->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="lastName">Status</label>
                        <select class="form-control custom-select d-block w-100" id="status_id" name="status_id">
                            <option value="">Selecione...</option>
                            @foreach($statuses as $status)
                            <option value="{{$status->id}}"
                                    @if( isset($status) && $status->client_id == $status->id )
                                        selected
                                    @endif
                                    >{{$status->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="col-md-4 form-group">
                        <label for="lastName">Designado a :</label>
                        <select class="form-control custom-select d-block w-100" id="assigned_to" name="assigned_to">
                            <option value="">Selecione...</option>
                            @foreach($users as $user)
                            <option value="{{$user->id}}"
                                    @if( isset($user) && $user->assigned_to == $user->id )
                                        selected
                                    @endif
                                    >{{$user->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Mês Devedor</label>
                        <select class="form-control custom-select d-block w-100" id="month_id" name="month_id">
                            <option value="">Selecione...</option>
                            @foreach($months as $month)
                            <option value="{{$month->id}}"
                                    @if( isset($month) && $month->month_id == $month->id )
                                        selected
                                    @endif
                                    >{{$month->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Valor</label>
                        <input class="form-control" id="amount" name="amount" value="{{ old('amount') }}" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Data Vencimento</label>
                        <input class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}" type="date">
                    </div>
                </div>                
                <button class="btn btn-primary" type="submit">Cadastrar Lançamento</button>
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