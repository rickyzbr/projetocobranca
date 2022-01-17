<div id="add_cargo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Novo Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h5>{{$client->name}}</h5>
                
                <form action="{{ route('cargo.store') }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group row">
                <div class="form-group col-xl-12">
                    <label for="Endereco">Nome : </label>
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                </div>
               
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"> FECHAR </button>
                <button type="submit"  class="btn btn-primary waves-effect waves-light"> CADASTRAR </button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->