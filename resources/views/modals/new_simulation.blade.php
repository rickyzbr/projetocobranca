<div class="modal fade" id="newSimulation_{{ $client->id }}" tabindex="-1" role="dialog" aria-labelledby="newSimulation_{{ $client->id }}" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h6 class="modal-title text-white" id="exampleModalPopoversLabel">Simulação de Acordo</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('releasesuser.simulation', $client->id) }}" >
                    @csrf
                    <div class="form-group">
                        <label for="inputEvent">Franquia</label>
                        <input type="text" placeholder="Event" id="inputEvent" name="title" class="form-control" value="{{$client->name}}">
                    </div>
                    <input type="hidden" name="client_id" value="{{ $client->id }}">                    
                    <div class="form-group">
                        <label for="lastName">Valor Devido</label>
                        <input class="form-control" id="agreements_amount" name="agreements_amount" value="{{ number_format($totalnew, 2, ',','.')}}" type="text">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Entrada</label>
                        <input class="form-control" id="inflow" name="inflow" value="0" type="text">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Parcelas</label>
                        <input class="form-control" id="installments" name="installments" type="number"  value="{{ old('installments') }}" type="text">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Primeiro Vencimento</label>
                        <input class="form-control" id="due_date" name="due_date" value="{{ $mytime->format('Y-m-d') }}" type="date">
                    </div>                   
                    <div class="form-group">
                        <button class="btn btn-success btn-block mr-10" type="submit">Simular</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>