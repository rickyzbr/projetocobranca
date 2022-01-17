<div class="collapse" id="newCharge">
    <br>
    <div class="card card-body">
    <h5>Referencias para contato</h5>
    <p>{{ $client->razao_social }} 
    @if($partners = $client->partnersClient)
    @foreach($partners as $partner)
    <p>{{ $partner->partner->name }} - {{ $partner->partner->phone }}</p>
    @endforeach
    @endif   
    <h6>Telefones Fixos Franquia</h6>
    <p>{{ $client->phone01 }} - {{ $client->phone02 }}</p>
    <hr>

    <form method="POST" enctype="multipart/form-data" action="{{ route('charge.store', $client->id) }}" >
                @csrf
                <div class="row">
                <div class="col-md-4 form-group">
                        <label for="lastName">Sócio</label>
                        <select class="form-control custom-select d-block w-100" id="partner_id" name="partner_id">
                            <option value="">Selecione...</option>
                            @if($partners = $client->partnersClient)
                                    @foreach($partners as $partner)
                            <option value="{{$partner->partner_id}}"
                                    @if( isset($partner) && $partner->client_id == $partner->partner->id )
                                        selected
                                    @endif
                                    >{{$partner->partner->name}}</option> 
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <input type="hidden" name="date" value="{{ $mytime }}">
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <div class="col-md-5 form-group">
                        <label for="firstName">Com Quem Falou</label>
                        <input class="form-control" id="name" name="name" value="{{ old('name') }}"  type="text">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="firstName">Telefone</label>
                        <input class="form-control" id="phone" name="phone" value="{{ old('phone') }}"  type="text">
                    </div>                    
                    <div class="col-md-12 form-group">
                        <label for="lastName">Descrição do Contato</label>
                        <textarea class="form-control" name="description" rows="4" placeholder="Textarea"></textarea>
                    </div>
</div>
<button class="btn btn-sm btn-primary" type="submit">Cadastrar</button>
</div>

    </form>
</div>