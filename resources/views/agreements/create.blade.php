@section('title', 'Cobrança | Gestão de Cobrança')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item active" aria-current="page">Lançamento de Acordo de Dívida </li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h4 class="hk-pg-title"><span class="fas fa-users"></span> Gerenciamento de Cobrança</h4>
</div>

<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">Lançamento</h5>
    <p class="mb-25">Preencha os Dados para fazer um novo lançamento de Cobrança de uma Franquia</p>
    <div class="row">
    @include('includes.alerts')
        <div class="col-sm">
            <form method="POST" enctype="multipart/form-data" action="{{ route('agreement.store', $client->id) }}">
            @csrf
            
                <input type="hidden" name="type_id" value="6">                    
                <input type="hidden" name="status_id" value="5">

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="lastName">Franquia</label>
                        <select class="form-control custom-select d-block w-100" id="client_id" name="client_id">
                            <option value="">Selecione...</option>
                            <option value="{{$client->id}}"
                                    @if( isset($client) && $client->id == $client->id )
                                        selected
                                    @endif
                                    >{{$client->name}}</option> 
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="lastName">Sócio</label>
                        <select class="form-control custom-select d-block w-100" id="partner_id" name="partner_id">
                            <option value="">Selecione...</option>
                            @foreach($partners as $partner)
                            <option value="{{$partner->partner->id}}"
                                    @if( isset($client) && $client->partner_id == $partner->id )
                                        selected
                                    @endif
                                    >{{$partner->partner->name}}</option> 
                            @endforeach
                        </select>
                    </div>
                    
                    @php
                        $totalfin = 0;
                        $totalnew = 0;
                    @endphp 

                    @foreach ($releases as $release)
                    <div style="display: none">{{$totalfin += $release->newAmount()}}</div>  
                    @endforeach

                    <div class="col-md-3 form-group">
                        <label for="lastName">Valor Devido</label>
                        <input class="form-control" id="agreements_amount" name="agreements_amount" value="{{ number_format($totalfin, 2, '.','')}}" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Entrada</label>
                        <input class="form-control" id="inflow" name="inflow" value="0" type="text">
                    </div>
                    <div class="col-md-2 form-group">
                        <label for="lastName">Parcelas</label>
                        <input class="form-control" id="installments" name="installments" type="number"  value="{{ old('installments') }}" type="text">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="lastName">Multa %</label>
                        <input class="form-control" id="test_1" name="test_1" value="2" type="text">
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="lastName">Juros Mês %</label>
                        <input class="form-control" id="test_2" name="test_2" value="1" type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lastName">Primeiro Vencimento</label>
                        <input class="form-control" id="due_date" name="due_date" value="{{ $date->format('Y-m-d') }}" type="date">
                    </div>                   
                    <div class="col-md-6 form-group">
                        <label for="lastName">Banco</label>
                        <select class="form-control custom-select d-block w-100" id="bank_id" name="bank_id">
                            <option value="">Selecione...</option>
                            @foreach($banks as $bank)
                            <option value="{{$bank->name}}" >
                                    {{$bank->name}}</option> 
                            @endforeach
                        </select>
                    </div>   
                </div>
                <hr>
                <table id="list_1" class="table table-hover w-100 display pb-30">
                                <thead >
                                    <tr>
                                        <th class="w-25">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                                <label class="custom-control-label" for="checkAll">Tipo de Cobrança</label>
                                            </div>
                                        </th>
                                        <th>Devedor</th>
                                        <th>Status</th>
                                        <th>Vencimento</th>
                                        <th>Valor</th>
                                        <th>Valor Devido</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($releases as $release)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="checkbox[]" data-id="{{$release->id}}"  value="{{$release->id}}" id="{{$release->id}}">
                                                <label class="custom-control-label" for="{{$release->id}}">{{$release->type->name}}</label>
                                            </div>
                                        </td>
                                        <td>@if($release->partner_id) <span class="badge badge-soft-success badge-pill">{{$release->partner->name}}</span> @else <span class="badge badge-danger badge-pill">Sem CPF Vinculado @endif</span></small></td>
                                        <td><span class="badge badge-{{$release->status->color}} badge-pill">{{$release->status->name}}</span></td>
                                        
                                        <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                        <td>R$ {{ number_format($release->amount, 2, ',','.') }}</td>
                                        <td>R$ {{ number_format($release->newAmount(), 2, ',','.') }}</td>                                        
                                    </tr>
                                    <div style="display: none">{{$total += $release->amount}}</div>
                                    <div style="display: none">{{$totalnew += $release->newAmount()}}</div>                                     
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right font-weight-600">Total :</th>
                                        <th class="text-left font-weight-600">R$ {{number_format($total, 2, ',','.')}}</th>
                                        <th class="text-left font-weight-600">R$ {{number_format($totalnew, 2, ',','.')}}</th>                                        
                                    </tr>
                                </tfoot>
                            </table>    
                <button class="btn btn-primary btn-sm" type="submit">Cadastrar</button>
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

    <script type="text/javascript">
        $(document).on('click', '#checkAll', function (){
            if (this.checked){
                $('.custom-control-input').each(function (){
                    this.checked = true;
                })
            } else {
                $('.custom-control-input').each(function (){
                    this.checked = false;
                })
            }
            if ($('.check-item:checked').length > 0){
                $('.dropdown-toggle').removeAttr('disabled')
            } else {
                $('.dropdown-toggle').attr('disabled', true)
            }
        })
    </script>
@endsection