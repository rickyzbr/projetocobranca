<div class="modal fade" id="newModalCharge" tabindex="-1" role="dialog" aria-labelledby="newModalCharge" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Agendamento de Cobrança</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('charge.schedule', $client->id) }}" >
                    @csrf
                    <div class="form-group">
                        <label for="inputEvent">Franquia</label>
                        <input type="text" placeholder="Event" id="inputEvent" name="" class="form-control" value="{{$client->name}}">
                    </div>
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <input type="hidden" name="url" value="{{ $client->id }}/listar">
                    <div class="form-group">
                        <label for="Sócio">Sócio</label>
                        <select class="form-control custom-select d-block w-100" id="partner_id" name="partner_id">
                            <option value="">Selecione...</option>
                            @if($partners = $client->partnersClient)
                                    @foreach($partners as $partner)
                            <option value="{{$partner->id}}"
                                    @if( isset($partner) && $partner->client_id == $partner->partner->id )
                                        selected
                                    @endif
                                    >{{$partner->partner->name}}</option> 
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Sucesso</label>
                        <select class="form-control custom-select d-block w-100" id="success" name="success">
                            <option value="">Selecione...</option>
                            <option value="1">SIM</option>
                            <option value="0">NÃO</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start">Inicio</label>
                        <input type="datetime-local" name="start"  class="form-control" value="$mytime">
                    </div>
                    <div class="form-group">
                        <label for="end">Fim</label>
                        <input type="datetime-local" name="end" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <button id="add_event" class="btn btn-success btn-block mr-10" type="submit">Gerar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>