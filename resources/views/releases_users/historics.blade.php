@section('title', 'Cobrança | Histórico de Cobranças')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item"><a href="{{route('releasesuser.index')}}">Minhas Cobranças</a></li>
        <li class="breadcrumb-item"><a href="{{route('releasesuser.list', $client->id)}}">Franquia</a></li>
        <li class="breadcrumb-item active" aria-current="page">Histórico</li>
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
            <h6 class="hk-sec-title">Histórico de Cobranças da Franque de : {{$client->name}} </h6>
            <hr>
                    <div class="table-wrap">
                        <table id="list_1" class="table table-hover w-100 display pb-30">
                                <thead >
                                    <tr>
                                        <th class="w-25">Contato Com ?</th>
                                        <th>Com quem Falou </th>
                                        <th>Exito</th>
                                        <th>Telefone</th>
                                        <th>Descrição</th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                    @foreach($historics as $historic)
                                    <tr>
                                        <td>@if($historic->partner_id) <span class="badge badge-soft-success badge-pill">{{$historic->partner->name}}</span> @else <span class="badge badge-danger badge-pill">Sem CPF Vinculado @endif</span></td>
                                        <td>{{$historic->name}}</td>
                                        <td>@if ( $historic->success == '1')
                                            <span class="badge badge-success badge-pill">SIM</span>
                                            @else
                                            <span class="badge badge-danger badge-pill">NÃO</span>
                                            @endif
                                        </td>
                                        <td>{{$historic->number}}</td>  
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#descriptionCharge_{{$historic->id}}">
                                            <i class="far fa-list-alt"></i>  Descrição
                                            </button>
                                        </td>                                      
                                    @include('modals.description_charge')
                                    </tr>S                                    
                                    @endforeach
                                </tbody> 
                                                               
                            </table>  
                            <hr>            
                </div>
            </div>                             
                </div>
        </section>
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