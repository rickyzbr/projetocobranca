@section('title', 'Cobrança | Gestão de Clientes')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Clientes</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gestão de Cobranças</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h4 class="hk-pg-title"><span class="fas fa-users"></span> Gerenciamento dos Lançamentos de Clientes Devedores</h4>
</div>

<div class="row">
    <div class="col-xl-12">

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
                                </select>
                            </div>
                            <div class="col-md-3">
                            <label for="country">Status</label>
                                            <div class="input-group">
                                            <select class="form-control custom-select d-block w-100"  id="status_id" name="status_id">
                                    <option value="">Selecione...</option>
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


<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">Relação de Lançamento de : {{$partner->name}} </h5>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                    <div class="btn-group">
                        <div class="dropdown">
                            <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle" disabled type="button"><i class="fa fa-edit"></i>Ações <span class="caret"></span></button>
                            <div role="menu" class="dropdown-menu">
                                @foreach ($users as $user)
                                <button type="button" class="dropdown-item" onclick="submitForm('{{ route('release.status') }}', '{{ $user->id }}' )">{{ $user->name }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkAll">
                                        <label class="custom-control-label" for="checkAll">Tipo de Cobrança</label>
                                    </div>
                                </th>
                                <th>Status</th>
                                <th>Vencimento</th>
                                <th>Valor</th>
                                <th>Cobrador:</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($releases as $release)
                                @if($release->client_id)
                                <tr>
                                    <td>
                                    <small>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="checkbox[]" data-id="{{$release->id}}"  value="{{$release->id}}" id="{{$release->id}}">
                                            <label class="custom-control-label" for="{{$release->id}}">{{$release->id}} - {{$release->type->name}}</label>
                                        </div> 
                                    </small>
                                    </td>
                                    <td><small>{{$release->status->name}}</small></td>
                                    <td><small>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</small></td>
                                    <td><small>R$ {{ number_format($release->amount, 2, ',','.') }}</small></td>
                                    <td><small>@if($release->assigned_to) {{$release->assigned->name}} @else Sem Cobrador @endif</small></td>
                                    <td>
                                    <a href="{{route('releases.manager.view', $release->client->id)}}" class="btn btn-indigo  btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endif
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
            if ($('.check-item:checked').length > 0){
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