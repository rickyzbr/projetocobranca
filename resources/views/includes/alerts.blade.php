@if ($errors->any())
<div class="callout callout-danger"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> 
        @foreach ($errors->all() as $error)
        <h4><i class="icon fa fa-ban"></i> ERRO !</h4>
        <p>{{ $error }}</p>
        @endforeach
    </div> 
@endif

@if(Session::has('success'))
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

@section('scripts')
@parent

@if(Session::has('success'))
<script>
		$.toast({
		heading: 'Feito !',
		text: '<p>{!! Session::get('success') !!}</p>',
		position: 'top-right',
		loaderBg:'#00acf0',
		class: 'jq-toast-primary',
		hideAfter: 3500, 
		stack: 6,
		showHideTransition: 'fade'
	});
</script>
@endif

@endsection

