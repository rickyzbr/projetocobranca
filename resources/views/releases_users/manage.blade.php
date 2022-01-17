@section('title', 'Cobrança | Gestão de Cobrança')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item"><a href="{{route('releasesuser.index')}}">Minhas Cobranças</a></li>
        <li class="breadcrumb-item"><a href="{{route('releasesuser.list', $client->id)}}">Franquia</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualização</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h5 class="hk-pg-title"><span class="fas fa-users"></span> Relação de Lançamentos em aberto a ser cobrado !</h5>
</div>
@include('includes.alerts')

<div class="row">
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h6 class="hk-sec-title">Relação de Lançamentos Vencidos de : {{$client->name}} </h6>
            <hr>
            <div class="row">
                <div class="col-sm ">
                    <nav class="navbar navbar-expand-xl navbar-light bg-light navbar-demo">
                        <div class="collapse navbar-collapse" id="navbarSupportedColor1">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item  pr-10">
                                    <a class="btn btn-success btn-sm" href="{{route('agreement.create', $client->id)}}" >
                                    <i class="far fa-handshake"></i > Contrato</a>
                                </li>
                            </ul>                            
                            <ul class="navbar-nav align-items-center flex-row">
                            </li> 
                                <li class="nav-item  pr-10">
                                    <a class="btn btn-warning btn-sm"  href="#" data-toggle="modal" data-target="#newSimulation_{{ $client->id }}" >
                                    <i class="fas fa-dollar-sign"></i> Simular</a>
                                </li>
                                <li class="nav-item  pr-10">
                                    <a class="btn btn-info btn-sm" href="{{route('releasesuser.list', $client->id)}}" >
                                    <i class="far fa-arrow-alt-circle-left"></i > Voltar</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    @include('collapse.new_charge')
                    @include('collapse.client_details')
                </div>
            </div>  
           
                    
                    <hr>
                    @if($countPartners != 0)
                        <div class="alert alert-warning alert-wth-icon alert-dismissible fade show" role="alert">
                            <span class="alert-icon-wrap"><i class="zmdi zmdi-alert-circle-o"></i></span> Existem {{$countPartners}} Lancamentos Sem CPF Vinculado !
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-wrap">
                    <form method="POST" action="" id="MyForm">
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
                                <div style="display: none">
                                    {{ $total = 0 }}
                                    {{ $totalnew = 0 }}
                                </div>
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
                                        <th>
                                            <div class="btn-group">
                                                <div class="dropdown">
                                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-sm btn-info dropdown-toggle" disabled type="button">Mudar Status <span class="fas fa-user"></span> <span class="caret"></span></button>
                                                    <div role="menu" class="dropdown-menu">
                                                        @foreach ($statuses as $status)
                                                        <button type="button" class="dropdown-item" onclick="submitForm('{{ route('releasesuser.status') }}', '{{ $status->id }}' )">{{ $status->name }}</button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-right font-weight-600">Total :</th>
                                        <th class="text-left font-weight-600">R$ {{number_format($total, 2, ',','.')}}</th>
                                        <th class="text-left font-weight-600">R$ {{number_format($totalnew, 2, ',','.')}} - R$ {{number_format($totalnew, 4, '.', '')}}</th>                                        
                                    </tr>
                                </tfoot>
                            </table>    
                        </form>              
                </div>
            </div>                             
        </div>
    </div>
</section>
        @include('modals.new_simulation')
@stop

@section('scripts')
@parent
    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>

    <!-- Data Table JavaScript -->
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min') }}.js"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dist/js/dataTables-data.js') }}"></script>

    <!-- Daterangepicker JavaScript -->
    <script src="{{ asset('vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('dist/js/daterangepicker-data.js') }}"></script>


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