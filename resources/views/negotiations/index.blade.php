@section('title', 'Cobrança | Negociações')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item active" aria-current="page">Negociações em Andamento</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h5 class="hk-pg-title"><span class="fas fa-users"></span> Lista de Negociações </h5>
</div>

@include('includes.alerts')

<section class="hk-sec-wrapper">
    <h6 class="hk-sec-title">Lista de Clientes a serem cobrados</h6>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Franquia</th>    
                                <th><span class="far fa-calendar-alt"></span></th>                             
                                <th>CNPJ</th>
                                <th>Valor</th>
                                <th>Ultima Cobrança</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            @foreach($releases as $release)
                                <tr>
                                    <td>{{$release->client->name}}</td>
                                    <td> </td>
                                    <td>{{$release->client->cnpj}}</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                    <a href="{{route('releasesuser.manage', $release->client_id)}}" class="btn btn-primary btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach                        
                        </tbody>
                    </table>
                </div>
            </div>
           
        </div>
    </div>
</section>
@if (isset($dataForm))
    {!! $releases->appends($dataForm)->links("pagination::bootstrap-4") !!}
@else
    {!! $releases->links("pagination::bootstrap-4") !!}   
@endif
@stop

@section('scripts')
@parent
    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>
@endsection