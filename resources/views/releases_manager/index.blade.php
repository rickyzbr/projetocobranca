@section('title', 'Cobrança | Gestão de Clientes')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gerenciamento</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h5 class="hk-pg-title"> <span class="fas fa-users"></span> Gerenciamento dos Lançamentos de Clientes Devedores</h5>
</div>

<div class="row">
    <div class="col-xl-12">


<section class="hk-sec-wrapper">
    <h6 class="hk-sec-title">Clientes Devedores </h6>
    <div class="row">
        <div class="col-sm">
        <div class="table-wrap">
            <table id="list_1" class="table table-hover w-100 display pb-30">
                <thead>
                    <tr>
                        <th>Franquia</th>
                        <th>CNPJ</th>
                        <th>Fone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        @if($client->releases->count() > 0)
                        <tr>
                            <td>
                                @if ($client->number_of_vencs())
                                    {{$client->name}} <span class="badge badge-danger badge-pill">{{$client->releases->count()}}</span>
                                @else
                                    {{$client->name}}
                                @endif
                            </td>
                            <td>{{$client->cnpj}}</td>
                            <td>{{$client->phone01}}</td>
                            <td>
                            <a href="{{route('releases.manager.view', $client->id)}}" class="btn btn-indigo  btn-icon-style-4 btn-sm"><i class="far fa-eye"></i></a>
                            <a href="{{route('releases.manager.list', $client->id)}}" class="btn btn-pumpkin btn-icon-style-4 btn-sm"><i class="far fa-user"></i></a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
                    <tfoot>
                        <tr>
                            <th>Franquia</th>
                            <th>CNPJ</th>
                            <th>Fone</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                </table>                   
                </div>
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