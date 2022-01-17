@section('title', 'Cobrança | Gestão de Clientes')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item"><a href="{{route('releases.manager.index')}}">Gerenciamento</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dividias por Sócio</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h5 class="hk-pg-title"><span class="fas fa-users"></span> Gerenciamento de Cobrança do Franqueado</h5>
</div>

@include('includes.alerts')

<section class="hk-sec-wrapper">
    <div class="hk-pg-header mb-10">
        <div>
            <h4 class="hk-pg-title"><span class="pg-title-icon"><i class="ion ion-md-bookmarks"></i></span>{{ $client->id }} - {{ $client->name }} - {{ $client->state }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper hk-invoice-wrap pa-35">                
                <h5>Lançamentos de Dividas Por Sócio</h5>
                <p>{{ $client->razao_social }} - {{ $client->state }}</p>
                <hr>
                <div class="invoice-details">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-striped table-border mb-0">
                                <thead>
                                    <tr>
                                        <th class="w-30">Nome</th>
                                        <th >CPF</th>
                                        <th>Email</th>
                                        <th>Dividas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($partners = $client->partnersClient)
                                    @foreach($partners as $partner)
                                    <tr>
                                    @if($partner->partner_id)
                                        <td>{{$partner->partner->name}}</td>
                                        <td>{{$partner->partner->cpf}}</td>
                                        <td>{{$partner->partner->email}}</td>
                                        <td> @if ($partner->partner->releases->count())
                                            <a href="{{route('releases.manager.list_partner', $partner->partner->id)}}" class="btn btn-danger btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                                        @else
                                            <a href="" class="btn btn-success btn-icon-style-4 btn-sm"><i class="far fa-check-circle"></i></a>
                                        @endif</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                <hr>
                <h5>Lançamentos de Dividas</h5>
                <hr>
                @if($countPartners != 0)
                <div class="alert alert-warning alert-wth-icon alert-dismissible fade show" role="alert">
                    <span class="alert-icon-wrap"><i class="zmdi zmdi-alert-circle-o"></i></span> Existem {{$countPartners}} Lancamentos Sem CPF Vinculado !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="invoice-details">
                <div class="table-wrap">
                            <form method="POST" action="" id="MyForm">
                            <table id="list_1" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th class="w-25">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                                <label class="custom-control-label" for="checkAll">Tipo de Cobrança</label>
                                            </div>
                                        </th>
                                        <th>Status</th>
                                        <th>Vencimento</th>
                                        <th>Devedor</th>
                                        <th>Valor Devido</th>
                                        <th>Valor Atual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($releases = $client->releases)
                                    @foreach($releases as $release)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="checkbox[]" data-id="{{$release->id}}"  value="{{$release->id}}" id="{{$release->id}}">
                                                <label class="custom-control-label" for="{{$release->id}}">{{$release->type->name}}</label>
                                            </div> 
                                        </td>
                                        <td><span class="badge badge-{{$release->status->color}} badge-pill">{{$release->status->name}}</span></td>
                                        <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                        <td>@if($release->partner_id) <span class="badge badge-soft-success badge-pill">{{$release->partner->name}}</span> @else <span class="badge badge-danger badge-pill">Sem CPF Vinculado @endif</span></small></td>
                                        <td>R$ {{ number_format($release->amount, 2, ',','.') }}</td>
                                        <td>R$ {{ number_format($release->newAmount(), 2, ',','.') }}</td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <div class="btn-group">
                                                <div class="dropdown">
                                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle" disabled type="button">Sócio <span class="fas fa-user"></span> <span class="caret"></span></button>
                                                    <div role="menu" class="dropdown-menu">
                                                        @foreach ($partners as $partner)
                                                        <button type="button" class="dropdown-item" onclick="submitForm('{{ route('release.partner') }}', '{{ $partner->partner->id }}' )">{{ $partner->partner->name }}</button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>Status</th>
                                        <th>Vencimento</th>
                                        <th>Devedor</th>
                                        <th>Valor Devido</th>
                                        <th>Valor Atual</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                        </div>
                    </div>
                </div>
                <hr>
                <ul class="invoice-terms-wrap font-14 list-ul">
                    @if($countPartners != 0)
                    <li>
                        Existem Lancamentos Sem CPF Vinculado !
                    </li>
                    @endif                      
                </ul>
            </section>
        </div>
    </div>
                <!-- /Row -->
</section>

@stop

@section('scripts')
@parent
    <!-- Tablesaw table CSS -->
    <link href="{{ asset('vendors/tablesaw/dist/tablesaw.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>

    <!-- Tablesaw JavaScript -->
    <script src="{{ asset('vendors/tablesaw/dist/tablesaw.jquery.js') }}"></script>
    <script src="{{ asset('dist/js/tablesaw-data.js') }}"></script>

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

    <!-- FeatherIcons JavaScript -->
    <script src="{{ asset('dist/js/feather.min.js') }}"></script>

    <script type="text/javascript">

        function submitForm(url, partner){
            
            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#MyForm').serialize() + '&partner=' + partner,
                
                success: function (data) {     
                    if (data.success) {
                        $.toast({
                            heading: 'Feito !',
                            text: "Você Cadastrou um CPF do Sócio com Sucesso !",
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