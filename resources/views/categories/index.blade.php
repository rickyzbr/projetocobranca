@section('title', 'Cobrança | Gestão de Produtos')

@extends ('layouts.app')

@section('content_header')
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Produtos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Gestão de Categories</li>
    </ol>
</nav>
@stop
<!-- end row -->

@section('content')
<div class="hk-pg-header">
    <h4 class="hk-pg-title"><span class="fas fa-users"></span> Gerenciamento das Categorias dos Produtos</h4>
</div>


<section class="hk-sec-wrapper">
    <div class="row mb-10">
        <div class="col-sm">
        <ul class="nav nav-pills nav-light bg-light pa-15 float-right " role="tablist">
            <li class="nav-item pr-10">
                <a  class="nav-link link-icon-top bg-light border border-light-20" data-toggle="modal" data-target="#newCategories"><i class="far fa-user-circle"></i>Novo</a>
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
    
</section>
@include('modals.new_category')
@include('includes.alerts')
<div id="form-messages" class="alert success" role="alert" style="display: none;"></div>
<section class="hk-sec-wrapper">
    <h5 class="hk-sec-title">Lista das Categorias Cadastradas</h5>
    <div class="row">
        <div class="col-sm">
            <div class="table-wrap">
                <div class="table-responsive">
                <div class="btn-group">
                    <div class="dropdown">
                        <button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle" disabled type="button">Ações <span class="caret"></span></button>
                        <div role="menu" class="dropdown-menu">
                            <button type="button" class="dropdown-item" onclick="submitForm('{{ route('categories.status') }}', '1' )">Ativo</button>
                            <button type="button" class="dropdown-item" onclick="submitForm('{{ route('categories.status') }}', '0' )">Inativo</button>
                            <div class="dropdown-divider"></div>
                            <button type="button" class="dropdown-item" onclick="submitForm('{{ route('staff.categories.delete') }}')">Apagar</button>
                        </div>
                    </div>
                </div>
                <form method="POST" action="" id="MyForm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"></th>
                                <th class="w-10">Imagem</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Autor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                            <td><input type="checkbox" class="check-item" name="checkbox[]" data-id="{{$category->id}}"  value="{{$category->id}}"></td>
                                <td> @if ($category->image != null)
                                    <img src="{{ url('storage/'.$category->image) }}" alt="{{ $category->image }}" style="max-width: 120px;">
                                    @else
                                    <img src="{{ url('dist/img/sem-produto.jpg') }}" alt="Sem Imagem" style="max-width: 120px;">
                                @endif</td>
                                <td>{{$category->name}}</td>
                                <td>@if ( $category->status == '1')
                                    <span class="badge badge-success">Ativo</span>
                                    @else
                                    <span class="badge badge-danger">Inativo</span>
                                    @endif
                                </td>
                                <td>{{$category->user->name}}</td>
                                <td>
                                 <a href="{{route('category.edit', $category->id)}}" class="btn btn-warning btn-icon-style-4 btn-sm"><i class="far fa-edit"></i></a>
                                <a href="{{route('category.destroy', $category->id)}}" class="btn btn-danger btn-icon-style-4 btn-sm"><i class="far fa-trash-alt"></i></a>
                                  
                                </td>
                            </tr>
                        @endforeach
                        </tbody>                        
                    </table>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
</section>
@if (isset($dataForm))
    {!! $categories->appends($dataForm)->links("pagination::bootstrap-4") !!}
@else
    {!! $categories->links("pagination::bootstrap-4") !!}   
@endif
@stop

@section('scripts')
@parent
    <script src="{{ asset('vendors/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('dist/js/peity-data.js') }}"></script>

    <!-- Jasny-bootstrap  JavaScript -->
    <script src="{{ asset('vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js') }}"></script>

    <script type="text/javascript">

        function submitForm(url, status){
            
            console.log(status)
            $.ajax({
                url: url,
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#MyForm').serialize() + '&status=' + status,
                
                success: function (data) {       
                                
                    if (data.success) {
                        $.toast({
                            heading: 'Feito !',
                            text: "Cadastros Selecionados foram Deletados Com Sucesso !",
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
                $('.check-item').each(function (){
                    this.checked = true;
                })
            } else {
                $('.check-item').each(function (){
                    this.checked = false;
                })
            }
            if ($('.check-item:checked').length > 0){
                $('.dropdown-toggle').removeAttr('disabled')
            } else {
                $('.dropdown-toggle').attr('disabled', true)
            }
        })

        $(document).on('click', '.check-item', function (){
            if ($('.check-item').length === $('.check-item:checked').length) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }

            if ($('.check-item:checked').length > 0){
                $('.dropdown-toggle').removeAttr('disabled')
            } else {
                $('.dropdown-toggle').attr('disabled', true)
            }
        })   
    </script>

@endsection