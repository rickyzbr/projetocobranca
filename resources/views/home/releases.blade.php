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
    <div class="row mb-20">
        <div class="col-sm">
            <ul class="nav nav-tabs nav-light bg-light pa-15" role="tablist">
                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
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
                                        <div style="display: none">
                                            {{ $total2 = 0 }}
                                        </div>        
                                            @if($releases = $client->releases)
                                                @foreach($releases as $release)
                                                    @if($release->status_id != $status->id)                                                
                                                        @else
                                                        <tr>
                                                            <td>{{$release->type_id}} - {{$release->type->name}}</td>
                                                            <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                                            <td>R$ {{ number_format($release->amount, 2, ',','.') }}</td>
                                                            <td><span class="badge badge-{{$release->status->color}} badge-pill">{{$release->status->name}}</span></td>
                                                            <div style="display: none">{{$total2 += $release->amount}}</div>
                                                            <td>
                                                            <a href="{{route('release.show', $release->id)}}" class="btn btn-smoke btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                                            <a href="{{route('client.edit', $release->id)}}" class="btn btn-warning btn-icon-style-4 btn-sm"><i class="far fa-edit"></i></a>
                                                            </td>
                                                        </tr>                            
                                                    @endif
                                                @endforeach
                                                <tfoot class="border-bottom border-1">
                                                    <tr>
                                                        <th colspan="2" class="text-right font-weight-600">Total : </th>
                                                        @if($release->status_id != $status->id)  
                                                        <th class="text-left font-weight-600"> R$ {{ number_format($total2, 2, ',','.') }}</th>
                                                        @else
                                                        <th class="text-left font-weight-600">Sem Valor</th>                                                        
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
                    @else
                        <div class="tab-pane active p-3" id="tab_{{$status->id}}" role="tabpanel">
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
                                        <div style="display: none">
                                            {{ $total = 0 }}
                                        </div>                
                                            @if($releases = $client->releases)
                                                @foreach($releases as $release)
                                                    @if($release->status_id != $status->id)                                                
                                                        @else
                                                        <tr>
                                                            <td>{{$release->type_id}} - {{$release->type->name}}</td>
                                                            <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                                            <td>R$ {{ number_format($release->amount, 2, ',','.') }}</td>
                                                            <td><span class="badge badge-{{$release->status->color}} badge-pill">{{$release->status->name}}</span></td>
                                                            <div style="display: none">{{$total += $release->amount}}</div>
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
                                                        @if($release->status_id != $status->id);
                                                        <th class="text-left font-weight-600 ">Sem Valor</th>
                                                        @else
                                                        <th class="text-left font-weight-600">R$ {{ number_format($total, 2, ',','.') }}</th>
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
@endsection