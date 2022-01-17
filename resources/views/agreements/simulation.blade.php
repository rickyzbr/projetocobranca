@section('title', 'Cobrança | Gestão de Cobrança')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lançamento de Acordo de Dívida</li>
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
            <form method="POST" enctype="multipart/form-data" action="{{ route('agreement.store') }}">
            @csrf
            @php
                $data = 0;
            @endphp  
                <div class="row">
                @for($i=1; $i <= $parcelas; $i++)
                    <div class="col-md-2 form-group">
                        <label for="lastName">Lançamento</label>
                        <input class="form-control" id="agreements_amount" name="agreements_amount" value="Acordo Dívida" type="text">
                    </div>
                    <input type="hidden" name="type_id" value="6">
                    
                    <input type="hidden" name="status_id" value="6">
                    <input type="hidden" name="client_id" value="{{$client_id}}">
                    <input type="hidden" name="partner_id" value="{{$partner_id}}">
                    <input type="hidden" name="parcelas" value="{{$parcelas}}">
                    

                    <div class="col-md-1 form-group">
                        <label for="lastName">Parcela</label>
                        <input class="form-control" id="portion" name="portion" value="{{$i}}" type="text">
                    </div>
                    
                    <div class="col-md-2 form-group">
                        <label for="lastName">Valor da Parcela</label>
                        <input class="form-control" id="amount" name="amount" value="{{number_format($valorparcela, 2, ',','.')}}" type="text">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="lastName">Multa %</label>
                        <input class="form-control" value="2" type="text">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="lastName">Juros Mês %</label>
                        <input class="form-control"  value="1" type="text">
                    </div>
                    <input type="hidden" name="issue_date" value="{{$date}}">

                    <div class="col-md-3 form-group">
                        <label for="lastName">Data Vencimento</label>
                        @php
                            $dates =  $i == 1 ? $due_date->format('d-m-Y') : $due_date->addMonth()->format('d-m-Y')
                        @endphp
                        <input class="form-control" id="due_date" name="due_date" value="{{ $dates }}"  >
                    </div>
                    @endfor
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

<script>
$(document).ready(function(){

    $("#installments").blur(function(){

    //declaração das variáveis
    var amount = 0, installments = 0, parcel_amunt = 0;

    //pegando as notas dos campos inputs
    amount2 = parseFloat($("input[name=agreements_amount]").text().replace(/[^d.,]/g,""));
    amount = parseFloat($("input[name=agreements_amount]").val());
    installments = parseFloat($("input[name=installments]").val());
    //formula para cálculo de média
    parcel_amunt = (amount / installments);
    

    //mostra o resultado no input name=media
    $("input[name=parcel_amount]").val(parcel_amunt);

    return false;
    });
});
</script>
@endsection