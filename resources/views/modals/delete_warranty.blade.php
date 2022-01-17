<div id="delWan{{ $warranty->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Apagar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h5>@if($warranty->client_id)
                    {{$warranty->client->name}}
                    @else
                    -
                    @endif</h5>
                <p>Voce Tem certeza que irá apagar o Laudo da empresa  Acima ? </p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"> FECHAR </button>
                
                <form action="{{ route('warranty.destroy', $warranty->id) }}" method="post">
                {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit"  class="btn btn-primary waves-effect waves-light"> APAGAR </button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->