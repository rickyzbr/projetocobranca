@if ($errors->any())
<div class="callout callout-danger"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
        @foreach ($errors->all() as $error)
        <h4><i class="icon fa fa-ban"></i> ERRO !</h4>
        <p>{{ $error }}</p>
        @endforeach
    </div> 
@endif

@if (session('success'))
    <div class="alert alert-success alert-wth-icon alert-dismissible fade show" role="alert">
        <span class="alert-icon-wrap"><i class="zmdi zmdi-check-circle"></i></span> <strong>Sucesso !</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif



@if (session('error'))
    <div class="alert alert-warning alert-wth-icon alert-dismissible fade show" role="alert">
        <span class="alert-icon-wrap"><i class="zmdi zmdi-help"></i></span> <strong>Erro !</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

