@section('title', 'Cobrança | Gestão de Clientes')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Acordos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Vizualização</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h4 class="hk-pg-title"><span class="fas fa-users"></span> Vizualização do Acordo de Divida da Franquia</h4>
</div>




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
                                        @if ($agreement->client->image != null)
                                            <div class="col-xl-1s">
                                                <img class="img-thumbnail shadow" src="{{ url('storage/'.$agreement->client->image) }}" alt="{{ $agreement->client->image }}" style="max-width: 200px;" data-holder-rendered="true">
                                            </div>
                                                @else
                                            <div class="col-xl-1s">
                                                <img class="img-thumbnail shadow" src="{{ url('assets/images/default_img.png') }}" alt="Sem Imagem" style="max-width: 200px;" data-holder-rendered="true">
                                            </div>
                                        @endif
                                        <br>
                                        <h6 class="mb-5">{{ $agreement->client->razao_social }} - {{ $agreement->client->state }}</h6>
                                        <address>
                                            <strong>Endereço :</strong> {{ $agreement->client->address }}, {{ $agreement->client->number }} - {{ $agreement->client->complement }}<strong> CEP :</strong> {{ $agreement->client->cep }}<br>
                                        </address>
                                    </div>
                                    <div class="col-md-5 mb-20">
                                        <br>
                                        <h4 class="mb-35 font-weight-600">{{ $agreement->client->id }} - {{ $agreement->client->name }} - {{ $agreement->client->state }}</h4>
                                        <br>
                                    <span class="badge badge-success"></span>
                                    <span class="d-block">Tipo de Venda : </span>
                                        
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <div class="invoice-to-wrap pb-20">
                                <div class="row">
                                    <div class="col-md-12 mb-30">
                                        <h6 class="mb-5">CONTRATO DE RENEGOCIAÇÃO DE DÍVIDA</h6>
                                        <p class="py-15 text-justify">Pelo presente instrumento, de um lado a Empresa :  {{ $agreement->client->name }},  Sob Responsabilidade de : {{ $agreement->partner->name}}, (estado civil), (Sócio), inscrito (a) no CPF sob o nº {{ $agreement->partner->cpf}}, residente e domiciliado (a) à {{$agreement->client->address}}, doravante denominado (a) DEVEDOR (a), e de outro lado (nome), (nacionalidade), (estado civil), (profissão), inscrito (a) no CPF sob o nº (informar) e no RG nº (informar), residente e domiciliado (a) à (endereço), doravante denominado (a) CREDOR (a), ajustam este contrato de renegociação de dívida pelas condições que seguem.</p>
                                        <p class="py-15 text-justify">Cláusula 1ª - O (a) DEVEDOR (a) declara que deve ao (à) CREDOR (a) a quantia atualizada e corrigida de R$ {{ number_format($agreement->agreements_amount, 2, ',','.') }} ({{$extenso->converter($agreement->agreements_amount)}}), em decorrência do(s) contrato de (informe a origem da dívida) firmado em (data do negócio que originou a dívida).</p>
                                        <p class="py-15 text-justify">Cláusula 2ª - A dívida será paga pelo (a) DEVEDOR (A) por meio de uma entrada de  R$ {{ number_format($agreement->inflow_amount, 2, ',','.') }} e o restante em {{ $agreement->installments }} parcelas mensais, iguais e sucessivas de R$ {{ number_format($agreement->parcel_amount, 2, ',','.') }} ({{$extenso->converter($agreement->parcel_amount)}}), com vencimento todo dia 10 de cada mês, ou dia útil seguinte, vencendo a primeira em (data) e a última em (data).</p>
                                        <p class="py-15 text-justify">Cláusula 3ª - As parcelas serão pagas mediante depósito na conta bancária do (a) CREDOR (a), junto ao Banco (informar) (número), agência (informar), conta corrente (informar).</p>
                                        <p class="py-15 text-justify">Cláusula 4ª - O atraso no pagamento de qualquer das parcelas implicará em multa de 5% (cinco por cento) sobre o valor inadimplido, juros de mora de 1% (um por cento) ao mês e correção monetária pelo INPC.</p>
                                        <p class="py-15 text-justify">Cláusula 5ª - Havendo atraso superior a 15 (quinze) dias no pagamento de qualquer das parcelas ocorrerá o vencimento antecipado das parcelas vincendas e poderá o (a) CREDOR (a) proceder a execução judicial da integralidade do débito, com os acréscimos da cláusula anterior, respondendo o (a) DEVEDOR (a) ainda pelos honorários advocatícios de 20% (vinte por cento) e custas processuais.</p>
                                        <p class="py-15 text-justify">Cláusula 6ª - Eventual aceitação do (a) CREDOR (a) em receber parcelas pagas intempestivamente, a seu critério, não importará em novação, mas mera liberalidade, permanecendo inalteradas as cláusulas deste contrato.</p>
                                        <address>
										</address>
                                    </div>
                                    <div class="col-md-5 mb-30">
                                        <br>
                                        </div>
                                </div>
                            </div>
                            <h5>Relação de Lançamentos em Aberto ao Acordo</h5>
                            <hr>
                            <div class="invoice-details">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-border mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="w-5">id</th>
                                                    <th class="w-30">Tipo</th>
                                                    <th>CNPJ</th>
                                                    <th>Vencimento</th>
                                                    <th>Valor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if($releases = $agreement->releasesAgreements)
                                                @foreach($releases as $release)
                                                <tr>
                                                    @if($release->release_id)
                                                        <td>{{$release->release_id}}</td>
                                                        <td>{{$release->release->type->name}}</td>
                                                        <td>{{$release->release->cnpj}}</td>
                                                        <td>{{$release->release->due_date}}</td>
                                                        <td>{{$release->release->amount}}</td>
                                                    @endif
                                                </tr>                                                    
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <ul class="invoice-terms-wrap font-14 list-ul">
                                <li>Declaram as partes, outrossim, que este instrumento tem validade de título executivo extrajudicial na forma do inciso III do artigo 784 do Código de Processo Civil.</li>
                                <li>E, por estarem justas e avençadas as partes, assinam o presente instrumento em 02 (duas) vias de igual teor, na presença das testemunhas abaixo.</li>
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