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
        <ul class="nav nav-pills nav-light bg-light pa-15 float-right" role="tablist">            
            <li class="nav-item">
                <a href="{{ url()->previous() }}" class="nav-link link-icon-top bg-light border border-light-20"><i class="far fa-arrow-alt-circle-left"></i>Voltar</a>
            </li>
        </ul>
        </div>
    </div>
    
</section>

@include('includes.alerts')

<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">Lista de Lançamentos em Aberto</h5>
    <p class="mb-25">Você Está vendo os Lançamentos da franquia de  : {{$client->name}}</p>
    <div class="alert alert-warning" role="alert">
        <p>Após Vencimento Cobrar Multa de 2%</p>
        <p>Multa de 1% ao Mês</p>
    </div>
    <div class="row mb-10">
        <div class="col-sm">
        <nav class="navbar navbar-expand-xl navbar-light bg-light navbar-demo">
            <ul class="nav nav-pills nav-light bg-light pa-15 mr-auto" role="tablist">
                <ul class="nav nav-tabs nav-tabs-custom " role="tablist">
                    @foreach ($statuses as $status)
                        @if($status->id != 3)
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_{{$status->id}}" role="tab">{{$status->name}}</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab_{{$status->id}}" role="tab">{{$status->name}}</a>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </ul>
            <span class="navbar-text">
            </span>
        </nav>
            <!-- Tab panes -->
            <div class="tab-content">
                @foreach ($statuses as $status)
                    @if($status->id != 3)
                        <div class="tab-pane p-3" id="tab_{{$status->id}}" role="tabpanel">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tipo de Cobrança</th>                                
                                                <th>Vencimento</th>
                                                <th>Valor</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>                
                                        @php
                                            $total_pedido = 0;
                                        @endphp       
                                            @if($releases = $client->releases)
                                                @foreach($releases as $release)
                                                    @if($release->status_id != $status->id)                                                
                                                        @else
                                                        <tr>
                                                            <td>{{$release->type->name}}</td>
                                                            <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                                            <td>R$ {{ number_format($release->amount, 2, ',','.') }}</td>
                                                            <td><span class="badge badge-{{$release->status->color}} badge-pill">{{$release->status->name}}</span></td>
                                                            @php
                                                                $total_pedido += $release->amount;
                                                            @endphp
                                                            <td>
                                                            <a href="{{route('release.show', $release->id)}}" class="btn btn-smoke btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                                            <a href="{{route('client.edit', $release->id)}}" class="btn btn-warning btn-icon-style-4 btn-sm"><i class="far fa-edit"></i></a>
                                                            </td>
                                                        </tr>                            
                                                    @endif
                                                @endforeach
                                                <tfoot class="border-bottom border-1">
                                                    <tr>
                                                        <th><a href="{{route('agreement.create', $client->id)}}" class="btn btn-primary btn-wth-icon btn-sm"> <span class="icon-label"><span class="feather-icon"><i data-feather="credit-card"></i></span> </span><span class="btn-text">Gerar Parcelamento</span></a></th>
                                                        <th class="text-right font-weight-600">Total : </th>
                                                        @if($release->status_id != $status->id)  
                                                        <th class="text-left font-weight-600">Sem Valor</th>
                                                        @else
                                                        <th class="text-left font-weight-600">R$ {{number_format($total_pedido, 2, ',','.')}}</th>                                                        
                                                        @endif
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot> 
                                            @endif                       
                                        </tbody>     
                                    </table>  
                                </div>
                            </div>
                        </div>
                        @if($status->id != 4)
                        <div class="tab-pane p-3" id="tab_{{$status->id}}" role="tabpanel">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tipo de Cobrança</th>                                
                                                <th>Vencimento</th>
                                                <th>Valor</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>                
                                        @php
                                            $total_pedido = 0;
                                        @endphp       
                                            @if($releases = $client->releases)
                                                @foreach($releases as $release)
                                                    @if($release->status_id != $status->id)                                                
                                                        @else
                                                        <tr>
                                                            <td>{{$release->type->name}}</td>
                                                            <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                                            <td>R$ {{ number_format($release->amount, 2, ',','.') }}</td>
                                                            <td><span class="badge badge-{{$release->status->color}} badge-pill">{{$release->status->name}}</span></td>
                                                            @php
                                                                $total_pedido += $release->amount;
                                                            @endphp
                                                            <td>
                                                            <a href="{{route('release.show', $release->id)}}" class="btn btn-smoke btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                                            <a href="{{route('client.edit', $release->id)}}" class="btn btn-warning btn-icon-style-4 btn-sm"><i class="far fa-edit"></i></a>
                                                            </td>
                                                        </tr>                            
                                                    @endif
                                                @endforeach
                                                <tfoot class="border-bottom border-1">
                                                    <tr>
                                                        <th><a href="{{route('agreement.create', $client->id)}}" class="btn btn-primary btn-wth-icon btn-sm"> <span class="icon-label"><span class="feather-icon"><i data-feather="credit-card"></i></span> </span><span class="btn-text">Gerar Parcelamento</span></a></th>
                                                        <th class="text-right font-weight-600">Total : </th>
                                                        @if($release->status_id != $status->id)  
                                                        <th class="text-left font-weight-600">Sem Valor</th>
                                                        @else
                                                        <th class="text-left font-weight-600">R$ {{number_format($total_pedido, 2, ',','.')}}</th>                                                        
                                                        @endif
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot> 
                                            @endif                       
                                        </tbody>     
                                    </table>  
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="tab-pane active p-3" id="tab_{{$status->id}}" role="tabpanel">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                
                                <form method="POST" action="" id="MyForm">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                                        <label class="custom-control-label" for="checkAll">Tipo de Cobrança</label>
                                                    </div>
                                                </th>                                
                                                <th>Vencimento</th>
                                                <th>Valor</th>
                                                <th>Correção</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>      
                                        <div style="display: none">
                                            {{ $total = 0 }}
                                            {{ $totalnew = 0 }}
                                        </div>               
                                                @foreach($releases as $release)
                                                    @if($release->status_id != $status->id)                                                
                                                        @else                                                       
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input" name="checkbox[]" data-id="{{$release->id}}"  value="{{$release->id}}">
                                                                    <input type="hidden" name="amount" value="{{ ($release->amount * 0.02) + $release->amount + ($mytime->diffInMonths($release->due_date) * $release->amount * 0.01) }}">
                                                                    <label class="custom-control-label" for="{{$release->id}}">{{$release->id}} - {{$release->type->name}}</label>
                                                                </div> 
                                                            </td>
                                                            <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                                            <td>R$ {{ number_format($release->amount, 2, ',','.') }}</td>
                                                            <td>
                                                                R$ {{ number_format($release->newAmount(), 2, ',','.') }}</td>
                                                            <td>
                                                                
                                                            </td>
                                                            <div style="display: none">{{$total += $release->amount}}</div>
                                                            <div style="display: none">{{$totalnew += $release->newAmount()}}</div>
                                                            <td>
                                                            <a href="{{route('release.show', $release->id)}}" class="btn btn-smoke btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                                            <a href="{{route('client.edit', $release->id)}}" class="btn btn-warning btn-icon-style-4 btn-sm"><i class="far fa-edit"></i></a>
                                                            </td>
                                                        </tr> 
                                                                                  
                                                    @endif
                                                @endforeach
                                                <tfoot class="border-bottom border-1">
                                                    <tr>
                                                        <th colspan="2" class="text-right font-weight-600">total : </th>
                                                        @if($release->status_id != $status->id)
                                                        <th class="text-left font-weight-600 ">Sem Valor</th>
                                                        @else
                                                        <th class="text-left font-weight-600">R$ {{number_format($total, 2, ',','.')}}</th>
                                                        <th class="text-left font-weight-600">R$ {{number_format($totalnew, 2, ',','.')}}</th>
                                                        @endif
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </tfoot>                                              
                                            </tbody>     
                                        </table>  
                                    </form>
                                </div>
                            </div>
                        </div>      
                        </form>             
                    @endif
                @endforeach
            </div>                       
        </div>
    </div>
</section>
@stop

@section('scripts')
@parent
    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>

<script type="text/javascript">

        function submitForm(url, status){
            
            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#MyForm').serialize() + '&status=' + status,
                
                success: function (data) {     
                    if (data.success) {
                        $.toast({
                            heading: 'Feito !',
                            text: "Cadastros Selecionados foram Alterados Com Sucesso !",
                            position: 'top-right',
                            loaderBg:'#00acf0',
                            class: 'jq-toast-primary',
                            hideAfter: 3000, 
                            stack: 2000,
                            showHideTransition: 'fade'                                                       
                        });
                        location.reload(); 
                    }
                }
            })
        }

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
            if ($('.custom-control-input:checked').length > 0){
                $('.dropdown-toggle').removeAttr('disabled')
            } else {
                $('.dropdown-toggle').attr('disabled', true)
            }
        })

        $(document).on('click', '.custom-control-input', function (){
            if ($('.custom-control-input').length === $('.custom-control-input:checked').length) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }

            if ($('.custom-control-input:checked').length > 0){
                $('.dropdown-toggle').removeAttr('disabled')
            } else {
                $('.dropdown-toggle').attr('disabled', true)
            }
        })   
    </script>
@endsection