@section('title', 'Cobrança | Gestão de Clientes')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Cobrança</a></li>
        <li class="breadcrumb-item"><a href="{{route('releases.manager.index')}}">Gerenciamento</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cobradores</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h5 class="hk-pg-title"><span class="fas fa-user"></span> Atribuir os lançamentos a um Cobrador</h5>
</div>
<div class="row">
    <div class="col-xl-12">
        <section class="hk-sec-wrapper">
            <h6 class="hk-sec-title">{{$client->name}}</h6>
            <p class="mb-40">Selecione os lancamentos que desejaabaixo para vincular a um cobrador especifico !</p>
                <div class="row">
                    <div class="col-sm">
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
                                        <th>Cobrador</th>
                                        <th>Status</th>
                                        <th>Atraso</th>
                                        <th>Vencimento</th>
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
                                        <td>@if($release->assigned_to)  <span class="badge badge-info badge-outline badge-pill">{{$release->assigned->name}}</span> @else <span class="badge badge-danger badge-pill"> Sem Cobrador @endif</span></small></td>
                                        <td><span class="badge badge-{{$release->status->color}} badge-pill">{{$release->status->name}}</span></td>
                                        
                                        <td>{{ date( 'd/m/Y' , strtotime($release->due_date))}}</td>
                                        <td>R$ {{ number_format($release->amount, 2, ',','.') }}</td>
                                        <td>R$ {{ number_format($release->newAmount(), 2, ',','.') }}</td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <div class="btn-group">
                                                <div class="dropdown">
                                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle" disabled type="button">Cobrador <span class="fas fa-user"></span> <span class="caret"></span></button>
                                                    <div role="menu" class="dropdown-menu">
                                                        @foreach ($users as $user)
                                                        <button type="button" class="dropdown-item" onclick="submitForm('{{ route('release.assigned') }}', '{{ $user->id }}' )">{{ $user->name }}</button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>Cobrador</th>
                                        <th>Status</th>
                                        <th>Vencimento</th>
                                        <th>Valor Devido</th>
                                        <th>Valor Atual</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
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

    <!-- FeatherIcons JavaScript -->
    <script src="{{ asset('dist/js/feather.min.js') }}"></script>

    <script type="text/javascript">

        function submitForm(url, user){
            
            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#MyForm').serialize() + '&user=' + user,
                
                success: function (data) {     
                    if (data.success) {
                        $.toast({
                            heading: 'Feito !',
                            text: "Você Alterou o Cobrador com Sucesso !",
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